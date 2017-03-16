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

	public function showFirst()
	{
		return View::make('welcome');
	}

	public function showLogin()
	{
		return View::make('login');
	}

	public function doLogin() {
		$user = Request::input('username');
		$pass = Request::input('password');
		$data = DB::table('tblUserAccounts')
				->join('tblUserType', 'tblUserAccounts.intUType', '=', 'tblUserType.intUTID')
				->where('tblUserAccounts.strUEmail', '=', $user)
				->where('tblUserAccounts.strUPassword', '=', $pass)
				->first();
		try
		{
			if($data->intUType == 2)
			{
				Session::put('user_type',$data->strUEmail);
				Session::put('user_desc',$data->strUTDesc);
				return Redirect::to('/index');
			}
			else if($data->intUType == 1)
			{
				Session::put('user_type',$data->strUEmail);
				return Redirect::to('/admin');
			}
			else if($data->intUType == 3)
			{
				Session::put('user_type',$data->strUEmail);
				Session::put('user_desc',$data->strUTDesc);
				return Redirect::to('/sec-home');
			}
			else if($data->intUType == 4)
			{
				Session::put('user_type',$data->strUEmail);
				return Redirect::to('/patient-home');
			}
			else
			{
				return Redirect::to('/account');
			}

		}
		catch (Exception $e)
		{
			return Redirect::to('/account');
		}
	}

	public function doLogout()
	{
		Session::flush();
		return Redirect::to('/account');
	}
		
}
