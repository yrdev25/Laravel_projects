<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(Session::has('image')){
        return redirect()->route('user.index');     
    }else{
        return redirect()->route('login');
    }
    
});

Route::resource('user',UserController::class);
Route::get('login',[UserController::class, 'login'])->name('login');
Route::post('check',[UserController::class,'check'])->name('check');
Route::post('logout',[UserController::class,'logout'])->name('logout');
Route::post('fetch_state',[UserController::class,'fetch_state'])->name('fetch_state');
Route::post('fetch_city',[UserController::class,'fetch_city'])->name('fetch_city');
