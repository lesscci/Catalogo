<?php

namespace App\Http\Controllers\Transaction;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::all();

        return response()->json(['data' => $transaction], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'quantity' => 'required|integer',
            'buyer_id' => 'required|exists:buyers,id',
            'product_id' => 'required|exists:products,id',
        ]);

        $product = Product::findOrFail($validatedData['product_id']);

        if ($product->quantity < $validatedData['quantity']) {
            return response()->json(['error' => 'No hay suficiente stock disponible'], 400);
        }

        $transaction = new Transaction();
        $transaction->quantity = $validatedData['quantity'];
        $transaction->buyer_id = $validatedData['buyer_id'];
        $transaction->product_id = $validatedData['product_id'];
        $transaction->save();

        $product->quantity -= $validatedData['quantity'];
        $product->save();

        return response()->json(['data' => $transaction], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::find($id);
        return response()->json(['data' => $transaction], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
