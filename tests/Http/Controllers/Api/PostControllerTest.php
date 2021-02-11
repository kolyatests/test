<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Generator\PostGenerator;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use DatabaseMigrations;


    public function testIndex()
    {
        PostGenerator::createPost();
        $this->get(route('posts.index'))
            ->assertStatus(200)
            ->assertSee('post description')
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
                'content' => 'post description'
            ]
        );
    }

    public function testShow()
    {
        PostGenerator::createPost();
        $this->get(route('posts.show', ['post' => 1]))
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


    public function testStore()
    {
        PostGenerator::createPost();
        $this->post(
            route(
                'posts.store',
                [
                    'title' => 'post',
                    'content' => 'post description',
                    'category_id' => '1'
                ]
            )
        )
            ->assertStatus(201)
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

    public function testUpdate()
    {
        $post = PostGenerator::createPost();
        $this->put(
            'api/posts/1',
            [
                'title' => 'post new',
                'content' => 'post description new',
                'category_id' => '1'
            ]
        )
            ->assertStatus(200)
            ->assertSee('post description new');
        $this->assertDatabaseHas(
            'posts',
            [
                'content' => 'post description new'
            ]
        );
        $this->assertFalse($post->title == Post::first()->title);
    }

    public function testDestroy()
    {
        $post = PostGenerator::createPost();
        $this->delete(route('posts.destroy', 1))
            ->assertStatus(204);
        $this->assertSoftDeleted($post);
    }


}
