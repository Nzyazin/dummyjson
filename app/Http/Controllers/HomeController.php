<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * @var ProductService
     */
    protected ProductService $productService;

    /**
     *
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     *
     * @return View
     */
    public function index(): View
    {
        $products = Product::all();
        return view('home', compact('products'));
    }

    /**
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function fetchIPhoneProducts()
    {
        $this->productService->fetchAndSaveIPhoneProducts();
        return redirect()->route('home')->with('success', 'iPhone products fetched and saved successfully');
    }

    /**
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteIPhoneProducts()
    {
        Product::truncate();
        return redirect()->route('home')->with('success', 'iPhone products deleted successfully');
    }

    /**
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'brand' => 'nullable|string|max:100',
            'thumbnail' => 'nullable|string|url',
            'images' => 'nullable|array',
        ]);

        $this->productService->addProduct($validated);
        
        return redirect()->route('home')->with('success', 'Product added successfully');
    }
}
