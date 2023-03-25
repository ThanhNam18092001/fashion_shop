<?php

namespace Tests\Feature\Category;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class UpdateCategoryTest extends TestCase
{

    /** @test */
    public function userCanUpdateCategoryIfCategoryExistsAndDataIsValid()
    {
        $admin = User::factory()->create(['role_as' => 1]);
        // $category = Category::factory()->create();
        $categoryId = 2;
        $dataUpdate = [
            'name' => $this->faker->name,
            'slug' => $this->faker->slug,
            'description' => $this->faker->text,
            'image' => $this->faker->image,
            'meta_title' => $this->faker->text,
            'meta_keyword' => $this->faker->text,
            'meta_description' => $this->faker->text,
            'status' => $this->faker->boolean,
        ];

        $this->withoutMiddleware();
        $response = $this->actingAs($admin)->put(route('category.update', $categoryId), $dataUpdate);

        $response->assertStatus(302);
        $response->assertRedirect(route('category.index'));
    }
}
