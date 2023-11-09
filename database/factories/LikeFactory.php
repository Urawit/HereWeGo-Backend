<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    do {
        $randomUserId = User::inRandomOrder()->value('id');
        $randomActivityId = Activity::inRandomOrder()->value('id');
    } while ($this->checkDuplicate($randomUserId, $randomActivityId));

    return [
        'user_id' => $randomUserId,
        'activity_id' => $randomActivityId,
    ];
}

private function checkDuplicate($userId, $activityId): bool
{
    return Like::where('user_id', $userId)
        ->where('activity_id', $activityId)
        ->exists();
}
}
