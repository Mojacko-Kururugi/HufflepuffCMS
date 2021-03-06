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

Route::post('/set-exp/{id}', 'AdminController@setExp');
Route::get('/admin/ord', 'AdminController@openAddItem');
Route::post('/admin/add-to-list', 'AdminController@addToList');
Route::get('/admin/rem-to-list/{id}', 'AdminController@removeToList');
Route::get('/admin/add-order', 'AdminController@addItem');
//Route::get('/admin/deliver/{id}', 'AdminController@deliverOrd');
Route::get('/admin/delivery/{id}', 'AdminController@openAddDel');
Route::post('/admin/delivery/', 'AdminController@deliverOrder');

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
Route::get('/materials/add', 'AdminController@openAddMat');
Route::get('/materials/{id}', 'AdminController@showUpMat');
Route::post('/products/update-prod','AdminController@updateProd' );
Route::get('delete-prod/{id}','AdminController@deactProd');



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
Route::post('/inventory/add-to-list', 'DoctorController@addToList');
Route::get('/inventory/rem-to-list/{id}', 'DoctorController@removeToList');
Route::get('/inventory/add-order', 'DoctorController@addOrd');
Route::get('/sales', 'DoctorController@showSales');
Route::get('/add-sched', 'DoctorController@addSched');
Route::get('/app-sched/{id}', 'DoctorController@appSched');
Route::get('/dec-sched/{id}', 'DoctorController@decSched');
Route::get('/cano-sched/{id}', 'DoctorController@canSched');
Route::get('/add-payment', 'DoctorController@showPayment');
Route::get('/job-order', 'DoctorController@openJO');
Route::post('/save-payment', 'DoctorController@addPayment');
Route::get('/reports', 'DoctorController@generateReport');
Route::get('/reports-inv', 'DoctorController@generateInv');

Route::get('/doc-jo', 'DoctorController@doctorJO');
Route::post('/doc-joborder-add', 'DoctorController@addJOtoList');
Route::get('/service/view-service/{id}', 'DoctorController@openServView');

//Dagdag ni tonet
Route::get('/add-payment-for-existing', 'DoctorController@showPaymentForExisting');
Route::post('/save-payment-for-existing', 'DoctorController@addPaymentForExisting');



//for sceretary
Route::get('/sec-patient/view/{id}', 'SecController@openPatView');
Route::get('/sec-patient/view-service/{id}', 'SecController@openServView');
Route::get('/sec-patient/view-joborder/{id}', 'SecController@openJOView');


Route::get('/sec-home', 'SecController@openSec');
Route::get('/sec-inv', 'SecController@openSecInv');
Route::get('/sec-order/ord', 'SecController@openAddOrd');
Route::get('/sec-order', 'SecController@openOrdList');
Route::post('/sec-order/add-to-list', 'SecController@addToList');
Route::get('/sec-order/rem-to-list/{id}', 'SecController@removeToList');
Route::get('/sec-inv/add-order', 'SecController@addOrd');
Route::post('/sec-inv/ord/{id}', 'SecController@receiveOrd');
Route::get('/adjustments', 'SecController@openSecAdj');
Route::get('/warranty', 'SecController@openSecWar');
Route::get('/replace/{serv_id}/{id}', 'SecController@replaceWar');
Route::get('/unclaimed', 'SecController@openSecUnc');
Route::get('/claim/{serv_id}/{id}', 'SecController@prodClaim');
Route::get('/claim-jo/{id}', 'SecController@joClaim');
Route::post('/adjust/{id}', 'SecController@adjInv');
Route::get('/expired', 'SecController@openExp');
Route::get('/sec-add-payment', 'SecController@showPayment');
Route::get('/sec-job-order', 'SecController@openJO');
Route::post('/sec-joborder-add', 'SecController@addJOtoList');

Route::post('/sec-purch/add-to-list', 'SecController@addPurchToList');

Route::get('/sec-purch/rem-to-list/{id}', 'SecController@remPurchToList');
Route::get('/sec-purch/rem-jo-list/{id}', 'SecController@remJoToList');

Route::get('/sec-purch/payment', 'SecController@showPayPurch');
Route::post('/sec-purch/addPayF', 'SecController@addPurchPay');
Route::get('/sec/payment/{id}', 'SecController@addPaymentE');
Route::post('/sec-purch/addPayEF', 'SecController@addPaymentEF');

Route::get('/receipt/{id}', 'SecController@generateReceipt');
Route::get('/reports-ord', 'SecController@generateOrd');
Route::get('/reports-adj', 'SecController@generateAdj');



//for patient
Route::get('/patient-home', 'PatientController@openPat');
Route::get('/patient-schedules', 'PatientController@showSched');
Route::get('/patient-schedules/req', 'PatientController@showReqSched');
Route::post('/patient-schedules/save', 'PatientController@saveReqSched');
Route::get('/patient-records', 'PatientController@showRec');
Route::get('/patient-sales', 'PatientController@showAcc');

Route::get('/patient-records/view-service/{id}', 'PatientController@openServView');
Route::get('/can-sched/{id}', 'PatientController@canSched');
Route::get('/ed-sched/{id}', 'PatientController@edSched');
Route::get('/del-sched/{id}', 'PatientController@delSched');
Route::get('/re-sched/{id}', 'PatientController@reSched');
Route::post('/patient-schedules/update', 'PatientController@updateReqSched');
Route::post('/patient-schedules/resched', 'PatientController@updateReSched');

Route::post('/patient/update-cred', 'PatientController@saveUpCred');

























