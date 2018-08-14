<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\RejectPendingOrder;
use App\Notifications\PaymentConfirmed;
use App\Notifications\NewPendingOrderForSeller;
use Carbon\Carbon;
use App\Payment;

class PaymentController extends Controller
{
    public function __construct()
    {
    	$this->middleware(['auth', 'admin.only']);
    }

   	public function index()
    {   
        
		if (request('code')) {
		    $payments = Payment::where('code', 'like', '%'.request('code').'%')->orderBy('is_paid', 'asc')->paginate(20);
		} else {
		    $payments = Payment::orderBy('is_paid', 'asc')->paginate(20);
		}
		return view('back.payment.index', compact('payments'));
     
    }

    public function detail(Payment $payment)
    {
        return view('back.payment.detail', compact('payment'));
    }

    public function done(Payment $payment)
    {
        $payment->is_paid = 1;
        $payment->save();


        //notofikasi pembayaran selesai
        $pembeli = $payment->user;
        $pembeli->notify(new PaymentConfirmed($payment));

        //dispatch delete order if pending in spesific time
        foreach ($payment->orders as $order) {
            RejectPendingOrder::dispatch($order)->delay(now()->addMinutes(env('REJORMIN_QUEUE')));

            //notify seller
            $seller = $order->store->user;
            $seller->notify(new NewPendingOrderForSeller($order));
        }

        return redirect()->route('admin.payment.index')
        ->with('success', 'Pembayaran '.$payment->getCode().' telah dibayar');
    }

    public function print()
    {
        $dari = Carbon::createFromFormat('d/m/Y', request('dari'))->toDateString();
        $sampai = Carbon::createFromFormat('d/m/Y', request('sampai'))->toDateString();
        $payments = Payment::where('is_paid', 1)->whereBetween('created_at', [$dari, $sampai])->get();
        return view('print.payment', compact('payments'));
    }
}
