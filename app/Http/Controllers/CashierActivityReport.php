<?php

namespace App\Http\Controllers;

use App\Models\sale_details;
use App\Models\sales;
use App\Models\User;
use Database\Seeders\userSeeder;
use Illuminate\Http\Request;

class CashierActivityReport extends Controller
{
    public function index()
    {
        if(auth()->user()->role != 3){
            $users = User::where('role', 3)->get();
        }
        else{
            $users = User::where('id', auth()->user()->id)->get();
        }
        return view('reports.cashier-activity.index', compact('users'));
    }

    public function details($from, $to, $user)
    {
        $sales = sale_details::where('created_at', '>=', $from)->where('created_at', '<=', $to)->where('userID', $user)->sum('amount');
        $discounts = sales::where('created_at', '>=', $from)->where('created_at', '<=', $to)->where('userID', $user)->sum('discount');

        $cash = getAccountBalance(1);

        

        return view('reports.cashier-activity.index', compact('sales', 'discounts'));
    }
}
