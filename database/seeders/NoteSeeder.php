<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\Prospect;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 40; $i++) {
            Note::create([
                'user_id' => User::inRandomOrder()->first()->id,
                'prospect_id' => Prospect::inRandomOrder()->first()->id,
                'title' => $faker->word,
                'body' => $faker->paragraph,
                'type_of_contact' => $faker->paragraph,
            ]);
        }
    }
}
