<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//general
Route::get('/', function()
{
	return View::make('welcome');
});

Route::get('/account', function()
{
	return View::make('login');
});

Route::post('/login', function()
{
	return Redirect::to('/index');
});


Route::get('/logout', function()
{
	return Redirect::to('/account');
});

Route::get('/index', function()
{
	return View::make('index');
});



//for Admin Module
Route::get('/admin', 'HomeController@openAdmin');
Route::get('/branches', 'HomeController@showBranches');
Route::get('/add-branch', 'HomeController@addBranchForm');
Route::post('/save-branch', 'HomeController@addBranch');
Route::get('/doctors', 'HomeController@showDoctors');
Route::get('/add-doctor', 'HomeController@addDoctorForm');
Route::post('/save-doctor', 'HomeController@addDoctor');
Route::get('/employees', 'HomeController@showEmployees');
Route::get('/add-emp', 'HomeController@addEmpForm');
Route::post('/save-emp', 'HomeController@addEmp');




//for Doctor
Route::get('/add-patient', function()
{
	return View::make('add-patient');
});

Route::get('/schedules', function()
{
	return View::make('schedule');
});

Route::get('/records', function()
{
	return View::make('record');
});

Route::get('/inventory', function()
{
	return View::make('inventory');
});

Route::get('/sales', function()
{
	return View::make('sales');
});


Route::get('/add-sched', function()
{
	return View::make('add-sched');
});

Route::get('/add-payment', function()
{
	return View::make('add-payment');
});




//for sceretary
Route::get('/sec-home', 'HomeController@openSec');



//for patient
Route::get('/patient-home', 'HomeController@openPat');
Route::get('/patient-schedules', 'HomeController@showSched');
Route::get('/patient-records', 'HomeController@showRec');
Route::get('/patient-sales', 'HomeController@showAcc');

























