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

Route::get('/add-patient2', function()
{
	return View::make('add-patient');
});


//general
Route::get('/', ['before' => 'checkSession', 'uses' => 'HomeController@showFirst']);
Route::get('/account', ['before' => 'checkSession', 'uses' => 'HomeController@showLogin']);
Route::post('/login','HomeController@doLogin');
Route::get('/logout', 'HomeController@doLogout');



//for Admin Module
Route::get('/admin', 'AdminController@openAdmin');
Route::get('/branches', 'AdminController@showBranches');
Route::get('/add-branch', 'AdminController@addBranchForm');
Route::post('/save-branch', 'AdminController@addBranch');
Route::get('branch/{id}', 'AdminController@openUpBranch');
Route::post('/update-branch','AdminController@updateBranch');
Route::get('d-branch/{id}', 'AdminController@deactBranch');
Route::get('/doctors', 'AdminController@showDoctors');
Route::get('/add-doctor', 'AdminController@addDoctorForm');
Route::post('/save-doctor', 'AdminController@addDoctor');
Route::post('/update-doc', 'AdminController@updateDoctor');
Route::get('delete-doc/{id}', 'AdminController@deactDoctor');
Route::get('doctor/{id}','AdminController@openUpDoctor' );
Route::get('/employees', 'AdminController@showEmployees');
Route::get('/add-emp', 'AdminController@addEmpForm');
Route::post('/save-emp', 'AdminController@addEmp');
Route::get('emp/{id}','AdminController@showUpEmp' );
Route::post('/update-emp','AdminController@updateEmp' );
Route::get('delete-emp/{id}','AdminController@deactEmp');




//for Doctor
Route::get('/index', 'DoctorController@index');
Route::get('/records', 'DoctorController@showPat');
Route::get('/service', 'DoctorController@showServ');
Route::get('/service/add-service', 'DoctorController@showAddServ');
Route::post('/save-service', 'DoctorController@saveServ');
Route::get('/add-patient', 'DoctorController@addPatForm');
Route::post('/save-pat', 'DoctorController@addPat');
Route::get('patient/{id}', 'DoctorController@openUpPat');
Route::post('/update-pat', 'DoctorController@updatePat');
Route::get('delete-pat/{id}', 'DoctorController@deactPat');
Route::get('/schedules', 'DoctorController@showSched');
Route::get('/inventory', 'DoctorController@showInv');
Route::get('/inventory/order', 'DoctorController@openOrdList');
Route::post('/inventory/add-order', 'DoctorController@addOrd');
Route::get('/sales', 'DoctorController@showSales');
Route::get('/add-sched', 'DoctorController@addSched');
Route::get('/add-payment', 'DoctorController@showPayment');




//for sceretary
Route::get('/sec-home', 'SecController@openSec');
Route::get('/sec-inv', 'SecController@openSecInv');
Route::get('/sec-order/ord', 'SecController@openAddOrd');
Route::get('/sec-order', 'SecController@openOrdList');
Route::post('/sec-inv/add-order', 'SecController@addOrd');
Route::post('/sec-inv/ord/{id}', 'SecController@receiveOrd');
Route::get('/sec-prod', 'SecController@openSecProd');
Route::get('/sec-prod/add', 'SecController@openAddProd');
Route::post('/sec-prod/add-prod', 'SecController@addProd');



//for patient
Route::get('/patient-home', 'PatientController@openPat');
Route::get('/patient-schedules', 'PatientController@showSched');
Route::get('/patient-records', 'PatientController@showRec');
Route::get('/patient-sales', 'PatientController@showAcc');

























