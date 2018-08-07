<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Order;
use App\AdminBank;
use App\Refund;

class RefundController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
        if (request('code')) {
            $rejectedOrders = Order::where('status_id', 5)
            ->where('code', 'like', '%'.request('code').'%')->orderBy('created_at', 'desc')->paginate(20);
        } else {
           $rejectedOrders = Order::where('status_id', 5)->orderBy('created_at', 'desc')->paginate(20); 
        }
    	
    	return view('back.refund.index', compact('rejectedOrders'));
    }

    public function create($code)
    {
    	$order = Order::where('code', $code)->first();
    	$order = Order::findOrFail($order->id);
    	$adminBanks = AdminBank::all();
    	return view('back.refund.create', compact('order', 'adminBanks'));
    }

    public function store(Request $request)
    {
    	$request->validate([
    		'order_id' => 'required',
    		'transfer_date' => 'required',
    		'admin_bank_id' => 'required',
    		'bank_account' => 'required|numeric',
    		'amount' => 'required|numeric',
    		'image' => 'required|image|mimes:jpeg,png|max:200'
    	]);

    	$order = Order::findOrFail($request->order_id);

    	//upload image
    	$filename = $order->getCode().'.'.$request->image->getClientOriginalExtension();
    	$request->image->move(public_path('img/refund'), $filename);

    	//insert database
    	Refund::create([
    		'order_id' => $order->id,
    		'transfer_date' => Carbon::createFromFormat('d/m/Y', $request->transfer_date)->toDateString(),
    		'admin_bank_id' => $request->admin_bank_id,
    		'user_bank_account' => $request->bank_account,
    		'amount' => $request->amount,
    		'image' => $filename
    	]);

    	//success
    	return redirect()->route('admin.refund.index')
    	->with('success', 'Konfirmasi Pengembalian Dana Pesanan Sukses');
    }

    public function show($code)
    {
        if (!request()->ajax()) {
            abort(404);
        }
    	$order = Order::where('code', $code)->firstOrFail();
    	$refund = $order->refund()->firstOrFail();
    	return view('back.refund.show', compact('refund'));
    }
}
