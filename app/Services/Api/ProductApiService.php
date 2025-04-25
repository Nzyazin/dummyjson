<?php

namespace App\Services\Api;

use Illuminate\Support\Facades\Http;

class ProductApiService extends AbstractApiService
{
    /**
     * @var string
     */
    protected string $endpoint = 'products';

    /**
     * Get products by category
     *
     * @param string $category
     * @param array $params
     * @return array
     */
    public function getByCategory(string $category, array $params = []): array
    {
        $response = Http::get($this->baseUrl . '/' . $this->endpoint . '/category/' . $category, $params);
        
        return $response->json();
    }

    /**
     * Get all categories
     *
     * @return array
     */
    public function getCategories(): array
    {
        $response = Http::get($this->baseUrl . '/' . $this->endpoint . '/categories');
        
        return $response->json();
    }
}
