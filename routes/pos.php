<?php

use App\Http\Controllers\POSController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get("pos", [POSController::class, 'index'])->name('pos');
    Route::get("pos/allproducts", [POSController::class, 'allproducts'])->name('pos.allproducts');
    Route::get("pos/bycategory/{id}", [POSController::class, 'bycategory'])->name('pos.bycategory');
    Route::get("pos/getSingleProduct/{id}", [POSController::class, 'getSingleProduct'])->name('pos.getSingleProduct');
    Route::get("pos/searchByCode/{code}", [POSController::class, 'searchByCode'])->name('pos.searchByCode');
    Route::get("pos/store", [POSController::class, 'store'])->name('pos.store');
    Route::get("pos/print/{id}", [POSController::class, 'print'])->name('pos.print');
    Route::get("pos/printlast", [POSController::class, 'printlast'])->name('pos.printlast');


});
