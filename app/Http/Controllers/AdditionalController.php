<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Province;
use App\City;

class AdditionalController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function province(Request $request)
    {
    	if (!$request->ajax()) {
    		abort(404);
    	}
    	$provinces = Province::all();
    	return view('additional.province', compact('provinces'));
    }

    public function city(Request $request, Province $province)
    {
    	$cities = $province->cities()->get();
    	return view('additional.city', compact('cities'));
    }
}
