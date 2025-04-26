<?php

namespace App\Providers;

use App\Services\Api\ApiServiceInterface;
use App\Services\Api\ProductApiService;
use App\Services\ProductService;
use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ApiServiceInterface::class, function ($app) {
            return new ProductApiService();
        });

        $this->app->bind(ProductService::class, function ($app) {
            return new ProductService(
                $app->make(ApiServiceInterface::class)
            );
        });
    }
}
