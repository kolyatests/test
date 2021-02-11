<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * @OA\Get(
     *     path="/categories",
     *     operationId="Index",
     *     summary="Display a list of categories",
     *     tags={"Categories"},
     *     @OA\Response(
     *         response=200,
     *         description="Return a list of of categories",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/CategoryListRequest"),
     *             )
     *         )
     *     ),
     *     security={{ "apiAuth": {} }}
     * )
     *
     *
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse//
    {
        return response()->json(Category::all(), 200);
    }

    /**
     * @OA\Get(
     *     path="/categories/{id}",
     *     operationId="Show",
     *     summary="Show category",
     *     tags={"Categories"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Show category by id",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Show category by id",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/CategoryListRequest"),
     *             )
     *         )
     *     ),
     *     security={{ "apiAuth": {} }}
     * )
     *
     * Display the specified resource.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function show(Category $category): JsonResponse
    {
        return response()->json($category, 200);
    }

    /**
     * @OA\Post(
     *     path="/categories",
     *     operationId="Store",
     *     tags={"Categories"},
     *     summary="Store category",
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
     *         name="parent_id",
     *         in="query",
     *         description="Parent Id",
     *         required=true,
     *         example="1",
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
     *                 @OA\Items(ref="#/components/schemas/CategoryRequest"),
     *             )
     *         )
     *     ),
     *     security={{ "apiAuth": {} }}
     * )
     *
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return JsonResponse
     */
    public function store(CategoryRequest $request): JsonResponse
    {
        $category = Category::create($request->all());
        return response()->json($category, 201);
    }

    /**
     * @OA\Patch(
     *     path="/categories/{id}",
     *     operationId="Update",
     *     tags={"Categories"},
     *     summary="Update category",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Select category by id",
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
     *         description="Return new category name",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/CategoryListRequest"),
     *             )
     *         )
     *     ),
     *     security={{ "apiAuth": {} }}
     * )
     *
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param Category $category
     * @return JsonResponse
     */
    public function update(CategoryRequest $request, Category $category): JsonResponse
    {
        $category->update($request->all());
        return response()->json($category, 200);
    }

    /**
     * @OA\Delete(
     *     path="/categories/{id}",
     *     operationId="Delete",
     *     tags={"Categories"},
     *     summary="Remove category",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Remove category by id)",
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
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Category $category): JsonResponse
    {
        $category->remove();
        return response()->json('', 204);
    }
}
