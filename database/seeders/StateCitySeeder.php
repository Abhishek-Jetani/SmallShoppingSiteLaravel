<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $states = [
            'California' => ['Los Angeles', 'San Diego', 'San Francisco'],
            'Texas' => ['Houston', 'Dallas', 'Austin'],
            'Florida' => ['Miami', 'Orlando', 'Tampa'],
            'New York' => ['New York City', 'Buffalo', 'Rochester'],
        ];

        foreach ($states as $stateName => $cities) {
            $state = State::create(['name' => $stateName]);

            foreach ($cities as $city) {
                City::create([
                    'name' => $city,
                    'state_id' => $state->id
                ]);
            }
        }
    }
}
