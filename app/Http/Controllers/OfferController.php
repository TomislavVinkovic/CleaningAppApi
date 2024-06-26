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

use Illuminate\Support\Facades\Log;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $listings = Offer::where('user_id', auth()->id())
            ->with(['listing'])
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
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {

        $offer = null;
        $listing = Listing::find($request->listing_id);
        
        try {
            $offer = Offer::create([
                'price' => $request->price,
                'status' => 'pending',
                'listing_id' => $request->listing_id,
                'user_id' => auth()->id()
            ]);
            $offer->load(['user', 'user.company']);

            Mail::to($listing->email)->send(new ListingOfferReceivedMail($listing, $offer));

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
            $offer->load(['listing', 'listing.job', 'user', 'user.company']);
            if($offer->listing->job) {
                return response('Oglas već ima dodijeljenog davatelja usluge');
            }
            $offer->update(['status' => 'accepted']);
            
            Mail::to($offer->user->email)->send(new ListingOfferAcceptedMail($offer));

            // Create a new job
            Job::create([
                'listing_id' => $offer->listing->id,
                'user_id' => $offer->user_id,
                'price' => $offer->price,
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

        return response('Poveznica je nevaljana ili je istekla.');
    }
}
