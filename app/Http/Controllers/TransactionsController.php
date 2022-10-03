<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{

    public function createTransaction(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'amount' => 'required|integer',
            'channel' => 'required|string',
        ]);

        $transaction = new Transactions([
            'email' => $request->user()->email,
            'type' => $request->type,
            'amount' => $request->amount,
            'channel' => $request->channel,
            'remark' => '',
        ]);

        $transaction->save();

        return response()->json([
            'message' => 'Transaction created successfully',
            'transaction' => $transaction
        ], 201);
    }

    public function getUserTransactions(Request $request)
    {
        $transactions = Transactions::where('email', $request->user()->email)->get();
        return response()->json($transactions);
    }
}
