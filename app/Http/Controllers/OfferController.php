<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\CreateRequest;
use App\Http\Resources\Listing\ShowResource;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Resources\Offer\ListResource;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $listings = Offer::paginate($perPage);

        return ListResource::collection($listings);
    }

    /**
     * Display the specified resource.
     */
    public function show(Offer $offer)
    {
        return new ShowResource($offer);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $offer = null;
        $validated = $request->validated;
        try {
            $offer = Offer::create([
                'price' => $validated->price,
                'status' => $validated->status,
                'listing_id' => $validated->listing_id,
                'user_id' => auth()->id()
            ]);

            return response()->json([
                'data' => [
                    'message' => 'Ponuda uspješno poslana! Obavijestit ćemo vas kad naručitelj odgovori na ponudu!'
                ]
            ]);
        }
        catch(\Exception $e) {
            if($offer) {
                $offer->delete();
            }
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offer)
    {
        $offer->delete();

        return response()->json([
            'data' => [
                'message' => 'Ponuda uspješno obrisana!'
            ]
        ]);
    }
}
