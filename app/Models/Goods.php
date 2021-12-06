<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_barang',
        'stok_barang',
        'harga_barang'
    ];

    public function production_detail(){
        return $this->hasMany('App\Models\ProductionDetail');
    }

    public function sales_transaction_detail(){
        return $this->hasMany('App\Models\SalesTransactionDetail');
    }
}
