<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhoWeightAge extends Model
{
    protected $table = 'who_weight_age';

    protected $fillable = [
        'gender',
        'umur_bulan',
        'minus_3sd',
        'minus_2sd',
        'median',
        'plus_1sd',
        'plus_2sd',
    ];
}