<?php

/**
 * @OA\Schema(
 *     type="object",
 *     title="Example post request",
 *     description="Example post",
 * )
 */
class PostListRequest
{
    /**
     * @OA\Property(
     *     title="ID",
     *     format="number",
     *     description="Unique ID",
     *     example="1"
     * )
     *
     * @var int
     */
    public int $id;

    /**
     * @OA\Property(
     *     title="Title",
     *     description="Post title",
     *     example="random",
     * )
     *
     * @var string
     */
    public string $title;

    /**
     * @OA\Property(
     *     title="Content",
     *     description="Post text",
     *     example="random",
     * )
     *
     * @var string
     */
    public string $content;

    /**
     * @OA\Property(
     *     title="Slug",
     *     description="Post slug",
     *     example="random",
     * )
     *
     * @var string
     */
    public string $slug;

    /**
     * @OA\Property(
     *     title="category_id",
     *     description="Category id",
     *     format="number",
     *     example="1"
     * )
     *
     * @var int
     */
    public int $category_id;
}
