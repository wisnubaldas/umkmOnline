<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\Cart_detail;

class CartController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function index()
    {
        $carts = Auth::user()->carts;
        $totalPembayaran = 0;
        foreach ($carts as $cart) {
            $cart->getOngkirJson();
            $totalPembayaran += $cart->totalTagihan();
        }
        return view('front.cart.index', compact('carts', 'totalPembayaran'));
    }
	
    public function store(Request $request)
    {
    	if (!$request->ajax()) {
    		abort(404);
    	}

    	$product = Product::find($request->productId);

    	if ($this->isUniqueCart($product)) {
    		$cart = new Cart();
    		$cart->store_id = $product->store_id;
    		$cart->user_id = Auth::id();
    		$cart->save();
    		$this->createNewCartDetail($cart, $product, $request);
            $cart->getOngkirJson();
            $cart->pilihLayananJne();
	    	return $cart;
    	}

    	$cart = $this->getNotUniqueCart($product);
		if ($this->isUniqueCartDetail($cart, $product)) {
			$this->createNewCartDetail($cart, $product, $request);
		} else {
			$cart_detail = $this->getNotUniqueCartDetail($cart, $product);
			$cart_detail->quantity += $request->quantity;
			$cart_detail->save();
		}
    	
    	return $cart;
    }

    public function update(Request $request, Cart $cart)
    {
        $cart->jne_service = $request->jne_service;
        $cart->save();
        return redirect()->route('cart.index');
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect()->route('cart.index');
    }

    public function updateCartQuantity(Request $request, Cart_detail $cart_detail)
    {
        if ($request->quantity == 0) {
            return back();
        }
        $cart_detail->quantity = $request->quantity;
        $cart_detail->save();
        return redirect()->route('cart.index');
    }

    public function deleteCartDetail(Cart_detail $cart_detail)
    {
        $cart = $cart_detail->cart;
        $cart_detail->delete();
        if ($cart->cart_details()->count() < 1) {
            $cart->delete();
        }
        return redirect()->route('cart.index');
        
    }

    private function isUniqueCart($product)
    {
    	return Cart::where('user_id', Auth::id())->where('store_id', $product->store_id)->count() < 1;
    }

    private function isUniqueCartDetail($cart, $product)
    {
    	return Cart_detail::where('cart_id', $cart->id)->where('product_id', $product->id)->count() < 1;
    }

    private function getNotUniqueCart($product)
    {
    	return Cart::where('user_id', Auth::id())->where('store_id', $product->store_id)->first();
    }

    private function getNotUniqueCartDetail($cart, $product)
    {
    	return Cart_detail::where('cart_id', $cart->id)->where('product_id', $product->id)->first();
    }

    private function createNewCartDetail($cart, $product, $request)
    {
    	Cart_detail::create([
    		'cart_id' => $cart->id,
    		'product_id' => $product->id,
    		'quantity' => $request->quantity,
    	]);
    }
}
