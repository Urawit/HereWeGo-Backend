<?php

namespace Database\Factories;

use App\Models\MasterActivity;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAcitivity>
 */
class UserActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      $user = User::all()->random();
      $activity = MasterActivity::all()->random();
      return [
        'user_id' => $user->id,
        'master_activity_id' => $activity->id,
      ];
    }
}
