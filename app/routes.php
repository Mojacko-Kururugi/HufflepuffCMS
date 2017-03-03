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

//tests
Route::get('test/{id}', function($id)
{
	$data = DB::table('tblBranch')
		->where('tblBranch.strBranchCode', '=', $id)
		->first();

    return View::make('update-branch')->with('data',$data);
});

Route::post('/update-branch', function()
{
		DB::table('tblBranch')
			->where('tblBranch.strBranchCode', '=', Request::input('user_id'))
			->update([
			'strBranchAddress' 		=> Request::input('adress'),
			'strContactNumb' 	=> Request::input('stud_id_no'),
			'strBranchName'	=> Request::input('number')
			]);

	return Redirect::to('/branches');
});


Route::get('test2/{id}', function($id)
{
	DB::table('tblBranch')
			->where('tblBranch.strBranchCode', '=', $id)
			->update([
				'intBStatus' => 0,
			]);

    return Redirect::to('/branches');
});

Route::get('doctor/{id}', function($id)
{
	$data = DB::table('tblUserInfo')
		->where('tblUserInfo.strUCode', '=', $id)
		->first();

    return View::make('update-doctor')->with('data',$data);
});

Route::get('emp/{id}', function($id)
{
	$data = DB::table('tblUserInfo')
		->where('tblUserInfo.strUCode', '=', $id)
		->first();

    return View::make('update-employee')->with('data',$data);
});

Route::get('patient/{id}', function($id)
{
	$data = DB::table('tblUserInfo')
		->where('tblUserInfo.strUCode', '=', $id)
		->first();

    return View::make('update-patient')->with('data',$data);
});

Route::post('/update-doc', function()
{
		DB::table('tblUserInfo')
			->where('tblUserInfo.strUCode', '=', Request::input('user_id'))
			->update([
			'strUCode' 	=> Request::input('user_id'),
			'strULast' 	=> Request::input('last_name_sa'),
			'strUFirst' => Request::input('first_name_sa'),
			'strUMiddle' => Request::input('middle_name_sa'),
			'intUAge' => Request::input('age'),
			'strUAddress' => Request::input('address'),
			'strUContactNumb' => Request::input('stud_id_no'),
			'strUBranch' => Request::input('number')
			]);

	return Redirect::to('/doctors');
});

Route::post('/update-emp', function()
{
		DB::table('tblUserInfo')
			->where('tblUserInfo.strUCode', '=', Request::input('user_id'))
			->update([
			'strUCode' 	=> Request::input('user_id'),
			'strULast' 	=> Request::input('last_name_sa'),
			'strUFirst' => Request::input('first_name_sa'),
			'strUMiddle' => Request::input('middle_name_sa'),
			'intUAge' => Request::input('age'),
			'strUAddress' => Request::input('address'),
			'strUContactNumb' => Request::input('stud_id_no'),
			'strUBranch' => Request::input('number')
			]);

	return Redirect::to('/employees');
});

Route::post('/update-pat', function()
{
		DB::table('tblUserInfo')
			->where('tblUserInfo.strUCode', '=', Request::input('user_id'))
			->update([
			'strUCode' 	=> Request::input('user_id'),
			'strULast' 	=> Request::input('last_name_sa'),
			'strUFirst' => Request::input('first_name_sa'),
			'strUMiddle' => Request::input('middle_name_sa'),
			'intUAge' => Request::input('age'),
			'strUAddress' => Request::input('address'),
			'strUContactNumb' => Request::input('stud_id_no')
			]);

	return Redirect::to('/records');
});

Route::get('delete-doc/{id}', function($id)
{
	DB::table('tblUserInfo')
			->where('tblUserInfo.strUCode', '=', $id)
			->update([
				'intBUtatus' => 0,
			]);

    return Redirect::to('/doctors');
});

Route::get('delete-emp/{id}', function($id)
{
	DB::table('tblUserInfo')
			->where('tblUserInfo.strUCode', '=', $id)
			->update([
				'intBUtatus' => 0,
			]);

    return Redirect::to('/employees');
});

Route::get('delete-pat/{id}', function($id)
{
	DB::table('tblUserInfo')
			->where('tblUserInfo.strUCode', '=', $id)
			->update([
				'intBUtatus' => 0,
			]);

    return Redirect::to('/records');
});



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
	$user = Request::input('username');
	$pass = Request::input('password');
	/*$data = DB::table('tblUserInfo')
			->where('tblUserInfo.intUType', '=', 2)
			->get();*/
	if($user == 'Doctor')
	{
		return Redirect::to('/index');
	}
	else if($user == 'Admin')
	{
		return Redirect::to('/admin');
	}
	else if($user == 'Secretary')
	{
		return Redirect::to('/sec-home');
	}
	else if($user == 'Patient')
	{
		return Redirect::to('/patient-home');
	}
	else
	{
		return Redirect::to('/account');
	}

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
Route::get('/admin', 'AdminController@openAdmin');
Route::get('/branches', 'AdminController@showBranches');
Route::get('/add-branch', 'AdminController@addBranchForm');
Route::post('/save-branch', 'AdminController@addBranch');
Route::get('/doctors', 'AdminController@showDoctors');
Route::get('/add-doctor', 'AdminController@addDoctorForm');
Route::post('/save-doctor', 'AdminController@addDoctor');
Route::get('/employees', 'AdminController@showEmployees');
Route::get('/add-emp', 'AdminController@addEmpForm');
Route::post('/save-emp', 'AdminController@addEmp');




//for Doctor
Route::get('/records', 'HomeController@showPat');
Route::get('/add-patient', 'HomeController@addPatForm');

Route::get('/add-patient2', function()
{
	return View::make('add-patient');
});

Route::post('/save-pat', 'HomeController@addPat');


Route::get('/schedules', function()
{
	return View::make('schedule');
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

























