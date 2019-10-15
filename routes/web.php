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
    return view('welcome');
});

Route::resource('employees','EmployeeController');
Route::post('employee/delete','EmployeeController@delete');

Route::resource('salarys','FolderSalaryController');


Route::get('salaryList/{id}','FolderSalaryController@salaryList');

Route::get('salaryEdit/{id}','FolderSalaryController@salaryEdit');

Route::post('salary_update_status','FolderSalaryController@updateStatusPayMent');

Auth::routes();
Route::get('/search','EmployeeController@search');
Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/edit', 'EmployeeController@edit')->name('home');
