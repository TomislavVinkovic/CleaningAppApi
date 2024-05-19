<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\CreateRequest;
use App\Http\Resources\Listing\ShowResource;
use App\Mail\ListingOfferReceivedMail;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Resources\Offer\ListResource;
use App\Mail\ListingOfferAcceptedMail;
use App\Mail\ListingOfferRejectedMail;
use Illuminate\Support\Facades\Mail;

use App\Models\Listing;
use App\Models\Job;

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
        $validated = $request->validated;

        $offer = null;
        $listing = Listing::find($validated->listing_id);
        
        try {
            $offer = Offer::create([
                'price' => $validated->price,
                'status' => 'pending',
                'listing_id' => $validated->listing_id,
                'user_id' => auth()->id()
            ]);

            Mail::to($validated['email'])->send(new ListingOfferReceivedMail($listing, $offer));

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

    // accessed by a signed url
    public function acceptOffer(Request $request, Offer $offer)
    {
        if ($request->hasValidSignature()) {
            // Mark the offer as accepted
            $offer->update(['status' => 'accepted']);
            $offer->load(['listing', 'listing.user', 'listing.user.company']);
            Mail::to($offer->user->email)->send(new ListingOfferAcceptedMail($offer));

            // Create a new job
            Job::create([
                'listing_id' => $offer->listing->id,
                'user_id' => $offer->user_id,
                'price' => $offer->listing->offer->price,
            ]);

            // Reject all other offers
            $otherOffers = $offer->listing->offers->where('id', '!=', $offer->id);
            $otherOffers->load(['listing', 'listing.user', 'listing.user.company']);
            $otherOffers->each(function(Offer $offer) {
                $offer->update(['status' => 'rejected']);
                Mail::to($offer->user->email)->send(new ListingOfferRejectedMail($offer));
            });

            return view('offer_accepted', ['offer' => $offer]);
        }

        return response()->json(['message' => 'Invalid or expired link.'], 401);
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
