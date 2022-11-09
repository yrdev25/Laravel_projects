<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        // \App\Models\User::create([
        //     'name' => 'admin',
        //     'email' => 'admin@admin.com',
        //     'password' => Hash::make('admin1234'),
        //  ]);

        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            GivePermissionsSeeder::class
        ]);
    }
}
