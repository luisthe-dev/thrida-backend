<?php

namespace App\Http\Controllers;

use App\Models\Tournaments;
use App\Http\Requests\StoreTournamentsRequest;
use App\Http\Requests\UpdateTournamentsRequest;

class TournamentsController extends Controller
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
     * @param  \App\Http\Requests\StoreTournamentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTournamentsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tournaments  $tournaments
     * @return \Illuminate\Http\Response
     */
    public function show(Tournaments $tournaments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tournaments  $tournaments
     * @return \Illuminate\Http\Response
     */
    public function edit(Tournaments $tournaments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTournamentsRequest  $request
     * @param  \App\Models\Tournaments  $tournaments
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTournamentsRequest $request, Tournaments $tournaments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tournaments  $tournaments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tournaments $tournaments)
    {
        //
    }
}
