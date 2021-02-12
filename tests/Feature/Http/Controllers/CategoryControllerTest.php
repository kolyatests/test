<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Generator\CategoryGenerator;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function test__invoke()
    {
        CategoryGenerator::createCategory();
        $this->get(route('category', ['category' => 'category']))
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
}
