<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Repository\CityRepository;

class CityController extends Controller
{
    public function __construct(CityRepository $cityRepository)
    {
        $this->middleware('auth');
        $this->middleware('permission:view_cities')->only('index');
        $this->middleware('permission:create_city')->only('create','store');
        $this->middleware('permission:show_city')->only('show');
        $this->middleware('permission:edit_city')->only('edit','update','status');
        $this->middleware('permission:destroy_city')->only('destroy');
        $this->cityRepo = $cityRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['breadcrumb'] = [
            'parent_title' => ['Cities'],
            'parent_url' => ['cities'],
            'page_title' => 'Cities',
            'page_items' => ['Dashboard' => '/', 'Location' => '', 'Cities' => '']
            ];

        if($request->ajax()){
            return $this->cityRepo->index($request);
        }

        return view('city.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['breadcrumb'] = [
            'parent_title' => ['Cities'],
            'parent_url' => [BASE_URL.'cities'],
            'page_title' => 'City Create',
            'page_items' => ['Dashboard' => '/','Location' => '', 'Cities' => BASE_URL.'city', 'City Create' => '']
        ];
        $states = State::where('is_active','=','1')->get();
        return view('city.create',compact('states'))->with($data);
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
            'city_name' => ['required', 'string', 'max:255', 'unique:cities'],
            'state_id' => ['required']
        ]);

        $city = City::create([
            'city_name' => $data['city_name'],
            'state_id' => $data['state_id'],
        ]);

        return redirect()->route('city.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['breadcrumb'] = [
            'parent_title' => ['Cities'],
            'parent_url' => [BASE_URL.'cities'],
            'page_title' => 'City Show',
            'page_items' => ['Dashboard' => '/','Location' => '', 'Cities' => BASE_URL.'city', 'City Show' => '']
        ];
        $city = City::with('state')->find($id);
        return view('city.show',compact('city'))->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['breadcrumb'] = [
            'parent_title' => ['Cities'],
            'parent_url' => [BASE_URL.'cities'],
            'page_title' => 'City Edit',
            'page_items' => ['Dashboard' => '/', 'Location' => '', 'Cities' => BASE_URL.'city', 'City Edit' => '']
        ];
        $states = State::all();
        $city = City::with('state')->find($id);
        return view('city.edit',compact('city','states'))->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'city_name' => ['required', 'string', 'max:255'],
            'state_id' => ['required']
        ]);

        $city = City::where('id','=',$id)->update([
            'city_name' => $data['city_name'],
            'state_id' => $data['state_id'],
        ]);

        return redirect()->route('city.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        City::destroy($id);
        return redirect()->back();
    }

    public function status($id, $status)
    {
        ($status == '1') ? $status = '0' : $status = '1';
        City::where('id','=',$id)->update(['is_active' => $status]);
        return redirect()->back();
    }

    public function fetch(Request $request)
    {
        $data = City::with('state');
        $flag = 0;
       if($request->city != "" && $request->state == ""){
           $data = $data->where('city_name','=',$request->city);
        //    dd('here');
           $flag = 1;
       }

       if($request->state != "" && $request->city == ""){
        // dd('here2');
           $data = $data->where('state_id','=',$request->state);
           $flag = 1;
       }

       if($request->city != "" && $request->state != ""){
           $data = $data->where('city_name','=',$request->city)->where('state_id','=',$request->state);
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
