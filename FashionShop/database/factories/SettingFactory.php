<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'website_name'=>$this->faker->url(),
            'website_url'=>$this->faker->url(),
            'page_title'=>$this->faker->text(),
            'meta_keyword'=>$this->faker->realText(),
            'meta_description'=>$this->faker->realText(),
            'address'=>$this->faker->realText(),
            'phone1'=>$this->faker->phoneNumber(),
            'phone2'=>$this->faker->phoneNumber(),
            'email1'=>$this->faker->email(),
            'email2'=>$this->faker->email(),
            'facebook'=>$this->faker->url(),
            'instagram'=>$this->faker->url(),
            'youtube'=>$this->faker->url(),
            'master_cart'=>$this->faker->url(),
            'visa'=>$this->faker->url(),
            'paypal'=>$this->faker->url(),
        ];
    }
}
