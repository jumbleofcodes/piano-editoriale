<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Resources\AuthLoginResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Attempt login
     *
     * @param AuthLoginRequest $request
     * @return AuthLoginResource
     * @throws ValidationException
     */
    public function login(AuthLoginRequest $request): AuthLoginResource
    {
        $user = User::where('email', $request->email)->firstOrFail(); //se non trova nessuna corrispondenza restituisce un errore

        if (!Hash::check($request->password, $user->password)) { //qui sactum ci facilita le cose | controllo sulle password (che è cifrata)
            throw ValidationException::withMessages([
                'email' => 'Invalid credentials',
            ]);

        }

        return new AuthLoginResource($user);
    }

}
