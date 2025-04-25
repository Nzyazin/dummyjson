<?php

namespace App\Services\Api;

use Illuminate\Support\Facades\Http;

abstract class AbstractApiService implements ApiServiceInterface
{
    /**
     * @var string
     */
    protected string $baseUrl = 'https://dummyjson.com';

    /**
     * @var string
     */
    protected string $endpoint;

    /**
     * Get all items
     *
     * @param array $params
     * @return array
     */
    public function getAll(array $params = []): array
    {
        $response = Http::get($this->baseUrl . '/' . $this->endpoint, $params);
        
        return $response->json();
    }

    /**
     * Get item by ID
     *
     * @param int $id
     * @return array|null
     */
    public function getById(int $id): ?array
    {
        $response = Http::get($this->baseUrl . '/' . $this->endpoint . '/' . $id);
        
        if ($response->failed()) {
            return null;
        }
        
        return $response->json();
    }

    /**
     * Search items
     *
     * @param string $query
     * @param array $params
     * @return array
     */
    public function search(string $query, array $params = []): array
    {
        $params['q'] = $query;
        $response = Http::get($this->baseUrl . '/' . $this->endpoint . '/search', $params);
        
        return $response->json();
    }

    /**
     * Add new item
     *
     * @param array $data
     * @return array
     */
    public function add(array $data): array
    {
        $response = Http::post($this->baseUrl . '/' . $this->endpoint . '/add', $data);
        
        return $response->json();
    }
}
