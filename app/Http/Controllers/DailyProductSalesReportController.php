<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\products;

class DailyProductSalesReportController extends Controller
{
    public function index()
    {
        return view('reports.dailyproductssales.index');
    }

    public function data($date)
    {
        $products = products::all();

        foreach ($products as $p) {
            $p->qty = $p->saleDetails()->where('date', $date)->sum('qty');
            $p->total = $p->saleDetails()->where('date', $date)->sum('amount');
        }

       return view('reports.dailyproductssales.details', compact('products', 'date'));
    }
}
