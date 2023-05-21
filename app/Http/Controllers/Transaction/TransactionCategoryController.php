<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionCategoryController extends Controller
{
    public function index(Request $request)
    {
        $transactionId = $request->route('transaction');
        $transaction = Transaction::findOrFail($transactionId);
        $categories = $transaction->product->categories;

        return response()->json(['data' => $categories], 200);
    }
    

}
