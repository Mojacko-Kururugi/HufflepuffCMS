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
			'strBranchAddress' 		=> Request::input('address'),
			'strContactNumb' 	=> Request::input('stud_id_no'),
			'strBranchName'	=> Request::input('number'),
			'intBStatus' => 1
		]);

		return Redirect::to('/branches');
	}

	public function showBranches() {

		$data = DB::table('tblBranch')
			->where('tblBranch.intBStatus', '=', 1)
			->get();

		return View::make('admin-branches')->with('data',$data);
		
		}

	public function addBranchForm() {

		return View::make('add-branch');
	}

	public function showDoctors() {
		$data = DB::table('tblUserInfo')
			->where('tblUserInfo.intUType', '=', 2)
			->get();

			return View::make('admin-doctors')->with('data',$data);
	}

	public function addDoctorForm() {

		return View::make('add-doctor');
	}

	public function addDoctor() {

		DB::table('tblUserInfo')
		->insert([
			'strUCode' 	=> Request::input('user_id'),
			'strULast' 	=> Request::input('last_name_sa'),
			'strUFirst' => Request::input('first_name_sa'),
			'strUMiddle' => Request::input('middle_name_sa'),
			'intUAge' => Request::input('age'),
			'strUAddress' => Request::input('address'),
			'strUContactNumb' => Request::input('stud_id_no'),
			'strUBranch' => Request::input('number'),
			'strUImagePath' => "",
			'intUType' => 2,
			'intUStatus' => 1
		]);

		return Redirect::to('/doctors');
	}


	public function showEmployees() {
		$data = DB::table('tblUserInfo')
			->where('tblUserInfo.intUType', '=', 3)
			->get();
		
			return View::make('admin-emp')->with('data',$data);
	}	

	public function addEmpForm() {

		return View::make('add-employee');
	}

	public function addEmp() {

		DB::table('tblUserInfo')
		->insert([
			'strUCode' 	=> Request::input('user_id'),
			'strULast' 	=> Request::input('last_name_sa'),
			'strUFirst' => Request::input('first_name_sa'),
			'strUMiddle' => Request::input('middle_name_sa'),
			'intUAge' => Request::input('age'),
			'strUAddress' => Request::input('address'),
			'strUContactNumb' => Request::input('stud_id_no'),
			'strUBranch' => Request::input('number'),
			'strUImagePath' => "",
			'intUType' => 3,
			'intUStatus' => 1
		]);

		return Redirect::to('/employees');
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

	public function showPat() {
		$data = DB::table('tblUserInfo')
			->where('tblUserInfo.intUType', '=', 4)
			->get();
		
				return View::make('record')->with('data',$data);
	}	

	public function addPatForm() {

		return View::make('test');
	}

	public function addPat() {

		DB::table('tblUserInfo')
		->insert([
			'strUCode' 	=> Request::input('user_id'),
			'strULast' 	=> Request::input('last_name_sa'),
			'strUFirst' => Request::input('first_name_sa'),
			'strUMiddle' => Request::input('middle_name_sa'),
			'intUAge' => Request::input('age'),
			'strUAddress' => Request::input('address'),
			'strUContactNumb' => Request::input('stud_id_no'),
			'strUBranch' => NULL,
			'strUImagePath' => "",
			'intUType' => 4,
			'intUStatus' => 1
		]);

		return Redirect::to('/records');
	}
		
}
