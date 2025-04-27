<?php

namespace App\Services;

use App\Models\Product;
use App\Services\Api\ProductApiService;
use Illuminate\Support\Collection;

class ProductService
{
    protected ProductApiService $apiService;

    public function __construct(ProductApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function fetchAndSaveIPhoneProducts(): Collection
    {
        $response = $this->apiService->search('iPhone');
        
        if (!isset($response['products']) || empty($response['products'])) {
            return collect();
        }

        $products = collect();
        
        foreach ($response['products'] as $productData) {
            $product = $this->saveProduct($productData);
            $products->push($product);
        }

        return $products;
    }

    public function saveProduct(array $productData): Product
    {
        $mainFields = [
            'title' => $productData['title'],
            'description' => $productData['description'] ?? null,
            'brand' => $productData['brand'] ?? null,
            'price' => $productData['price'] ?? null,
            'thumbnail' => $productData['thumbnail'] ?? null,
            'images' => $productData['images'] ?? [],
        ];

        $additionalData = array_diff_key($productData, array_flip([
            'id', 'title', 'description', 'brand', 'price', 'thumbnail', 'images'
        ]));

        $product = Product::updateOrCreate(
            ['external_id' => $productData['id']],
            array_merge($mainFields, ['data' => $additionalData])
        );

        return $product;
    }
}
