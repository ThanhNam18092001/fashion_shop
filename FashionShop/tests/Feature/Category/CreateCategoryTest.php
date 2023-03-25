<?php

namespace Tests\Feature\Category;

use App\Models\Category;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CreateCategoryTest extends TestCase
{

    /** @test */
    public function userCanCreateCategoryIfDataIsValid(): void
    {
        $admin = User::factory()->create(['role_as' => 1]);
        $dataCreate = [
            'name' => $this->faker->name,
            'slug' => $this->faker->slug,
            'description' => $this->faker->text,
            'image' => $this->faker->image,
            'meta_title' => $this->faker->text,
            'meta_keyword' => $this->faker->text,
            'meta_description' => $this->faker->text,
            'status' => $this->faker->boolean,
        ];
        $response = $this->actingAs($admin)->post('admin/category', $dataCreate);

        $response->assertStatus(302);
        $response->assertRedirect(route('category.index'));
    }
}
