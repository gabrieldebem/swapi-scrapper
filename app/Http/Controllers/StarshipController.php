<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStarshipRequest;
use App\Http\Requests\UpdateStarshipRequest;
use App\Models\Starship;

class StarshipController extends Controller
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
     * @param  \App\Http\Requests\StoreStarshipRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStarshipRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Starship  $starship
     * @return \Illuminate\Http\Response
     */
    public function show(Starship $starship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Starship  $starship
     * @return \Illuminate\Http\Response
     */
    public function edit(Starship $starship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStarshipRequest  $request
     * @param  \App\Models\Starship  $starship
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStarshipRequest $request, Starship $starship)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Starship  $starship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Starship $starship)
    {
        //
    }
}
