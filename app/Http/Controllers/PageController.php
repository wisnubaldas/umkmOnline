<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class PageController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth')->only('dashboard');
	}

    public function index()
    {
    	$products = Product::all();
    	return view('front.index', compact('products'));
    }
}
