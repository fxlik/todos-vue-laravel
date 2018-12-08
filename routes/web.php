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

Route::get('/', function () {
    return view('home');
});

Route::get('/vue', function () {
    return view('vue', ['title' => 'An even cooler way to do the title']);
});

Route::get('/page', function () {
    return view('page',
        [
            'title' => "Page 2 - A little about the Author",
            'author' => json_encode([
                    "name" => "Hime",
                    "role" => "Software Enginner",
                    "code" => "Always keeping it clean"
            ])
        ]
    );
});

Route::get('/{any}', function(){
    return view('vueapp');
})->where('any', '.*');

// user management
Route::post('/user', 'UserController@store');
Route::get('/user/paginate', 'UserController@paginate');
Route::get('/user/{id}', 'UserController@show');
Route::get('/user', 'UserController@view');

