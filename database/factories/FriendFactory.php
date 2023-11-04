<?php

namespace Database\Factories;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Friend>
 */
class FriendFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      $user = User::all()->random();
      $friend = User::where('id', '!=', $user->id)->inRandomOrder()->first();
      return [
        "user_id"=> $user->id,
        "friend_id"=> $friend->id,
      ];
    }

    public function configure()
    {
      return $this->afterCreating(function (Friend $friend) {
        Friend::create([
            'user_id' => $friend->friend_id,
            'friend_id' => $friend->user_id,
        ]);
    });
    }
}
