<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    use HasFactory;
    protected $fillable = [
        'nik',
        'district_id',
        'alamat',
        'no_telepon',
        'sisa_uang_return'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function district(){
        return $this->belongsTo('App\Models\District');
    }

    public function sales_transaction(){
        return $this->hasMany('App\Models\SalesTransaction');
    }
}
