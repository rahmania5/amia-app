<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'sales_transaction_id',
        'metode_pembayaran',
        'tanggal_pembayaran',
        'jumlah_pembayaran',
        'bukti_pembayaran',
        'keterangan'
    ];

    public function sales_transaction(){
        return $this->belongsTo('App\Models\SalesTransaction');
    }
}
