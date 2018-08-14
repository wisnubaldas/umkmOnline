<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function __construct()
    {
    	$this->middleware(['auth', 'admin.only']);
    }

    public function index()
    {
    	if (request('code')) {
		    $orders = Order::where('code', 'like', '%'.request('code').'%')->orderBy('created_at', 'desc')->paginate(20);
		} else {
		    $orders = Order::orderBy('created_at', 'desc')->paginate(20);
		}
		return view('back.order.index', compact('orders'));
    }

    public function detail(Order $order)
    {
        return view('back.order.detail', compact('order'));
    }

    public function print()
    {
        $dari = Carbon::createFromFormat('d/m/Y', request('dari'))->toDateString();
        $sampai = Carbon::createFromFormat('d/m/Y', request('sampai'))->toDateString();
        $orders = Order::whereBetween('created_at', [$dari, $sampai])->get();
        return view('print.order', compact('orders'));
    }
}
