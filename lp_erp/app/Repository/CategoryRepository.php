<?php
namespace App\Repository;


use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;


class CategoryRepository
{

    public function index($request){
        $categories = Category::all();
        return Datatables::of($categories)
        ->addIndexColumn()
        ->addColumn('action',function($row){
            $authUserObj = Auth::user();
            $isActionedit = false;
            $isActiondestroy = false;


            if ($authUserObj->can('edit_category')) {
                $isActionedit = 'edit';
            }
            if ($authUserObj->can('destroy_category')) {
                $isActiondestroy = 'destroy';
            }
            $btn = "<div class='d-flex'>";

                $btn .= '<a href="'.route('category.show',$row->id).'" data-toggle="tooltip"
                data-original-title="Show" class="btn btn-icon btn-hover-primary btn-sm">
                <i class="fa fa-eye text-primary"></i>
                </a>';

            if ($isActionedit=='edit') {
                $btn .= '<a href="'.route('category.edit',$row->id).'" data-toggle="tooltip" data-original-title="Edit" class="btn btn-icon btn-hover-primary btn-sm edit"><i class="fa fa-edit text-primary"></i></a>';
            }
            if ($isActiondestroy=='destroy'){
                $btn .= '<form action="'.route('category.destroy',$row->id).'" method="POST">'.csrf_field().''.method_field("DELETE").'<button type="submit" class="btn btn-icon btn-hover-primary btn-sm ml-2 delete" onclick="return confirm(`Are you sure you want to delete this record?`);"><i class="fas fa-trash text-danger"></i></button></form>';
            }
            $btn .= "</div>";
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

}
