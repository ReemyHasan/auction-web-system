<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function __construct(
        protected CategoryService $modelService
    ) {}
    public function store(CategoryRequest $request)
    {

        $category = $this->modelService->create($request->validated());

        return response()->format(new CategoryResource($category), 'Category created', 201);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category = $this->modelService->update($category, $request->validated());


        return response()->format(new CategoryResource($category), 'Category updated');
    }

    public function destroy(Category $category)
    {
        $this->modelService->delete($category);


        return response()->format(null, 'Category deleted', 200);
    }
}
