<?php


namespace App\Repository;

use App\Models\User;
use App\Models\State;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class StateRepository
{

    public function index($request){
        // dd('here');
        $states = State::with('country')->get();
        if(!empty($request->state)){
           $states = $states->where('state_name','=',$request->state);
        }
        if(!empty($request->country)){
            $states = $states->where('country_id','=',$request->country);
        }
        return DataTables::of($states)
        ->addIndexColumn()
        ->editColumn('country_name', function ($row) {
            return $row->country->country_name;
        })
        ->editColumn('status',function($row){
            if($row->is_active == 1){
              return '<a href="'.route('state.status',[$row->id,$row->is_active]).'">Active</a>';
            //   url('state/'.$row->id.'/'.$row->is_active)
            }else{
                return '<a href="'.route('state.status',[$row->id,$row->is_active]).'">Inactive</a>';
            }
        })
        ->editColumn('action',function($row){
            $authUserObj = Auth::user();
            $isActionedit = false;
            $isActiondestroy = false;


            if ($authUserObj->can('edit_state')) {
                $isActionedit = 'edit';
            }
            if ($authUserObj->can('destroy_state')) {
                $isActiondestroy = 'destroy';
            }
            $btn = "<div class='d-flex'>";
                $btn .= '<a href="'.route('state.show',$row->id).'" data-toggle="tooltip"
                data-original-title="Show" class="btn btn-icon btn-hover-primary btn-sm">
                <i class="fa fa-eye text-primary"></i>
                </a>';

            if ($isActionedit=='edit') {
                $btn .= '<a href="'.route('state.edit',$row->id).'" data-toggle="tooltip" data-original-title="Edit" class="btn btn-icon btn-hover-primary btn-sm edit"><i class="fa fa-edit text-primary"></i></a>';
            }
            if ($isActiondestroy=='destroy'){
                $btn .= '<form action="'.route('state.destroy',$row->id).'" method="POST">'.csrf_field().''.method_field("DELETE").'<button type="submit" class="btn btn-icon btn-hover-primary btn-sm ml-2 delete" onclick="return confirm(`Are you sure you want to delete this record?`);"><i class="fas fa-trash text-danger"></i></button></form>';
            }
            $btn .= "</div>";
            return $btn;
        })
        ->rawColumns(['status','action'])
        ->make(true);
    }

    public function store($input) {




        $leave = Leave::create($input);
        return $leave;
    }

    public function update($input, $id) {
        $leaveObj = Leave::find($id);
        $leaveObj->update($input);

        return $leaveObj;
    }
    public function pastleaves($leave) {
        $startDate = Carbon::today();
        $authUserObj = Auth::user();
        $data = Leave::with('user')->where('end_date','<',$startDate);
        if(!empty($leave->status)){

           $data->where('status',$leave->status);

        }
        if(!empty($leave->user_id)){

           $data->where('user_id',$leave->user_id);

        }
        if($authUserObj->can(['all-leaves','own-leaves'])) {
            $data=$data;
        }
        elseif($authUserObj->can('all-leaves'))
        {
            $data=$data;
        }
        elseif ($authUserObj->can('own-leaves')) {
            $data->where('user_id','=',Auth::user()->id);
        }
        else
        {
            $data->where('user_id','=',Auth::user()->id);
        }
        $data=$data->orderBy('status','ASC')->orderby('created_at','DESC')->get();

              // echo '<pre>'; print_r($data); exit;



        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('created_at', function ($row) {
                return displayDate($row->created_at);
            })
            ->addColumn('id', function ($row) {
                return $row->id;
            })
            ->addColumn('user', function ($row) {
                return $row->user->name;
            })
            ->addColumn('type', function ($row) {
                return $row->leave_type;
            })
            ->addColumn('from_date', function ($row) {
                return displayDate($row->from_date);
            })
            ->addColumn('end_date', function ($row) {
                return displayDate($row->end_date);
            })
            ->addColumn('days', function ($row) {
                if($row->days >=2){
                    return '<span class="alert alert-danger">'.$row->days.'</span>';
                } else {
                    return '<span class="alert">'.$row->days.'</span>';

                }
            })
            ->addColumn('reason', function ($row) {
                return $row->reason;
            })
            ->addColumn('pm', function ($row) {
                $pm_name=User::find($row->pm);
                if(!empty($pm_name))
                {
                    return $pm_name->name;
                }else {
                    return ' ';
                }
            })
            ->addColumn('current_projects', function ($row) {
                return $row->current_projects;
            })
            ->addColumn('status', function($row){

                if ($row->status==0) {

                    $demo="Pending";
                    return $demo;

                }
                elseif($row->status==1){

                    $demo1="Approved";
                    return $demo1;
                }
                elseif($row->status==2){
                    $demo2="Rejected";
                    return $demo2;
                }

            })
            ->addColumn('action_by', function ($row) {
                if($row->action_by)
                {
                    $user=User::where('deleted_at',null)->find($row->action_by);
                    if(!empty($user)){
                        return $user->name;
                    }else {
                        return '';
                    }
                }
            })
            ->addColumn('action', function($row){
                $authUserObj = Auth::user();
                $isActionedit = false;
                $isActiondelete = false;

                if ($authUserObj->can('leave-edit')) {
                    $isActionedit = 'edit';

                }
                if ($authUserObj->can('leave-delete')) {
                    $isActiondelete = 'delete';

                }
                $btn = "";
                // $btn .= '<a href="'.url('leaves/'. $row->id ) .'" data-toggle="tooltip"
                // data-original-title="Show" class="btn btn-icon btn-hover-primary btn-sm">
                // <i class="fa fa-eye text-primary"></i>
                // </a>';
                // if ($isActionedit=='edit') {
                //     $btn .= '<a href="'.url('leaves/'. $row->id .'/edit').'" data-toggle="tooltip" data-original-title="Edit" class="btn btn-icon btn-hover-primary btn-sm edit"><i class="fa fa-edit text-primary"></i></a>';
                // }
                if ($isActiondelete=='delete'){
                    $btn .= '<a href="javascript:;" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" data-href="' . url('leaves/'. $row->id) . '" class="btn btn-icon btn-hover-primary btn-sm ml-2 delete"><i class="fas fa-trash text-danger"></i></a>';
                }
                return $btn;
            })
            ->rawColumns(['action','days'])

            ->make(true);
    }

    public function dashboardleaves($request) {
        $data=Leave::with('user')->whereDate('from_date','>=', Carbon::today())->orderby('created_at','DESC');

        if(!empty($request->user_id)){

           $data->where('user_id',$request->user_id);

        }

        $authUserObj = Auth::user();

        if($authUserObj->can(['all-leaves','own-leaves'])) {
            $data=$data;
        }
            elseif($authUserObj->can('all-leaves'))
            {
                $data=$data;
            }
            elseif ($authUserObj->can('own-leaves')) {
                $data->where('user_id','=',Auth::user()->id);
            }
        else
        {
            $data->where('user_id','=',Auth::user()->id);
        }
        $data=$data->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('created_at', function ($row) {
                return displayDate($row->created_at);
            })
            ->addColumn('id', function ($row) {
                return $row->id;
            })
            ->addColumn('user', function ($row) {
                return $row->user->name;
            })
            ->addColumn('from_date', function ($row) {
                return displayDate($row->from_date);
            })
            ->addColumn('end_date', function ($row) {
                return displayDate($row->end_date);
            })
            ->addColumn('days', function ($row) {
                if($row->days >=2){
                    return '<span class="alert alert-danger">'.$row->days.'</span>';
                } else {
                    return '<span class="alert">'.$row->days.'</span>';

                }
            })
            ->addColumn('current_projects', function ($row) {
                return $row->current_projects;
            })
            ->rawColumns(['action','days'])
            ->make(true);
    }

    public function leavestab($request){
                // todayleave
             $authUserObj = Auth::user();
            $startDate = Carbon::today();
        $data = Leave::where('from_date','<=', $startDate)->Where('end_date','>=',$startDate)->where('status','!=',2)->orderby('created_at','DESC')->orderBy('status','ASC');
              // echo '<pre>'; print_r($leave); exit;
        if(!empty($request->status)){

           $data->where('status',$request->status);

        }
        if(!empty($request->user_id)){

           $data->where('user_id',$request->user_id);

        }
        if($authUserObj->can(['all-leaves','own-leaves'])) {
            $data=$data;
        }
        elseif($authUserObj->can('all-leaves'))
        {
            $data=$data;
        }
        elseif ($authUserObj->can('own-leaves')) {
            $data->where('user_id','=',Auth::user()->id);
        }
        else
        {
            $data->where('user_id','=',Auth::user()->id);
        }
        $data=$data->get();

              // echo '<pre>'; print_r($data); exit;


        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('created_at', function ($row) {
                return displayDate($row->created_at);
            })
            ->addColumn('id', function ($row) {
                return $row->id;
            })
            ->addColumn('user', function ($row) {
                return $row->user->name;
            })
            ->addColumn('type', function ($row) {
                return $row->leave_type;
            })
            ->addColumn('from_date', function ($row) {
                return displayDate($row->from_date);
            })
            ->addColumn('end_date', function ($row) {
                return displayDate($row->end_date);
            })
            ->addColumn('days', function ($row) {
                if($row->days >=2){
                    return '<span class="alert alert-danger">'.$row->days.'</span>';
                } else {
                    return '<span class="alert">'.$row->days.'</span>';

                }
            })
            ->addColumn('reason', function ($row) {
                return $row->reason;
            })
            ->addColumn('pm', function ($row) {
                $pm_name=User::find($row->pm);
                if(!empty($pm_name))
                {
                    return $pm_name->name;
                }else {
                    return ' ';
                }
            })
            ->addColumn('current_projects', function ($row) {
                return $row->current_projects;
            })
            ->addColumn('status', function($row){
                if ($row->status==0) {

                    $demo="Pending";
                    return $demo;

                }
                elseif($row->status==1){

                    $demo1="Approved";
                    return $demo1;
                }
                elseif($row->status==2){
                    $demo2="Rejected";
                    return $demo2;
                }

            })
            ->addColumn('action_by', function ($row) {

            if($row->action_by)
                {
                    $user=User::where('deleted_at',null)->find($row->action_by);
                    if(!empty($user)){
                        return $user->name;
                    }else {
                        return '';
                    }
                }
            })
            ->addColumn('action', function($row){
                $authUserObj = Auth::user();
                $isActionedit = false;
                $isActiondelete = false;

                if ($authUserObj->can('leave-edit')) {
                    $isActionedit = 'edit';

                }
                if ($authUserObj->can('leave-delete')) {
                    $isActiondelete = 'delete';

                }
                $btn = "";
                $btn .= '<a href="'.url('leaves/'. $row->id ) .'" data-toggle="tooltip"
                data-original-title="Show" class="btn btn-icon btn-hover-primary btn-sm">
                <i class="fa fa-eye text-primary"></i>
                </a>';
                if ($isActionedit=='edit') {
                    $btn .= '<a href="'.url('leaves/'. $row->id .'/edit').'" data-toggle="tooltip" data-original-title="Edit" class="btn btn-icon btn-hover-primary btn-sm edit"><i class="fa fa-edit text-primary"></i></a>';
                }
                if ($isActiondelete=='delete'){
                    $btn .= '<a href="javascript:;" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" data-href="' . url('leaves/'. $row->id) . '" class="btn btn-icon btn-hover-primary btn-sm ml-2 delete"><i class="fas fa-trash text-danger"></i></a>';
                }
                return $btn;
            })
            ->rawColumns(['action','days'])
            ->make(true);
    }


    public function upcomingleave($request){
        $startDate = Carbon::today();
        $authUserObj = Auth::user();
        $data = Leave::where('from_date','>', $startDate)->Where('end_date','>=',$startDate)
        ->orderby('created_at','DESC');

        if(!empty($request->status)){

           $data->where('status',$request->status);

        }
        if(!empty($request->user_id)){

           $data->where('user_id',$request->user_id);

        }
        if($authUserObj->can(['all-leaves','own-leaves'])) {
            $data=$data;
        }
        elseif($authUserObj->can('all-leaves'))
        {
            $data=$data;
        }
        elseif ($authUserObj->can('own-leaves')) {
            $data->where('user_id','=',Auth::user()->id);
        }
        else
        {
            $data->where('user_id','=',Auth::user()->id);
        }
         $data=$data->get();
              // echo '<pre>'; print_r($data); exit;
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('created_at', function ($row) {
                return displayDate($row->created_at);
            })
            ->addColumn('id', function ($row) {
                return $row->id;
            })
            ->addColumn('user', function ($row) {
                return $row->user->name;
            })
            ->addColumn('type', function ($row) {
                return $row->leave_type;
            })
            ->addColumn('from_date', function ($row) {
                return displayDate($row->from_date);
            })
            ->addColumn('end_date', function ($row) {
                return displayDate($row->end_date);
            })
            ->addColumn('days', function ($row) {
                if($row->days >=2){
                    return '<span class="alert alert-danger">'.$row->days.'</span>';
                } else {
                    return '<span class="alert">'.$row->days.'</span>';

                }
            })
            ->addColumn('reason', function ($row) {
                return $row->reason;
            })
            ->addColumn('pm', function ($row) {
                $pm_name=User::find($row->pm);
                if(!empty($pm_name))
                {
                    return $pm_name->name;
                }else {
                    return ' ';
                }
            })
            ->addColumn('current_projects', function ($row) {
                return $row->current_projects;
            })
            ->addColumn('status', function($row){
                if ($row->status==0) {

                    $demo="Pending";
                    return $demo;

                }
                elseif($row->status==1){

                    $demo1="Approved";
                    return $demo1;
                }
                elseif($row->status==2){
                    $demo2="Rejected";
                    return $demo2;
                }

            })
            ->addColumn('action_by', function ($row) {
                if($row->action_by)
                {
                    $user=User::where('deleted_at',null)->find($row->action_by);
                    if(!empty($user)){
                        return $user->name;
                    }else {
                        return '';
                    }
                }
            })
            ->addColumn('action', function($row){
                $authUserObj = Auth::user();
                $isActionedit = false;
                $isActiondelete = false;

                if ($authUserObj->can('leave-edit')) {
                    $isActionedit = 'edit';

                }
                if ($authUserObj->can('leave-delete')) {
                    $isActiondelete = 'delete';

                }
                $btn = "";
                $btn .= '<a href="'.url('leaves/'. $row->id ) .'" data-toggle="tooltip"
                data-original-title="Show" class="btn btn-icon btn-hover-primary btn-sm">
                <i class="fa fa-eye text-primary"></i>
                </a>';
                if ($isActionedit=='edit') {
                    $btn .= '<a href="'.url('leaves/'. $row->id .'/edit').'" data-toggle="tooltip" data-original-title="Edit" class="btn btn-icon btn-hover-primary btn-sm edit"><i class="fa fa-edit text-primary"></i></a>';
                }
                if ($isActiondelete=='delete'){
                    $btn .= '<a href="javascript:;" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" data-href="' . url('leaves/'. $row->id) . '" class="btn btn-icon btn-hover-primary btn-sm ml-2 delete"><i class="fas fa-trash text-danger"></i></a>';
                }
                return $btn;
            })
            ->rawColumns(['action','days'])
            ->make(true);
    }

}
