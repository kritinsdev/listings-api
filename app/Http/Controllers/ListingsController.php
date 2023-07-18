<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $url = $request->query('url');
    
        if ($url) {
            $listings = Listing::where('url', $url)->get();
        } else {
            $listings = Listing::all();
        }
    
        return response()->json($listings);
    }

    public function create(Request $request)
    {

    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'model_id' => 'required|exists:phone_models,id',
            'price' => 'required|numeric',
            'memory' => 'integer',
            'battery_capacity' => 'numeric',
            'added' => 'required|string',
            'url' => 'required',
        ]);

        $listing = Listing::create($validatedData);

        return response()->json($listing, 201);
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