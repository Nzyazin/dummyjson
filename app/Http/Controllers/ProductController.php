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
}
