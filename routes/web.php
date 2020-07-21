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

Route::get('/', 'HomeController@index')->name('home');
Auth::routes(['register' => false]);
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
   
    Route::resource('teams', 'TeamsController');
    Route::post('teams/search', 'TeamsController@search')->name('teams.search');
    Route::resource('fixtures', 'MatchController');
    
    Route::post('fixtures/search', 'MatchController@search')->name('fixtures.search');
    
  
});