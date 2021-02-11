<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    /**
     * @OA\Get(
     *     path="/posts",
     *     operationId="Index",
     *     summary="Display a list of posts",
     *     tags={"Posts"},
     *     @OA\Response(
     *         response=200,
     *         description="Return a list of of posts",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/PostListRequest"),
     *             )
     *         )
     *     ),
     *     security={{ "apiAuth": {} }}
     * )
     *
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Post::all(), 200);
    }

    /**
     * @OA\Get(
     *     path="/posts/{id}",
     *     operationId="Show",
     *     summary="Show post",
     *     tags={"Posts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Update post by id",
     *         required=true,
     *         example="2",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Show post by id",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/PostListRequest"),
     *             )
     *         )
     *     ),
     *     security={{ "apiAuth": {} }}
     * )
     *
     * Display the specified resource.
     *
     * @param Post $post
     * @return JsonResponse
     */
    public function show(Post $post): JsonResponse
    {
        return response()->json($post, 200);
    }

    /**
     * @OA\Post(
     *     path="/posts",
     *     operationId="Store",
     *     tags={"Posts"},
     *     summary="Store post",
     *     @OA\Parameter(
     *         name="title",
     *         in="query",
     *         description="Store title",
     *         required=true,
     *         example="new name",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="content",
     *         in="query",
     *         description="Store description",
     *         required=true,
     *         example="new description",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="category_id",
     *         in="query",
     *         description="Category Id",
     *         required=true,
     *         example="2",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Save completed successfully",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/PostRequest"),
     *             )
     *         )
     *     ),
     *     security={{ "apiAuth": {} }}
     * )
     *
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return JsonResponse
     */
    public function store(PostRequest $request): JsonResponse
    {
        $post = Post::add($request->all());
        $post->uploadImage($request->file('image'));
        $post->setCategory($request->get('category_id'));
        return response()->json($post, 201);
    }

    /**
     * @OA\Patch(
     *     path="/posts/{id}",
     *     operationId="Update",
     *     tags={"Posts"},
     *     summary="Update post",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Select post by id",
     *         required=true,
     *         example="2",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Parameter(
     *         name="title",
     *         in="query",
     *         description="Update title",
     *         required=true,
     *         example="new name",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="content",
     *         in="query",
     *         description="Update description",
     *         required=true,
     *         example="new description",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="parent_id",
     *         in="query",
     *         description="ParentId",
     *         required=true,
     *         example="2",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Return new post name",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/PostListRequest"),
     *             )
     *         )
     *     ),
     *     security={{ "apiAuth": {} }}
     * )
     *
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param Post $post
     * @return JsonResponse
     */
    public function update(PostRequest $request, Post $post): JsonResponse
    {
        $post->edit($request->all());
        $post->uploadImage($request->file('image'));
        $post->setCategory($request->get('category_id'));
        return response()->json($post, 200);
    }

    /**
     * @OA\Delete(
     *     path="/posts/{id}",
     *     operationId="Delete",
     *     tags={"Posts"},
     *     summary="Remove post",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Remove post by id)",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="204",
     *         description="Deleted",
     *     ),
     *     security={{ "apiAuth": {} }}
     * )
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return JsonResponse
     */
    public function destroy(Post $post): JsonResponse
    {
        $post->remove();
        return response()->json('', 204);
    }
}
