<?php

namespace Tests\Feature\Category;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class GetCategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function youCanGetCategoryIfCategoryExists()
    {
        $admin = User::factory()->create(['role_as' => 1]);
        $category = Category::factory()->create();
        $response = $this->actingAs($admin)->getJson(route('category.show', $category->id));
        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function userCanNotGetCategoryIfCategoryNotExists()
    {
        $admin = User::factory()->create(['role_as' => 1]);
        $categoryId = -1;
        $response = $this->actingAs($admin)->getJson(route('category.show', $categoryId));
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
