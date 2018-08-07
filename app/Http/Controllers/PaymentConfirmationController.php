<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Payment_confirmation;
use App\Payment;
use App\AdminBank;
use File;

class PaymentConfirmationController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function create(Request $request)
    {
    	if (!$request->get('kode')) {
            abort(404);
        }
        $payment = Payment::where('code', $request->get('kode'))->firstOrFail();
    	$adminBanks = AdminBank::all();
    	return view('front.payment.confirmation.create', compact('payment', 'adminBanks'));
    }

    public function store(Request $request)
    {
        if (!$request->get('kode')) {
            abort(404);
        }
        $payment = Payment::where('code', $request->get('kode'))->firstOrFail();
    	$request->validate([
    		'transfer_date' => 'required',
    		'admin_bank_id' => 'required',
    		'user_bank_name' => 'required',
    		'bank_account' => 'required|numeric',
    		'under_the_name' => 'required',
    		'amount' => 'required|numeric',
    		'image' => 'required|image|mimes:jpeg,png|max:200'
    	]);

    	//upload image
    	$filename = $payment->getCode().'.'.$request->image->getClientOriginalExtension();
    	$request->image->move(public_path('img/payment_confirmation'), $filename);

    	//insert database
    	Payment_confirmation::create([
    		'payment_id' => $payment->id,
    		'transfer_date' => Carbon::createFromFormat('d/m/Y', $request->transfer_date)->toDateString(),
    		'admin_bank_id' => $request->admin_bank_id,
    		'user_bank_name' => $request->user_bank_name,
    		'bank_account' => $request->bank_account,
    		'under_the_name' => $request->under_the_name,
    		'amount' => $request->amount,
    		'image' => $filename
    	]);

    	//success
    	return redirect()->route('payment.show', ['code' => $payment->code])
    	->with('success', 'Konfirmasi Pembayaran tersimpan. Harap tunggu, kami akan meninjau konfirmasi anda dan akan secepatnya memproses pesanan anda.');

    }

    public function show(Payment_confirmation $paymentConfirmation)
    {
        return view('back.payment.confirmation.show', compact('paymentConfirmation'));
    }

    public function edit(Payment_confirmation $paymentConfirmation)
    {
        $payment = $paymentConfirmation->payment;
        $adminBanks = AdminBank::all();
        return view('front.payment.confirmation.edit', compact('paymentConfirmation', 'payment', 'adminBanks'));
    }

    public function update(Request $request, Payment_confirmation $paymentConfirmation)
    {
        $payment = $paymentConfirmation->payment;
        $request->validate([
            'transfer_date' => 'required',
            'admin_bank_id' => 'required',
            'user_bank_name' => 'required',
            'bank_account' => 'required|numeric',
            'under_the_name' => 'required',
            'amount' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png|max:200'
        ]);

        //delete file
        File::delete(public_path('img/payment_confirmation/'.$paymentConfirmation->image));
        //upload image
        $filename = $payment->getCode().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('img/payment_confirmation'), $filename);
        //update database
        $paymentConfirmation->transfer_date = Carbon::createFromFormat('d/m/Y', $request->transfer_date)->toDateString();
        $paymentConfirmation->admin_bank_id = $request->admin_bank_id;
        $paymentConfirmation->user_bank_name = $request->user_bank_name;
        $paymentConfirmation->bank_account = $request->bank_account;
        $paymentConfirmation->under_the_name = $request->under_the_name;
        $paymentConfirmation->amount = $request->amount;
        $paymentConfirmation->image = $filename;
        $paymentConfirmation->save();

        //success
        return redirect()->route('payment.show', ['code' => $payment->code])
        ->with('success', 'Konfirmasi Pembayaran sukses diupdate. Harap tunggu, kami akan meninjau konfirmasi anda dan akan secepatnya memproses pesanan anda.');
    }

    public function destroy(Payment_confirmation $paymentConfirmation)
    {
        //deleteFile
        File::delete(public_path('img/payment_confirmation/'.$paymentConfirmation->image));
        //delete data
        $paymentConfirmation->delete();
        //success
        return redirect()->route('payment.show', ['code' => $paymentConfirmation->payment->code])
        ->with('success', 'Konfirmasi Pembayaran telah dihapus. Untuk memproses pesanan anda kami perlu meninjau konfirmasi pemabayaran anda. Silahkan anda konfirmasi jika sudah melakukan pembayaran');
    }
}
