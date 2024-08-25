<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    /**
     * Register a new user and return a JWT token.
     *
     * @param array $data
     * @return string $token
     */
    public function register(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Generate JWT token for the user
        return JWTAuth::fromUser($user);
    }
// =============================================================================================================
    /**
     * Authenticate user and return a JWT token.
     *
     * @param array $credentials
     * @return string|false
     */
    public function login(array $credentials)
    {
        return JWTAuth::attempt($credentials);
    }
}
