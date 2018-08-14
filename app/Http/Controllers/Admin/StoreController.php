<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\StoreActivatedForSeller;
use App\Store;

class StoreController extends Controller
{
    public function __construct()
    {
    	$this->middleware(['auth', 'admin.only']);
    }

    public function index()
    {

        if (request('store_name')) {
            $stores = Store::where('name', 'like', '%'.request('store_name').'%')->paginate(20);
        } else {
            $stores = Store::orderBy('is_active', 'asc')->paginate(20);
        }
        return view('back.store.index', compact('stores'));
    }

    public function show(Store $store)
    {
        return view('back.store.show', compact('store'));
    }

    public function activate(Store $store)
    {
        $store->is_active = 1;
        $store->save();

        //notify seller
        $store->user->notify(new StoreActivatedForSeller($store));

        return redirect()->route('admin.store.show', ['store' => $store]);
    }

    public function nonActivate(Store $store)
    {
        $store->is_active = 0;
        $store->save();
        return redirect()->route('admin.store.show', ['store' => $store]);
    }

    public function print()
    {
        $stores = Store::all();
        return view('print.store', compact('stores'));
    }
}
