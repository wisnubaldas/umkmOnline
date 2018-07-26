<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\Address;
use Auth;

class StoreController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function create()
    {
    	if (Auth::user()->isHaveStore()) {
    		return redirect()->route('store.yours');
    	}
    	return view('front.store.create');
    }

    public function store(Request $request)
    {
    	$request->validate([
    		'store_name' => 'required|unique:stores,name',
    		'store_description' => 'required',
    		'province_id' => 'required',
    		'city_id' => 'required',
    		'address' => 'required',
    		'postal_code' => 'required',
    		'phone' => 'required|numeric',
    		'ktp' => 'required|image|mimes:jpeg,png|max:200'
    	]);

    	$slug = str_slug($request->store_name);
    	//upload image
    	$ktp = $slug.'.'.$request->ktp->getClientOriginalExtension();
    	$request->ktp->move(public_path('img/store/ktp'), $ktp);

    	//insert database
    	$store = new Store();
    	$store->name = $request->store_name;
    	$store->description = $request->store_description;
    	$store->slug = $slug;
    	$store->user_id = Auth::id();
    	$store->ktp = $ktp;
    	$store->save();

    	//insert address
    	Address::create([
    		'store_id' => $store->id,
    		'phone' => $request->phone,
    		'address' => $request->address,
    		'city_id' => $request->city_id,
    		'province_id' => $request->province_id,
    		'postal_code' => $request->postal_code
    	]);

    	return redirect()->route('store.yours')->with('success', 'Toko sudah dibuat. Tunggu sampai admin mengaktifkan toko anda');
    }

    public function yours()
    {   
        $store = Auth::user()->store()->firstOrFail();
        $products = $store->products;
    	return view('front.store.yours', compact('store', 'products'));
    }
}
