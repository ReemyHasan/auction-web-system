<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'slug' => $this->slug,
            'parent' => $this->parent ? [
                'id' => $this->parent?->id,
                'name' => $this->parent?->name,
                'is_active' => $this->parent?->is_active,
            ] : null,
            'children'    => $this->whenLoaded('children', function () {
                return $this->children->map(function ($child) {
                    return [
                        'id'   => $child->id,
                        'name' => $child->name,
                        'slug' => $child->slug,
                    ];
                });
            }),
            'is_active' => $this->is_active,
            'added_at' => showDateTime($this->created_at),
            'updated_at' => diffForHumans($this->updated_at)
        ];
    }
}
