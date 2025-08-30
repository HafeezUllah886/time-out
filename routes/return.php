<?php

use App\Http\Controllers\ReturnController;
use App\Http\Middleware\confirmPassword;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::resource('return', ReturnController::class);

    Route::get("returns/getproduct/{id}", [ReturnController::class, 'getSignleProduct']);
    Route::get("returns/delete/{id}", [ReturnController::class, 'destroy'])->name('return.delete')->middleware(confirmPassword::class);
    Route::get("returns/pdf/{id}", [ReturnController::class, 'pdf'])->name('return.pdf');

    Route::get("product/searchByCode/{code}", [ReturnController::class, 'getProductByCode'])->name('product.searchByCode');
});
