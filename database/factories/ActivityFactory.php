<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => null, 
            'name' => $this->faker->sentence,
            'detail' => $this->faker->paragraph,
            'maximum' => $this->faker->numberBetween(5, 20),
            'post_image_path' => $this->faker->imageUrl(), 
            'start_date' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
            'end_date' => $this->faker->dateTimeBetween('+2 weeks', '+4 weeks'),
            'create_date' => now(),
            'delete_date' => null,
        ];
    }
}
