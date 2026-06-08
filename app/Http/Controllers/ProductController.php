<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // List all products
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.products.index', compact('products'));
    }

    // Show create form
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // Store new product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id'
        ]);

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $request->image,
            'category_id' => $request->category_id
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully!');
    }

    // Show edit form
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Update product
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id'
        ]);

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $request->image,
            'category_id' => $request->category_id
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully!');
    }

    // Delete product
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully!');
    }
}