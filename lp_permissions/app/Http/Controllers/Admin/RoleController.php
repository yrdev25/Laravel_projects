<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Whoops\Run;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        //$roles = Role::all()->whereNotIn('name','admin');
        return view('admin.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.create');
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
        return redirect()->route('admin.roles.index');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {   
      
       $permissions = Permission::all(); 
       return view('admin.roles.create',compact('role','permissions'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
    
        $validated = $request->validate([
            'name' => ['required','unique:roles']
        ]);
        $role->update($validated);

        return redirect()->route('admin.roles.index');
    
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
        return redirect()->route('admin.roles.index');
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

    public function revokePermissions(Role $role, Permission $permission){

        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
            return back()->with('message','Permission revoked');
        }
    }
}
