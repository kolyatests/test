<?php

namespace Tests\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Generator\CategoryGenerator;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use DatabaseMigrations;


    public function testIndex()
    {
        CategoryGenerator::createCategory();
        $this->get(route('categories.index'))
            ->assertStatus(200)
            ->assertSee('category description')
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
                'content' => 'category description'
            ]
        );
    }

    public function testShow()
    {
        CategoryGenerator::createCategory();
        $this->get(route('categories.show', ['category' => 1]))
            ->assertStatus(200)
            ->assertSee('category description')
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
                'content' => 'category description'
            ]
        );
    }


    public function testStore()
    {
        CategoryGenerator::createCategory();
        $this->post(
            route(
                'categories.store',
                [
                    'title' => 'category',
                    'content' => 'category description',
                    'parent_id' => '1'
                ]
            )
        )
            ->assertStatus(201)
            ->assertSee('category description')
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
                'content' => 'category description'
            ]
        );
    }

    public function testUpdate()
    {
        $category = CategoryGenerator::createCategory();
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
        $category = CategoryGenerator::createCategory();
        $this->delete(route('categories.destroy', 1))
            ->assertStatus(204);
        $this->assertSoftDeleted($category);
    }


}
