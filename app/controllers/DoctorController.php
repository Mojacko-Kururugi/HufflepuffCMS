<?php

class DoctorController extends BaseController {
		
	public function index(){

		return View::make('index');

	}


	public function showPat() {
		$data = DB::table('tblPatientInfo')
			->where('tblPatientInfo.intPatStatus', '=', 1)
			->get();
		
				return View::make('record')->with('data',$data);
	}	

	public function addPatForm() {

		return View::make('test');
	}

	public function addPat() {

		DB::table('tblPatientInfo')
		->insert([
			'strPatLast' 	=> Request::input('last_name_sa'),
			'strPatFirst' => Request::input('first_name_sa'),
			'strPatMiddle' => Request::input('middle_name_sa'),
			'intPatGender' => Request::input('gender'),
			'dPatBirthdate' => null,
			'strPatHistory' => null,
			'strPatComplaints' => NULL,
			'strPatOldRX' => NULL,
			'strPatImagePath' => "",
			'intPatStatus' => 1
		]);

		return Redirect::to('/records');
	}

	public function openUpPat($id) {
		$data = DB::table('tblPatientInfo')
			->where('tblPatientInfo.strPatCode', '=', $id)
			->first();

	    return View::make('update-patient')->with('data',$data)->with('id',$id);
	}

	public function updatePat() {
			DB::table('tblPatientInfo')
				->where('tblPatientInfo.strPatCode', '=', Session::get('upId'))
				->update([
					'strPatLast' 	=> Request::input('last_name_sa'),
					'strPatFirst' => Request::input('first_name_sa'),
					'strPatMiddle' => Request::input('middle_name_sa'),
					'intPatGender' => Request::input('gender'),
				]);

		return Redirect::to('/records');
	}

	public function deactPat($id){
		DB::table('tblPatientInfo')
				->where('tblPatientInfo.strPatCode', '=', $id)
				->update([
					'intPatStatus' => 0,
				]);

	    return Redirect::to('/records');
	}

	public function showInv() {
		return View::make('inventory');
	}

	public function showSales() {
		return View::make('sales');
	}

	public function showSched() {
		$try = DB::table('tblBranch')
				->where('tblBranch.intBStatus', '=', 1)
				->get();
		return View::make('schedule')->with('try',$try);
	}
	public function addSched() {
		$data = DB::table('tblPatientInfo')
			->where('tblPatientInfo.intPatStatus', '=', 1)
			->get();

		return View::make('add-sched')->with('data',$data);
	}

	public function showPayment() {
		return View::make('add-payment');
	}

}