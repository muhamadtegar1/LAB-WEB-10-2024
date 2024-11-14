<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\InventoryLog;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::create($request->all());
        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($request->all());
        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }

    public function decreaseStock(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);
        $product = Product::findOrFail($id);

        if ($product->stock < $request->quantity) {
            return redirect()->route('product.index')->withErrors(['message' => 'Stock is insufficient!']);
        }

        $product->stock -= $request->quantity;
        $product->save();

        InventoryLog::create([
            'product_id' => $product->id,
            'type' => 'sold',
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('product.index')->with('success', 'Stock decreased successfully.');
    }

    public function increaseStock(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);
        $product = Product::findOrFail($id);

        $product->stock += $request->quantity;
        $product->save();

        InventoryLog::create([
            'product_id' => $product->id,
            'type' => 'restock',
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('product.index')->with('success', 'Stock increased successfully.');
    }
}