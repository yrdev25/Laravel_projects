<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array_1 = array('area','customer','delete','state','user','role','permission');
        $array_2 = array('category','city','country');

        foreach($array_1 as $k => $var){
            $array = array('view_'.$var.'s','create_'.$var.'','edit_'.$var.'','destroy_'.$var.'');
            foreach($array as $k => $v){
                Permission::create(['name' => $v]);
            }
        }

        foreach($array_2 as $k => $var){
            $y = rtrim($var, 'y');
            $array = array('view_'.$y.'ies','create_'.$var.'','edit_'.$var.'','destroy_'.$var.'');
            foreach($array as $k => $v){
                Permission::create(['name' => $v]);
            }
        }
    }
}
