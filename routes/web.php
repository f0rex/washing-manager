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

Route::get('/', 'ShowIndex')->name('index');

Route::get('/group/index', 'GroupController@index')->name('group.index');
Route::get('/group/create', 'GroupController@create')->name('group.create');
Route::post('/group', 'GroupController@store')->name('group.store');
Route::get('/group/{group}/edit', 'GroupController@edit')->name('group.edit');
Route::put('/group/{group}', 'GroupController@update')->name('group.update');
Route::delete('/group/{group}', 'GroupController@destroy')->name('group.destroy');

Route::get('/vehicle/index', 'VehicleController@index')->name('vehicle.index');
Route::get('/vehicle/create', 'VehicleController@create')->name('vehicle.create');
Route::post('/vehicle', 'VehicleController@store')->name('vehicle.store');
Route::get('/vehicle/{vehicle}/edit', 'VehicleController@edit')->name('vehicle.edit');
Route::put('/vehicle/{vehicle}', 'VehicleController@update')->name('vehicle.update');
Route::delete('/vehicle/{vehicle}', 'VehicleController@destroy')->name('vehicle.destroy');

Route::get('/schedule/{schedule}/wash', 'ScheduleController@wash')->name('schedule.wash');
Route::get('/schedule/index', 'ScheduleController@index')->name('schedule.index');
Route::get('/schedule/create', 'ScheduleController@create')->name('schedule.create');
Route::post('/schedule', 'ScheduleController@store')->name('schedule.store');
Route::get('/schedule/{schedule}/edit', 'ScheduleController@edit')->name('schedule.edit');
Route::put('/schedule/{schedule}', 'ScheduleController@update')->name('schedule.update');
Route::delete('/schedule/{schedule}', 'ScheduleController@destroy')->name('schedule.destroy');

Route::get('/generator/create', 'GeneratorController@create')->name('generator.create');
Route::post('/generator/generate', 'GeneratorController@generate')->name('generator.generate');
