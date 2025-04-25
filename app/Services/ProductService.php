<?php

namespace App\Services;

use App\Models\Product;
use App\Services\Api\ProductApiService;
use Illuminate\Support\Collection;

class ProductService
{
    // Сервис для работы с API продуктов
    protected ProductApiService $apiService;

    // Конструктор
    public function __construct(ProductApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    // Получить и сохранить iPhone продукты
    public function fetchAndSaveIPhoneProducts(): Collection
    {
        // Поиск всех продуктов iPhone
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

    // Сохранить продукт в базу данных
    public function saveProduct(array $productData): Product
    {
        $product = Product::updateOrCreate(
            ['external_id' => $productData['id']],
            [
                'title' => $productData['title'],
                'description' => $productData['description'] ?? null,
                'category' => $productData['category'] ?? null,
                'price' => $productData['price'] ?? null,
                'discount_percentage' => $productData['discountPercentage'] ?? null,
                'rating' => $productData['rating'] ?? null,
                'stock' => $productData['stock'] ?? null,
                'brand' => $productData['brand'] ?? null,
                'thumbnail' => $productData['thumbnail'] ?? null,
                'images' => $productData['images'] ?? [],
                'tags' => $productData['tags'] ?? [],
                'meta' => isset($productData['meta']) ? $productData['meta'] : null,
            ]
        );

        return $product;
    }

    // Добавить новый продукт
    public function addProduct(array $data): Product
    {
        // Добавляем продукт через API
        $response = $this->apiService->add($data);
        
        // Сохраняем в базу данных
        return $this->saveProduct($response);
    }

    // Получить все продукты из базы данных
    public function getAllProducts(): Collection
    {
        return Product::all();
    }

    // Получить продукт по ID
    public function getProductById(int $id): ?Product
    {
        return Product::find($id);
    }

    // Получить продукты по бренду
    public function getProductsByBrand(string $brand): Collection
    {
        return Product::where('brand', 'like', "%{$brand}%")->get();
    }
}
