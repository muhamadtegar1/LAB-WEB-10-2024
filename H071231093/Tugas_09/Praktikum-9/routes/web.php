<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InventoryLogController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/',[ProductController::class,'index']);

Route::resource('category', CategoryController::class);
Route::resource('product', ProductController::class);
Route::resource('inventorylog', InventoryLogController::class);

Route::post('product/{id}/decrease-stock', [ProductController::class, 'decreaseStock'])->name('product.decreaseStock');
Route::post('product/{id}/increase-stock', [ProductController::class, 'increaseStock'])->name('product.increaseStock');