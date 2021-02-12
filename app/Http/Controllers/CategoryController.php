<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Category $category): JsonResponse
    {
        $category = $this->load('categoryChildren.posts');

        return response()->json($category, 200);
    }
}
