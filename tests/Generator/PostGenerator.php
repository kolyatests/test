<?php

namespace Tests\Generator;

use App\Models\Category;
use App\Models\Post;

class PostGenerator
{
    public static function createPost()
    {

        Category::create(
            [
                'title' => 'category',
                'content' => 'category description',
                'slug' => 'category',
                'parent_id' => '0',
            ]
        );
        return Post::create(
            [
                'title' => 'post',
                'content' => 'post description',
                'slug' => 'post',
                'category_id' => '1',
            ]
        );
    }


}
