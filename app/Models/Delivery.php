<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $fillable = [
        'driver_id',
        'vehicle_id',
        'tanggal_pengantaran',
        'jam_berangkat',
        'jam_diterima'
    ];

    public function delivery_detail(){
        return $this->hasMany('App\Models\DeliveryDetail');
    }

    public function driver(){
        return $this->belongsTo('App\Models\Driver');
    }

    public function vehicle(){
        return $this->belongsTo('App\Models\Vehicle');
    }
}
