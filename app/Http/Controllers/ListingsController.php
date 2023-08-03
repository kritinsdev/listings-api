<?php

namespace App\Http\Controllers;

use App\Http\Resources\ListingResource;
use App\Mail\ListingCreated;
use App\Models\Listing;
use App\Models\ModelStat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ListingsController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->query('id');
        $url = $request->query('url');
        $site = $request->query('site');
        $model_id = $request->query('model_id');
        $category = $request->query('category_id');

        $query = Listing::with('listingModel')->where('active', 1)->where('model_id', '!=', 24)->orderBy('added', 'desc');

        if($id) {
            $query->where('id', $id);
        }

        if ($url) {
            $query->where('url', $url);
        }

        if($site) {
            $query->where('site', $site);
        }

        if ($model_id) {
            $query->where('model_id', $model_id);
        }

        if($category) {
            $query->where('category_id', $category);
        }

        $listings = $query->get();

        return ListingResource::collection($listings);
    }

    public function getUrls(Request $request)
    {
        $site = $request->query('site');
        $active = $request->query('active');
        $query = Listing::select(['id', 'url']);
    
        if($active !== null) {
            $query->where('active', $active);
        }
    
        if ($site !== null) {
            $query->where('site', $site);
        }
    
        $urls = $query->get();
    
        return $urls;
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'model_id' => 'required|exists:listing_models,id',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'added' => 'required|string',
            'url' => 'required',
            'site' => 'required|string',
        ]);

        $listing = Listing::create($validatedData);

        $modelStat = ModelStat::where('model_id', $listing->model_id)->first();

        $listing['model'] = $listing->listingModel->model_name;

        if($listing->model_id != 24) {
            if (($modelStat->average_price - $listing->price) >= 70) {
                Mail::to('krlistingstrackcer@gmail.com')->send(new ListingCreated($listing));
            }
        }

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

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'price' => 'numeric',
            'active' => 'required|boolean'
        ]);

        $listing = Listing::findOrFail($id);

        if (!empty($validatedData['price'])) {
            $listing->price = $validatedData['price'];
        }

        $listing->active = $validatedData['active'];

        $listing->save();

        return response()->json($listing, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the listing by id
        $listing = Listing::find($id);

        // If listing is not found, return error response
        if (!$listing) {
            return response()->json(['error' => 'Listing not found'], 404);
        }

        // Delete the listing
        $listing->delete();

        // Return a successful response
        return response()->json(['message' => 'Listing successfully deleted'], 200);
    }

}