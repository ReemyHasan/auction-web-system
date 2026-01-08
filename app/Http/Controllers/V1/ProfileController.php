<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {}
    public function myProfile()
    {
        $user = auth()->user();
        return response()->format(new UserResource($user), 'messages.register_success', 200, true);
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $data = $request->validated();

        $user = $this->userService->update(auth()->user(), $data);

        return response()->format(new UserResource($user), 'messages.register_success', 200, true);
    }
}
