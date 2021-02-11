<?php

/**
 * @OA\Schema(
 *     type="object",
 *     title="Example category request",
 *     description="Example category",
 * )
 */
class CategoryRequest
{
    /**
     * @OA\Property(
     *     title="Title",
     *     description="Post title",
     *     example="random",
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *     title="Content",
     *     description="Post text",
     *     example="random",
     * )
     *
     * @var string
     */
    public $content;

    /**
     * @OA\Property(
     *     title="Slug",
     *     description="Post slug",
     *     example="random",
     * )
     *
     * @var string
     */
    public $slug;

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
    public $id;
}
