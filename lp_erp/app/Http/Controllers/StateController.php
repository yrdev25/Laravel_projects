<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Repository\StateRepository;

class StateController extends Controller
{
    public $stateRepo;
    public function __construct(StateRepository $stateRepository)
    {
        $this->middleware('auth');
        $this->middleware('permission:view_states')->only('index');
        $this->middleware('permission:create_state')->only('create','store');
        $this->middleware('permission:show_state')->only('show');
        $this->middleware('permission:edit_state')->only('edit','update','status');
        $this->middleware('permission:destroy_state')->only('destroy');
        $this->stateRepo = $stateRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['breadcrumb'] = [
            'parent_title' => ['States'],
            'parent_url' => ['states'],
            'page_title' => 'States',
            'page_items' => ['Dashboard' => '/', 'Location' => '' , 'States' => '']
        ];

        if($request->ajax()){
            return $this->stateRepo->index($request);
        }
        return view('state.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['breadcrumb'] = [
            'parent_title' => ['States'],
            'parent_url' => [BASE_URL.'states'],
            'page_title' => 'State Create',
            'page_items' => ['Dashboard' => '/','Location' => '', 'States' => BASE_URL.'state', 'State Create' => '']
        ];
        $countries = Country::where('is_active','=','1')->get();
        return view('state.create',compact('countries'))->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'state_name' => ['required', 'string', 'max:255', 'unique:states'],
            'country_id' => ['required']
        ]);

        $state = State::create([
            'state_name' => $data['state_name'],
            'country_id' => $data['country_id'],
        ]);

        return redirect()->route('state.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['breadcrumb'] = [
            'parent_title' => ['States'],
            'parent_url' => [BASE_URL.'states'],
            'page_title' => 'State Show',
            'page_items' => ['Dashboard' => '/','Location' => '', 'States' => BASE_URL.'state', 'State Show' => '']
        ];
        $state = State::with('country')->find($id);
        return view('state.show',compact('state'))->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['breadcrumb'] = [
            'parent_title' => ['States'],
            'parent_url' => [BASE_URL.'states'],
            'page_title' => 'State Edit',
            'page_items' => ['Dashboard' => '/','Location' => '', 'States' => BASE_URL.'state', 'State Edit' => '']
        ];
        $countries = Country::all();
        $state = State::with('country')->find($id);
        return view('state.edit',compact('state','countries'))->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $data = $request->validate([
            'state_name' => ['required', 'string', 'max:255'],
            'country_id' => ['required']
        ]);

        $state = State::where('id','=',$id)->update([
            'state_name' => $data['state_name'],
            'country_id' => $data['country_id'],
        ]);

        return redirect()->route('state.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        State::destroy($id);
        return redirect()->back();
    }

    public function status($id, $status)
    {
        ($status == '1') ? $status = '0' : $status = '1';
        State::where('id','=',$id)->update(['is_active' => $status]);
        return redirect()->back();
    }

    public function fetch(Request $request)
    {
        $data = State::with('country');
        $flag = 0;
       if($request->state != "" && $request->country == ""){
           $data = $data->where('state_name','=',$request->state);
        //    dd('here');
           $flag = 1;
       }

       if($request->country != "" && $request->state == ""){
        // dd('here2');
           $data = $data->where('country_id','=',$request->country);
           $flag = 1;
       }

       if($request->state != "" && $request->country != ""){
           $data = $data->where('state_name','=',$request->state)->where('country_id','=',$request->country);
        //    dd('here3');
           $flag = 1;
       }

       if($flag == 1){
           $data =  $data->get();
       }else{
           $data = NULL;
       }

       return response()->json($data);
    }

}
