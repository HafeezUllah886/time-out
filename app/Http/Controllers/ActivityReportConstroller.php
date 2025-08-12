<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\purchase_details;
use App\Models\sale_details;
use Illuminate\Http\Request;

class ActivityReportConstroller extends Controller
{
    public function index()
    {
        return view('reports.activity.index');
    }

    public function details($from, $to)
    {
        $purchases = purchase_details::whereBetween('date', [$from, $to])->get();
        $sales = sale_details::whereBetween('date', [$from, $to])->get();
        $purchases->groupBy('productID');
        $sales->groupBy('productID');
        return view('reports.activity.details', compact('purchases', 'sales'));
    }
}
