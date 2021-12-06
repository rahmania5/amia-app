<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReturnDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_return_id',
        'sales_transaction_detail_id',
        'qty_return',
        'alasan_return'
    ];

    public function return(){
        return $this->belongsTo('App\Models\ProductReturn');
    }

    public function sales_transaction_detail(){
        return $this->belongsTo('App\Models\SalesTransactionDetail');
    }
}
