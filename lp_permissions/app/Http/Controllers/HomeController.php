<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

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
        if(Auth::id() == '1'){
            if(Auth::user()->hasAllPermissions(['create_hr','create_employee']))
            {
                $users = User::with('roles')->whereNotIn('id',[Auth::id()]);
                return view('home',compact('users'));
            }else{
                $user = Auth::user();
                $user->assignRole('admin');
                return redirect()->route('home');
            }          
        }
        
        if(Auth::user()->hasPermissionTo('create_employee')){               
            $users = User::with('roles')->whereNotIn('id',[Auth::id(),'1'])->get();
            return view('home',compact('users')); 
        }

        return view('home');
    }

    public function create(){

        return view('create');
    }

    public function store(Request $request){
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role_id' => ['required']
        ]);

        $role_id = $request->role_id;
        $password = Hash::make($request->password);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
        ]);
        
        if($role_id == '2'){
            $user->assignRole('hr');
        }
        elseif($role_id == '3'){
            $user->assignRole('employee');
        }
        return redirect()->route('home');
    }

    public function importform()
    {
       return view('importform');
    }

     
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request) 
    {
        $request->validate([
           'file' => 'required'
        ]);
        Excel::import(new UsersImport,$request->file('file'));            
        // return back();
        return redirect()->route('home');
    }
}
