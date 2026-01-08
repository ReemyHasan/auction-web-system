<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    public function __construct(
        protected UserService $userService
    ) {}
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $user = $this->userService->create($data);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->format([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => new UserResource($user)

        ], 'messages.register_success', 200, true);
    }
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->format(null, 'messages.credentials_failure', 401, false);
        }

        $user = User::where('email', $request->email)->firstOrFail();



        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->format([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => new UserResource($user)
        ], 'messages.login_success_message', 200, true);
    }

    public function logout()
    {
        $currentToken = auth()->user()->currentAccessToken();
        if ($currentToken) {
            $currentToken->delete();
        }

        return response()->format(null, 'messages.logout_success', 200, true);
    }

    public function deleteAccount()
    {
        DB::transaction(function () {
            $user = auth()->user();

            $user->tokens()->delete();
            $user->delete();
        });


        return response()->format(null, 'messages.account_deleted', 200, true);
    }
}
