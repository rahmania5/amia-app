<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_polisi',
        'jenis_kendaraan'
    ];

    public function delivery(){
        return $this->hasMany('App\Models\Delivery');
    }
}
