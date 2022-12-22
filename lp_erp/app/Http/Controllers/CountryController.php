<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Repository\CountryRepository;

class CountryController extends Controller
{
    public $countryRepo;
    public function __construct(CountryRepository $countryRepository)
    {
        $this->middleware('auth');
        $this->middleware('permission:view_countries')->only('index');
        $this->middleware('permission:create_country')->only('create','store');
        $this->middleware('permission:show_country')->only('show');
        $this->middleware('permission:edit_country')->only('edit','update','status');
        $this->middleware('permission:destroy_country')->only('destroy');
        $this->countryRepo = $countryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data['breadcrumb'] = [
            'parent_title' => ['Countries'],
            'parent_url' => ['countries'],
            'page_title' => 'Countries',
            'page_items' => ['Dashboard' => '/' ,'Location' => '','Countries' => '']
            ];
        if ($request->ajax()) {

            return $this->countryRepo->index($request);
        }

        return view('country.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['breadcrumb'] = [
            'parent_title' => ['Countries'],
            'parent_url' => [BASE_URL.'countries'],
            'page_title' => 'Country Create',
            'page_items' => ['Dashboard' => '/','Location' => '', 'Countries' => BASE_URL.'country', 'Country Create' => '']
        ];
        return view('country.create')->with($data);
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
            'country_name' => ['required', 'string', 'max:255', 'unique:countries'],
        ]);

        $country = Country::create([
            'country_name' => $data['country_name'],
        ]);

        return redirect()->route('country.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['breadcrumb'] = [
            'parent_title' => ['Countries'],
            'parent_url' => [BASE_URL.'countries'],
            'page_title' => 'Country Show',
            'page_items' => ['Dashboard' => '/','Location' => '', 'Countries' => BASE_URL.'country', 'Country Show' => '']
        ];

        $country = Country::find($id);
        return view('country.show',compact('country'))->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['breadcrumb'] = [
            'parent_title' => ['Countries'],
            'parent_url' => [BASE_URL.'countries'],
            'page_title' => 'Country Edit',
            'page_items' => ['Dashboard' => '/','Location' => '', 'Countries' => BASE_URL.'country', 'Country Edit' => '']
        ];
        $country = Country::find($id);
        return view('country.edit',compact('country'))->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'country_name' => ['required', 'string', 'max:255'],
        ]);

        $country = Country::where('id','=',$id)->update([
            'country_name' => $data['country_name'],
        ]);

        return redirect()->route('country.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Country::destroy($id);
        return redirect()->back();
    }

    public function status($id, $status)
    {
        ($status == '1') ? $status = '0' : $status = '1';
        Country::where('id','=',$id)->update(['is_active' => $status]);
        return redirect()->back();
    }
}
