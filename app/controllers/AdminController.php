<?php

class AdminController extends BaseController {

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
}