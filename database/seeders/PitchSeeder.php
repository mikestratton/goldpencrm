<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\Pitch;
use App\Models\Prospect;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PitchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            Pitch::create([
                'user_id' => User::inRandomOrder()->first()->id,
                'note_id' => Note::inRandomOrder()->first()->id,
                'title' => $faker->domainWord,
                'body' => $faker->text($maxNbChars = 75),
            ]);
        }
    }
}
