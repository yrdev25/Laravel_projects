<?php
namespace App\Repository;

//
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Permission;

class PermissionRepository
{
    public function index($request){
        $permissions = Permission::all();
        return DataTables::of($permissions)
        ->addIndexColumn()
        ->editColumn('action',function($row){
            $authUserObj = Auth::user();
            $isActionedit = false;
            $isActiondestroy = false;


            if ($authUserObj->can('edit_permission')) {
                $isActionedit = 'edit';
            }
            if ($authUserObj->can('destroy_permission')) {
                $isActiondestroy = 'destroy';
            }
            $btn = "<div class='d-flex'>";
                $btn .= '<a href="'.route('permissions.show',$row->id).'" data-toggle="tooltip"
                data-original-title="Show" class="btn btn-icon btn-hover-primary btn-sm">
                <i class="fa fa-eye text-primary"></i>
                </a>';

            if ($isActionedit=='edit') {
                $btn .= '<a href="'.route('permissions.edit',$row->id).'" data-toggle="tooltip" data-original-title="Edit" class="btn btn-icon btn-hover-primary btn-sm edit"><i class="fa fa-edit text-primary"></i></a>';
            }
            if ($isActiondestroy=='destroy'){
                $btn .= '<form action="'.route('permissions.destroy',$row->id).'" method="POST">'.csrf_field().''.method_field("DELETE").'<button type="submit" class="btn btn-icon btn-hover-primary btn-sm ml-2 delete" onclick="return confirm(`Are you sure you want to delete this record?`);"><i class="fas fa-trash text-danger"></i></button></form>';
            }
            $btn .= "</div>";
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}
