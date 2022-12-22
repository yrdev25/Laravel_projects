<?php
namespace App\Repository;

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

// customer.restore
//customer.verify
class CustomerRepository
{

    public function index($request){
        $customers = Customer::with('category')->with('country')->with('state')->with('city')->with('area')->get();
        if(!empty($request->category)){
            $customers = $customers->where('category_id','=',$request->category);
            // dd('here');
        }
        return DataTables::of($customers)
        ->addIndexColumn()
        ->editColumn('name_1',function($row){
            return $row->first_name_1.' '.$row->last_name_1;
         })
         ->editColumn('name_2',function($row){
            return $row->first_name_2.' '.$row->last_name_2;
         })
        ->editColumn('category_name',function($row){
           return $row->category->category_name;
        })
            ->editColumn('is_verified',function($row){
                if($row->is_verified == 1){
                  return '<a href="'.route('customer.verify',[$row->id,$row->is_verified]).'"><i class="fa fa-check"></i></a>';
                }else{
                    return '<a href="'.route('customer.verify',[$row->id,$row->is_verified]).'"><i class="fa fa-times"></i></a>';
                }
            })
            ->editColumn('action',function($row){
                $authUserObj = Auth::user();
                $isActionedit = false;
                $isActiondestroy = false;

                if ($authUserObj->can('edit_customer')) {
                    $isActionedit = 'edit';
                }
                if ($authUserObj->can('destroy_customer')) {
                    $isActiondestroy = 'destroy';
                }
                $btn = "<div class='d-flex'>";

                    $btn .= '<a href="'.route('customer.show',[$row->id]).'" data-toggle="tooltip"
                    data-original-title="Show" class="btn btn-icon btn-hover-primary btn-sm">
                    <i class="fa fa-eye text-primary"></i>
                    </a>';

                if ($isActionedit=='edit') {
                    $btn .= '<a href="'.route('customer.edit',$row->id).'" data-toggle="tooltip" data-original-title="Edit" class="btn btn-icon btn-hover-primary btn-sm edit"><i class="fa fa-edit text-primary"></i></a>';
                }
                if ($isActiondestroy=='destroy'){
                    $btn .= '<form action="'.route('customer.destroy',$row->id).'" method="POST">'.csrf_field().''.method_field("DELETE").'<button type="submit" class="btn btn-icon btn-hover-primary btn-sm ml-2 delete" onclick="return confirm(`Are you sure you want to delete this record?`);"><i class="fas fa-trash text-danger"></i></button></form>';
                }
                $btn .= "</div>";
                return $btn;
            })
            ->rawColumns(['is_verified','action'])
            ->make(true);
    }

    public function verified($request){
        $customers = Customer::where('is_verified','=','1')->with('category')->with('country')->with('state')->with('city')->with('area')->get();
        if(!empty($request->category)){
            $customers = $customers->where('category_id','=',$request->category);
        }
        return DataTables::of($customers)
        ->addIndexColumn()
        ->editColumn('name_1',function($row){
            return $row->first_name_1.' '.$row->last_name_1;
         })
         ->editColumn('name_2',function($row){
            return $row->first_name_2.' '.$row->last_name_2;
         })
        ->editColumn('category_name',function($row){
           return $row->category->category_name;
        })
        ->editColumn('is_verified',function($row){
            if($row->is_verified == 1){
              return '<a href="'.route('customer.verify',[$row->id,$row->is_verified]).'"><i class="fa fa-check"></i></a>';
            }else{
                return '<a href="'.route('customer.verify',[$row->id,$row->is_verified]).'"><i class="fa fa-times"></i></a>';
            }
        })
        ->editColumn('action',function($row){
            $authUserObj = Auth::user();
            $isActionedit = false;
            $isActiondestroy = false;

            if ($authUserObj->can('edit_customer')) {
                $isActionedit = 'edit';
            }
            if ($authUserObj->can('destroy_customer')) {
                $isActiondestroy = 'destroy';
            }
            $btn = "<div class='d-flex'>";
                $btn .= '<a href="'.route('customer.show',$row->id).'" data-toggle="tooltip"
                data-original-title="Show" class="btn btn-icon btn-hover-primary btn-sm">
                <i class="fa fa-eye text-primary"></i>
                </a>';

            if ($isActionedit=='edit') {
                $btn .= '<a href="'.route('customer.edit',$row->id).'" data-toggle="tooltip" data-original-title="Edit" class="btn btn-icon btn-hover-primary btn-sm edit"><i class="fa fa-edit text-primary"></i></a>';
            }
            if ($isActiondestroy=='destroy'){
                $btn .= '<form action="'.route('customer.destroy',$row->id).'" method="POST">'.csrf_field().''.method_field("DELETE").'<button type="submit" class="btn btn-icon btn-hover-primary btn-sm ml-2 delete" onclick="return confirm(`Are you sure you want to delete this record?`);"><i class="fas fa-trash text-danger"></i></button></form>';
            }
            $btn .= "</div>";
            return $btn;
        })
        ->rawColumns(['is_verified','action'])
        ->make(true);
    }

