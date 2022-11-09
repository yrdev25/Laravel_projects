<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Country;
use App\Models\Address;
use App\Models\City;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Country::create([
            'name' => 'India',
        ]);
        Country::create([
            'name' => 'Australia',
        ]);
        Country::create([
            'name' => 'Argentina',
        ]);

        State::create([
            'country_id' => '1',
            'name' => 'Gujrat'
        ]);

        State::create([
            'country_id' => '1',
            'name' => 'Maharashtra'
        ]);

        State::create([
            'country_id' => '1',
            'name' => 'Tamil Nadu'
        ]);
        
        State::create([
            'country_id' => '2',
            'name' => 'New South Wales'
        ]);

        State::create([
            'country_id' => '2',
            'name' => 'Queensland'
        ]);

        City::create([
            'state_id' => '1',
            'name' => 'Sidhpur'
        ]);
        
        City::create([
            'state_id' => '1',
            'name' => 'Ahmd'
        ]);
    
        City::create([
            'state_id' => '2',
            'name' => 'Mumbai'
        ]);
    }
}
