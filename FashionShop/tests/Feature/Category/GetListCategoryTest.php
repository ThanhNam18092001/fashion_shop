<?php

namespace Tests\Feature\Category;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class GetListCategoryTest extends TestCase
{
    // use RefreshDatabase;

    /** @test */
    public function userCanListCategory()
    {
        $admin = User::factory()->create(['role_as' => 1]);
        $response = $this->actingAs($admin)->getJson(route('category.index'));
        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function userNoCanListCategory()
    {
        $response = $this->getJson(route('category.index'));
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
