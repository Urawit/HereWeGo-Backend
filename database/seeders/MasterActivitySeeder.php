<?php

namespace Database\Seeders;

use App\Models\MasterActivity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $activities = [
        'Hiking',
        'Swimming',
        'Cooking',
        'Painting',
        'Reading',
        'Dancing',
        'Yoga',
        'Gardening',
        'Biking',
        'Writing',
        'Singing',
        'Camping',
        'Fishing',
        'Playing chess',
        'Playing tennis',
        'Bird watching',
        'Karaoke',
        'Running',
        'Photography',
        'Rock climbing',
        'Volunteering',
        'Sailing',
        'Meditation',
        'Sculpting',
        'Surfing',
        'Knitting',
        'Pottery',
        'Playing the piano',
        'Traveling',
        'Skiing',
        'Skydiving',
        'Woodworking',
        'Playing the guitar',
        'Canoeing',
        'Bird watching',
        'Geocaching',
        'Wine tasting',
        'Horseback riding',
        'Juggling',
        'Ice skating',
        'Rollerblading',
        'Mountain biking',
        'Birdwatching',
        'Kayaking',
        'Kite flying',
        'Model building',
        'Playing cards',
        'Gardening',
        'Ziplining',
        'Bowling',
        'Stargazing',
        'Scuba diving',
        'Playing the violin',
        'Origami',
        'Playing board games',
        'Cooking',
        'Making jewelry',
        'Indoor rock climbing',
        'Stand-up comedy',
        'Hula hooping',
        'Horseback riding',
        'Snorkeling',
        'Pottery',
        'Martial arts',
        'Photography',
        'Canyoning',
        'Dancing',
        'Wine tasting',
        'Playing the flute',
        'Rafting',
        'Painting',
        'Cycling',
        'Skydiving',
        'Singing',
        'Yoga',
        'Fishing',
        'Playing soccer',
        'Sculpting',
        'Playing the drums',
        'Bowling',
        'Gardening',
        'Geocaching',
        'Swimming',
        'Hiking',
        'Playing tennis',
        'Bird watching',
        'Karaoke',
        'Running',
        'Surfing',
        'Knitting',
        'Meditation',
        'Ziplining',
        'Canoeing',
        'Horseback riding',
        'Juggling',
        'Ice skating',
        'Birdwatching',
        'Kite flying',
        'Model building',
        'Playing cards' ];

      $uniqueActivities = array_unique($activities);

      foreach ($uniqueActivities as $activity) {
        MasterActivity::factory()->create(['name' => $activity]);
      }
    }
}
