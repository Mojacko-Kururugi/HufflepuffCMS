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

Route::get('/admin/ord', 'AdminController@openAddItem');
Route::post('/admin/add-order', 'AdminController@addItem');
Route::get('/admin/deliver/{id}', 'AdminController@deliverOrd');

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

Route::get('/product-type', 'AdminController@openProdType');
Route::get('/product-type/add-pt', 'AdminController@openAddProdType');
Route::post('/product-type/save', 'AdminController@addProdType');
Route::get('/product-type/{id}', 'AdminController@showUpPT');
Route::post('/product-type/update', 'AdminController@updatePT');
Route::get('delete-pt/{id}','AdminController@deactPT');

Route::get('/products', 'AdminController@openProd');
Route::get('/products/add', 'AdminController@openAddProd');
Route::post('/products/add-prod', 'AdminController@addProd');
Route::get('/products/{id}', 'AdminController@showUpProd');
Route::post('/products/update-prod','AdminController@updateProd' );
Route::get('delete-prod/{id}','AdminController@deactProd');

Route::get('/materials/add', 'AdminController@openAddMat');

Route::get('/services', 'AdminController@openServ');
Route::get('/services/add-serv', 'AdminController@openAddServ');
Route::post('/services/save-serv','AdminController@addServ' );
Route::get('/services/{id}', 'AdminController@openUpServ');
Route::post('/services/update-serv','AdminController@updateServ' );
Route::get('delete-serv/{id}','AdminController@deactServ');



//for Doctor
Route::get('/index', 'DoctorController@index');
Route::get('/records', 'DoctorController@showPat');
Route::get('/service', 'DoctorController@showServ');
Route::get('/service/add-service', 'DoctorController@showAddServ');
Route::post('/save-service', 'DoctorController@saveServ');
Route::get('/add-patient', 'DoctorController@addPatForm');
Route::post('/save-pat/', 'DoctorController@addPat');
Route::get('patient/{id}', 'DoctorController@openUpPat');
Route::post('/update-pat', 'DoctorController@updatePat');
Route::get('delete-pat/{id}', 'DoctorController@deactPat');
Route::get('/schedules', 'DoctorController@showSched');
Route::post('/schedules/save', 'DoctorController@saveSched');
Route::get('/inventory', 'DoctorController@showInv');
Route::get('/inventory/order', 'DoctorController@openOrdList');
Route::post('/inventory/add-order', 'DoctorController@addOrd');
Route::get('/sales', 'DoctorController@showSales');
Route::get('/add-sched', 'DoctorController@addSched');
Route::get('/add-payment', 'DoctorController@showPayment');
Route::get('/job-order', 'DoctorController@openJO');
Route::post('/save-payment', 'DoctorController@addPayment');
Route::get('/reports', 'DoctorController@generateReport');

//Dagdag ni tonet
Route::get('/add-payment-for-existing', 'DoctorController@showPaymentForExisting');
Route::post('/save-payment-for-existing', 'DoctorController@addPaymentForExisting');



//for sceretary
Route::get('/sec-home', 'SecController@openSec');
Route::get('/sec-inv', 'SecController@openSecInv');
Route::get('/sec-order/ord', 'SecController@openAddOrd');
Route::get('/sec-order', 'SecController@openOrdList');
Route::post('/sec-inv/add-order', 'SecController@addOrd');
Route::post('/sec-inv/ord/{id}', 'SecController@receiveOrd');
Route::get('/adjustments', 'SecController@openSecAdj');
Route::get('/warranty', 'SecController@openSecWar');
Route::get('/replace/{id}', 'SecController@replaceWar');
Route::get('/unclaimed', 'SecController@openSecUnc');
Route::get('/claim/{id}', 'SecController@prodClaim');
Route::post('/adjust/{id}', 'SecController@adjInv');
Route::get('/expired', 'SecController@openExp');
Route::get('/sec-add-payment', 'SecController@showPayment');
Route::get('/sec-job-order', 'SecController@openJO');



//for patient
Route::get('/patient-home', 'PatientController@openPat');
Route::get('/patient-schedules', 'PatientController@showSched');
Route::get('/patient-schedules/req', 'PatientController@showReqSched');
Route::post('/patient-schedules/save', 'PatientController@saveReqSched');
Route::get('/patient-records', 'PatientController@showRec');
Route::get('/patient-sales', 'PatientController@showAcc');

























