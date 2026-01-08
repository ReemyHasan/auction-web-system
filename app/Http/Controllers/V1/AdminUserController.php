<?php

namespace App\Http\Controllers\V1;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateUserStatusRequest;
use App\Http\Requests\Admin\UserRoleRequest;
use App\Http\Resources\AdminUserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AdminUserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('isAdmin', only: ['index', 'changeRole']),
        ];
    }
    public function __construct(
        protected UserService $userService
    ) {}

    public function index()
    {
        $users = $this->userService->getAll();
        return response()->format(AdminUserResource::collection($users), "messages.success", 200, true);
    }

    public function changeRole(UserRoleRequest $request, User $user)
    {
        $user = $this->userService->changeRole(
            $user,
            UserRole::from($request->role)
        );
        return response()->format(new AdminUserResource($user), "messages.success", 200, true);
    }

    public function toggleActivate(UpdateUserStatusRequest $request, User $user)
    {
        $status = $request->status == 'active' ? true : false;
        $user = $this->userService->activate(
            $user,
            $status
        );
        return response()->format(new AdminUserResource($user), "messages.success", 200, true);
    }
}
