<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\ActivityMember;
use App\Models\MasterActivity;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = User::pluck('id')->toArray();
        $masterActivityIds = MasterActivity::pluck('id')->toArray();

        $user = User::all()->random();
        $masterActivity = MasterActivity::inRandomOrder()->first();

        $userIndex = array_rand($userIds);
        $masterActivityIndex = array_rand($masterActivityIds);

        if ($user->id != $userIds[$userIndex]) {
            $user = User::find($userIds[$userIndex]);
        }

        if ($masterActivity->id != $masterActivityIds[$masterActivityIndex]) {
            $masterActivity = MasterActivity::find($masterActivityIds[$masterActivityIndex]);
        }

        // Create the Activity instance
        $activity = Activity::create([
            'user_id' => $user->id,
            'master_activity_id' => $masterActivity->id,
            'name' => $this->faker->sentence,
            'detail' => $this->faker->paragraph,
            'goal' => $this->faker->paragraph,
            'location' => $this->faker->city,
            'maximum' => $this->faker->numberBetween(5, 20),
            'post_image_path' => "avatars/default.png",
            'start_date' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
            'end_date' => $this->faker->dateTimeBetween('+2 weeks', '+4 weeks'),
        ]);

        ActivityMember::create([
            'user_id' => $activity->user_id,
            'activity_id' => $activity->id,
        ]);

        return [
            'user_id' => $user->id,
            'master_activity_id' => $masterActivity->id,
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
