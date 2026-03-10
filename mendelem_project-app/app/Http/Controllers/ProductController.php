<?php
class ProductController extends Controller
{
    public function index()
    {
        $products = \App\Models\Product::active()->get();
        return view('products.index', compact('products'));
    }
}
