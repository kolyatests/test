<?php

/**
 * @OA\Schema(
 *     type="object",
 *     title="Example category request",
 *     description="Example category",
 * )
 */
class CategoryListRequest
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
    public $id;

    /**
     * @OA\Property(
     *     title="Title",
     *     description="Category title",
     *     example="random",
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *     title="Content",
     *     description="Category text",
     *     example="random",
     * )
     *
     * @var string
     */
    public $content;

    /**
     * @OA\Property(
     *     title="Slug",
     *     description="Category slug",
     *     example="random",
     * )
     *
     * @var string
     */
    public $slug;

    /**
     * @OA\Property(
     *     title="ParentId",
     *     description="Parent category id",
     *     format="number",
     *     example="1"
     * )
     *
     * @var int
     */
    public $parent_id;
}
