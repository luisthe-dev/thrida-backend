<?php

namespace App\Http\Controllers;

use App\Models\settings;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        $remark = Str::random(8);

        $transaction = new Transactions([
            'email' => $request->user()->email,
            'type' => $request->type,
            'amount' => $request->amount,
            'channel' => $request->channel,
            'remark' => $remark,
        ]);

        $transaction->save();

        $responseData = [
            'message' => 'Transaction created successfully',
            'transaction' => $transaction
        ];

        $keys = array(
            "Bitcoin" => 'btc_address',
            "USDT ERC 20" => 'usdt_erc_address',
            "USDT TRC 20" => 'usdt_trc_address',
            "Litecoin" => 'ltc_address',
            "Ethereum" => 'eth_address',
            "Paypal" => 'paypal_email',
            "Card" => 'loading',
            "Bank Transfer" => 'btc_address'
        );

        $pricekeys = array(
            "Bitcoin" => 'btc_price',
            "USDT ERC 20" => 'usdt_erc_price',
            "USDT TRC 20" => 'usdt_trc_price',
            "Litecoin" => 'ltc_price',
            "Ethereum" => 'eth_price',
            "Paypal" => 'paypal_email',
            "Card" => 'loading',
            "Bank Transfer" => 'btc_price'
        );


        $settings = settings::where('setting', $keys[$request->channel])->first();
        $amount = settings::where('setting', $pricekeys[$request->channel])->first();
        $dollar_price = settings::where('setting', 'dollar_price')->first();

        if (!$settings || !$amount || !$dollar_price) {
            $transaction->status = 'Failed';
            $transaction->save();
            $responseData['message'] = 'Invalid Payment Method';
            return response()->json($responseData, 400);
        }

        $pay_amount = intval($request->amount) * $amount->value;

        $responseData['setting'] = $settings;
        $responseData['payAmount'] = $pay_amount;

        if ($request->channel == 'Bank Transfer') {
            $responseData['depositData'] = [
                'account_name' => 'John Doe',
                'account_number' => '1234567890',
                'bank_name' => 'Bank Name',
                'deposit_rem' => $remark
            ];
        } else {
            $responseData['depositData'] = [
                'wallet_address' => $settings->value,
                'deposit_rem' => $remark
                // 'wallet_qr' => 'https://www.oreilly.com/api/v2/epubs/9781118370711/files/images/9781118370711-fg0101_fmt.png',
            ];
        }

        return response()->json($responseData, 201);
    }

    public function getUserTransactions(Request $request)
    {
        $transactions = Transactions::where('email', $request->user()->email)->orderByDesc('created_at')->get();
        return response()->json($transactions);
    }

    public function getUserDepositTransactions(Request $request)
    {
        $transactions = Transactions::where('email', $request->user()->email)->where('type', 'Deposit')->where('status', 'Success')->orderByDesc('created_at')->get();
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
