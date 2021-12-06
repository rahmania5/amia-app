<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'production_id',
        'goods_id',
        'qty_barang_jadi',
        'qty_barang_rusak'
    ];

    public function production(){
        return $this->belongsTo('App\Models\Production');
    }

    public function goods(){
        return $this->belongsTo('App\Models\Goods');
    }
}
