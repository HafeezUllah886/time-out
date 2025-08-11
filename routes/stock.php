<?php

use App\Http\Controllers\StockAdjustmentController;
use App\Http\Controllers\StockController;
use App\Http\Middleware\confirmPassword;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('products/stock/{id}/{from}/{to}', [StockController::class, 'show'])->name('stockDetails');
    Route::resource('product_stock', StockController::class);

    Route::resource('stockAdjustments', StockAdjustmentController::class);
    Route::get('stockAdjustment/delete/{ref}', [StockAdjustmentController::class, 'destroy'])->name('stockAdjustment.delete')->middleware(confirmPassword::class);

    Route::get('stock/getstock/{id}', function ($id) {
        return response()->json(['stock' => getStock($id)]);
    })->name('getStock');
});

