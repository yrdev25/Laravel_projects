<?php
namespace App\Repository;

use App\Models\City;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;


class CityRepository
{

    public function index($request){
        $cities = City::with('state')->get();
        if(!empty($request->city)){
            $cities = $cities->where('city_name','=',$request->city);
         }
         if(!empty($request->state)){
            $cities = $cities->where('state_id','=',$request->state);
         }
        return Datatables::of($cities)
        ->addIndexColumn()
        ->addColumn('state_name', function ($row) {
            return $row->state->state_name;
        })
        ->editColumn('status',function($row){
            if($row->is_active == 1){
              return '<a href="'.route('city.status',[$row->id,$row->is_active]).'">Active</a>';
            }else{
                return '<a href="'.route('city.status',[$row->id,$row->is_active]).'">Inactive</a>';
            }
        })
        ->editColumn('action',function($row){
            $authUserObj = Auth::user();
            $isActionedit = false;
            $isActiondestroy = false;


            if ($authUserObj->can('edit_city')) {
                $isActionedit = 'edit';
            }
            if ($authUserObj->can('destroy_city')) {
                $isActiondestroy = 'destroy';
            }
            $btn = "<div class='d-flex'>";

                $btn .= '<a href="'.route('city.show',$row->id).'" data-toggle="tooltip"
                data-original-title="Show" class="btn btn-icon btn-hover-primary btn-sm">
                <i class="fa fa-eye text-primary"></i>
                </a>';

            if ($isActionedit=='edit') {
                $btn .= '<a href="'.route('city.edit',$row->id).'" data-toggle="tooltip" data-original-title="Edit" class="btn btn-icon btn-hover-primary btn-sm edit"><i class="fa fa-edit text-primary"></i></a>';
            }
            if ($isActiondestroy=='destroy'){
                $btn .= '<form action="'.route('city.destroy',$row->id).'" method="POST">'.csrf_field().''.method_field("DELETE").'<button type="submit" class="btn btn-icon btn-hover-primary btn-sm ml-2 delete" onclick="return confirm(`Are you sure you want to delete this record?`);"><i class="fas fa-trash text-danger"></i></button></form>';
            }
            $btn .= "</div>";
            return $btn;
        })
        ->rawColumns(['status','action'])
        ->make(true);
    }
}
