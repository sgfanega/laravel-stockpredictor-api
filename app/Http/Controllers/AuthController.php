<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;

    /**
     * Login Method
     *
     * @param \App\Http\Requests\LoginUserRequest
     * @return \App\Traits\HttpResponse
     */
    public function login(LoginUserRequest $request)
    {
        $request->validated($request->only(['email', 'password']));

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return $this->fail('', 'Credentials do not match', 401);
        }

        $user = User::where('email', $request->email)->first();

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token')->plainTextToken
        ], "Do not share Tokens!");
    }

    /**
     * Register Method
     * 
     * @param \App\Http\Requests\StoreUserRequest
     * @return \App\Traits\HttpResponse
     */
    public function register(StoreUserRequest $request)
    {
        $request->validated($request->only(['name', 'email', 'password']));

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token')->plainTextToken
        ], "Welcome to the club.");
    }

    /**
     * Logout Method
     * 
     * @return \App\Traits\HttpResponse
     */
    public function logout()
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();

        $user->currentAccessToken()->delete();

        return $this->success(null, 'You have succesfully logged out of the Stock Predictor API, and your token has been deleted.');
    }
}
