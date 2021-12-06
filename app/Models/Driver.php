<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_driver'
    ];

    public function delivery(){
        return $this->hasMany('App\Models\Delivery');
    }
}
