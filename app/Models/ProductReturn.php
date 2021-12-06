<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReturn extends Model
{
    use HasFactory;
    protected $fillable = [
        'total_return',
        'status_return'
    ];

    public function return_detail(){
        return $this->hasMany('App\Models\ProductReturnDetail');
    }

}
