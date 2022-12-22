<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Customer;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Repository\CustomerRepository;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public $customerRepo;
    public function __construct(CustomerRepository $customerRepository)
    {
        // $this->middleware('auth');
        $this->middleware('permission:view_customers')->only('index');
        $this->middleware('permission:create_customer')->only('create','store');
        $this->middleware('permission:edit_customer')->only('edit','update','verify');
        $this->middleware('permission:destroy_customer')->only('destroy');
        $this->customerRepo = $customerRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['breadcrumb'] = [
            'parent_title' => ['Customers'],
            'parent_url' => ['customers'],
            'page_title' => 'Customers',
            'page_items' => ['Dashboard' => '/', 'Customers' => '']
            ];

        if($request->ajax()){
            return $this->customerRepo->index($request);
        }
        return view('customer.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['breadcrumb'] = [
            'parent_title' => ['Customers'],
            'parent_url' => [BASE_URL.'customers'],
            'page_title' => 'Customer Create',
            'page_items' => ['Dashboard' => '/', 'Customers' => BASE_URL.'customer', 'Customer Create' => '']
        ];

        $categories = Category::where('is_active','=','1')->get();
        $countries = Country::where('is_active','=','1')->get();
        $states = State::where('is_active','=','1')->get();
        $cities = City::where('is_active','=','1')->get();
        $areas = Area::where('is_active','=','1')->get();
        return view('customer.create',compact('categories','countries','states','cities','areas'))->with($data);
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
            'category_id' => ['required', 'integer'],
            'first_name_1' => ['required', 'string', 'max:255'],
            'middle_name_1' => ['required', 'string', 'max:255'],
            'last_name_1' => ['required', 'string', 'max:255'],
            'first_name_2' => ['required', 'string', 'max:255'],
            'middle_name_2' => ['required', 'string', 'max:255'],
            'last_name_2' => ['required', 'string', 'max:255'],
            'line_1' => ['required', 'string', 'max:255'],
            'line_2' => ['required', 'string', 'max:255'],
            'landmark' => ['required', 'string', 'max:255'],
            'country_id' => ['required', 'integer'],
            'state_id' => ['required', 'integer'],
            'city_id' => ['required', 'integer'],
            'area_id' => ['required', 'integer'],
            'pincode' => ['required', 'numeric', 'digits:6'],
            'mobile_1' => ['required', 'numeric', 'digits:10'],
            'mobile_2' => ['required', 'numeric', 'digits:10'],
            'res_no' => ['required', 'numeric', 'digits:10'],
            'office_no' => ['required', 'numeric', 'digits:10'],
            'email' => ['required', 'email', 'unique:customers'],
            'dob' => ['nullable','date'],
            'marriage_anniversary' => ['nullable','date'],
            'like' => ['required', 'max:255'],
            'dislike' => ['required', 'max:255'],
            'remarks' => ['required', 'max:255'],
        ]);
        // 'departure_time' => date("H:i:s", strtotime(request('departureTime')));

        $customer = Customer::create([
            'category_id' => $data['category_id'],
            'first_name_1' => $data['first_name_1'],
            'middle_name_1' => $data['middle_name_1'],
            'last_name_1' => $data['last_name_1'],
            'first_name_2' => $data['first_name_2'],
            'middle_name_2' => $data['middle_name_2'],
            'last_name_2' => $data['last_name_2'],
            'line_1' => $data['line_1'],
            'line_2' => $data['line_2'],
            'landmark' => $data['landmark'],
            'country_id' => $data['country_id'],
            'state_id' => $data['state_id'],
            'city_id' => $data['city_id'],
            'area_id' => $data['area_id'],
            'pincode' => $data['pincode'],
            'mobile_1' => $data['mobile_1'],
            'mobile_2' => $data['mobile_2'],
            'res_no' => $data['res_no'],
            'office_no' => $data['office_no'],
            'email' => $data['email'],
            'dob' => $data['dob'],
            // 'dob' => date("H:i:s", strtotime($data['dob'])),
            'marriage_anniversary' => $data['marriage_anniversary'],
            // 'marriage_anniversary' => date("H:i:s", strtotime($data['marriage_anniversary'])),
            'like' => $data['like'],
            'dislike' => $data['dislike'],
            'remarks' => $data['remarks'],
        ]);

        return redirect()->route('customer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['breadcrumb'] = [
            'parent_title' => ['Customers'],
            'parent_url' => [BASE_URL.'customers'],
            'page_title' => 'Customer Show',
            'page_items' => ['Dashboard' => '/', 'Customers' => BASE_URL.'customer', 'Customer Show' => '']
        ];

        $customer = Customer::withTrashed()->with('category')->with('country')->with('state')->with('city')->find($id);
        return view('customer.show',compact('customer'))->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['breadcrumb'] = [
            'parent_title' => ['Customers'],
            'parent_url' => [BASE_URL.'customers'],
            'page_title' => 'Customer Edit',
            'page_items' => ['Dashboard' => '/', 'Customers' => BASE_URL.'customer', 'Customer Edit' => '']
        ];

        $categories = Category::where('is_active','=','1')->get();
        $countries = Country::where('is_active','=','1')->get();
        $states = State::where('is_active','=','1')->get();
        $cities = City::where('is_active','=','1')->get();
        $areas = Area::where('is_active','=','1')->get();
        $customer = Customer::find($id);
        return view('customer.edit',compact('customer','categories','countries','states','cities','areas'))->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $data = $request->validate([
            'category_id' => ['required', 'integer'],
            'first_name_1' => ['required', 'string', 'max:255'],
            'middle_name_1' => ['required', 'string', 'max:255'],
            'last_name_1' => ['required', 'string', 'max:255'],
            'first_name_2' => ['required', 'string', 'max:255'],
            'middle_name_2' => ['required', 'string', 'max:255'],
            'last_name_2' => ['required', 'string', 'max:255'],
            'line_1' => ['required', 'string', 'max:255'],
            'line_2' => ['required', 'string', 'max:255'],
            'landmark' => ['required', 'string', 'max:255'],
            'country_id' => ['required', 'integer'],
            'state_id' => ['required', 'integer'],
            'city_id' => ['required', 'integer'],
            'area_id' => ['required', 'integer'],
            'pincode' => ['required', 'numeric', 'digits:6'],
            'mobile_1' => ['required', 'numeric', 'digits:10'],
            'mobile_2' => ['required', 'numeric', 'digits:10'],
            'res_no' => ['required', 'numeric', 'digits:10'],
            'office_no' => ['required', 'numeric', 'digits:10'],
            'email' => ['required', 'email'],
            'dob' => ['nullable','date'],
            'marriage_anniversary' => ['nullable','date'],
            'like' => ['required', 'max:255'],
            'dislike' => ['required', 'max:255'],
            'remarks' => ['required', 'max:255'],
        ]);

        $customer = Customer::where('id','=',$id)->update([
            'category_id' => $data['category_id'],
            'first_name_1' => $data['first_name_1'],
            'middle_name_1' => $data['middle_name_1'],
            'last_name_1' => $data['last_name_1'],
            'first_name_2' => $data['first_name_2'],
            'middle_name_2' => $data['middle_name_2'],
            'last_name_2' => $data['last_name_2'],
            'line_1' => $data['line_1'],
            'line_2' => $data['line_2'],
            'landmark' => $data['landmark'],
            'country_id' => $data['country_id'],
            'state_id' => $data['state_id'],
            'city_id' => $data['city_id'],
            'area_id' => $data['area_id'],
            'pincode' => $data['pincode'],
            'mobile_1' => $data['mobile_1'],
            'mobile_2' => $data['mobile_2'],
            'res_no' => $data['res_no'],
            'office_no' => $data['office_no'],
            'email' => $data['email'],
            'dob' => $data['dob'],
            'marriage_anniversary' => $data['marriage_anniversary'],
            'like' => $data['like'],
            'dislike' => $data['dislike'],
            'remarks' => $data['remarks'],
        ]);

        return redirect()->route('customer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::destroy($id);
        return redirect()->back();
    }

    public function verify($id, $verify)
    {
        ($verify == '0') ? $verify = '1' : $verify = '0';
        Customer::where('id','=',$id)->update(['is_verified' => $verify]);
        return redirect()->back();
    }

    public function verified(Request $request)
    {
        $data['breadcrumb'] = [
            'parent_title' => ['Customers'],
            'parent_url' => [BASE_URL.'customers'],
            'page_title' => 'Customers Verified',
            'page_items' => ['Dashboard' => '/','Reports' => '', 'Verified' => '']
        ];
        if($request->ajax()){
            return $this->customerRepo->verified($request);
        }
        return view('customer.verified')->with($data);
    }

    public function anniversary(Request $request){
        $data['breadcrumb'] = [
            'parent_title' => ['Customers'],
            'parent_url' => [BASE_URL.'customers'],
            'page_title' => 'Customers Anniversary',
            'page_items' => ['Dashboard' => '/','Reports' => '', 'Anniversary' => '']
            ];
        if($request->ajax()){
            return $this->customerRepo->anniversary($request);
        }
        return view('customer.anniversary')->with($data);
    }

    public function dob(Request $request){
        $data['breadcrumb'] = [
            'parent_title' => ['Customers'],
            'parent_url' => [BASE_URL.'customers'],
            'page_title' => 'Customers Date Of Birth',
            'page_items' => ['Dashboard' => '/','Reports' => '', 'DOB' => '']
        ];
        if($request->ajax()){
            return $this->customerRepo->dob($request);
        }
        return view('customer.dob')->with($data);
    }

    public function unverified(Request $request){
        $data['breadcrumb'] = [
            'parent_title' => ['Customers'],
            'parent_url' => [BASE_URL.'customers'],
            'page_title' => 'Customers Unverified',
            'page_items' => ['Dashboard' => '/','Reports' => '', 'Unverified' => '']
        ];
        if($request->ajax()){
            return $this->customerRepo->unverified($request);
        }
        return view('customer.unverified')->with($data);
    }

    public function withoutdob(Request $request){
        $data['breadcrumb'] = [
            'parent_title' => ['Customers'],
            'parent_url' => [BASE_URL.'customers'],
            'page_title' => 'Customers Without DOB',
            'page_items' => ['Dashboard' => '/','Reports' => '', 'Without DOB' => '']
        ];
        if($request->ajax()){
            return $this->customerRepo->withoutdob($request);
        }
        return view('customer.withoutdob')->with($data);
    }

    public function city_area(Request $request){
        $data['breadcrumb'] = [
            'parent_title' => ['Customers'],
            'parent_url' => [BASE_URL.'customers'],
            'page_title' => 'Customers City/Area',
            'page_items' => ['Dashboard' => '/','Reports' => '', 'City/Area' => '']
        ];
        if($request->ajax()){
            return $this->customerRepo->city_area($request);
        }
        return view('customer.city_area')->with($data);
    }

    public function deleted(Request $request){

        $data['breadcrumb'] = [
            'parent_title' => ['Customers'],
            'parent_url' => [BASE_URL.'customers'],
            'page_title' => 'Customers Deleted',
            'page_items' => ['Dashboard' => '/','Reports' => '', 'Deleted' => '']
        ];
        if($request->ajax()){
            return $this->customerRepo->deleted($request);
        }
        return view('customer.deleted')->with($data);
    }

    public function restore($id)
    {
        // dd('asdf');
        Customer::onlyTrashed()->where('id', $id)->restore();
        return back();
    }

    // public function fetch(){
    //     $customers = Customer::all();
    //     $dates = array();
    //     foreach($customers as $customer){
    //        $month = date('F',strtotime($customer->dob));
    //        array_push($dates,$month);
    //     }
    //     return response()->json($dates);
    // }

}
