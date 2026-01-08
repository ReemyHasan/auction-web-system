<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use App\Enums\UserRole;

class UserService
{

    protected User $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }


    public function getAll(): Collection
    {
        return $this->model->latest()->get();
    }

    public function findById(int $id): ?User
    {
        return $this->model->find($id);
    }

    public function findByEmail(string $email): ?User
    {
        return $this->model->where('email', $email)->first();
    }


    public function create(array $data): User
    {
        return $this->model->create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => $data['role'] ?? UserRole::USER,
        ]);
    }

    public function update(User $user, array $data): User
    {
        $user->update($data);
        return $user;
    }

    public function updatePassword(User $user, string $password): User
    {
        $user->update([
            'password' => Hash::make($password),
        ]);

        return $user;
    }


    public function changeRole(User $user, UserRole $role): User
    {
        $user->update([
            'role' => $role,
        ]);

        return $user;
    }


    public function activate(User $user, $activate = true): User
    {
        $user->update([
            'is_active' => $activate,
        ]);

        return $user;
    }

  

    public function updateWallet(User $user, string $walletAddress): User
    {
        $user->update([
            'wallet_address' => strtolower($walletAddress),
        ]);

        return $user;
    }

    public function delete(User $user): bool
    {
        return $user->delete();
    }
}
