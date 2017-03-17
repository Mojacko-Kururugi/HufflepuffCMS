<?php

class PatientController extends BaseController {
	public function openPat() {
		
		$data = DB::table('tblPatientInfo')
			->where('tblPatientInfo.strPatEmail', '=', Session::get('user_type'))
			->first();

		Session::put('user_name',$data->strPatLast . ', ' . $data->strPatFirst);
		Session::put('user_code',$data->intPatID);

		$app = DB::table('tblSchedules')
				->join('tblDocInfo', 'tblSchedules.intSchedDoctor', '=', 'tblDocInfo.intDocID')
				->where('tblSchedules.intSchedPatient', '=',  Session::get('user_code'))
				->get();

			return View::make('patient-home')->with('app',$app);
	}

	public function showSched() {
				$data = DB::table('tblSchedules')
				->get();
				
			return View::make('patient-sched')->with('data',$data);
	}

	public function showReqSched() {
		$data = DB::table('tblDocInfo')
			->join('tblBranch', 'tblDocInfo.intDocBranch', '=', 'tblBranch.intBranchID')
			->where('tblDocInfo.intDocStatus', '=', 1)
			->get();
				
			return View::make('patient-sched-request')->with('data',$data);
	}

	public function saveReqSched() {

	DB::table('tblSchedules')
		->insert([
			'dtSchedDate' 		=> Request::input('date'),
			'tmSchedTime'			=> Request::input('time'),
			'strSchedHeader' 	=> Request::input('name'),
			'strSchedDetails'	=> Request::input('desc'),
			'intSchedPatient'	=> Session::get('user_code'),			
			'intSchedDoctor' => Request::input('doctor'),
			'intSchedFrequencyType' => Request::input('time_frequency'),
			'intSchedType' => 2,
			'intSchedStatus' => 2,
		]);

		return Redirect::to('/patient-schedules');
	}


	public function showRec() {
		
			return View::make('patient-record');
	}

	public function showAcc() {
		
			return View::make('patient-sales');
	}

}