<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Favorite; // Assuming Favorite is the model being used

class FavoriteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        do {
            $randomUserId = User::inRandomOrder()->first()->id;
            $randomActivityId = Activity::inRandomOrder()->first()->id;
        } while ($this->checkDuplicate($randomUserId, $randomActivityId));

        return [
            'user_id' => $randomUserId,
            'activity_id' => $randomActivityId,
        ];
    }

    private function checkDuplicate($userId, $activityId): bool
    {
        return Favorite::where('user_id', $userId)
            ->where('activity_id', $activityId)
            ->exists();
    }
}