    public function anniversary($request){
        $customers = Customer::orderBy('marriage_anniversary', 'desc')->with('category')->with('country')->with('state')->with('city')->with('area');
        if(!empty($request->category)){
            $customers = $customers->where('category_id','=',$request->category);
        }
        if(!empty($request->month)){
            $customers = $customers->whereMonth('marriage_anniversary',$request->month);
        }
        return DataTables::of($customers)
        ->addIndexColumn()
        ->editColumn('name_1',function($row){
            return $row->first_name_1.' '.$row->last_name_1;
         })
         ->editColumn('name_2',function($row){
            return $row->first_name_2.' '.$row->last_name_2;
         })
        ->editColumn('category_name',function($row){
           return $row->category->category_name;
        })
        ->editColumn('is_verified',function($row){
            if($row->is_verified == 1){
              return '<a href="'.route('customer.verify',[$row->id,$row->is_verified]).'"><i class="fa fa-check"></i></a>';
            }else{
                return '<a href="'.route('customer.verify',[$row->id,$row->is_verified]).'"><i class="fa fa-times"></i></a>';
            }
        })
        ->editColumn('action',function($row){
            $authUserObj = Auth::user();
            $isActionedit = false;
            $isActiondestroy = false;

            if ($authUserObj->can('edit_customer')) {
                $isActionedit = 'edit';
            }
            if ($authUserObj->can('destroy_customer')) {
                $isActiondestroy = 'destroy';
            }
            $btn = "<div class='d-flex'>";
                $btn .= '<a href="'.route('customer.show',$row->id).'" data-toggle="tooltip"
                data-original-title="Show" class="btn btn-icon btn-hover-primary btn-sm">
                <i class="fa fa-eye text-primary"></i>
                </a>';

            if ($isActionedit=='edit') {
                $btn .= '<a href="'.route('customer.edit',$row->id).'" data-toggle="tooltip" data-original-title="Edit" class="btn btn-icon btn-hover-primary btn-sm edit"><i class="fa fa-edit text-primary"></i></a>';
            }
            if ($isActiondestroy=='destroy'){
                $btn .= '<form action="'.route('customer.destroy',$row->id).'" method="POST">'.csrf_field().''.method_field("DELETE").'<button type="submit" class="btn btn-icon btn-hover-primary btn-sm ml-2 delete" onclick="return confirm(`Are you sure you want to delete this record?`);"><i class="fas fa-trash text-danger"></i></button></form>';
            }
            $btn .= "</div>";
            return $btn;
        })
        ->rawColumns(['is_verified','action'])
        ->make(true);
    }

