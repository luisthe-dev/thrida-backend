<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    //User Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'User does not exist'
            ], 401);
        $user = $request->user();
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
            )->toDateTimeString()
        ]);
    }

    //User Sign Up
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string',
        ]);

        $newWallet = json_encode([
            'demo_wallet' => 35000000,
            'real_wallet' => 0,
            'tournament_wallet' => 0,
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'wallets' => $newWallet,
            'password' => bcrypt($request->password),
        ]);

        $user->save();
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    public function getUserInfo(Request $request)
    {
        return response()->json($request->user());
    }
}
