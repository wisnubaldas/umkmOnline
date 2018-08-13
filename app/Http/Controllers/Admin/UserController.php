<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	if (request('user_name')) {
            $users = User::where('name', 'like', '%'.request('user_name').'%')->paginate(20);
        } else {
            $users = User::orderBy('role_id', 'asc')->paginate(20);
        }
        return view('back.user.index', compact('users'));
    }

    public function profile(User $user)
    {
    	return view('back.user.profile', compact('user'));
    }

    public function destroy(User $user)
    {
    	$user->delete();
    	return redirect()->route('admin.user.index')->with('success', 'Berhasil hapus pengguna');
    }
}
