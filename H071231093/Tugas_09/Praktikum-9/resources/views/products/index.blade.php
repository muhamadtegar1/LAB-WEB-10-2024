@extends('layouts.base')

@section('title', 'Products')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Products</h1>

    <a href="{{ route('product.create') }}" class="inline-block mb-4 px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
        Create New
    </a>

    <table class="min-w-full bg-white border border-gray-300 shadow-md rounded-lg">
        <thead>
            <tr>
                <th class="px-4 py-2 border-b text-left" style="background-color: lightgray">Name</th>
                <th class="px-4 py-2 border-b text-left" style="background-color: lightgray">Description</th>
                <th class="px-4 py-2 border-b text-left" style="background-color: lightgray">Price</th>
                <th class="px-4 py-2 border-b text-left" style="background-color: lightgray">Stock</th>
                <th class="px-4 py-2 border-b text-left" style="background-color: lightgray">Category</th>
                <th class="px-4 py-2 border-b text-left" style="background-color: lightgray">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td class="px-4 py-2 border-b">{{ $product->name }}</td>
                    <td class="px-4 py-2 border-b">{{ $product->description }}</td>
                    <td class="px-4 py-2 border-b">{{ $product->price }}</td>
                    <td class="px-4 py-2 border-b">{{ $product->stock }}</td>
                    <td class="px-4 py-2 border-b">{{ $product->category->name }}</td>
                    <td class="px-4 py-2 border-b space-x-2">

                    <div class="flex items-center space-x-2">
                        <!-- Tombol Edit -->
                        <a href="{{ route('product.edit', $product->id) }}" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <img src="https://cdn-icons-png.flaticon.com/512/1828/1828859.png" alt="Edit Icon" class="inline-block w-4 h-4">
                        </a>
                    
                        <!-- Tombol Delete -->
                        <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                <img src="https://cdn-icons-png.flaticon.com/512/1214/1214428.png" alt="Delete Icon" class="inline-block w-4 h-4">
                            </button>
                        </form>
                    
                        <!-- Form Sell -->
                        <form action="{{ route('product.decreaseStock', $product->id) }}" method="POST" class="flex items-center space-x-1">
                            @csrf
                            <input type="number" name="quantity" min="1" placeholder="Qty" required class="w-16 px-2 py-1 border rounded text-center">
                            <button type="submit" class="px-2 py-1 bg-green-600 text-white rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                Sell
                            </button>
                        </form>
                    
                        <!-- Form Restock -->
                        <form action="{{ route('product.increaseStock', $product->id) }}" method="POST" class="flex items-center space-x-1">
                            @csrf
                            <input type="number" name="quantity" min="1" placeholder="Qty" required class="w-16 px-2 py-1 border rounded text-center">
                            <button type="submit" class="px-2 py-1 bg-yellow-600 text-white rounded hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                                Restock
                            </button>
                        </form>
                    </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 