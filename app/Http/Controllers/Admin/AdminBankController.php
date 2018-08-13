<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AdminBank;

class AdminBankController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$adminBanks = AdminBank::orderBy('created_at', 'desc')->paginate(20)->appends(request()->except('page'));
    	return view('back.bank.index', compact('adminBanks'));
    }

    public function store(Request $request)
    {
    	$request->validate([
    		'bank_name' => 'required',
    		'bank_account' => 'required',
    		'under_the_name' => 'required'
    	]);

    	AdminBank::create([
    		'bank_name' => $request->bank_name,
    		'bank_account' => $request->bank_account,
    		'under_the_name' => $request->under_the_name,
    	]);

    	$adminBanks = AdminBank::orderBy('created_at', 'desc')->paginate(20)->appends(request()->except('page'));
    	return view('back.bank.index', compact('adminBanks'));
    }

    public function edit(AdminBank $adminBank)
    {
    	return view('back.bank.edit', compact('adminBank'));
    }

    public function update(Request $request, AdminBank $adminBank)
    {
    	$request->validate([
    		'bank_name' => 'required',
    		'bank_account' => 'required',
    		'under_the_name' => 'required'
    	]);

    	$adminBank->bank_name = $request->bank_name;
    	$adminBank->bank_account = $request->bank_account;
    	$adminBank->under_the_name = $request->under_the_name;
    	$adminBank->save();
    	
    	$adminBanks = AdminBank::orderBy('created_at', 'desc')->paginate(20)->appends(request()->except('page'));
    	return view('back.bank.index', compact('adminBanks'));
    }

    public function destroy(AdminBank $adminBank)
    {
    	$adminBank->delete();
    	return redirect()->route('admin.setting.index');
    }
}
