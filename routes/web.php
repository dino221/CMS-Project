<?php

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
Auth::routes();

Route::group(['middleware' => ['auth', 'auth.admin']], function (){
    Route::get('admin-panel', function () {
        return view('admin-panel.dashboard');
    });
});

Route::namespace('Admin')->prefix('admin')->middleware(['auth', 'auth.admin'])->name('admin.')->group(function() {
    Route::resource('/users', 'UserController', ['except' => ['show']]);
    Route::resource('/roles', 'RoleController', ['except' => ['show']]);
    Route::resource('/pages', 'PageController', ['except' => ['show']]);
});
Route::get('/logout', 'Auth\LoginController@logout');
Route::namespace('App')->name('app.')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP
    |--------------------------------------------------------------------------
    */

    Route::get('/', 'Controller@index')->name('index');
    Route::get('/home', 'Controller@home')->name('home');
    Route::get(('/inner/{slug}/{id}'), 'Controller@innerPageItem')->name('inner');


});
