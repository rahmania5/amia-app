<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'distributor_id',
        'tanggal_transaksi',
        'jenis_pembayaran',
        'total_transaksi',
        'sisa_utang',
        'tanggal_kirim',
        'status'
    ];

    public function distributor(){
        return $this->belongsTo('App\Models\Distributor');
    }

    public function sales_transaction_detail(){
        return $this->hasMany('App\Models\SalesTransactionDetail');
    }

    public function payment(){
        return $this->hasMany('App\Models\Payment');
    }

    public function delivery(){
        return $this->hasMany('App\Models\Delivery');
    }
}
