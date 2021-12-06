<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'delivery_id',
        'sales_transaction_detail_id',
        'qty_barang_dikirim'
    ];

    public function delivery(){
        return $this->belongsTo('App\Models\Delivery');
    }

    public function sales_transaction_detail(){
        return $this->belongsTo('App\Models\SalesTransactionDetail');
    }
}
