<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transection extends Model
{
    //
    protected $fillable = [
        'TranID',
        'TranType',
        'ProductID',
        'Qty',
        'Price',
        'Detail',
    ];
}
