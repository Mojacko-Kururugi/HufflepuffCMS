<?php

class PatientController extends BaseController {
	public function openPat() {
		
		$data = DB::table('tblPatientInfo')
			->where('tblPatientInfo.strPatEmail', '=', Session::get('user_type'))
			->first();

		Session::put('user_name',$data->strPatLast . ', ' . $data->strPatFirst);

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