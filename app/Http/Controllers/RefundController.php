<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Refund;
use Auth;

class RefundController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$rejectedOrders = Auth::user()->orders()->where('status_id', 5)->orderBy('created_at', 'desc')->paginate(20);
    	return view('front.refund.index', compact('rejectedOrders'));
    }

    public function show(Request $request, Refund $refund)
    {
    	if (!$request->ajax()) {
    		abort(404);
    	}
    	return view('front.refund.show', compact('refund'));
    }
}
