<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\NewStoreForAdmin;
use App\Store;
use App\StoreBank;
use App\Address;
use App\City;
use App\Province;
use Auth;
use File;
use Image;

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
            'bank_name' => 'required',
            'bank_account' => 'required|numeric',
            'under_the_name' => 'required',
    		'ktp' => 'required|image|mimes:jpeg,png|max:200',
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

        //insert store bank
        StoreBank::create([
            'store_id' => $store->id,
            'bank_name' => $request->bank_name,
            'bank_account' => $request->bank_account,
            'under_the_name' => $request->under_the_name
        ]);

        //notify admin
        foreach (\App\User::all() as $user) {
            if ($user->isAdmin() || $user->isOperator()) {
                $user->notify(new NewStoreForAdmin($store));
            }
        }

    	return redirect()->route('store.yours')->with('success', 'Toko sudah dibuat. Tunggu sampai admin mengaktifkan toko anda');
    }

    public function yours()
    {   
        $store = Auth::user()->store()->firstOrFail();
        $products = $store->products;
        $cities = City::all();
        $provinces = Province::all();
    	return view('front.store.yours', compact(
            'store', 'products', 'cities', 'provinces'
        ));
    }

    public function update(Request $request, Store $store)
    {
        if (!$request->ajax()) {
            abort(404);
        }
        $this->update_store($request, $store);
        return url('store/yours');
    }

    private function upload_image($request, $slug)
    {
         // upload image
        $filename = $slug . '.' . $request->store_image->getClientOriginalExtension();
        $path = public_path('img/store/' . $filename);
        $image = Image::make($request->store_image->getRealpath());
        $height = $image->height();
        $width = $image->width();
        if ($height < $width) {
            $image->crop($height, $height)->save($path); 
        } elseif ($height > $width) {
            $image->crop($width, $width)->save($path); 
        } else {
            $image->save($path);
        }
        return $filename;
    }

    private function update_store($request, $store)
    {
        if ($request->get('attr') == 'image') {
            $request->validate([
                'store_image' => 'required|image|mimes:jpeg,png|max:200'
            ]);

            //hapus photo lama
            if (!$store->isNullImage()) {
                File::delete(public_path('img/store/'.$store->image));
            }

            //upload image
            $filename = $this->upload_image($request, $store->slug);

            //update database
            $store->image = $filename;
            $store->save();

        } elseif ($request->get('attr') == 'name') {

            $request->validate([
                'store_name' => 'required|unique:stores,name,'.$store->id,
            ]);

            $store->name = $request->store_name;
            $store->slug = str_slug($request->store_name);
            $store->save();
        } elseif ($request->get('attr') == 'desc') {
            $request->validate([
                'store_description' => 'required',
            ]);

            $store->description = $request->store_description;
            $store->save();
        } elseif ($request->get('attr') == 'address') {
            $request->validate([
                'province_id' => 'required',
                'city_id' => 'required',
                'address' => 'required',
                'postal_code' => 'required',
                'phone' => 'required|numeric',
            ]);
            $store->address->province_id = $request->province_id;
            $store->address->city_id = $request->city_id;
            $store->address->address = $request->address;
            $store->address->postal_code = $request->postal_code;
            $store->address->phone = $request->phone;
            $store->address->save();
        } elseif ($request->get('attr') == 'bank') {
            $request->validate([
                'bank_name' => 'required',
                'bank_account' => 'required|numeric',
                'under_the_name' => 'required'
            ]);
            $store->bank->bank_name = $request->bank_name;
            $store->bank->bank_account = $request->bank_account;
            $store->bank->under_the_name = $request->under_the_name;
            $store->bank->save();
        }
    }
}
