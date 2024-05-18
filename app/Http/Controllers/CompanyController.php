<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\CreateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
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
        $user = null;
        $company = null;
        try {
            $user = User::create([
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'email' => $request->email,
                'name' => $request->email,
                'password' => Hash::make(Str::random(16)), // Create a random password
            ]);
    
            // Create a new company associated with the user
            $company = Company::create([
                'name' => $request->companyName,
                'oib' => $request->companyOib,
                'address' => $request->companyAddress,
                'city' => $request->companyCity,
                'postal_code' => $request->companyPostalCode,
                'user_id' => $user->id,
                'description' => $request->companyDescription,
            ]);
        }
        catch (\Exception $e) {

            Log::info($e->getMessage());

            // If an error occurs, delete the user and company
            if ($user) {
                $user->delete();
            }
            if ($company) {
                $company->delete();
            }

            // Return an error response
            return response()->json(
                [
                    'error' => 'Došlo je do greške prilikom slanja zahtjeva! Pokušajte ponovno kasnije ili kontaktirajte korisničku službu!'
                ], 
                500
            );
        }
        

        // Return a response or redirect
        return response()->json(
            [
                'data' => [
                    'message' => '
                    Zahtjev uspješno poslan! Nakon naše provjere, 
                    dobit ćete obavijest i podatke za prijavu na Vašu e-mail adresu!
                '
                ]
            ], 
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }
}
