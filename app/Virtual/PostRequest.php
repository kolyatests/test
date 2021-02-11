<?php

/**
 * @OA\Schema(
 *     type="object",
 *     title="Example post request",
 *     description="Example post",
 * )
 */
class PostRequest
{
    /**
     * @OA\Property(
     *     title="title",
     *     description="Post title",
     *     example="random",
     * )
     *
     * @var string
     */
    public string $title;

    /**
     * @OA\Property(
     *     title="content",
     *     description="Post text",
     *     example="random",
     * )
     *
     * @var string
     */
    public string $content;

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

    /**
     * @OA\Property(
     *     title="slug",
     *     description="Post slug",
     *     example="random",
     * )
     *
     * @var string
     */
    public string $slug;

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

}
