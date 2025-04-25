<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'external_id',
        'title',
        'description',
        'category',
        'price',
        'discount_percentage',
        'rating',
        'stock',
        'brand',
        'thumbnail',
        'images',
        'tags',
        'meta',
    ];

    protected $casts = [
        'images' => 'array',
        'tags' => 'array',
        'meta' => 'array',
        'price' => 'float',
        'discount_percentage' => 'float',
        'rating' => 'float',
        'stock' => 'integer',
    ];
}
