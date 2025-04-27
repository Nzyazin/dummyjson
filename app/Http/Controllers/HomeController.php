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
}
