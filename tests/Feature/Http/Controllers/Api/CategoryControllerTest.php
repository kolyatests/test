<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Generator\CategoryGenerator;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use DatabaseMigrations;


    public function testIndex()
    {
        $category = Category::factory()->create();
        $this->get(route('categories.index'))
            ->assertStatus(200)
            ->assertSee($category->title)
            ->assertJsonStructure(
                [
                    [
                        'id',
                        'title',
                        'content',
                        'slug',
                        'parent_id',
                    ]
                ]
            );
        $this->assertDatabaseHas(
            'categories',
            [
                'title' => $category->title
            ]
        );
    }

    public function testShow()
    {
        $category = Category::factory()->create();
        $this
            ->get(route('categories.show', 1))
            ->assertStatus(200)
            ->assertSee($category->title)
            ->assertJsonStructure(
                [
                    'id',
                    'title',
                    'content',
                    'slug',
                    'parent_id',
                ]
            )
        ;
        $this->assertDatabaseHas(
            'categories',
            [
                'title' => $category->title
            ]
        );
    }


    public function testStore()
    {
        $category = Category::factory()->make();
        $this
            ->post(route('categories.store', $category->toArray()))
            ->assertStatus(201)
            ->assertSee($category->title)
            ->assertJsonStructure(
                [
                    'title',
                    'content',
                    'parent_id',
                    'slug',
                    'id',
                ]
            );
        $this->assertDatabaseHas(
            'categories',
            [
                'title' => $category->title
            ]
        );
    }

    public function testUpdate()
    {
        $category = Category::factory()->create();
        $this->put(
            'api/categories/1',
            [
                'title' => 'category new',
                'content' => 'category description new',
                'parent_id' => '1'
            ]
        )
            ->assertStatus(200)
            ->assertSee('category description new');
        $this->assertDatabaseHas(
            'categories',
            [
                'content' => 'category description new'
            ]
        );
        $this->assertFalse($category->title == Category::first()->title);
    }

    public function testDestroy()
    {
        $post = Post::factory()->create();
        $category = Category::factory()->create();
        $this->delete(route('categories.destroy', 1))
            ->assertStatus(204);
        $this->assertSoftDeleted($category);
        $this->assertSoftDeleted($post);
    }


}
