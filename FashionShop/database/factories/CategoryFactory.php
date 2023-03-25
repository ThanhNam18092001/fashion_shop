<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name(),
            'slug'=>$this->faker->slug(),
            'description'=>$this->faker->text(),
            'image' => $this->faker->image(null, 360, 360, 'animals', true, true, 'cats', true),
            'meta_title'=>$this->faker->text(),
            'meta_keyword'=>$this->faker->text(),
            'meta_description'=>$this->faker->text(),
            'status'=>$this->faker->boolean(),
        ];
    }
}
