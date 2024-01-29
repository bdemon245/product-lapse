<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Features\Product\ProductStageController;
use App\Http\Controllers\Features\Product\ProductCategoryController;


Route::resource('product', ProductController::class);
Route::get('product/home/filter', [ProductController::class, 'filter'])->name('product.home.filter');
Route::get('search', [ProductController::class, 'search'])->name('product.search');
