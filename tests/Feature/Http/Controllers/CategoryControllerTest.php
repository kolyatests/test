<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Generator\CategoryGenerator;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function test__invoke()
    {
        $category = Category::factory()->create();
        $this
            ->get(route('category', $category->slug))
            ->assertStatus(200)
            ->assertSee($category->title)
            ->assertJsonStructure(
                [
                    'title',
                    'content',
                    'parent_id',
                    'slug',
                    'id',
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
}
