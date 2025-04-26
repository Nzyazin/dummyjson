<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'external_id',
        'title',
        'description',
        'brand',
        'price',
        'thumbnail',
        'images',
        'data',
    ];

    protected $casts = [
        'external_id' => 'integer',
        'price' => 'float',
        'images' => 'array',
        'data' => 'array',
    ];
}
