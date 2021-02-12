<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use DatabaseMigrations;


    public function testIndex()
    {
        $post = Post::factory()->create();
        $this->get(route('posts.index'))
            ->assertStatus(200)
            ->assertSee($post->title)
            ->assertJsonStructure(
                [
                    [
                        'id',
                        'title',
                        'content',
                        'slug',
                        'category_id',
                    ]
                ]
            );
        $this->assertDatabaseHas(
            'posts',
            [
                'title' => $post->title
            ]
        );
    }

    public function testShow()
    {
        $post = Post::factory()->create();
        $this->get(route('posts.show', 1))
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

    public function testStore()
    {
        Category::factory()->create();
        $post = Post::factory()->make();
        $this->post(
            route('posts.store',$post->toArray()))
            ->assertStatus(201)
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

    public function testUpdate()
    {
        Category::factory()->create();
        $postOld = Post::factory()->create();
        $postNew = Post::factory()->make();
        $this->put('api/posts/1',$postNew->toArray())
            ->assertStatus(200)
            ->assertSee($postNew->title);
        $this->assertDatabaseHas(
            'posts',
            [
                'title' => $postNew->title
            ]
        );
        $this->assertFalse($postOld->title == Post::first()->title);
    }

    public function testDestroy()
    {
        $post = Post::factory()->create();
        $this->delete(route('posts.destroy', 1))
            ->assertStatus(204);
        $this->assertSoftDeleted($post);
    }
}
