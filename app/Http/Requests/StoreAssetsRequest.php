<?php

namespace App\Http\Requests;

use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreAssetsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        $request->validate([
            'asset_name'  => 'required|string',
            'volatility' => 'required|string',
            'level' => 'required|string',
            'status' => 'required|string'
        ]);

        $user = $request->user();

        $isUser = Admin::where('email', $user->email)->first();

        if ($isUser) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'asset_name'  => 'required|string',
            'volatility' => 'required|string',
            'level' => 'required|string',
            'status' => 'required|integer'
        ];
    }
}
