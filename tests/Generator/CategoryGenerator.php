<?php

namespace Tests\Generator;

use App\Models\Category;

class CategoryGenerator
{
    public static function createCategory()
    {

        return Category::create(
            [
                'title' => 'category',
                'content' => 'category description',
                'slug' => 'category',
                'parent_id' => '0',
            ]
        );
    }
}
