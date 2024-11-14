<?php

namespace App\Http\Controllers;

use App\Models\InventoryLog;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryLogController extends Controller
{
    public function index()
    {
        $logs = InventoryLog::with('product')->get();
        return view('inventorylogs.index', compact('logs'));
    }

    public function create()
    {
        $products = Product::all();
        return view('inventorylogs.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|string|in:sale,restock',
            'quantity' => 'required|integer|min:1',
        ]);

        $log = InventoryLog::create($request->all());

        $product = $log->product;
        if ($log->type === 'sale') {
            $product->stock -= $log->quantity;
        } else {
            $product->stock += $log->quantity;
        }
        $product->save();

        return redirect()->route('inventorylog.index')->with('success', 'Inventory log recorded successfully.');
    }

    public function destroy(InventoryLog $inventoryLog)
    {
        $inventoryLog->delete();
        return redirect()->route('inventorylog.index')->with('success', 'Inventory log deleted successfully.');
    }
}