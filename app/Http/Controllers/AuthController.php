<?php

namespace App\Http\Controllers;

use App\Exceptions\BusinessException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::validate([
            'email' => $validated['email'],
            'password' => $validated['password'],
            'confirmed_email' => 'confirmed',
        ])) {
            $user = Auth::getLastAttempted();
            Auth::login($user);

            $token = $user->createToken('auth_token')->plainTextToken;
            cache(['user' . $validated['email'] . ':token' => $token], now()->addMinutes(600));

            return response()->json(['token' => $token]);
        } else {
            throw new BusinessException(__('messages.auth_fail'));
        }

    }
}
