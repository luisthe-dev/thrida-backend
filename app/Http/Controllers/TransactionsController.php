<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class TransactionsController extends Controller
{

    public function getAllTransactions()
    {
        return Transactions::orderByDesc('id')->paginate(25);;
    }

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

        $responseData = [
            'message' => 'Transaction created successfully',
            'transaction' => $transaction
        ];

        if ($request->channel == 'Bank Transfer') {
            $responseData['depositData'] = [
                'account_name' => 'John Doe',
                'account_number' => '1234567890',
                'bank_name' => 'Bank Name',
            ];
        } else {
            $responseData['depositData'] = [
                'wallet_address' => '0x1234567890',
                'wallet_qr' => 'https://www.oreilly.com/api/v2/epubs/9781118370711/files/images/9781118370711-fg0101_fmt.png',
            ];
        }

        return response()->json($responseData, 201);
    }

    public function getUserTransactions(Request $request)
    {
        $transactions = Transactions::where('email', $request->user()->email)->get();
        return response()->json($transactions);
    }

    public function updateDeposit(Request $request, $id)
    {

        if ($request->hasFile('depositSlip')) {

            $request->validate([
                'depositSlip' => 'required|image|mimes:jpg,jpeg,png|max:6144'
            ]);

            $fileUrl = $request->file('depositSlip')->store('images/depositSlips', 'public');

            $mainTransaction = Transactions::find($id);

            $mainTransaction->update([
                'remark' => 'storage/' . $fileUrl,
            ]);


            // $fileUrl = URL::asset('storage/' . $fileUrl);

            return response()->json($mainTransaction, 200);
        }
    }
}
