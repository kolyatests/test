<?php

namespace Tests\Http\Controllers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Generator\PostGenerator;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function test__invoke()
    {
        PostGenerator::createPost();
        $this->get(route('post', ['post' => 'post']))
            ->assertStatus(200)
            ->assertSee('post description')
            ->assertJsonStructure(
                [
                    'title',
                    'content',
                    'category_id',
                    'slug',
                    'id',
                ]
            );
        $this->assertDatabaseHas(
            'posts',
            [
                'content' => 'post description'
            ]
        );
    }
}
