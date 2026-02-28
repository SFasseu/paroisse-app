<?php

namespace App\Http\Controllers;

use App\Models\Priest;
use App\Http\Requests\StorePriestRequest;
use App\Http\Requests\UpdatePriestRequest;

class PriestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePriestRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Priest $priest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Priest $priest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePriestRequest $request, Priest $priest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Priest $priest)
    {
        //
    }
}
