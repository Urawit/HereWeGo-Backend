<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityMemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = User::pluck('id')->toArray();
        $activityIds = Activity::pluck('id')->toArray();

        $userId = $this->faker->unique()->randomElement($userIds);
        $activityId = $this->faker->unique()->randomElement($activityIds);

        return [
            'user_id' => $userId,
            'activity_id' => $activityId,
        ];
    }
}
