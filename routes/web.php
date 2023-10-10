<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\SiteController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\ProductController;

Route::get('/', [SiteController::class, 'index'])->name('site.home');
///admin
Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('brand',BrandController::class);
    //catrgory
    Route::resource('category',CategoryController::class);
    Route::get('category_trash',[CategoryController::class,'trash'])->name('category.trash');

    Route::prefix('admin')->group(function () {
        Route::get('status/{category}',[CategoryController::class,'status'])->name('category.status');
        Route::get('delete/{category}',[CategoryController::class,'delete'])->name('category.delete');
        Route::get('restore/{category}',[CategoryController::class,'restore'])->name('category.restore');
        Route::get('destroy/{category}',[CategoryController::class,'destroy'])->name('category.destroy');


    });
    //brand
    Route::resource('brand',BrandController::class);
    Route::get('brand_trash',[BrandController::class,'trash'])->name('brand.trash');

    Route::prefix('admin')->group(function () {
        Route::get('status/{brand}',[BrandController::class,'status'])->name('brand.status');
        Route::get('delete/{brand}',[BrandController::class,'delete'])->name('brand.delete');
        Route::get('restore/{brand}',[BrandController::class,'restore'])->name('brand.restore');
        Route::get('destroy/{brand}',[BrandController::class,'destroy'])->name('brand.destroy');


    });
    Route::resource('product',ProductController::class);
});

