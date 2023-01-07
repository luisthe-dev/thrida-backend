<?php

namespace App\Http\Controllers;

use App\Models\settings;
use App\Http\Requests\StoresettingsRequest;
use App\Http\Requests\UpdatesettingsRequest;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class SettingsController extends Controller
{
    public function getAllSettings(Request $request)
    {
        return settings::all();
    }

    public function updateSetting(Request $request)
    {

        $request->validate([
            'setting_name' => 'required|string',
            'setting_value' => 'required|string'
        ]);

        $setting = settings::where('setting', $request->setting_name)->first();

        if (!$setting) return response()->json(['message' => 'Error Validating Setting'], 400);

        $setting->value = $request->setting_value;

        $setting->save();

        return response()->json(['message' => 'Setting Updated Successfully'], 200);
    }
}
