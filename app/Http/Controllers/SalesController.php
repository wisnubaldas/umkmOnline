<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Order;

class SalesController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(Request $request)
    {
    	if ($status = $request->get('status')) {
            $orders = Auth::user()->store->orders()->where('status_id', $status)->orderBy('created_at', 'asc')->get();
    		if ($status == 1) {
    			return view('front.sales.pending', compact('orders'));
    		} elseif ($status == 2){
                return view('front.sales.accepted', compact('orders'));
            } elseif ($status == 3) {
                return view('front.sales.sent', compact('orders'));
            } elseif ($status == 4) {
                return view('front.sales.completed', compact('orders'));
            } else {
                abort(404);
            }
    	} else {
    		abort(404);
    	}
    }

    public function show(Request $request, Order $order)
    {
        if (!$request->ajax()) {
            abort(404);
        }
        return view('front.sales.show', compact('order'));
    }

    public function accept(Order $order)
    {
        $order->status_id = 2;
        $order->save();
        return back();
    }

    public function send(Request $request, Order $order)
    {
        $order->resi_number = $request->resi_number;
        $order->status_id = 3;
        $order->save();
        return back();
    }

    public function updateResi(Request $request, Order $order)
    {
        $order->resi_number = $request->resi_number;
        $order->save();
        return back();
    }
}
