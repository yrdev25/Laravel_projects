<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class GivePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::findById(1);
        $permission = Permission::findById(1);
        $permission2 = Permission::findById(2);
        $role1->givePermissionTo($permission);
        $role1->givePermissionTo($permission2); 
    
        $role2 = Role::findById(2);
        $permission3 = Permission::findById(2);
        $role2->givePermissionTo($permission3);
        
    }
}
