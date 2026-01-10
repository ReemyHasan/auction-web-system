<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryService $modelService
    ) {}
    public function index()
    {
        $categories = $this->modelService->getAll();

        return response()->format(CategoryResource::collection($categories), 'Categories list');
    }

    public function show($id)
    {
        $category = $this->modelService->findById($id);

        return response()->format(new CategoryResource($category), 'Category details');
    }
}
