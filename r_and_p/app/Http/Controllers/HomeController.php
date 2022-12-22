<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      // $password = Hash::make('admin1234');
      // return $password;
        // Role::create(['name' => 'admin']);
         // Role::create(['name' => 'hr']);
          // Role::create(['name' => 'employee']);
         // Permission::create(['name' => 'add_hr']);
        //  Permission::create(['name' => 'add_employee']);
        $role = Role::findById(1);
           $permission = Permission::findById(1);
      //  $permission2 = Permission::findById(2);
         //$role->givePermissionTo($permission);
      //   $role->givePermissionTo($permission2);
     // auth()->user()->assignRole('Admin');
    //   $pormission->removeRole($role);
    // $user = User::first();
     $user->assignRole('admin');
  // return auth()->user()->getPermissionsViaRoles();
 

      if(Auth::user()->role_id == '2'){
        auth()->user()->assignRole('hr');
        $users = User::all()->except([Auth::id(),'1'])->where('role_id', '!=', '2');
        return view('home',compact('users'));
      }

      $users = User::all()->except(Auth::id());
      return view('home',compact('users'));
    }
}
