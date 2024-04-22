<?php

namespace App\Http\Controllers;

use App\Http\Resources\User\DetailsResource;
use App\Http\Resources\User\ShowResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{

    // meant for the currently logged in user
    public function details() {
        return new DetailsResource(Auth::user());
    }

    // meant for public display
    public function show(User $user)
    {
        return new ShowResource($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
