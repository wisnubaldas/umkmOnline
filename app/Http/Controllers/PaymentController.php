<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Traits\Gencode;
use App\Payment;
use App\Cart;
use App\Order;
use App\Order_detail;
use App\AdminBank;

class PaymentController extends Controller
{
    use Gencode;

    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {   
    	$payments = Auth::user()->payments()->where('is_paid', 0)->get();
    	return view('front.payment.index', compact('payments'));
    }

    public function store(Request $request)
    {
        # insert payment
        $payment = new Payment();
        $payment->code = $this->generateCode('payments', 'pay');
        $payment->amount = $request->amount;
        $payment->user_id = Auth::id();
        $payment->save();

        # insert order
        $carts = Auth::user()->carts;
        foreach ($carts as $cart) {

            $cart->getOngkirJson();

            $order = new Order();
            $order->code = $this->generateCode('orders', 'ord');
            $order->store_id = $cart->store_id;
            $order->user_id = $cart->user_id;
            $order->subtotal = $cart->subtotal();
            $order->payment_id = $payment->id;
            $order->jne_service = $cart->jne_service;
            $order->ongkir = $cart->jumlahOngkir();
            $order->save();

            #insert order detail
            foreach ($cart->cart_details as $item) {
                $odetail = new Order_detail;
                $odetail->order_id = $order->id;
                $odetail->product_id = $item->product_id;
                $odetail->quantity = $item->quantity;
                $odetail->price = $item->product->price;
                $odetail->weight = $item->product->weight;
                $odetail->save();
            }
        }

    	$this->destroyCart();
    	return redirect()->route('payment.show', ['code' => $payment->code]);
    }

    public function show($code)
    {
        $payment = Payment::where('code', $code)->firstOrFail();
        $payment = Payment::findOrFail($payment->id);
        $adminBanks = AdminBank::all();
        return view('front.payment.show', compact('payment', 'adminBanks'));
    }

    private function destroyCart()
    {
    	$carts = Auth::user()->carts()->get();
    	foreach ($carts as $cart) {
    		$cart->delete();
    	}
    }
}
