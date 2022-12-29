<?php

namespace App\Http\Controllers;

use App\Models\deposits;
use App\Http\Requests\StoredepositsRequest;
use App\Http\Requests\UpdatedepositsRequest;

class DepositsController extends Controller
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
     * @param  \App\Http\Requests\StoredepositsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoredepositsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\deposits  $deposits
     * @return \Illuminate\Http\Response
     */
    public function show(deposits $deposits)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\deposits  $deposits
     * @return \Illuminate\Http\Response
     */
    public function edit(deposits $deposits)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatedepositsRequest  $request
     * @param  \App\Models\deposits  $deposits
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatedepositsRequest $request, deposits $deposits)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\deposits  $deposits
     * @return \Illuminate\Http\Response
     */
    public function destroy(deposits $deposits)
    {
        //
    }
}
