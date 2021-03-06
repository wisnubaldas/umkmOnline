<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class NotificationController extends Controller
{
    public function __construct()
    {
    	$this->middleware(['auth', 'admin.only']);
    }

    public function index()
    {
    	foreach (Auth::user()->unreadNotifications as $n) {
    		$n->markAsRead();
    	}
    	$notifications = Auth::user()->notifications;
    	return view('back.notification.index', compact('notifications'));
    }
}
