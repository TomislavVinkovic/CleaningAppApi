<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use App\Http\Resources\User\DetailsResource;
use App\Http\Resources\User\ListResource;
use App\Http\Resources\User\ShowResource;

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

    public function list(Request $request) {
        $perPage = $request->query('per_page', 10);
        $users = User::paginate($perPage);

        return ListResource::collection($users);
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
