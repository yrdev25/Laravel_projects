<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          \App\Models\User::create([
            'fname' => 'admin',
            'lname' => 'admin',
            'email' => 'admin@admin.com',
            'username' => 'admin',
            'password' => Hash::make('admin1234'),
            'is_active' => '1',
            'role_id' => '1',
         ]);
           Role::create([ 'name' => 'admin']);
           $user = User::first();
           $user->assignRole('admin');
    }
}
