<?php

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


/*

ADMINISTRATOR ROUTES

*/

// User Route

Route::get('/admin', function () {
    return view('admin.user.login');
})->name('admin');

Route::get('/admin/dashboard', [\App\Http\Controllers\userController::class, 'dashbaord']);
Route::get('/admin/settings/profile', [\App\Http\Controllers\userController::class, 'profile']);
Route::post('/admin/settings/profile', [\App\Http\Controllers\userController::class, 'update_profile']);
Route::get('/admin/settings/change-password', [\App\Http\Controllers\userController::class, 'change_password']);
Route::post('/admin/settings/change-password', [\App\Http\Controllers\userController::class, 'update_password']);
Route::resource('/admin/user', \App\Http\Controllers\userController::class);

Route::resource('/admin/region', \App\Http\Controllers\RegionController::class);

Auth::routes();

// Business
Route::get('/admin/business', [\App\Http\Controllers\BusinessController::class, 'index']);
Route::delete('/admin/business/{id}', [\App\Http\Controllers\BusinessController::class, 'destroy']);


// Person
Route::get('/admin/person', [\App\Http\Controllers\PersonController::class, 'index']);
Route::delete('/admin/person/{id}', [\App\Http\Controllers\PersonController::class, 'destroy']);

