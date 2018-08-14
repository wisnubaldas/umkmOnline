<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\FinishedOrderForSeller;
use App\Notifications\NewAdminPaymentForAdmin;
use App\Payment;
use App\Order;

class BuyController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(Request $request)
    {
    	$payments = Auth::user()->payments()->where('is_paid', 1)->orderBy('created_at', 'asc')->get();
    	return view('front.buy.index', compact('payments'));
    }

    public function show(Request $request, Order $order)
    {
    	if (!$request->ajax()) {
    		abort(404);
    	}
    	return view('front.buy.show', compact('order'));
    }

    public function completed()
    {
    	$orders = Auth::user()->orders()->where('status_id', 4)->orderBy('created_at', 'asc')->get();
    	return view('front.buy.completed', compact('orders'));
    }

    public function completing(Order $order)
    {
    	$order->status_id = 4;
    	$order->save();

        // notify seller
        $seller = $order->store->user;
        $seller->notify(new FinishedOrderForSeller($order));

        //notify admin
        $users = \App\User::all();
        foreach ($users as $user) {
            if ($user->isAdmin() || $user->isOperator()) {
                $user->notify(new NewAdminPaymentForAdmin($order));
            }
        }
        
    	return redirect()->route('buy.index');
    }

    public function print(Order $order)
    {
        return view('print.invoice', compact('order'));
    }
}
