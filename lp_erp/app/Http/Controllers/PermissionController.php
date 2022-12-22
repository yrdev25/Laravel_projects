<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Repository\PermissionRepository;

class PermissionController extends Controller
{
    public $permissionRepo;
    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->middleware('auth');
        $this->middleware('permission:view_permissions')->only('index');
        $this->middleware('permission:create_permission')->only('create','store');
        $this->middleware('permission:show_permission')->only('show');
        $this->middleware('permission:edit_permission')->only('edit','update');
        $this->middleware('permission:destroy_permission')->only('destroy');
        $this->permissionRepo = $permissionRepository;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['breadcrumb'] = [
            'parent_title' => ['Permissions'],
            'parent_url' => ['permissions'],
            'page_title' => 'Permissions',
            'page_items' => ['Dashboard' => '/', 'Role | Permission' => '','Permission' => '']
            ];

        if($request->ajax()){
            return $this->permissionRepo->index($request);
        }
        return view('permissions.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['breadcrumb'] = [
            'parent_title' => ['Permissions'],
            'parent_url' => [BASE_URL.'permissions'],
            'page_title' => 'Permission Create',
            'page_items' => ['Dashboard' => '/', 'Role | Permission' => '', 'Permission' => BASE_URL.'permission', 'Permission Create' => '']
        ];
        return view('permissions.create')->with($data);
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
            'name' => ['required','unique:permissions']
        ]);
        Permission::create($validated);
        return redirect()->route('permissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        $data['breadcrumb'] = [
            'parent_title' => ['Permissions'],
            'parent_url' => [BASE_URL.'permissions'],
            'page_title' => 'Permission Show',
            'page_items' => ['Dashboard' => '/', 'Role | Permission' => '', 'Permission' => BASE_URL.'permission', 'Permission Show' => '']
        ];
        return view('permissions.show',compact('permission'))->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        $data['breadcrumb'] = [
            'parent_title' => ['Permissions'],
            'parent_url' => [BASE_URL.'permissions'],
            'page_title' => 'Permission Edit',
            'page_items' => ['Dashboard' => '/', 'Role | Permission' => '', 'Permission' => BASE_URL.'permission', 'Permission Edit' => '']
        ];
       return view('permissions.edit',compact('permission'))->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'name' => ['required']
        ]);
        $permission->update($validated);

        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index');
    }
}
