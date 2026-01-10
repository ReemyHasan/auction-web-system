<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'wallet_address' => $this->wallet_address,
            'role' => $this->role,
            'added_at' => showDateTime($this->created_at),
            'updated_at' => diffForHumans($this->updated_at)
        ];
    }
}
