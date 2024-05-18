<?php

namespace App\Http\Controllers;

use App\Http\Requests\Listing\CreateRequest;
use App\Models\Listing;
use Illuminate\Http\Request;

use App\Models\Service;
use App\Models\SofaCleaningService;
use App\Models\CarpetCleaningService;
use App\Models\CarCleaningService;
use App\Models\KercherService;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $service = null;
        $listing = null;
        $serviceInfo = null;
        try {
            $validated = $request->validated();

            // Create a new service
            $service = Service::create([
                'type' => $validated['listingCategory'],
                'duration_days' => $validated['durationDays'] ?? null,
            ]);

            // Depending on the listingCategory, create the appropriate service
            switch ($validated['listingCategory']) {
                case 'sofa':
                    $serviceInfo = SofaCleaningService::create([
                        'no_seats' => $validated['listingSofaNumberOfSeats'],
                        'service_id' => $service->id,
                    ]);
                    break;

                case 'carpet':
                    $serviceInfo = CarpetCleaningService::create([
                        'area' => $validated['listingCarpetArea'],
                        'service_id' => $service->id,
                    ]);
                    break;

                case 'car':
                    $serviceInfo = CarCleaningService::create([
                        'car_type' => $validated['listingCarType'],
                        'no_seats' => $validated['listingCarSeats'],
                        'service_id' => $service->id,
                    ]);
                    break;

                case 'kercher':
                    $serviceInfo = KercherService::create([
                        'psi' => $validated['listingKercherPSI'],
                        'chemicals_description' => $validated['listingKercherChemicals'],
                        'service_id' => $service->id,
                    ]);
                    break;
            }

            // create the listing
            $listing = Listing::create([
                'first_name' => $validated['firstName'],
                'last_name' => $validated['lastName'],
                'email' => $validated['email'],
                'oib' => $validated['oib'],
                'address' => $validated['listingAddress'],
                'city' => $validated['listingCity'],
                'postal_code' => $validated['listingPostalCode'],
                'type' => $validated['listingType'],
                'service_id' => $service->id,
            ]);
            
            return response()->json([
                'data' => [
                    'message' => '
                        Zahtjev uspješno kreiran!
                        Dobit ćete dodatnu potvrdu na vašu email adresu.
                        Ponude će vam također biti poslane na email adresu.
                    ',
                ]
            ], 201);
        }
        catch (\Exception $e) {
            if ($service) {
                $service->delete();
            }
            if ($serviceInfo) {
                $serviceInfo->delete();
            }
            if ($listing) {
                $listing->delete();
            }
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        //
    }
}
