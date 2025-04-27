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
}
