<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use App\Http\Resources\User\DetailsResource;
use App\Http\Resources\User\ListResource;
use App\Http\Resources\User\ShowResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

    // meant for the currently logged in user
    public function details() {
        $user = User::find(Auth::id())->load('company', 'roles');
        return new DetailsResource($user);
    }

    // meant for public display
    public function show(User $user)
    {
        $user->load('company', 'roles');
        return new ShowResource($user);
    }

    public function list(Request $request) {
        $perPage = $request->query('per_page', 10);
        $users = User::paginate($perPage);

        return ListResource::collection($users);
    }

    public function verify(User $user) {
        $user->email_verified_at = now();
        $user->save();

        return response()->json([
            'data' => [
                'message' => 'Korisnik uspješno verificiran!'
            ]
        ]);
    }

    public function deactivate(User $user) {
        $user->email_verified_at = null;
        $user->save();

        return response()->json([
            'data' => [
                'message' => 'Korisnik uspješno deaktiviran!'
            ]
        ]);
    }

    public function resetPassword(User $user) {
        if($user->email_verified_at === null) {
            return response()->json([
                'error' => 'Korisnik nije verificiran!'
            ], 400);
        }
        // TODO: send email with new password
        // TODO: see security considerations
        $user->password = Hash::make(Str::random(16));
        $user->save();

        return response()->json([
            'data' => [
                'message' => 'Lozinka uspješno resetirana!'
            ]
        ]);
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
