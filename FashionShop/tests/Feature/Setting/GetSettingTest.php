<?php

namespace Tests\Feature\Setting;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class GetSettingTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function youCanGetSettingIfCategoryExists()
    {
        $admin = User::factory()->create(['role_as' => 1]);
        $response = $this->actingAs($admin)->get('admin/settings');
        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function youCannotSeeTheListOfSettings()
    {
        $response = $this->get('admin/settings');
        $response->assertStatus(302);
    }
}
