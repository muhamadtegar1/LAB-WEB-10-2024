@extends('layouts.base')

@section('title', 'Inventory Logs')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Inventory Logs</h1>

    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left bg-gray-200" style="background-color: lightgray">Product</th>
                <th class="px-4 py-2 text-left bg-gray-200" style="background-color: lightgray">Type</th>
                <th class="px-4 py-2 text-left bg-gray-200" style="background-color: lightgray">Quantity</th>
                <th class="px-4 py-2 text-left bg-gray-200" style="background-color: lightgray">Date</th>
                <th class="px-4 py-2 text-left bg-gray-200" style="background-color: lightgray">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $log->product->name }}</td>
                    <td class="px-4 py-2">{{ $log->type }}</td>
                    <td class="px-4 py-2">{{ $log->quantity }}</td>
                    <td class="px-4 py-2">{{ $log->created_at->format('d-m-Y H:i') }}</td>
                    <td class="px-4 py-2">
                        <form action="{{ route('inventorylog.destroy', $log->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-600">
                                <img src="https://cdn-icons-png.flaticon.com/512/1214/1214428.png" alt="Delete Icon" class="inline-block w-4 h-4 mr-1">
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection