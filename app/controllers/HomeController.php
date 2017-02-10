<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}

	public function openAdmin() {
		
		return View::make('layouts/admin-master');
	}

	public function addBranch() {

		DB::table('tblBranch')
		->insert([
			'strBranchCode' 	=> Request::input('user_id'),
			'strBranchAddress' 		=> Request::input('adress'),
			'strContactNumb' 	=> Request::input('stud_id_no'),
			'strBranchName'	=> Request::input('number')
		]);

		return Redirect::to('/branches');
	}

	public function showBranches() {

		$data = DB::table('tblBranch')
			->get();

		return View::make('admin-branches')->with('data',$data);
		
		}

	public function addBranchForm() {

		return View::make('add-branch');
	}

	public function showDoctors() {

			return View::make('admin-doctors');
	}

	public function addDoctorForm() {

		return View::make('add-doctor');
	}

	public function openSec() {
		
			return View::make('layouts/secretary-master');
	}

	public function openPat() {
		
			return View::make('patient-home');
	}

	public function showSched() {
		
			return View::make('patient-sched');
	}

	public function showRec() {
		
			return View::make('patient-record');
	}

	public function showAcc() {
		
			return View::make('patient-sales');
	}		
}
