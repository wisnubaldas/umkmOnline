<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminPayment;
use Auth;

class AdminPaymentController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$finishedOrders = Auth::user()->store->orders()
    	->where('status_id', 4)->orderBy('created_at', 'desc')->paginate(20);
    	return view('front.adminPayment.index', compact('finishedOrders'));
    }

    public function show(Request $request, AdminPayment $adminPayment)
    {
    	if (!$request->ajax()) {
    		abort(404);
    	}
    	return view('front.adminPayment.show', compact('adminPayment'));
    }

    public function print()
    {
        $orders = Auth::user()->store->orders()
        ->where('status_id', 4)->orderBy('created_at', 'asc')->get();
        return view('print.pendapatan_toko', compact('orders'));
    }
}
