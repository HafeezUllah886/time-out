<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\products;
use Illuminate\Http\Request;

class TopSellingProductsReportController extends Controller
{
    public function index()
    {
        $topProducts = products::withSum('saleDetails', 'qty')->withSum('saleDetails', 'amount')
        ->orderByDesc('sale_details_sum_qty')
        ->take(200)
        ->get();

        $topProductsArray = [];

        foreach($topProducts as $product)
        {
            $stock = getStock($product->id);
            $price = avgSalePrice('all', 'all', $product->id);

            $topProductsArray [] = ['name' => $product->name, 'price' => $price, 'stock' => $stock, 'amount' => $product->sale_details_sum_amount, 'sold' => $product->sale_details_sum_qty];
        }


        return view('reports.top_selling_products.details', compact('topProductsArray'));
    }
}
