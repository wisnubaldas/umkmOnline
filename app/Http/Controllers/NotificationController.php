<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class NotificationController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	foreach (Auth::user()->unreadNotifications as $n) {
    		$n->markAsRead();
    	}
    	$notifications = Auth::user()->notifications;
    	return view('front.notification.index', compact('notifications'));
    }
}