    public function dob($request){
        $customers = Customer::orderBy('dob', 'desc')->with('category')->with('country')->with('state')->with('city')->with('area');
        if(!empty($request->category)){
            $customers = $customers->where('category_id','=',$request->category);
        }
        if(!empty($request->month)){
            $customers = $customers->whereMonth('dob',$request->month);
        }
        return DataTables::of($customers)
        ->addIndexColumn()
        ->editColumn('name_1',function($row){
            return $row->first_name_1.' '.$row->last_name_1;
         })
         ->editColumn('name_2',function($row){
            return $row->first_name_2.' '.$row->last_name_2;
         })
        ->editColumn('category_name',function($row){
           return $row->category->category_name;
        })
        ->editColumn('is_verified',function($row){
            if($row->is_verified == 1){
              return '<a href="'.route('customer.verify',[$row->id,$row->is_verified]).'"><i class="fa fa-check"></i></a>';
            }else{
                return '<a href="'.route('customer.verify',[$row->id,$row->is_verified]).'"><i class="fa fa-times"></i></a>';
            }
        })
        ->editColumn('action',function($row){
            $authUserObj = Auth::user();
            $isActionedit = false;
            $isActiondestroy = false;

            if ($authUserObj->can('edit_customer')) {
                $isActionedit = 'edit';
            }
            if ($authUserObj->can('destroy_customer')) {
                $isActiondestroy = 'destroy';
            }
            $btn = "<div class='d-flex'>";
                $btn .= '<a href="'.route('customer.show',$row->id).'" data-toggle="tooltip"
                data-original-title="Show" class="btn btn-icon btn-hover-primary btn-sm">
                <i class="fa fa-eye text-primary"></i>
                </a>';

            if ($isActionedit=='edit') {
                $btn .= '<a href="'.route('customer.edit',$row->id).'" data-toggle="tooltip" data-original-title="Edit" class="btn btn-icon btn-hover-primary btn-sm edit"><i class="fa fa-edit text-primary"></i></a>';
            }
            if ($isActiondestroy=='destroy'){
                $btn .= '<form action="'.route('customer.destroy',$row->id).'" method="POST">'.csrf_field().''.method_field("DELETE").'<button type="submit" class="btn btn-icon btn-hover-primary btn-sm ml-2 delete" onclick="return confirm(`Are you sure you want to delete this record?`);"><i class="fas fa-trash text-danger"></i></button></form>';
            }
            $btn .= "</div>";
            return $btn;
        })
        ->rawColumns(['is_verified','action'])
        ->make(true);
    }

    public function unverified($request){

        $customers = Customer::where('is_verified','=','0')->with('category')->with('country')->with('state')->with('city')->with('area');
        if(!empty($request->category)){
            $customers = $customers->where('category_id','=',$request->category);
        }
        return DataTables::of($customers)
        ->addIndexColumn()
        ->editColumn('name_1',function($row){
            return $row->first_name_1.' '.$row->last_name_1;
         })
         ->editColumn('name_2',function($row){
            return $row->first_name_2.' '.$row->last_name_2;
         })
        ->editColumn('category_name',function($row){
           return $row->category->category_name;
        })
        ->editColumn('is_verified',function($row){
            if($row->is_verified == 1){
              return '<a href="'.route('customer.verify',[$row->id,$row->is_verified]).'"><i class="fa fa-check"></i></a>';
            }else{
                return '<a href="'.route('customer.verify',[$row->id,$row->is_verified]).'"><i class="fa fa-times"></i></a>';
            }
        })
        ->editColumn('action',function($row){
            $authUserObj = Auth::user();
            $isActionedit = false;
            $isActiondestroy = false;


            if ($authUserObj->can('edit_customer')) {
                $isActionedit = 'edit';
            }
            if ($authUserObj->can('destroy_customer')) {
                $isActiondestroy = 'destroy';
            }
            $btn = "<div class='d-flex'>";
                $btn .= '<a href="'.route('customer.show',$row->id).'" data-toggle="tooltip"
                data-original-title="Show" class="btn btn-icon btn-hover-primary btn-sm">
                <i class="fa fa-eye text-primary"></i>
                </a>';

            if ($isActionedit=='edit') {
                $btn .= '<a href="'.route('customer.edit',$row->id).'" data-toggle="tooltip" data-original-title="Edit" class="btn btn-icon btn-hover-primary btn-sm edit"><i class="fa fa-edit text-primary"></i></a>';
            }
            if ($isActiondestroy=='destroy'){
                $btn .= '<form action="'.route('customer.destroy',$row->id).'" method="POST">'.csrf_field().''.method_field("DELETE").'<button type="submit" class="btn btn-icon btn-hover-primary btn-sm ml-2 delete" onclick="return confirm(`Are you sure you want to delete this record?`);"><i class="fas fa-trash text-danger"></i></button></form>';
            }
            $btn .= "</div>";
            return $btn;
        })
        ->rawColumns(['is_verified','action'])
        ->make(true);
    }

