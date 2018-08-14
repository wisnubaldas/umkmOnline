<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\PaidAdminPaymentForSeller;
use Carbon\Carbon;
use App\Order;
use App\AdminBank;
use App\AdminPayment;

class AdminPaymentController extends Controller
{
    public function __construct()
    {
    	$this->middleware(['auth', 'admin.only']);
    }

    public function index()
    {
        if (request('code')) {
            $orders = $orders = Order::where('status_id', 4)
            ->where('code', 'like', '%'.request('code').'%')->orderBy('created_at', 'desc')->paginate(20);
        } else {
            $orders = Order::where('status_id', 4)->orderBy('created_at', 'desc')->paginate(20);
        }
    	
    	return view('back.adminPayment.index', compact('orders'));
    }

    public function create($code)
    {
    	$order = Order::where('code', $code)->firstOrFail();
    	$adminBanks = AdminBank::all();
    	return view('back.adminPayment.create', compact('order', 'adminBanks'));
    }

    public function store(Request $request)
    {
    	$request->validate([
    		'order_id' => 'required',
    		'transfer_date' => 'required',
    		'admin_bank_id' => 'required',
    		'store_bank_id' => 'required',
    		'amount' => 'required|numeric',
    		'image' => 'required|image|mimes:jpeg,png|max:200'
    	]);

    	$order = Order::findOrFail($request->order_id);

    	//upload image
    	$filename = $order->getCode().'.'.$request->image->getClientOriginalExtension();
    	$request->image->move(public_path('img/admin_payment'), $filename);

    	//insert database
    	AdminPayment::create([
    		'order_id' => $order->id,
    		'transfer_date' => Carbon::createFromFormat('d/m/Y', $request->transfer_date)->toDateString(),
    		'admin_bank_id' => $request->admin_bank_id,
    		'store_bank_id' => $request->store_bank_id,
    		'amount' => $request->amount,
    		'image' => $filename
    	]);

        //notify seller
        $order->store->user->notify(new PaidAdminPaymentForSeller($order));

    	//success
    	return redirect()->route('admin.adminPayment.index')
    	->with('success', 'Konfirmasi Pembayaran toko '.$order->store->name.' Sukses');
    }

    public function show($code)
    {
        if(!request()->ajax()){
            abort(404);
        }

        $order = Order::where('code', $code)->firstOrFail();
        $adminPayment = $order->admin_payment()->firstOrFail();
        return view('back.adminPayment.show', compact('adminPayment'));
    }

    public function print()
    {
        $dari = Carbon::createFromFormat('d/m/Y', request('dari'))->toDateString();
        $sampai = Carbon::createFromFormat('d/m/Y', request('sampai'))->toDateString();
        $orders = Order::where('status_id', 4)->whereBetween('created_at', [$dari, $sampai])->get();
        return view('print.admin_payment', compact('orders'));
    }
}
