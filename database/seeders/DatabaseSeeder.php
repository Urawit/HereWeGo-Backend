<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      $this->call(MasterActivitySeeder::class);
      $this->call(UserSeeder::class);
      $this->call(UserActivitySeeder::class);
      $this->call(FriendSeeder::class);
      // $this->call(NotificationSeeder::class);
      $this->call(ActivitySeeder::class);
      $this->call(ActivityMemberSeeder::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
