<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Http\Resources\Listing\ListResource;
use App\Http\Resources\Listing\ShowResource;

class AdminListingController extends Controller
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
