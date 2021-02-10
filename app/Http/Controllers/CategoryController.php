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
    public function __invoke($slug): JsonResponse
    {
        $category = Category::where('slug', $slug)->first()->load('categoryChildren.posts');
        if (! $category) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }

        return response()->json($category, 200);
    }
}
