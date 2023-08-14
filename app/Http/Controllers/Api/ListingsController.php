<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ListingResource;
use App\Mail\ListingCreated;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class ListingsController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->query('id');
        $url = $request->query('url');
        $site = $request->query('site');
        $model_id = $request->query('model_id');

        $query = Listing::with('listingModel')->where('model_id', '<', 66)->orderBy('added', 'desc');

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

        $listings = $query->get();

        return ListingResource::collection($listings);
    }

    public function getUrls(Request $request)
    {
        $site = $request->query('site');
        $query = Listing::select(['id', 'url']);
    
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
            'price' => 'required|numeric',
            'memory' => 'numeric|nullable',
            'added' => 'required|string',
            'url' => 'required',
            'site' => 'required|string',
        ]);

        $listing = Listing::create($validatedData);
        $listing['model'] = $listing->listingModel->model_name;

        

        if($listing->model_id < 86) {
            if ($listing->listingModel->model_price - $listing->price >= -50) {
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
        ]);

        $listing = Listing::findOrFail($id);

        if (!empty($validatedData['price'])) {
            $listing->price = $validatedData['price'];
        }

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