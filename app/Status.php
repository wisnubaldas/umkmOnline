<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = [
    	'name'
    ];

    public function textForBuyer()
    {
    	if ($this->id == 1) {
    		return 'Menunggu respon Penjual. Tunggu sampai pemilik toko menyetujui pesanan anda';
    	} elseif ($this->id == 2) {
    		return 'Penjual/Pemilik Toko menyetujui pesanan anda. Dalam hal ini, penjual sedang memproses pesanan anda sampai mengirimnya via JNE';
    	} elseif ($this->id == 3) {
    		return 'Pesanan sedang dikirim. Tunggu beberapa hari sesuai paket JNE yang anda pilih, Pesanan anda akan tiba dirumah anda. Jangan lupa Konfirmasi apabila pesanan barang sudah anda terima.';
    	} else {
    		return 'Transaksi Selesai';
    	}
    }

    public function textForSeller()
    {
        if ($this->id == 1) {
            return 'Pesanan Baru. Pembeli menunggu respon anda. segera setujui/accept Pesanan.';
        } elseif ($this->id == 2) {
            return 'Anda telah menyetujui pesanan yang diminta pembeli. Dalam hal ini, Anda sedang memproses pesanan sampai mengirimnya via JNE';
        } elseif ($this->id == 3) {
            return 'Pesanan sedang dikirim. Tunggu beberapa hari sesuai paket JNE yang Pembeli pilih. Apabila pembeli melakukan konfirmasi penerimaan barang, admin akan melakukan transfer uang pesanan ke Toko anda.';
        } else {
            return 'Transaksi Selesai';
        }
    }

    //relation
    public function orders()
    {
    	return $this->hasMany('App\Order');
    }
}