    public function withoutdob($request){
        $customers = Customer::where('is_verified','=','1')->where('dob','=',NULL)->with('category')->with('country')->with('state')->with('city')->with('area')->get();
        if(!empty($request->category)){
            $customers = $customers->where('category_id','=',$request->category);
        }
        return DataTables::of($customers)
        ->addIndexColumn()
        ->editColumn('name_1',function($row){
            return $row->first_name_1.' '.$row->last_name_1;
         })
         ->editColumn('name_2',function($row){
            return $row->first_name_2.' '.$row->last_name_2;
         })
        ->editColumn('category_name',function($row){
           return $row->category->category_name;
        })
        ->editColumn('is_verified',function($row){
            if($row->is_verified == 1){
              return '<a href="'.route('customer.verify',[$row->id,$row->is_verified]).'"><i class="fa fa-check"></i></a>';
            }else{
                return '<a href="'.route('customer.verify',[$row->id,$row->is_verified]).'"><i class="fa fa-times"></i></a>';
            }
        })
        ->editColumn('action',function($row){
            $authUserObj = Auth::user();
            $isActionedit = false;
            $isActiondestroy = false;

            if ($authUserObj->can('edit_customer')) {
                $isActionedit = 'edit';
            }
            if ($authUserObj->can('destroy_customer')) {
                $isActiondestroy = 'destroy';
            }
            $btn = "<div class='d-flex'>";
                $btn .= '<a href="'.route('customer.show',$row->id).'" data-toggle="tooltip"
                data-original-title="Show" class="btn btn-icon btn-hover-primary btn-sm">
                <i class="fa fa-eye text-primary"></i>
                </a>';

            if ($isActionedit=='edit') {
                $btn .= '<a href="'.route('customer.edit',$row->id).'" data-toggle="tooltip" data-original-title="Edit" class="btn btn-icon btn-hover-primary btn-sm edit"><i class="fa fa-edit text-primary"></i></a>';
            }
            if ($isActiondestroy=='destroy'){
                $btn .= '<form action="'.route('customer.destroy',$row->id).'" method="POST">'.csrf_field().''.method_field("DELETE").'<button type="submit" class="btn btn-icon btn-hover-primary btn-sm ml-2 delete" onclick="return confirm(`Are you sure you want to delete this record?`);"><i class="fas fa-trash text-danger"></i></button></form>';
            }
            $btn .= "</div>";
            return $btn;
        })
        ->rawColumns(['is_verified','action'])
        ->make(true);
    }

