<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\products;
use App\Models\User;

class DailyProductSalesReportController extends Controller
{
    public function index()
    {
        if(auth()->user()->role != 3){
            $users = User::where('role', 3)->get();
        }
        else{
            $users = User::where('id', auth()->user()->id)->get();
        }
        return view('reports.dailyproductssales.index', compact('users'));
    }

    public function data($from, $to, $user)
    {
        $products = products::all();

        foreach ($products as $p) {
            if($user == 'all'){
                $p->qty = $p->saleDetails()->whereBetween('created_at', [$from,$to])->sum('qty');
                $p->total = $p->saleDetails()->whereBetween('created_at', [$from,$to])->sum('amount');
            }
            else{
                $p->qty = $p->saleDetails()->whereBetween('created_at', [$from,$to])->where('userID', $user)->sum('qty');
                $p->total = $p->saleDetails()->whereBetween('created_at', [$from,$to])->where('userID', $user)->sum('amount');
            }
            $avg_purchase = avgPurchasePrice('all', 'all', $p->id);
            $p->avg_purchase = $avg_purchase;
        }

        if($user == 'all'){
            $user = 'All';
        }
        else
        {
            $user = User::find($user)->name;
        }

       return view('reports.dailyproductssales.details', compact('products', 'from', 'to', 'user'));
    }
}
