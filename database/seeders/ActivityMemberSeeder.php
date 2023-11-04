<?php

namespace Database\Seeders;

use App\Models\ActivityMember;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivityMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      ActivityMember::factory(10)->create();
    }
}
