<?php

namespace App\Services\Api;

interface ApiServiceInterface
{
    /**
     * Get all items
     *
     * @param array $params
     * @return array
     */
    public function getAll(array $params = []): array;

    /**
     * Get item by ID
     *
     * @param int $id
     * @return array|null
     */
    public function getById(int $id): ?array;

    /**
     * Search items
     *
     * @param string $query
     * @param array $params
     * @return array
     */
    public function search(string $query, array $params = []): array;

    /**
     * Add new item
     *
     * @param array $data
     * @return array
     */
    public function add(array $data): array;
}
