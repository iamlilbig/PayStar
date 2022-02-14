<?php

namespace App\Http\Controllers\v1;

use App\Exceptions\v1\NotMatchCredentialException;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

    /**
     * Register User With Email & Password & Name.
     *
     */
    public function register(RegisterRequest $request)
    {
        $token = Str::random(64);


        $validData = [
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'token'=> $token
        ];
        $user = User::query()->create($validData);
        return response()->json(
            [
                'massage' => 'successes',
                'data' => new UserResource($user),
            ],
            200
        );
    }

    /**
     * Login User With Email & Password.
     *
     */
    public function login(LoginRequest $request)
    {
        $validData = [
            'email' => $request->email,
            'password'=>$request->password,
        ];
        if(Auth::attempt($validData)){
            return response()->json(
                [
                    'massage' => 'successes',
                    'data' => new UserResource(Auth::user()),
                ],
                200
            );
        }

        throw new NotMatchCredentialException();
    }

    /**
     * Show User Credential.
     *
     */
    public function Show(Request $request)
    {
        return response()->json(
            [
                'massage' => 'successes',
                'data' => new UserResource(Auth::user()),
            ],
            200
        );
    }
}
