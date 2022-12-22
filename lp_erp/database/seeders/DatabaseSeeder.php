<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

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
        $this->call([
            AdminSeeder::class,
            PermissionSeeder::class,
            CategorySeeder::class,
            CountrySeeder::class,
            StateSeeder::class,
            CitySeeder::class,
            AreaSeeder::class
        ]);
    }
}
