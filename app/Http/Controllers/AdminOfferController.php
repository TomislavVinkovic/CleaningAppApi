<?php

namespace App\Http\Controllers;

use App\Http\Requests\Offer\CreateRequest;
use App\Http\Resources\Offer\ShowResource;
use App\Mail\ListingOfferReceivedMail;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Resources\Offer\ListResource;
use App\Mail\ListingOfferAcceptedMail;
use App\Mail\ListingOfferRejectedMail;
use Illuminate\Support\Facades\Mail;

use App\Models\Listing;
use App\Models\Job;

class AdminOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $listings = Offer::with(['listing'])
            ->paginate($perPage);

        return ListResource::collection($listings);
    }

    /**
     * Display the specified resource.
     */
    public function show(Offer $offer)
    {
        $offer->load(['listing']);
        return new ShowResource($offer);
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
