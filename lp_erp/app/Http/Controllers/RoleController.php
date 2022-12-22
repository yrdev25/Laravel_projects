<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Whoops\Run;
use App\Repository\RoleRepository;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public $roleRepo;
    public function __construct(RoleRepository $roleRepository)
    {
        $this->middleware('auth');
        $this->middleware('permission:view_roles')->only('index');
        $this->middleware('permission:create_role')->only('create','store');
        $this->middleware('permission:show_role')->only('show');
        $this->middleware('permission:edit_role')->only('edit','update','givePermission','revokePermission');
        $this->middleware('permission:destroy_role')->only('destroy');
        $this->roleRepo = $roleRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data['breadcrumb'] = [
            'parent_title' => ['Roles'],
            'parent_url' => ['roles'],
            'page_title' => 'Roles',
            'page_items' => ['Dashboard' => '/', 'Role | Permission' => '', 'Role' => '']
        ];
        if($request->ajax()){
            return $this->roleRepo->index($request);
        }
        //$roles = Role::all()->whereNotIn('name','admin');
        return view('roles.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['breadcrumb'] = [
            'parent_title' => ['Roles'],
            'parent_url' => [BASE_URL.'roles'],
            'page_title' => 'Role Create',
            'page_items' => ['Dashboard' => '/', 'Role | Permission' => '', 'Role' => BASE_URL.'role', 'Role Create' => '']
        ];
        return view('roles.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => ['required','unique:roles']
        ]);
        Role::create($validated);
        return redirect()->route('roles.index');

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
            'parent_title' => ['Roles'],
            'parent_url' => [BASE_URL.'roles'],
            'page_title' => 'Role Show',
            'page_items' => ['Dashboard' => '/', 'Role | Permission' => '', 'Role' => BASE_URL.'role', 'Role Show' => '']
        ];

    //     $permissions = Permission::all();
    //    return view('roles.show',compact('role','permissions'));
    $role = Role::find($id);
    $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
        ->where("role_has_permissions.role_id",$id)
        ->get();

    return view('roles.show',compact('role','rolePermissions'))->with($data);
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
            'parent_title' => ['Roles'],
            'parent_url' => [BASE_URL.'roles'],
            'page_title' => 'Role Edit',
            'page_items' => ['Dashboard' => '/',  'Role | Permission' => '', 'Role' => BASE_URL.'role', 'Role Edit' => '']
        ];
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
    //    $permissions = Permission::all();
       return view('roles.edit',compact('role','permission','rolePermissions'))->with($data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        // $validated = $request->validate([
        //     'name' => ['required']
        // ]);
        // $role->update($validated);

        // return redirect()->route('roles.index');
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index');
    }

    public function givePermission(Request $request,Role $role)
    {
        if($role->hasPermissionTo($request->permission)){
            return back()->with('message','Permission added');
        }else{
            $role->givePermissionTo($request->permission);
            return back()->with('message','Permission added');
        }

    }

    public function revokePermission(Role $role, Permission $permission){

        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
            return back()->with('message','Permission revoked');
        }
    }
}
