<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\expenses;
use App\Models\products;
use App\Models\purchase;
use App\Models\purchase_details;
use App\Models\sale_details;
use App\Models\sales;
use Illuminate\Http\Request;

class ActivityReportConstroller extends Controller
{
    public function index()
    {
        return view('reports.activity.index');
    }

    public function details($from, $to)
    {
        $products = products::all();
        foreach($products as $product){
            $purchases = purchase_details::where('productID', $product->id)->whereBetween('date', [$from, $to])->get();
            $sales = sale_details::where('productID', $product->id)->whereBetween('date', [$from, $to])->get();

           if($purchases->count() > 0){
            $product->purchases = [
                'price' => $purchases->sum('amount') / $purchases->sum('qty') ,
                'qty' => $purchases->sum('qty'),
                'total' => $purchases->sum('amount'),
            ];
           }
           if($sales->count() > 0){
            $product->sales = [
                'price' => $sales->sum('amount') / $sales->sum('qty') ,
                'qty' => $sales->sum('qty'),
                'total' => $sales->sum('amount'),
            ];
           }
        }
        $purchase = purchase::whereBetween('date', [$from, $to]);
        $sale = sales::whereBetween('date', [$from, $to]);

        $purchase_discount = $purchase->sum('discount');
        $purchase_dc = $purchase->sum('dc');

        $sale_discount = $sale->sum('discount');
        $sale_dc = $sale->sum('dc');

        $profit = profit($from, $to);

        $expense = expenses::whereBetween('date', [$from, $to])->sum('amount');

        $net_profit = $profit - $expense;
       
        return view('reports.activity.details', compact('products', 'from', 'to', 'purchase_discount', 'purchase_dc', 'sale_discount', 'sale_dc', 'profit', 'expense', 'net_profit'));
    }
}
