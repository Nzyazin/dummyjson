<?php

namespace App\Services\Api;

use Illuminate\Support\Facades\Http;

class ProductApiService extends AbstractApiService
{
    /**
     * @var string
     */
    protected string $endpoint = 'products';
}
