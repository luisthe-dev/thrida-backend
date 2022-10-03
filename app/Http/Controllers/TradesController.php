<?php

namespace App\Http\Controllers;

use App\Models\Trades;
use App\Http\Requests\StoreTradesRequest;
use App\Http\Requests\UpdateTradesRequest;

class TradesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreTradesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTradesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trades  $trades
     * @return \Illuminate\Http\Response
     */
    public function show(Trades $trades)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trades  $trades
     * @return \Illuminate\Http\Response
     */
    public function edit(Trades $trades)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTradesRequest  $request
     * @param  \App\Models\Trades  $trades
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTradesRequest $request, Trades $trades)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trades  $trades
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trades $trades)
    {
        //
    }
}
