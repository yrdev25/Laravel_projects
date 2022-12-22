<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\City;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Repository\AreaRepository;

class AreaController extends Controller
{
    public $areaRepo;
    public function __construct(AreaRepository $areaRepository)
    {
        $this->middleware('auth');
        $this->middleware('permission:view_areas')->only('index');
        $this->middleware('permission:create_area')->only('create','store');
        $this->middleware('permission:show_area')->only('show');
        $this->middleware('permission:edit_area')->only('edit','update','status');
        $this->middleware('permission:destroy_area')->only('destroy');
        $this->areaRepo = $areaRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['breadcrumb'] = [
            'parent_title' => ['Areas'],
            'parent_url' => ['areas'],
            'page_title' => 'Areas',
            'page_items' => ['Dashboard' => '/','Location' => '', 'Areas' => '']
            ];

        if($request->ajax()){
            return $this->areaRepo->index($request);
        }
        return view('area.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['breadcrumb'] = [
            'parent_title' => ['Areas'],
            'parent_url' => [BASE_URL.'area'],
            'page_title' => 'Area Create',
            'page_items' => ['Dashboard' => '/','Location' => '', 'Areas' => BASE_URL.'area', 'Area Create' => '']
        ];
        $cities = City::where('is_active','=','1')->get();
        return view('area.create',compact('cities'))->with($data);
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
            'area_name' => ['required', 'string', 'max:255', 'unique:areas'],
            'city_id' => ['required']
        ]);

        $area = Area::create([
            'area_name' => $data['area_name'],
            'city_id' => $data['city_id'],
        ]);

        return redirect()->route('area.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['breadcrumb'] = [
            'parent_title' => ['Areas'],
            'parent_url' => [BASE_URL.'area'],
            'page_title' => 'Area Show',
            'page_items' => ['Dashboard' => '/','Location' => '', 'Areas' => BASE_URL.'area', 'Area Show' => '']
        ];
        $area = Area::with('city')->find($id);
        return view('area.show',compact('area'))->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['breadcrumb'] = [
            'parent_title' => ['Areas'],
            'parent_url' => [BASE_URL.'area'],
            'page_title' => 'Area Edit',
            'page_items' => ['Dashboard' => '/','Location' => '', 'Areas' => BASE_URL.'area', 'Area Edit' => '']
        ];
        $cities = City::all();
        $area = Area::with('city')->find($id);
        return view('area.edit',compact('area','cities'))->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $data = $request->validate([
            'area_name' => ['required', 'string', 'max:255'],
            'city_id' => ['required']
        ]);

        $area = Area::where('id','=',$id)->update([
            'area_name' => $data['area_name'],
            'city_id' => $data['city_id'],
        ]);

        return redirect()->route('area.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Area::destroy($id);
        return redirect()->back();
    }

    public function status($id, $status)
    {
        ($status == '1') ? $status = '0' : $status = '1';
        Area::where('id','=',$id)->update(['is_active' => $status]);
        return redirect()->back();
    }

    public function fetch(Request $request)
    {
        $data = Area::with('city');
        $flag = 0;
       if($request->area != "" && $request->city == ""){
           $data = $data->where('area_name','=',$request->area);
        //    dd('here');
           $flag = 1;
       }

       if($request->city != "" && $request->area == ""){
        // dd('here2');
           $data = $data->where('city_id','=',$request->city);
           $flag = 1;
       }

       if($request->area != "" && $request->city != ""){
           $data = $data->where('area_name','=',$request->area)->where('city_id','=',$request->city);
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
