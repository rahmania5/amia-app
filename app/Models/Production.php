<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggal_produksi'
    ];

    public function production_detail(){
        return $this->hasMany('App\Models\ProductionDetail');
    }
}
