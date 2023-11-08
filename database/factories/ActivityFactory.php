<?php

namespace Database\Factories;

use App\Models\User;
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
      $user = User::all()->random();
        return [
            'user_id' => $user->id, 
            'name' => $this->faker->sentence,
            'detail' => $this->faker->paragraph,
            'goal' => $this->faker->paragraph,
            'location' => $this->faker->city,
            'maximum' => $this->faker->numberBetween(5, 20),
            'post_image_path' => "avatars/default.png", 
            'start_date' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
            'end_date' => $this->faker->dateTimeBetween('+2 weeks', '+4 weeks'),
        ];
    }
}
