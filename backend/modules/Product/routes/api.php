<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\BrandsController;
use Modules\Product\Http\Controllers\CategoryController;
use Modules\Product\Http\Controllers\ProductController;
use Modules\Product\Http\Controllers\ProductImagesController;

//TODO: guards

Route::prefix('management')->group(function () {
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'getProductsByRootCategory']);
        Route::post('/create', [ProductController::class, 'store']);
    });


    Route::get('/brands', [BrandsController::class, 'getPaginated']);

    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::get('/root', [CategoryController::class, 'rootCategories']);
    });

    Route::post('/product/{product}/images', [ProductImagesController::class, 'store']);
});