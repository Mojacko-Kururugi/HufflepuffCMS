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

	public function canSched($id) {

		DB::table('tblSchedules')
		->where('tblSchedules.intSchedID','=',$id)
		->update([
			'intSchedStatus' => 5
		]);

		return Redirect::to('/patient-schedules');
	}

	public function edSched($id) {
		 Session::put('upsId',$id);

		$ex = DB::table('tblSchedules')
		->where('tblSchedules.intSchedID','=',$id)
		->first();

		$data = DB::table('tblDocInfo')
			->join('tblBranch', 'tblDocInfo.intDocBranch', '=', 'tblBranch.intBranchID')
			->where('tblDocInfo.intDocStatus', '=', 1)
			->get();

		return View::make('patient-sched-ed')->with('data',$data)->with('ex',$ex);
	}

	public function updateReqSched() {

	DB::table('tblSchedules')
		->where('tblSchedules.intSchedID','=',Session::get('upsId'))
		->update([
			'dtSchedDate' 		=> Request::input('date'),
			'tmSchedTime'			=> Request::input('time'),
			'strSchedHeader' 	=> Request::input('name'),
			'strSchedDetails'	=> Request::input('desc'),
			'intSchedPatient'	=> Session::get('user_code'),			
			'intSchedDoctor' => Request::input('doctor')
		]);

		return Redirect::to('/patient-schedules');
	}


	public function showRec() {
		/*
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
			*/

				$data = DB::table('tblPatientInfo')
			//->join('tblPatientRX', 'tblPatientRX.intRXPatID', '=', 'tblPatientInfo.intPatID')
			->where('tblPatientInfo.intPatID', '=', Session::get('user_code'))
			->first();

		$rx = DB::table('tblPatientRX')
			->where('tblPatientRX.intRXPatID', '=', Session::get('user_code'))
			->get();

		$serv = DB::table('tblServiceHeader')
			->join('tblPatientInfo', 'tblServiceHeader.intSHPatID','=','tblPatientInfo.intPatID')
			->join('tblServices', 'tblServiceHeader.intSHServiceID','=','tblServices.intServID')
			->where('tblPatientInfo.intPatID', '=', Session::get('user_code'))
			->orderby('tblServiceHeader.intSHID','asc')
			->get();

		
			return View::make('patient-records')
			->with('data',$data)
			->with('rx',$rx)
			->with('serv',$serv);
	}

	public function openServView($id) {
		$data = DB::table('tblServiceHeader')
			->where('tblServiceHeader.intSHID', '=', $id)
			->first();

		$serv_id = $data->strSHCode;

		$rx = DB::table('tblPatientRX')
				->where('tblPatientRX.created_at', '<=', $data->intSHDateTime)
				->where('tblPatientRX.intRXPatID', '=', $data->intSHPatID)
				->orderby('tblPatientRX.intRXID','desc')
				->first();

		$med = DB::table('tblServiceHeader')
			->join('tblPatientInfo', 'tblServiceHeader.intSHPatID','=','tblPatientInfo.intPatID')
			->join('tblServices', 'tblServiceHeader.intSHServiceID','=','tblServices.intServID')
			->join('tblConsultationRecords', 'tblServiceHeader.strSHCode','=','tblConsultationRecords.strCRHeaderCode')
			->join('tblDocInfo', 'tblConsultationRecords.intCRDocID','=','tblDocInfo.intDocID')
			->where('tblServiceHeader.intSHID', '=', $id)
			->first();

		$purch = DB::table('tblServiceHeader')
			->join('tblServiceDetails', 'tblServiceDetails.strHeaderCode', '=', 'tblServiceHeader.strSHCode')
			->join('tblInventory', 'tblServiceDetails.intHInvID','=','tblInventory.intInvID')
			->join('tblItems','tblInventory.intInvPID','=','tblItems.intItemID')
			->where('tblServiceHeader.intSHID', '=', $id)
			->get();

		$list2 = DB::table('tblJobOrder')
			->where('tblJobOrder.strJOHC','=',$serv_id)
			->get();

		$list3 = DB::table('tblConsultationRecords')
			->where('tblConsultationRecords.strCRHeaderCode','=',$serv_id)
			->get();

		return View::make('pat-serv-detail')->with('med',$med)->with('purch',$purch)->with('serv_id',$serv_id)->with('rx',$rx)->with('list2',$list2)->with('list3',$list3);
	}


	public function showAcc() {
		
		$data = DB::table('tblSales')
			->join('tblServiceHeader','tblSales.strSServCode','=','tblServiceHeader.strSHCode')
			->join('tblPatientInfo', 'tblServiceHeader.intSHPatID','=','tblPatientInfo.intPatID')
			->join('tblPayType', 'tblServiceHeader.intSHPaymentType','=','tblPayType.intPayTID')
			->join('tblSalesStatus', 'tblSales.intSStatus','=','tblSalesStatus.intSaleSID')
			->join('tblPayment', 'tblSales.intSaleID','=','tblPayment.intPymServID')
			->where('tblPatientInfo.intPatID', '=',  Session::get('user_code'))
			//->groupby('tblSales.intSaleID')
			//->selectRaw('*, sum(dcmPymPayment) as sum')
			->get();

			return View::make('patient-sales')->with('data',$data);
	}

}