<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use App\Http\Requests\StoreAssetsRequest;
use App\Http\Requests\UpdateAssetsRequest;

class AssetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Assets::all();
    }

    public function activeIndex()
    {
        return Assets::where('status', 1)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAssetsRequest  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assets  $assets
     * @return \Illuminate\Http\Response
     */
    public function show(Assets $assets)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assets  $assets
     * @return \Illuminate\Http\Response
     */
    public function edit(Assets $assets)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAssetsRequest  $request
     * @param  \App\Models\Assets  $assets
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAssetsRequest $request, Assets $assets)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assets  $assets
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assets $assets)
    {
        //
    }
}
