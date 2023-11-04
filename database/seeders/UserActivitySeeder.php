<?php

namespace Database\Seeders;

use App\Models\UserActivity;
use Database\Factories\UserAcitivityFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      UserActivity::factory(20)->create();
    }
}
