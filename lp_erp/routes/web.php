<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\DeleteController;

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
    return redirect()->route('home');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/login', [App\Http\Controllers\HomeController::class, 'login'])->name('login');
// Route::name('admin.')->prefix('admin')->group(function(){
//     Route::resource('/roles', RoleController::class);
//     Route::post('roles/{role}/permissions',[RoleController::class,'givePermission'])->name('roles.permission');
//     Route::delete('roles/{role}/permissions/{permission}',[RoleController::class,'revokePermission'])->name('roles.permissions.revoke');
//     Route::resource('/permissions', PermissionController::class);
// });
Route::resource('/roles', RoleController::class);
Route::resource('/permissions', PermissionController::class);

Route::resource('/user', UserController::class);
Route::get('/user/{user}/{status}',[ UserController::class, 'status'])->name('user.status');
// Route::post('user/softdeletes/{user}',[ UserController::class, 'softdeletes'])->name('user.softdeletes');

Route::resource('customer', CustomerController::class);
Route::get('customer/{customer}/{verify}',[ CustomerController::class, 'verify'])->name('customer.verify');
Route::get('/restore/{customer}/',[ CustomerController::class, 'restore'])->name('restore');
Route::get('/deleted',[ CustomerController::class, 'deleted'])->name('deleted');
Route::get('/verified',[ CustomerController::class, 'verified'])->name('verified');
Route::get('/unverified',[ CustomerController::class, 'unverified'])->name('unverified');
Route::get('/anniversary',[ CustomerController::class, 'anniversary'])->name('anniversary');
Route::get('/dob',[ CustomerController::class, 'dob'])->name('dob');
Route::get('/withoutdob',[ CustomerController::class, 'withoutdob'])->name('withoutdob');
Route::get('/city_area',[ CustomerController::class, 'city_area'])->name('city_area');
// Route::get('/fetch_customer',[ CustomerController::class, 'fetch'])->name('fetch_customer');

Route::resource('/category', CategoryController::class);
Route::get('/category/{category}/{status}',[ CategoryController::class, 'status'])->name('category.status');

Route::resource('/country',CountryController::class);
Route::get('/country/{country}/{status}',[ CountryController::class, 'status'])->name('country.status');

Route::resource('/state',StateController::class);
Route::get('/state/{state}/{status}',[ StateController::class, 'status'])->name('state.status');
// Route::get('/state/fetch',[ StateController::class, 'fetch'])->name('fetch');
Route::post('/fetch_state',[ StateController::class, 'fetch'])->name('fetch_state');

Route::resource('/city',CityController::class);
Route::get('/city/{city}/{status}',[ CityController::class, 'status'])->name('city.status');
Route::post('/fetch_city',[ CityController::class, 'fetch'])->name('fetch_city');

Route::resource('/area',AreaController::class);
Route::get('/area/{area}/{status}',[ AreaController::class, 'status'])->name('area.status');
Route::post('/fetch_area',[ AreaController::class, 'fetch'])->name('fetch_area');

Route::resource('/delete',DeleteController::class);
Route::get('/delete/{delete}/{status}',[ DeleteController::class, 'status'])->name('delete.status');




