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
Route::post('/save-branch', 'HomeController@addBranch');

Route::get('/', function()
{
	return View::make('welcome');
});

Route::get('/account', function()
{
	return View::make('login');
});

Route::get('/sec-home', function()
{
	return View::make('layouts/secretary-master');
//	return View::make('test');
});

Route::get('/admin', function()
{
	return View::make('layouts/admin-master');
//	return View::make('test');
});

Route::get('/doctors', function()
{
	return View::make('admin-doctors');
});

Route::get('/add-doctor', function()
{
	return View::make('add-doctor');
});

Route::get('/branches', 'HomeController@showBranches');

Route::get('/add-branch', function()
{
	return View::make('add-branch');
});

Route::get('/add-patient', function()
{
	return View::make('add-patient');
});

Route::get('/patient-home', function()
{
	return View::make('student-home');
});

Route::get('/patient-schedules', function()
{
	return View::make('patient-sched');
});

Route::get('/patient-records', function()
{
	return View::make('patient-record');
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

