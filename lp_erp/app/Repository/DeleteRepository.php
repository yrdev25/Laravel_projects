<?php
namespace App\Repository;

use App\Models\Delete;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;


class DeleteRepository
{

    public function index($request){
        $deletes = Delete::all();
        return DataTables::of($deletes)
        ->addIndexColumn()
        ->editColumn('status',function($row){
            if($row->is_active == 1){
              return '<a href="'.route('area.status',[$row->id,$row->is_active]).'">Active</a>';
            //   url('area/'.$row->id.'/'.$row->is_active)
            }else{
                return '<a href="'.route('area.status',[$row->id,$row->is_active]).'">Inactive</a>';
            }
        })
        ->editColumn('action',function($row){
            $authUserObj = Auth::user();
            $isActionedit = false;
            $isActiondestroy = false;


            if ($authUserObj->can('edit_delete')) {
                $isActionedit = 'edit';
            }
            if ($authUserObj->can('destroy_delete')) {
                $isActiondestroy = 'destroy';
            }
            $btn = "<div class='d-flex'>";
                $btn .= '<a href="'.route('delete.show',$row->id).'" data-toggle="tooltip"
                data-original-title="Show" class="btn btn-icon btn-hover-primary btn-sm">
                <i class="fa fa-eye text-primary"></i>
                </a>';

            if ($isActionedit=='edit') {
                $btn .= '<a href="'.route('delete.edit',$row->id).'" data-toggle="tooltip" data-original-title="Edit" class="btn btn-icon btn-hover-primary btn-sm edit"><i class="fa fa-edit text-primary"></i></a>';
            }
            if ($isActiondestroy=='destroy'){
                $btn .= '<form action="'.route('delete.destroy',$row->id).'" method="POST">'.csrf_field().''.method_field("DELETE").'<button type="submit" class="btn btn-icon btn-hover-primary btn-sm ml-2 delete" onclick="return confirm(`Are you sure you want to delete this record?`);"><i class="fas fa-trash text-danger"></i></button></form>';
            }
            $btn .= "</div>";
            return $btn;
        })
        ->rawColumns(['status','action'])
        ->make(true);
    }
}
