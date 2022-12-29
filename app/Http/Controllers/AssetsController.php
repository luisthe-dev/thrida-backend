<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use App\Http\Requests\StoreAssetsRequest;
use App\Http\Requests\UpdateAssetsRequest;

class AssetsController extends Controller
{
    public function index()
    {
        return Assets::all();
    }

    public function activeIndex()
    {
        return Assets::where('status', 1)->get();
    }

    public function toggleAsset($id)
    {
        $assetData = Assets::where('id', $id)->first();

        if (!$assetData) return response()->json(['message' => 'Asset Does Not Exist'], 400);

        $currentStatus = $assetData->status;

        $assetData->status = !$currentStatus;

        $assetData->save();

        return response()->json(['message' => 'Asset Updated Successfully'], 200);
    }

    public function deleteAsset($id)
    {
        $assetData = Assets::where('id', $id)->delete();

        if (!$assetData) return response()->json(['message' => 'Asset Does Not Exist'], 400);

        return response()->json(['message' => 'User Deleted Successfully'], 200);
    }

    public function store(StoreAssetsRequest $request)
    {
        $asset = new Assets([
            'asset_name' => $request->asset_name,
            'volatility' => $request->volatility,
            'level' => $request->level,
            'status' => $request->status
        ]);

        $asset->save();

        return response()->json(['message' => 'Asset added successfully', 'asset' => $asset], 200);
    }
}
