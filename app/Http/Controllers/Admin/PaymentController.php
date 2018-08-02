<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Payment;

class PaymentController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

   	public function index()
    {   
        
		if (request('code')) {
		    $payments = Payment::where('code', 'like', '%'.request('code').'%')->orderBy('is_paid')->paginate(20);
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
        return redirect()->route('admin.payment.index')
        ->with('success', 'Pembayaran '.$payment->getCode().' telah dibayar');
    }
}
