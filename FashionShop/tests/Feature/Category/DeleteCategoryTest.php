<?php

namespace Tests\Feature\Category;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class DeleteCategoryTest extends TestCase
{
    // use RefreshDatabase;
    /** @test */
    public function userCanDeleteCategoryIfCategoryExists()
    {
        $admin = User::factory()->create(['role_as' => 1]);
        // $category = Category::factory()->create();
        $categoryId = 2;
        $response = $this->actingAs($admin)->get('admin/category/'.$categoryId.'/delete');
        $response->assertStatus(302);
    }

    /** @test */
    public function userCanNotDeleteCategoryIfCategoryNotExists()
    {
        $admin = User::factory()->create(['role_as' => 1]);
        $categoryId = -1;
        $response = $this->actingAs($admin)->get('admin/category/'.$categoryId.'/delete');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
