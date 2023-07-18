<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingsController extends Controller
{
    public function index(Request $request)
    {
        $url = $request->query('url');
        $model_id = $request->query('model_id');
    
        $query = Listing::with('phoneModel')->orderBy('added', 'desc');
    
        if ($url) {
            $query->where('url', $url);
        }
        
        if ($model_id) {
            $query->where('model_id', $model_id);
        }
    
        $listings = $query->get();
    
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