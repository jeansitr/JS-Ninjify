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
    return view('index');
});

Route::match(['get', 'post', 'put', 'delete'], '/ninjify/buzzword', function () {
    return new Execption('Not implemented yet');
});

route::match(['get', 'post', 'put', 'delete'], 'ninjify/word', function () {
    return new Execption('Not implemented yet');
});
