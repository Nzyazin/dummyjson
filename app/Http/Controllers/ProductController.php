<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(): JsonResponse
    {
        $products = $this->productService->getAllProducts();
        
        return response()->json([
            'success' => true,
            'data' => $products,
            'count' => $products->count(),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'brand' => 'nullable|string|max:100',
            'thumbnail' => 'nullable|string',
            'images' => 'nullable|array',
        ]);

        $product = $this->productService->addProduct($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'data' => $product,
        ], Response::HTTP_CREATED);
    }

    // Получить продукт по ID
    public function show(int $id): JsonResponse
    {
        $product = $this->productService->getProductById($id);
        
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
            ], Response::HTTP_NOT_FOUND);
        }
        
        return response()->json([
            'success' => true,
            'data' => $product,
        ]);
    }

    // Получить и сохранить все iPhone продукты из API
    public function fetchAndSaveIPhoneProducts(): JsonResponse
    {
        $products = $this->productService->fetchAndSaveIPhoneProducts();
        
        return response()->json([
            'success' => true,
            'message' => 'iPhone products fetched and saved successfully',
            'count' => $products->count(),
            'data' => $products,
        ]);
    }

    // Получить продукты по бренду
    public function getByBrand(string $brand): JsonResponse
    {
        $products = $this->productService->getProductsByBrand($brand);
        
        return response()->json([
            'success' => true,
            'count' => $products->count(),
            'data' => $products,
        ]);
    }
}
