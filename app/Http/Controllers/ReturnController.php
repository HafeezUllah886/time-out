<?php

namespace App\Http\Controllers;

use App\Http\Middleware\confirmPassword;
use App\Models\accounts;
use App\Models\categories;
use App\Models\products;
use App\Models\return_details;
use App\Models\returns;
use App\Models\stock;
use App\Models\transactions;
use App\Models\warehouses;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;

class ReturnController extends Controller
{
    public function index()
    {
        $returns = returns::orderby('id', 'desc')->paginate(10);
        return view('returns.index', compact('returns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = products::orderby('name', 'asc')->get();
       
        $warehouses = warehouses::all();
        $customers = accounts::customer()->get();
        $accounts = accounts::business()->get();
        $cats = categories::orderBy('name', 'asc')->get();
        return view('returns.create', compact('products', 'warehouses', 'customers', 'accounts', 'cats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try
        {
            if($request->isNotFilled('id'))
            {
                throw new Exception('Please Select Atleast One Product');
            }

            DB::beginTransaction();
            $ref = getRef();
            $return = returns::create(
                [
                  'customerID'      => $request->customerID,
                  'date'            => $request->date,
                  'notes'           => $request->notes,
                  'customerName'    => $request->customerName,
                  'refID'           => $ref,
                  'userID'          => auth()->user()->id,
                  'accountID'       => $request->accountID,
                ]
            );

            $ids = $request->id;

            $total = 0;
            foreach($ids as $key => $id)
            {
                if($request->amount[$key] > 0)
                {
                $qty = $request->qty[$key];
                $price = $request->price[$key];
                $total += $request->amount[$key];

                $stock = stock::where('productID', $id)->where('batch', $request->batch[$key])->orderBy('id', 'desc')->first();
                return_details::create(
                    [
                        'returnID'       => $return->id,
                        'productID'     => $id,
                        'price'         => $price,
                        'qty'           => $qty,
                        'amount'        => $request->amount[$key],
                        'date'          => $request->date,
                        'batch'         => $stock->batch ?? null,
                        'expiry'        => $stock->expiry ?? null,
                        'refID'         => $ref,
                        'userID'        => auth()->user()->id,
                        'accountID'     => $request->accountID,
                    ]
                );
                createStock($id,$qty, 0, $request->date, "Return in # $return->id", $ref, $stock->batch  ?? null, $stock->expiry ?? null);
                }

            }

            $return->update(
                [
                    'total'   => $total,
                ]
            );

            createTransaction($request->accountID, $request->date, 0, $total, "Return of Inv No. $return->id", $ref);
           
           DB::commit();
            return to_route('return.index')->with('success', "Return Created");
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $return = returns::find($id);
        return view('returns.print', compact('return'));
    }

    public function destroy($id)
    {
        try
        {
            DB::beginTransaction();
            $return = returns::find($id);
           $return->details()->delete();
            stock::where('refID', $return->refID)->delete();
            transactions::where('refID', $return->refID)->delete();
            $return->delete();
            DB::commit();
            session()->forget('confirmed_password');
            return to_route('return.index')->with('success', "Return Deleted");
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            session()->forget('confirmed_password');
            return to_route('return.index')->with('error', $e->getMessage());
        }
    }

   public function getSignleProduct($id)
    {
        $product = products::find($id);
        $stocks = stock::select('batch', DB::raw('SUM(cr) - SUM(db) AS balance'))
                  ->where('productID', $product->id)
                  ->groupBy('batch')
                  ->get();

        $product->batches = $stocks;
        return $product;
    }

    public function getProductByCode($code)
    {
        $product = products::where('code', $code)->first();
        if($product)
        {
           return $product->id;
        }
        return "Not Found";
    } 
}
