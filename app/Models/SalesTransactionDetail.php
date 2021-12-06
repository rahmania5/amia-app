<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesTransactionDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'goods_id',
        'sales_transaction_id',
        'qty',
        'keterangan'
    ];

    public function goods(){
        return $this->belongsTo('App\Models\Goods');
    }

    public function sales_transaction(){
        return $this->belongsTo('App\Models\SalesTransaction');
    }

    public function return_detail(){
        return $this->hasMany('App\Models\ProductReturnDetail');
    }

    public function delivery_detail(){
        return $this->hasMany('App\Models\DeliveryDetail');
    }
}
