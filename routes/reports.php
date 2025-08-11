<?php

use App\Http\Controllers\dailycashbookController;
use App\Http\Controllers\ledgerReportController;
use App\Http\Controllers\profitController;
use App\Http\Controllers\DailyProductSalesReportController;
use App\Http\Controllers\TopSellingProductsReportController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::get('/reports/profit', [profitController::class, 'index'])->name('reportProfit');
    Route::get('/reports/profit/{from}/{to}', [profitController::class, 'data'])->name('reportProfitData');

    Route::get('/reports/dailycashbook', [dailycashbookController::class, 'index'])->name('reportCashbook');
    Route::get('/reports/dailycashbook/{date}', [dailycashbookController::class, 'details'])->name('reportCashbookData');

    Route::get('/reports/ledger', [ledgerReportController::class, 'index'])->name('reportLedger');
    Route::get('/reports/ledger/{from}/{to}/{type}', [ledgerReportController::class, 'data'])->name('reportLedgerData');

    Route::get('/reports/dailysales', [DailyProductSalesReportController::class, 'index'])->name('dailySalesReport');
    Route::get('/reports/dailysales/{date}', [DailyProductSalesReportController::class, 'data'])->name('dailySalesReportData');

    Route::get('/reports/top-selling-products', [TopSellingProductsReportController::class, 'index'])->name('topSellingProductsReport');

});
