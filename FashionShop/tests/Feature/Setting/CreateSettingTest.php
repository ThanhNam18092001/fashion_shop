<?php

namespace Tests\Feature\Setting;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateSettingTest extends TestCase
{
    /** @test */
    public function youCanGetSettingIfSettingExists()
    {
        $admin = User::factory()->create(['role_as' => 1]);
        $dataCreate = [
            'website_name'=>$this->faker->url,
            'website_url'=>$this->faker->url,
            'page_title'=>$this->faker->text,
            'meta_keyword'=>$this->faker->realText,
            'meta_description'=>$this->faker->realText,
            'address'=>$this->faker->realText,
            'phone1'=>$this->faker->phoneNumber,
            'phone2'=>$this->faker->phoneNumber,
            'email1'=>$this->faker->email,
            'email2'=>$this->faker->email,
            'facebook'=>$this->faker->url,
            'instagram'=>$this->faker->url,
            'youtube'=>$this->faker->url,
            'master_cart'=>$this->faker->url,
            'visa'=>$this->faker->url,
            'paypal'=>$this->faker->url,
        ];
        $response = $this->actingAs($admin)->post('admin/settings', $dataCreate);

        $response->assertStatus(302);
    }
}
