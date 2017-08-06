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
		$data = DB::table('tblServiceHeader')
			->join('tblPatientInfo', 'tblServiceHeader.intSHPatID','=','tblPatientInfo.intPatID')
			//->join('tblDocInfo', 'tblServiceHeader.intSHDocID','=','tblDocInfo.intDocID')
			->join('tblServices', 'tblServiceHeader.intSHServiceID','=','tblServices.intServID')
			->join('tblPayType', 'tblServiceHeader.intSHPaymentType','=','tblPayType.intPayTID')
			->join('tblServiceStatus', 'tblServiceHeader.intSHStatus','=','tblServiceStatus.intServStatID')
			->join('tblConsultationRecords', 'tblServiceHeader.strSHCode','=','tblConsultationRecords.strCRHeaderCode')
			->join('tblServiceDetails', 'tblServiceHeader.strSHCode','=','tblServiceDetails.strHeaderCode')
			->join('tblInventory', 'tblServiceDetails.intHInvID','=','tblInventory.intInvID')
			->join('tblProducts','tblInventory.intInvPID','=','tblProducts.intProdID')
			->where('tblPatientInfo.intPatID', '=',  Session::get('user_code'))
			->get();

		
			return View::make('patient-record')->with('data',$data);
	}

	public function showAcc() {
		
		$data = DB::table('tblSales')
			->join('tblServiceHeader','tblSales.strSServCode','=','tblServiceHeader.strSHCode')
			->join('tblPatientInfo', 'tblServiceHeader.intSHPatID','=','tblPatientInfo.intPatID')
			->join('tblPayType', 'tblServiceHeader.intSHPaymentType','=','tblPayType.intPayTID')
			->join('tblSalesStatus', 'tblSales.intSStatus','=','tblSalesStatus.intSaleSID')
			->join('tblPayment', 'tblSales.intSaleID','=','tblPayment.intPymServID')
			->where('tblPatientInfo.intPatID', '=',  Session::get('user_code'))
			->groupby('tblSales.intSaleID')
			->selectRaw('*, sum(dcmPymPayment) as sum')
			->get();

			return View::make('patient-sales')->with('data',$data);
	}

}