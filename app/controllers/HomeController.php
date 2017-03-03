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
