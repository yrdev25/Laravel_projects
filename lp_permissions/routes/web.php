<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/create',[HomeController::class,'create'])->name('create')->middleware('permission:create_hr|create_employee');
Route::post('/store',[HomeController::class,'store'])->name('store')->middleware('permission:create_hr|create_employee');

Route::name('admin.')->prefix('admin')->group(function(){
    Route::resource('/roles', RoleController::class)->middleware('permission:create_role');
    Route::post('roles/{role}/permissions',[RoleController::class,'givePermission'])->name('roles.permission')->middleware(['permission:create_role','permission:create_permission']);
    Route::delete('roles/{role}/permissions/{permission}',[RoleController::class,'revokePermissions'])->name('roles.permissions.revoke')->middleware(['permission:create_role','permission:create_permission']);
    Route::resource('/permissions', PermissionController::class)->middleware('permission:create_permission');
});


// Route::get('/',[IndexController::class,'index'])->name('index');
  
Route::get('/importform', [HomeController::class, 'importform'])->name('importform')->middleware(['permission:create_role','permission:create_permission']);;
Route::post('/import', [HomeController::class, 'import'])->name('import')->middleware(['permission:create_role','permission:create_permission']);;