<?php

use App\Models\products;
use App\Models\purchase_details;
use App\Models\ref;
use App\Models\sale_details;
use App\Models\stock;
use Carbon\Carbon;

function getRef(){
    $ref = ref::first();
    if($ref){
        $ref->ref = $ref->ref + 1;
    }
    else{
        $ref = new ref();
        $ref->ref = 1;
    }
    $ref->save();
    return $ref->ref;
}

function firstDayOfMonth()
{
    $startOfMonth = Carbon::now()->startOfMonth();

    return $startOfMonth->format('Y-m-d');
}
function lastDayOfMonth()
{

    $endOfMonth = Carbon::now()->endOfMonth();

    return $endOfMonth->format('Y-m-d');
}


function createStock($id, $cr, $db, $date, $notes, $ref, /* $warehouse, */ $batch, $expiry)
{
    stock::create(
        [
            'productID'     => $id,
            'cr'            => $cr,
            'db'            => $db,
            'date'          => $date,
            'notes'         => $notes,
            'refID'         => $ref,
            /* 'warehouseID'   => $warehouse, */
            'batch'         => $batch,
            'expiry'        => $expiry,
        ]
    );
}
function getStock($id){
   
        $cr  = stock::where('productID', $id)->sum('cr');
        $db  = stock::where('productID', $id)->sum('db');
  
    return $cr - $db;
}

function avgSalePrice($from, $to, $id)
{
    $sales = sale_details::where('productID', $id);
    if($from != 'all' && $to != 'all')
    {
        $sales->whereBetween('date', [$from, $to]);
    }
    $sales_amount = $sales->sum('amount');
    $sales_qty = $sales->sum('qty');

    if($sales_qty > 0)
    {
        $sale_price = $sales_amount / $sales_qty;
    }
    else
    {
        $product = products::find($id);
        $sale_price = $product->price;


    }

    return $sale_price;
}


function avgPurchasePrice($from, $to, $id)
{
    
    if($from != 'all' && $to != 'all')
    {
        $purchases = purchase_details::where('productID', $id)->whereBetween('date', [$from, $to])->orderBy('id','desc')->take(10);
    }
    else
    {
        $purchases = purchase_details::where('productID', $id)->orderBy('id','desc')->take(10);
    }
    
    $purchase_amount = $purchases->sum('amount');
    $purchase_qty = $purchases->sum('qty');

    if($purchase_qty > 0)
    {
        $purchase_price = $purchase_amount / $purchase_qty;
    }
    else
    {
        $product = products::find($id);
        $purchase_price = $product->pprice;
    }

    return $purchase_price;
}

function stockValue()
{
    $products = products::all();

    $value = 0;
    foreach($products as $product)
    {
        $value += productStockValue($product->id);
    }

    return $value;
}

function productStockValue($id)
{
    $stock = getStock($id);
    $price = avgPurchasePrice('all', 'all', $id);

    return $price * $stock;
}

function projectNameAuth()
{
    return "Time Out Mart";
}

function projectNameHeader()
{
    return "Time Out";
}
function projectNameShort()
{
    return "TOM";
}
