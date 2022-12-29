<?php

namespace App\Http\Controllers;

use App\Models\Trades;
use App\Http\Requests\StoreTradesRequest;
use App\Http\Requests\UpdateTradesRequest;
use App\Models\Assets;
use App\Models\settings;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TradesController extends Controller
{
    public function startTrade(StoreTradesRequest $request)
    {

        $tradeSetting = settings::where('setting', 'win_algo')->first()->value;
        $userTrades = Trades::where('email', $request->user()->email)->get();
        $assetDetail = Assets::where('id', $request->asset_id)->where('status', 1)->first();
        $user = $request->user();
        $walletType = $request->walletType;
        $userWallet = json_decode($user->wallets, true);
        $userPredict = $request->userPredict;

        $tradeSetting = str_split($tradeSetting);

        $algoSize = sizeof($tradeSetting);
        $tradeSize = sizeof($userTrades);

        if ($tradeSize == 0) {
            $algoIndex = 0;
        } else if ($algoSize > $tradeSize) {
            $algoIndex = $tradeSize;
        } else {
            $divisibleCount = intval($tradeSize / $algoSize);
            $solidNumber = $divisibleCount * $algoSize;
            $algoIndex = $tradeSize - $solidNumber;
        }

        $walletBalance = $userWallet[$walletType];

        if (!$assetDetail) return response()->json(['message' => 'Asset Is Invalid'], 400);

        if ($walletBalance < $request->amount_staked) return response()->json(['message' => 'Balance Is Too Low To Place Trade'], 400);

        $walletBalance = $walletBalance - $request->amount_staked;

        $userWallet[$walletType] = $walletBalance;

        $user->wallets = json_encode($userWallet);

        $algoSet = $tradeSetting[$algoIndex];

        if ($algoSet === 'W') {
            $amountGain = $request->amount_staked + ($request->amount_staked * ($assetDetail->volatility / 100));
            if ($userPredict === 'GAIN') {
                $newVal = rand(floatval($request->entry_value) + 10, floatval($request->entry_value) + rand(20, 88));
            } else {
                $newVal = rand(floatval($request->entry_value) - rand(20, 88), floatval($request->entry_value) - 5);
            }
        } else {
            $amountGain = 0;
            if ($userPredict === 'GAIN') {
                $newVal = rand(floatval($request->entry_value) - rand(20, 88), floatval($request->entry_value) - 5);
            } else {
                $newVal = rand(floatval($request->entry_value) + 10, floatval($request->entry_value) + rand(20, 88));
            }
        }

        $newVal = $newVal + (rand(0, 80) / 100);

        $trade = new Trades([
            'email' => $user->email,
            'amount' => $request->amount_staked,
            'amount_won' => $amountGain,
            'assets_id' => $assetDetail->id,
            'percentage_win' => $assetDetail->volatility,
            'entry_value' => $request->entry_value,
            'exit_value' => $newVal,
            'time_period' => $request->time_period
        ]);

        $trade->save();
        $user->save();

        return response()->json(['message' => 'Trade Started Successfully', 'tradeDetails' => $trade, 'userDetails' => $user], 201);
    }

    public function getUserTrades(Request $request)
    {

        $user = $request->user();

        return Trades::where('email', $user->email)->orderByDesc('created_at')->paginate(50);
    }
}
