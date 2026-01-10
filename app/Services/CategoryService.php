<?php

namespace App\Services;

use Illuminate\Support\Collection;
use App\Models\Category;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class CategoryService
{

    protected Category $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }


    public function getAll(): Collection
    {
        return $this->model->with(['children', 'stats'])
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->latest()
            ->get();
    }

    public function findById(int $id): ?Category
    {
        return $this->model->with(['children', 'parent', 'stats'])->find($id);
    }

    public function findByEmail(string $email): ?Category
    {
        return $this->model->where('email', $email)->first();
    }


    public function create(array $data): Category
    {
        $data['slug'] = Str::slug($data['name']);

        return $this->model->create($data);
    }

    public function update(Category $category, array $data): Category
    {
        $data['slug'] = Str::slug($data['name']);
        $category->update($data);
        return $category;
    }


    public function delete(Category $category): bool
    {
        if ($category->children()->exists()) {
            throw new BadRequestException('Cannot delete category with subcategories');
        }
        return $category->delete();
    }
}
