<?php

namespace Database\Seeders;

use App\Models\Prospect;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProspectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 40; $i++) {
            Prospect::create([
                'user_id' => User::inRandomOrder()->first()->id,
                'name_first' => $faker->firstName,
                'name_last' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->phoneNumber,
                'fax' => $faker->phoneNumber,
                'company' => $faker->company,
                'status' => $faker->numberBetween(1, 4),
            ]);
        }
    }
}
