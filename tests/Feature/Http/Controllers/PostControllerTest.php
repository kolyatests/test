<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Generator\PostGenerator;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function test__invoke()
    {
        $post = Post::factory()->create();
        $this->get(route('post', $post->slug))
            ->assertStatus(200)
            ->assertSee($post->title)
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
                'title' => $post->title
            ]
        );
    }
}
