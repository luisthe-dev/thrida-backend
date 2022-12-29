<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Transactions;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $user = Admin::where('username', $request->username)->first();
        if (!$user)
            return response()->json([
                'message' => 'Admin does not exist'
            ], 401);
        if (password_verify($request->password, $user->password)) {
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->accessToken;
            if ($request->remember_me)
                $token->expires_at = Carbon::now()->addWeeks(3);
            $token->save();
            return response()->json([
                'access_token' => $tokenResult->plainTextToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->accessToken->expires_at
                )->toDateTimeString(),
                'user' => $user
            ]);
        } else {
            return response()->json([
                'message' => 'Unauthorized Login!'
            ], 401);
        }
    }

    public function signup(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'email' => 'required|string|email|unique:admins,email',
            'password' => 'required|string',
        ]);

        $user = new Admin([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->save();
        return response()->json([
            'message' => 'Successfully created admin!'
        ], 201);
    }

    public function getStats()
    {
        $users = User::all()->count();
        $transactions = Transactions::all()->count();
        $proUsers = User::where('is_pro', 1)->count();

        return response()->json(['user_count' => $users, 'pro_user_count' => $proUsers, 'transaction_count' => $transactions], 200);
    }
}
