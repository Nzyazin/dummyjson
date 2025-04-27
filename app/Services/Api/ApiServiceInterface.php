<?php

namespace App\Services\Api;

interface ApiServiceInterface
{
    /**
     * Search items
     *
     * @param string $query
     * @param array $params
     * @return array
     */
    public function search(string $query, array $params = []): array;
}
