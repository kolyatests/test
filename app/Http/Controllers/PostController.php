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
    public function __invoke($slug): JsonResponse
    {
        $post = Post::where('slug', $slug)->first();
        if(! $post){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }

        return response()->json($post, 200);
    }

}
