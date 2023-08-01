<?php

namespace App\Http\Controllers;

use App\Models\ListingDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListingDetailController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'listing_id' => 'required|integer|exists:listings,id',
            'memory' => 'nullable|integer',
            'full_title' => 'nullable|string',
            'description' => 'nullable|string',
            'views' => 'nullable|integer',
            'location' => 'nullable|string',
        ]);

        $listingDetail = ListingDetail::create($validatedData);

        return response()->json([
            'message' => 'Listing detail created successfully',
            'listing_detail' => $listingDetail
        ], 201);
    }
}
