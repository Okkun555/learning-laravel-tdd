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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
  Route::get('/lessons/{lesson}', 'LessonController@show')->name('lessons.show');
  Route::post('/lessons/{lesson}/reserve', 'Lesson\ReserveController')->name('lessons.reserve');
});
