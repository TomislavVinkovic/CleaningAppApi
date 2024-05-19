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
use Illuminate\Support\Facades\Mail;

use App\Http\Resources\Listing\ListResource;
use App\Http\Resources\Listing\ShowResource;
use App\Mail\ListingConfirmedMail;
use Illuminate\Support\Facades\Log;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list(Request $request) {
        $perPage = $request->query('per_page', 10);
        $listings = Listing::paginate($perPage);

        return ListResource::collection($listings);
    }

    public function show(Listing $listing)
    {
        $listing->load('service');
        // depending on the type of the service, load different relationship model
        switch($listing->service->type) {
            case 'kercher':
                $listing->load('service.kercherService');
                break;
            case 'sofa':
                $listing->load('service.sofaCleaningService');
                break;
            case 'car':
                $listing->load('service.carCleaningService');
                break;
            case 'carpet':
                $listing->load('service.carpetCleaningService');
                break;
        }

        return new ShowResource($listing);
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

            Mail::to($validated['email'])->send(new ListingConfirmedMail($listing));
            
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
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();

        return response()->json([
            'data' => [
                'message' => 'Zahtjev uspješno obrisan!'
            ]
        ]);
    }
}
