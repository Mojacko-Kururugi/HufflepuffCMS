<?php

class AdminController extends BaseController {

	public function openAdmin() {
		
		return View::make('layouts/admin-master');
	}

	public function addBranch() {

		DB::table('tblBranch')
		->insert([
			'strBranchAddress' 		=> Request::input('address'),
			'strBContactNumb' 	=> Request::input('stud_id_no'),
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

	public function openUpBranch($id) {
		$data = DB::table('tblBranch')
			->where('tblBranch.strBranchCode', '=', $id)
			->first();

	    return View::make('update-branch')->with('data',$data)->with('id',$id);
	}

	public function updateBranch()	{
			DB::table('tblBranch')
				->where('tblBranch.strBranchCode', '=', Session::get('upId'))
				->update([
				'strBranchAddress' 		=> Request::input('address'),
				'strBContactNumb' 	=> Request::input('stud_id_no'),
				'strBranchName'	=> Request::input('number')
				]);

		return Redirect::to('/branches');
	}

	public function deactBranch($id) {
		DB::table('tblBranch')
				->where('tblBranch.strBranchCode', '=', $id)
				->update([
					'intBStatus' => 0,
				]);

	    return Redirect::to('/branches');
	}

	public function showDoctors() {
		$data = DB::table('tblDocInfo')
			->join('tblBranch', 'tblDocInfo.strDocBranch', '=', 'tblBranch.strBranchCode')
			->where('tblDocInfo.intDocStatus', '=', 1)
			->get();

			return View::make('admin-doctors')->with('data',$data);
	}

	public function addDoctorForm() {

		$branch = DB::table('tblBranch')
			->where('tblBranch.intBStatus', '=', 1)
			->get();

		return View::make('add-doctor')->with('branch',$branch);
	}

	public function addDoctor() {

		DB::table('tblDocInfo')
		->insert([
			'strDocLicNumb' 	=> Request::input('user_id'),
			'strDocLast' 	=> Request::input('last_name_sa'),
			'strDocFirst' => Request::input('first_name_sa'),
			'strDocMiddle' => Request::input('middle_name_sa'),
			'intDocGender' => Request::input('gender'),
			'strDocContactNumb' => Request::input('stud_id_no'),
			'strDocBranch' => Request::input('branch'),
			'strDocImagePath' => "",
			'strDocEmail' 	=> Request::input('email'),
			'intDocStatus' => 1
		]);

		DB::table('tblUserAccounts')
		->insert([
			'strUEmail' 	=> Request::input('email'),
			'strUPassword' 	=> Request::input('password'),
			'intUType' => 2
		]);

		return Redirect::to('/doctors');
	}

	public function openUpDoctor($id) {
		$data = DB::table('tblDocInfo')
			->join('tblBranch', 'tblDocInfo.strDocBranch', '=', 'tblBranch.strBranchCode')
			->where('tblDocInfo.strDocCode', '=', $id)
			->first();

		$branch = DB::table('tblBranch')
			->where('tblBranch.intBStatus', '=', 1)
			->get();

	    return View::make('update-doctor')->with('data',$data)->with('branch',$branch)->with('id',$id);
	}

	public function updateDoctor(){
			DB::table('tblDocInfo')
				->where('tblDocInfo.strDocCode', '=', Session::get('upId'))
				->update([
					'strDocLicNumb' 	=> Request::input('user_id'),
					'strDocLast' 	=> Request::input('last_name_sa'),
					'strDocFirst' => Request::input('first_name_sa'),
					'strDocMiddle' => Request::input('middle_name_sa'),
					'intDocGender' => Request::input('gender'),
					'strDocContactNumb' => Request::input('stud_id_no'),
					'strDocBranch' => Request::input('branch')
				]);

		return Redirect::to('/doctors');
	}

	public function deactDoctor($id) {
		DB::table('tblDocInfo')
				->where('tblDocInfo.strDocCode', '=', $id)
				->update([
					'intDocStatus' => 0,
				]);

	    return Redirect::to('/doctors');
	}

	public function showEmployees() {
		$data = DB::table('tblEmployeeInfo')
			->join('tblBranch', 'tblEmployeeInfo.strEmpBranch', '=', 'tblBranch.strBranchCode')
			->where('tblEmployeeInfo.intEmpStatus', '=', 1)
			->get();
		
			return View::make('admin-emp')->with('data',$data);
	}	

	public function addEmpForm() {

		$branch = DB::table('tblBranch')
			->where('tblBranch.intBStatus', '=', 1)
			->get();

		return View::make('add-employee')->with('branch',$branch);
	}

	public function addEmp() {

		DB::table('tblEmployeeInfo')
		->insert([
			'strEmpLast' 	=> Request::input('last_name_sa'),
			'strEmpFirst' => Request::input('first_name_sa'),
			'strEmpMiddle' => Request::input('middle_name_sa'),
			'strEmpBranch' => Request::input('branch'),
			'strEmpImagePath' => "",
			'strEmpEmail' 	=> Request::input('email'),
			'intEmpStatus' => 1
		]);

		DB::table('tblUserAccounts')
		->insert([
			'strUEmail' 	=> Request::input('email'),
			'strUPassword' 	=> Request::input('password'),
			'intUType' => 3
		]);

		return Redirect::to('/employees');
	}

	public function showUpEmp($id) {
		$data = DB::table('tblEmployeeInfo')
			->where('tblEmployeeInfo.strEmpCode', '=', $id)
			->first();


		$branch = DB::table('tblBranch')
				->where('tblBranch.intBStatus', '=', 1)
				->get();

	    return View::make('update-employee')->with('data',$data)->with('branch',$branch)->with('id',$id);
	}

	public function updateEmp() {
			DB::table('tblEmployeeInfo')
				->where('tblEmployeeInfo.strEmpCode', '=', Session::get('upId'))
				->update([
				'strEmpLast' 	=> Request::input('last_name_sa'),
				'strEmpFirst' => Request::input('first_name_sa'),
				'strEmpMiddle' => Request::input('middle_name_sa'),
				'strEmpBranch' => Request::input('branch'),
				]);

		return Redirect::to('/employees');
	}

	public function deactEmp($id) {
		DB::table('tblEmployeeInfo')
				->where('tblEmployeeInfo.strEmpCode', '=', $id)
				->update([
					'intEmpStatus' => 0,
				]);

	    return Redirect::to('/employees');
	}

}