    public function city_area($request){
        $customers = Customer::with('category')->with('country')->with('state')->with('city')->get();
        if(!empty($request->category)){
            $customers = $customers->where('category_id','=',$request->category);
            // dd('here');
        }
        if(!empty($request->country)){
            $customers = $customers->where('country_id','=',$request->country);
        }
        if(!empty($request->state)){
            $customers = $customers->where('state_id','=',$request->state);
        }
        if(!empty($request->city)){
            $customers = $customers->where('city_id','=',$request->city);
        }
        if(!empty($request->area)){
            $customers = $customers->where('area_id','=',$request->area);
        }
        return DataTables::of($customers)
        ->addIndexColumn()
        ->editColumn('name_1',function($row){
            return $row->first_name_1.' '.$row->last_name_1;
         })
         ->editColumn('name_2',function($row){
            return $row->first_name_2.' '.$row->last_name_2;
         })
        ->editColumn('category_name',function($row){
           return $row->category->category_name;
        })
        ->editColumn('country_name',function($row){
            return $row->country->country_name;
         })
         ->editColumn('state_name',function($row){
            return $row->state->state_name;
         })
         ->editColumn('city_name',function($row){
            return $row->city->city_name;
         })
         ->editColumn('area_name',function($row){
            return $row->area->area_name;
         })
        ->editColumn('is_verified',function($row){
            if($row->is_verified == 1){
              return '<a href="'.route('customer.verify',[$row->id,$row->is_verified]).'"><i class="fa fa-check"></i></a>';
            }else{
                return '<a href="'.route('customer.verify',[$row->id,$row->is_verified]).'"><i class="fa fa-times"></i></a>';
            }
        })
        ->editColumn('action',function($row){
            $authUserObj = Auth::user();
            $isActionedit = false;
            $isActiondestroy = false;

            if ($authUserObj->can('edit_customer')) {
                $isActionedit = 'edit';
            }
            if ($authUserObj->can('destroy_customer')) {
                $isActiondestroy = 'destroy';
            }
            $btn = "<div class='d-flex'>";
                $btn .= '<a href="'.route('customer.show',$row->id).'" data-toggle="tooltip"
                data-original-title="Show" class="btn btn-icon btn-hover-primary btn-sm">
                <i class="fa fa-eye text-primary"></i>
                </a>';

            if ($isActionedit=='edit') {
                $btn .= '<a href="'.route('customer.edit',$row->id).'" data-toggle="tooltip" data-original-title="Edit" class="btn btn-icon btn-hover-primary btn-sm edit"><i class="fa fa-edit text-primary"></i></a>';
            }
            if ($isActiondestroy=='destroy'){
                $btn .= '<form action="'.route('customer.destroy',$row->id).'" method="POST">'.csrf_field().''.method_field("DELETE").'<button type="submit" class="btn btn-icon btn-hover-primary btn-sm ml-2 delete" onclick="return confirm(`Are you sure you want to delete this record?`);"><i class="fas fa-trash text-danger"></i></button></form>';
            }
            $btn .= "</div>";
            return $btn;
        })
        ->rawColumns(['is_verified','action'])
        ->make(true);
    }

    public function deleted($request){
        $customers = Customer::withTrashed()->where('deleted_at','!=',NULL)->get();
        return DataTables::of($customers)
        ->addIndexColumn()
        ->editColumn('name_1',function($row){
            return $row->first_name_1.' '.$row->last_name_1;
         })
         ->editColumn('name_2',function($row){
            return $row->first_name_2.' '.$row->last_name_2;
         })
        ->editColumn('category_name',function($row){
           return $row->category->category_name;
        })
        ->editColumn('add',function($row){
            return '<a href="'.route('restore',$row->id).'" onclick="return confirm(`Are you sure you want to restore this record?`);"><i class="fas fa-trash-restore"></i></a>';
        })
        ->editColumn('is_verified',function($row){
                if($row->is_verified == 1){
                  return '<a href="'.route('customer.verify',[$row->id,$row->is_verified]).'"><i class="fa fa-check"></i></a>';
                }else{
                    return '<a href="'.route('customer.verify',[$row->id,$row->is_verified]).'"><i class="fa fa-times"></i></a>';
                }
        })
        ->editColumn('action',function($row){
                $btn = "<div class='d-flex'>";

                $btn .= '<a href="'.route('customer.show',$row->id).'" data-toggle="tooltip"
                data-original-title="Show" class="btn btn-icon btn-hover-primary btn-sm">
                <i class="fa fa-eye text-primary"></i>
                </a>';
                $btn .= "</div>";
                return $btn;
            })
            ->rawColumns(['add','is_verified','action'])
            ->make(true);
    }
}
