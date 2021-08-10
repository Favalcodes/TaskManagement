<?php

namespace Database\Seeders;

use App\Models\Upcoming;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UpcomingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for($i = 0; $i<5; $i++){
            Upcoming::create([
                'completed' => false,
                'title' => $faker->sentence($nbWords = 4, $variableNbWords = false),
                'approved' => false,
                'waiting' => true,
                'taskId' => Str::random(10)
            ]);
        }
    }
}
