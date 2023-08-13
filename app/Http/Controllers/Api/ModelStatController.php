<?php

namespace App\Http\Controllers\Api;

use App\Models\ModelStat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class ModelStatController extends Controller
{
    public function index()
    {
        $modelStats = ModelStat::all();

        return response()->json($modelStats);
    }
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
