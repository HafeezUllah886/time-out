<?php

namespace App\Http\Controllers;

use App\Models\counter_transaction;
use App\Models\sale_details;
use App\Models\sales;
use App\Models\transactions;
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
        $sales = sale_details::whereBetween('date', [$from,$to])->where('userID', $user)->sum('amount');
        $discounts = sales::whereBetween('date', [$from,$to])->where('userID', $user)->sum('discount');
        $dc = sales::whereBetween('date', [$from,$to])->where('userID', $user)->sum('dc');

        $current = getAccountBalance(1);

        $pre_cr = transactions::where('accountID', 1)->whereDate('date', '<', $from)->sum('cr');
        $pre_db = transactions::where('accountID', 1)->whereDate('date', '<', $from)->sum('db');
        $pre_balance = $pre_cr - $pre_db;

        $cash_given= counter_transaction::whereBetween('date', [$from,$to])->where('userID', $user)->where('type', 'Give')->sum('amount');
        $cash_taken = counter_transaction::whereBetween('date', [$from,$to])->where('userID', $user)->where('type', 'Take')->sum('amount');

        $user = User::find($user)->name;

        return view('reports.cashier-activity.print', compact('sales', 'discounts', 'dc', 'current', 'pre_balance', 'from', 'to', 'user', 'cash_given', 'cash_taken'));
    }
}
