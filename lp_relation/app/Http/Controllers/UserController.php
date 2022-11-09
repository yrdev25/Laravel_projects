<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DataTables;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
       // $users = User::with('address')->get();
       // dd($users->first());
       if(Session::has('id')){
        $users = Address::with('user')->with('country')->with('city')->with('state')->where('user_id','!=',Session::get('id'))->get();
        return view('index',compact('users'));
       }else{
        return redirect()->route('login');
       }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
       // dd($cities);
        return view('create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fname' => ['required'],
            'lname' => ['required'],
            'dob' => ['required'],
            'age' => ['required'],
            'email' => ['required','unique:users'],
            'number' => ['required'],
            'image' => ['required'],
            'password' => ['required'],
            'address' => ['required'],
            'zipcode' => ['required'],
            'country' => ['required'],
            'state' => ['required'],
            'city' => ['required'],
        ]);
        $image_name = Str::random(9).'.png';
        $image_path = $request->file('image')->storeAs(
            'avatars',
            $image_name,
            'public'
        );
        $image_path = Storage::url($image_path);
        //dd($image_path);

        //$image_path = Storage::url($image_name);
        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'dob' => $request->dob,
            'age' => $request->age,
            'email' => $request->email,
            'number' => $request->number,
            'image' => $image_path,
            'password' => $request->password
        ]);
        
        $uid = $user->id;
        Address::create([
            'address' => $request->address,
           'zipcode' => $request->zipcode,
           'user_id' => $uid,
           'country_id' => $request->country,
           'state_id' => $request->state,
           'city_id' => $request->city
        ]);
        
        if(Session::has('id')){
            return redirect()->route('user.index');
        }else{
        session(['id' => $user->id]);
        session(['fname' => $user->fname]);
        session(['lname' => $user->lname]);
        session(['image' => $image_path]);
        return redirect()->route('user.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Session::has('id')){
        $user = Address::with('user')->where('user_id','=',$id)->with('country')->get();   
        $userdata = $user->first();
        $countries = Country::all();
        return view('create',compact('userdata','countries'));
        }else{
            return redirect()->route('login');
        }
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
        $request->validate([
            'fname' => ['required'],
            'lname' => ['required'],
            'dob' => ['required'],
            'age' => ['required'],
            'email' => ['required','unique:users'],
            'number' => ['required'],
            'image' => ['required'],
            'password' => ['required'],
            'address' => ['required'],
            'zipcode' => ['required'],
            'country' => ['required'],
            'state' => ['required'],
            'city' => ['required'],
        ]);

        $image_name = Str::random(9).'.png';
        $image_path = $request->file('image')->storeAs(
            'avatars',
            $image_name,
            'public'
        );
        $image_path = Storage::url($image_path);
        //dd($image_path);

        //$image_path = Storage::url($image_name);
        $user = User::where('id','=',$id)->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'dob' => $request->dob,
            'age' => $request->age,
            'email' => $request->email,
            'number' => $request->number,
            'image' => $image_path,
            'password' => $request->password
        ]);

        Address::where('user_id','=',$id)->update([
            'address' => $request->address,
           'zipcode' => $request->zipcode,
           'user_id' => $id,
           'country_id' => $request->country,
           'state_id' => $request->state,
           'city_id' => $request->city
        ]);

       
            return redirect()->route('user.index');
        

        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   $user = new User;
        //dd($id);
        if($id == session('id')){
            $user->where('id','=',$id)->delete();
            Session::flush();
            return redirect()->route('user.create');
        }else{
            $user->where('id','=',$id)->delete();
            return redirect()->route('user.index');
        }
         
          
    }

    public function login(){
       // dd('login');
       if(Session::has('id')){
          return redirect()->route('user.index');
       }else{
        return view('login');
       }

    }


    public function logout(){
        Session::flush();
        return redirect()->route('login');
    }

    public function check(Request $request){
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email','=',$email)->where('password','=',$password)->get();
        $userdata = $user->first();
        if($userdata){
            session(['id' => $userdata->id]);
            session(['fname' => $userdata->fname]);
            session(['lname' => $userdata->lname]);
            session(['image' => $userdata->image]);
            return redirect()->route('user.index');
        }else{
            echo "<script>alert('Invalid User')</script>";
        }
    }

    public function fetch_state(Request $request){
        $states = State::where("country_id",$request->country_id)->get();
        return response()->json($states);
    }

    public function fetch_city(Request $request){
        $cities = City::where("state_id",$request->state_id)->get();
        return response()->json($cities);
    }
}
