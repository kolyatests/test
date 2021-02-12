<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param $slug
     * @return JsonResponse
     */
    public function __invoke(Post $post): JsonResponse
    {
        return response()->json($post, 200);
    }

}
