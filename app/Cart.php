<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Cart extends Model
{
    protected $fillable = ['store_id', 'user_id', 'jne_service'];

    public function subtotal()
    {
        $total = 0;
        foreach ($this->cart_details as $item) {
            $total += $item->totalPrice();
        }
        return $total;
    }

    public function subtotalStringFormatted()
    {
        return 'Rp. ' . number_format($this->subtotal(), 0, '', '.');
    }

    public function totalWeight()
    {
        $total = 0;
        foreach ($this->cart_details as $item) {
            $total += $item->product->weight * $item->quantity;
        }
        return $total;
    }

    public function totalWeightInKilo()
    {
        return number_format($this->totalWeight() / 1000, 2) . ' kg';
    }

    public function jumlahOngkir()
    {
        $data = $this->daftarLayananJne();
        if (is_null($data)) {
            return null;
        } elseif ($data['status'] != 200) {
            return null;
        } else {
            foreach ($data['layanan'] as $key => $value) {
                if ($this->jne_service == $key) {
                    return $value;
                }
            }
        }
    }

    public function totalTagihan()
    {
        return $this->subtotal() + $this->jumlahOngkir();
    }

    public function totalTagihanStringFormatted()
    {
        return 'Rp. ' . number_format($this->totalTagihan(), 0, '', '.');
    }

    //relation
    public function store()
    {
    	return $this->belongsTo('App\Store');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function cart_details()
    {
    	return $this->hasMany('App\Cart_detail');
    }

    //ongkir
    public function getOngkirJson()
    {
        File::delete(database_path('json/ongkir.json'));

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=".$this->store->city->id."&destination=".$this->user->city->id."&weight=".$this->totalWeight()."&courier=jne",
            CURLOPT_HTTPHEADER => [
                "content-type: application/x-www-form-urlencoded",
                "key: " . env('RAJAONGKIR_KEY') 
                ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            File::put(database_path('json/ongkir.json'), $err);
        } else {
            File::put(database_path('json/ongkir.json'), $response);
        }
    }

    public function daftarLayananJne()
    {
        $file = File::get(database_path('json/ongkir.json'));
        $data = json_decode($file);

        if (!is_null($data)) {
            $response = [];
            if ($data->rajaongkir) {
                $response ['status'] = $data->rajaongkir->status->code;
                if ($data->rajaongkir->status->code == 200) {
                    foreach ($data->rajaongkir->results[0]->costs as $d) {
                       $response['layanan'][$d->service] = $d->cost[0]->value; 
                    } 
                }
                return $response;
            }
        }
        return null;
    }

    public function pilihLayananJne()
    {
        $data = $this->daftarLayananJne();
        if (is_null($data)) {
            return false;
        } elseif ($data['status'] != 200) {
            return false;
        } else {
           foreach ($data['layanan'] as $key => $value) {
                $this->jne_service = $key;
                $this->save();
                return;
            } 
        }
    }
}
