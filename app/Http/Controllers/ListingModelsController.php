<?php

namespace App\Http\Controllers;

use App\Models\ListingModel;
use Illuminate\Http\Request;

class ListingModelsController extends Controller
{
    public function index(Request $request)
    {
        $category_id = $request->query('category_id');

        $query = ListingModel::with('modelStats');

        if ($category_id) {
            $query->where('category_id', $category_id);
        }

        $models = $query->get();

        return response()->json($models);
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
