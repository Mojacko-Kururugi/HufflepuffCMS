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

	public function addBranch() {

		DB::table('tblBranch')
		->insert([
			'strBranchCode' 	=> Request::input('user_id'),
			'strBranchAddress' 		=> Request::input('adress'),
			'strContactNumb' 	=> Request::input('stud_id_no'),
			'strBanchName'	=> Request::input('number')
		]);

		return Redirect::to('/branches');
	}

		public function showBranches() {

		$branches = DB::table('tblBranch')
			->get();

		return View::make('admin-branches')->with('branches',$branches);
		
		}
}
