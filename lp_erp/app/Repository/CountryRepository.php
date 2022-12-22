<?php


namespace App\Repository;

use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;


class CountryRepository
{

    public function index($request){
        // dd('here');
        $countries = Country::all();

        return Datatables::of($countries)
        ->addIndexColumn()
        ->editColumn('status',function($row){
            if($row->is_active == 1){
              return '<a href="'.route('country.status',[$row->id,$row->is_active]).'">Active</a>';
            }else{
                return '<a href="'.route('country.status',[$row->id,$row->is_active]).'">Inactive</a>';
            }
        })
        ->editColumn('action',function($row){
            $authUserObj = Auth::user();
            $isActionedit = false;
            $isActiondestroy = false;

            if ($authUserObj->can('edit_country')) {
                $isActionedit = 'edit';
            }
            if ($authUserObj->can('destroy_country')) {
                $isActiondestroy = 'destroy';
            }
            $btn = "<div class='d-flex'>";
                $btn .= '<a href="'.route('country.show',$row->id).'" data-toggle="tooltip"
                data-original-title="Show" class="btn btn-icon btn-hover-primary btn-sm">
                <i class="fa fa-eye text-primary"></i>
                </a>';

            if ($isActionedit=='edit') {
                $btn .= '<a href="'.route('country.edit',$row->id).'" data-toggle="tooltip" data-original-title="Edit" class="btn btn-icon btn-hover-primary btn-sm edit"><i class="fa fa-edit text-primary"></i></a>';
            }
            if ($isActiondestroy=='destroy'){
                $btn .= '<form action="'.route('country.destroy',$row->id).'" method="POST">'.csrf_field().''.method_field("DELETE").'<button type="submit" class="btn btn-icon btn-hover-primary btn-sm ml-2 delete" onclick="return confirm(`Are you sure you want to delete this record?`);"><i class="fas fa-trash text-danger"></i></button></form>';
            }
            $btn .= "</div>";
            return $btn;
        })
        ->rawColumns(['status','action'])
        ->make(true);
    }



}
