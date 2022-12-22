<?php

namespace App\Http\Controllers;

use App\Models\Model_Has_Role;
use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;


class UserController extends Controller
{
    public $userRepo;
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('auth');
        $this->middleware('permission:view_users')->only('index');
        $this->middleware('permission:create_user')->only('create','store');
        $this->middleware('permission:show_user')->only('show');
        $this->middleware('permission:edit_user')->only('edit','update','status');
        $this->middleware('permission:destroy_user')->only('destroy');
        $this->userRepo = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['breadcrumb'] = [
            'parent_title' => ['Users'],
            'parent_url' => ['users'],
            'page_title' => 'Users',
            'page_items' => ['Dashboard' => '/', 'Users' => '']
        ];
        // $users = User::where('deleted_at','=',NULL)->with('roles')->get();
        if($request->ajax()){
            return $this->userRepo->index($request);
        }
        return view('user.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['breadcrumb'] = [
            'parent_title' => ['Users'],
            'parent_url' => [BASE_URL.'users'],
            'page_title' => 'User Create',
            'page_items' => ['Dashboard' => '/', 'Users' => BASE_URL.'user', 'User Create' => '']
        ];

        $roles = Role::where('id','!=','1')->get();
        return view('user.create',compact('roles'))->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required'],
        ]);

        $user = User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'role_id' => $data['role_id']
        ]);

        $user->assignRole(Role::find($data['role_id'])->id);

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['breadcrumb'] = [
            'parent_title' => ['Users'],
            'parent_url' => [BASE_URL.'users'],
            'page_title' => 'User Show',
            'page_items' => ['Dashboard' => '/', 'Users' => BASE_URL.'users', 'User Show' => '']
        ];
        $user = User::find($id);
        // dd($user);
        return view('user.show',compact('user'))->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['breadcrumb'] = [
            'parent_title' => ['Users'],
            'parent_url' => [BASE_URL.'users'],
            'page_title' => 'User Edit',
            'page_items' => ['Dashboard' => '/', 'Users' => BASE_URL.'users', 'User Edit' => '']
        ];
        $user = User::find($id);
        $roles = Role::where('id','!=','1')->get();
        return view('user.edit',compact('user','roles'))->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required'],
        ]);

        $user = User::where('id','=',$id)->update([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'role_id' => $data['role_id']
        ]);

        $user = User::find($id);
        $user->roles()->detach();
        $user->assignRole(Role::find($data['role_id']));
        // Model_Has_Role::where('model_id','=',$id)->update([
        //     'role_id' => $data['role_id']
        // ]);
        // $user->assignRole(Role::find($data['role_id'])->id);

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->back();
    }

    // public function softdeletes($id)
    // {
    //     User::find($id)->delete();
    //     return redirect()->back();
    // }

    public function status($id, $status)
    {
        ($status == '1') ? $status = '0' : $status = '1';
        User::where('id','=',$id)->update(['is_active' => $status]);
        return redirect()->back();
    }
}
