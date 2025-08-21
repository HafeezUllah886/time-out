<?php

namespace App\Http\Controllers;

use App\Models\accounts;
use App\Models\counter_transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CounterTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trans = counter_transaction::orderBy('refID', 'desc')->get();
        $users = User::where('role', 3)->get();
        $accounts = accounts::where('category', 'Cash')->where('type', 'Business')->get();
        return view('Finance.counter-transaction.index', compact('trans', 'users', 'accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            DB::beginTransaction();
            $ref = getRef();
            $transaction = counter_transaction::create([
            'userID' => $request->userID,
            'accountID' => $request->accountID,
            'date' => $request->date,
            'amount' => $request->amount,
            'type' => $request->type,
            'refID' => $ref,
        ]);

        if($request->type == 'Take'){
            createTransaction(1, $request->date, 0, $request->amount, "Payment added to counter", $ref);
        }else{
            createTransaction(1, $request->date, $request->amount, 0, "Payment taken from counter", $ref);
        }
            
        DB::commit();
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }

        return redirect()->back()->with('success', 'Counter Transaction Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(counter_transaction $counter_transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(counter_transaction $counter_transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, counter_transaction $counter_transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(counter_transaction $counter_transaction)
    {
        //
    }
}
