<?php
use Barryvdh\DomPDF\Facade as PDF;

class DoctorController extends BaseController {
		
	public function index(){

		$data = DB::table('tblDocInfo')
			->join('tblBranch', 'tblDocInfo.intDocBranch', '=', 'tblBranch.intBranchID')
			->where('tblDocInfo.strDocEmail', '=', Session::get('user_type'))
			->first();

		Session::put('user_code',$data->intDocID);
		Session::put('user_name',$data->strDocLast . ', ' . $data->strDocFirst);
		Session::put('user_b',$data->strBranchName);
		Session::put('user_bc',$data->intBranchID);

		$inv = DB::table('tblInventory')
			->join('tblItems', 'tblInventory.intInvPID', '=', 'tblItems.intItemID')
			->where('tblInventory.intInvBranch', '=', Session::get('user_bc'))
			->where('tblInventory.intInvStatus','!=',3)
			->groupby('tblInventory.intInvPID')
			->selectRaw('*, sum(intInvQty) as sum')
			->get();

		$app = DB::table('tblSchedules')
				->join('tblPatientInfo', 'tblSchedules.intSchedPatient', '=', 'tblPatientInfo.intPatID')
				->where('tblSchedules.intSchedDoctor', '=',  Session::get('user_code'))
				->where('tblSchedules.intSchedStatus', '=',  1)
				->get();

		$req = DB::table('tblSchedules')
				->join('tblPatientInfo', 'tblSchedules.intSchedPatient', '=', 'tblPatientInfo.intPatID')
				->where('tblSchedules.intSchedDoctor', '=',  Session::get('user_code'))
				->where('tblSchedules.intSchedStatus', '=',  2)
				->get();;

		return View::make('index')->with('inv',$inv)->with('app',$app)->with('req',$req);

	}


	public function showPat() {
		$data = DB::table('tblPatientInfo')
			//->join('tblPatientRX', 'tblPatientRX.intRXPatID', '=', 'tblPatientInfo.intPatID')
			->where('tblPatientInfo.intPatStatus', '=', 1)
			->where('tblPatientInfo.intPatID', '!=', 1)
			->get();
		
		return View::make('record')->with('data',$data);
	}	

	public function addPatForm() {

		return View::make('test');
	}

	public function addPat() {
		$history = Request::input('diabetes') . Request::input('glaucoma') . Request::input('asthma') . Request::input('highblood') . Request::input('goiter') . Request::input('kidneyprob'); 	
		//$complaints = Request::input('BOVfar') . Request::input('BOVnear') . Request::input('headache') . Request::input('dizziness') . Request::input('glare') . Request::input('vomitting'); 	
		
		//$oldrx = Request::input('OD') . '-' . Request::input('ODAdd') . ',' . Request::input('OS') . '-' . Request::input('OSAdd') . '/' . Request::input('CLOD') . '-' . Request::input('CLOS');

		$ct = 1 + DB::table('tblPatientInfo')
			->count();
		
		DB::table('tblPatientInfo')
		->insert([
			'strPatLast' 	=> Request::input('last_name_sa'),
			'strPatFirst' => Request::input('first_name_sa'),
			'strPatMiddle' => Request::input('middle_name_sa') ,
			'intPatGender' => Request::input('gender'),
			'strPatAddress' => Request::input('address'),
			'strPatContactNumb' =>Request::input('number'),
			'strPatCompany' =>Request::input('company'),
			'dPatBirthdate' => null,
			'strPatHistory' => $history,
			'strPatImagePath' => "",
			'strPatEmail' 	=> Request::input('email'),
			'intPatStatus' => 1
		]);

		DB::table('tblPatientRX')
		->insert([
			'intRXPatID' 	=> $ct,
			'strSOD' => Request::input('OD'),
			'strSODAdd' => Request::input('ODAdd'),
			'strSOS' => Request::input('OS'),
			'strSOSAdd' => Request::input('OSAdd'),
			'strCLOD' => Request::input('CLOD'),
			'strCLOS' => Request::input('CLOS'),
			'intRXPatStatus' => 1
		]);


		DB::table('tblUserAccounts')
		->insert([
			'strUEmail' 	=> Request::input('email'),
			'strUPassword' 	=> Request::input('password'),
			'intUType' => 4
		]);

		return Redirect::to('/records');
	}

	public function openUpPat($id) {
		$data = DB::table('tblPatientInfo')
			->where('tblPatientInfo.intPatID', '=', $id)
			->first();

	    return View::make('update-patient')->with('data',$data)->with('id',$id);
	}

	public function updatePat() {
			DB::table('tblPatientInfo')
				->where('tblPatientInfo.intPatID', '=', Session::get('upId'))
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
				->where('tblPatientInfo.intPatID', '=', $id)
				->update([
					'intPatStatus' => 0,
				]);

	    return Redirect::to('/records');
	}


	public function showServ() {
		/*
		$data = DB::table('tblServiceHeader')
			->join('tblPatientInfo', 'tblServiceHeader.intSHPatID','=','tblPatientInfo.intPatID')
			->join('tblDocInfo', 'tblServiceHeader.intSHDocID','=','tblDocInfo.intDocID')
			->join('tblServices', 'tblServiceHeader.intSHServiceID','=','tblServices.intServID')
			->join('tblPayType', 'tblServiceHeader.intSHPaymentType','=','tblPayType.intPayTID')
			->join('tblServiceStatus', 'tblServiceHeader.intSHStatus','=','tblServiceStatus.intServStatID')
			->join('tblConsultationRecords', 'tblServiceHeader.strSHCode','=','tblConsultationRecords.strCRHeaderCode')
			->join('tblServiceDetails', 'tblServiceHeader.strSHCode','=','tblServiceDetails.strHeaderCode')
			->join('tblInventory', 'tblServiceDetails.intHInvID','=','tblInventory.intInvID')
			->join('tblItems','tblInventory.intInvPID','=','tblItems.intItemID')
			->where('tblInventory.intInvBranch', '=', Session::get('user_bc'))
			->get();
	

				return View::make('services')->with('data',$data);
		*/

		$serv = DB::table('tblServiceHeader')
			->join('tblPatientInfo', 'tblServiceHeader.intSHPatID','=','tblPatientInfo.intPatID')
			->join('tblServices', 'tblServiceHeader.intSHServiceID','=','tblServices.intServID')
			->join('tblEmployeeInfo', 'tblServiceHeader.intSHEmpID','=','tblEmployeeInfo.intEmpID')
			->where('tblEmployeeInfo.intEmpBranch', '=', Session::get('user_bc'))
			//->where('tblServiceHeader.intSHStatus', '!=', 2)
			//->join('tblConsultationRecords', 'tblServiceHeader.strSHCode','=','tblConsultationRecords.strCRHeaderCode')
			//->join('tblDocInfo', 'tblConsultationRecords.intCRDocID','=','tblDocInfo.intDocID')
			->get();


			return View::make('doc-services')->with('serv',$serv);
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
			->where('tblInventory.intInvBranch', '=', Session::get('user_bc'))
			->where('tblServiceHeader.intSHID', '=', $id)
			->get();

		$list2 = DB::table('tblJobOrder')
			->where('tblJobOrder.strJOHC','=',$serv_id)
			->get();

		$list3 = DB::table('tblConsultationRecords')
			->where('tblConsultationRecords.strCRHeaderCode','=',$serv_id)
			->get();

		return View::make('doc-serv-detail')->with('med',$med)->with('purch',$purch)->with('serv_id',$serv_id)->with('rx',$rx)->with('list2',$list2)->with('list3',$list3);
	}


	public function showAddServ() {

		$patient = DB::table('tblPatientInfo')
			->where('tblPatientInfo.intPatID', '!=', 1)
			->where('tblPatientInfo.intPatStatus', '=', 1)
			->get();

		$doc = DB::table('tblDocInfo')
			->join('tblBranch', 'tblDocInfo.intDocBranch', '=', 'tblBranch.intBranchID')
			->where('tblDocInfo.intDocStatus', '=', 1)
			->get();

		$service = DB::table('tblServices')
			->where('tblServices.intServStatus', '=', 1)
			->get();

		$type = DB::table('tblPayType')
			->get();

		$status = DB::table('tblServiceStatus')
			->get();
		

		$ct = 1 + DB::table('tblServiceHeader')
			->where('tblServiceHeader.intSHStatus', '!=', 2)
			->count();

		if($ct < 10)
			$count = "SRV00" . $ct;
		else if($ct < 100)
			$count = "SRV0" . $ct;
		else if($ct < 1000)
			$count = "SRV" . $ct;

				return View::make('add-service')->with('patient',$patient)->with('service',$service)->with('type',$type)->with('status',$status)->with('count',$count)->with('doc',$doc);
	}	

	public function saveServ() {
		
		/* $complaints = "";
		if(Request::input('BOVfar') == 1)
		$complaints = $complaints . "Farsighted";
		if(Request::input('BOVnear') == 1)
		$complaints = $complaints . ", Nearsighted";
		if(Request::input('headache') == 1)
		$complaints = $complaints . ", Headache";
		if(Request::input('dizziness') == 1)
		$complaints = $complaints . ", Dizziness";
		if(Request::input('glare') == 1)
		$complaints = $complaints . ", Glare";
		if(Request::input('vomitting') == 1)
		$complaints = $complaints . ", Vomitting"; 	
		*/

		/*
		DB::table('tblServiceDetails')
		->insert([
			'strHeaderCode' => Request::input('user_id'),
    		'intHInvID' => Request::input('product'),
    		'intQty' => Request::input('qty'),
    		'intClaimStatus' => Request::input('claim'),
    		'intHWarranty' => 1
		]); 

		$data = DB::table('tblInventory')
				->where('tblInventory.intInvID', '=', Request::input('product'))
				->first();

		$balance = $data->dcInvPPrice * Request::input('qty');

		DB::table('tblSales')
		->insert([
    		'strSServCode' => Request::input('user_id'),
    		'dcmSBalance' => $balance,
    		'intSStatus' => 2
		]);


		$data = DB::table('tblInventory')
				->where('tblInventory.intInvID', '=', Request::input('product'))
				->first();

		$new_qty = Request::input('qty');
		$curr_qty =  $data->intInvQty;
		$total;

		$total = $curr_qty - $new_qty;

		DB::table('tblInventory')
		->where('tblInventory.intInvID', '=', Request::input('product'))
		->update([
			'intInvQty' => $total,
		]);
		*/
		if(Request::input('claim') == 2)
		{

		$complaints = Request::input('BOVfar') . Request::input('BOVnear') . Request::input('headache') . Request::input('dizziness') . Request::input('glare') . Request::input('vomitting');

		DB::table('tblServiceHeader')
		->insert([
			'strSHCode' => Request::input('user_id'),
			'intSHPatID' 	=> Request::input('patient'),
			'intSHEmpID' => Session::get('user_code'),
			'intSHServiceID' => 1,
			'intSHPaymentType' => 1,
			'intSHStatus' => 1
		]);


		DB::table('tblConsultationRecords')
		->insert([
			'strCRHeaderCode' => Request::input('user_id'),
			'intCRDocID' 	=> Request::input('doc'),
			'strPatComplaints' => $complaints,
    		'strCRDiagnosis' => Request::input('desc'),
    		'strCRPrescriptions' => Request::input('asc'),
    		'dcCRFee' => Request::input('fee')
		]);
		
		if(Request::input('OD') != "" && Request::input('ODAdd') != "" && Request::input('OS') != "" && Request::input('OSAdd') != "" && Request::input('CLOD') != "" && Request::input('CLOS') != "")
		{
		DB::table('tblPatientRX')
		->insert([
			'intRXPatID' 	=> Request::input('patient'),
			'strSOD' => Request::input('OD'),
			'strSODAdd' => Request::input('ODAdd'),
			'strSOS' => Request::input('OS'),
			'strSOSAdd' => Request::input('OSAdd'),
			'strCLOD' => Request::input('CLOD'),
			'strCLOS' => Request::input('CLOS'),
			'intRXPatStatus' => 1
		]);
		}

		if((Request::input('fee') == ""))
			return Redirect::to('/sec-home');
		else
			{
				DB::table('tblSales')
				->insert([
		    		'strSServCode' => Request::input('user_id'),
		    		'dcmSBalance' => Request::input('fee'),
		    		'intSStatus' => 2
				]);

				DB::table('tblServiceHeader')
				->where('tblServiceHeader.strSHCode', '=', Request::input('user_id'))
				->update([
					'intSHPaymentType' => 1,
				]);

				$id = Request::input('user_id');

				$data = DB::table('tblSales')
					//->join('tblPayment', 'tblSales.intSaleID','=','tblPayment.intPymServID')
					->where('tblSales.strSServCode','=',$id)
					->first();

				/*$bal = DB::table('tblPayment')
					->where('tblPayment.intPymServID','=',$data->intSaleID)
					->groupby('tblPayment.intPymServID')
					->selectRaw('*, sum(dcmPymPayment) as sum')
					->get();*/

			DB::table('tblServiceHeader')
				->where('tblServiceHeader.strSHCode','=',Request::input('user_id'))
				->update([
					'intSHServiceID' => 2
				]);

				Session::put('sess_payex',$data->intSaleID);

				return View::make('pay-to-med')->with('data',$data);

				//return Redirect::to('/sec/payment/' . Request::input('user_id'));
			}
		}
		else
		{
			$complaints = Request::input('BOVfar') . Request::input('BOVnear') . Request::input('headache') . Request::input('dizziness') . Request::input('glare') . Request::input('vomitting');

		DB::table('tblServiceHeader')
		->insert([
			'strSHCode' => Request::input('user_id'),
			'intSHPatID' 	=> Request::input('patient'),
			'intSHEmpID' => Session::get('user_code'),
			'intSHServiceID' => Request::input('service'),
			'intSHPaymentType' => NULL,
			'intSHStatus' => 2
		]);


		DB::table('tblConsultationRecords')
		->insert([
			'strCRHeaderCode' => Request::input('user_id'),
			'intCRDocID' 	=> Request::input('doc'),
			'strPatComplaints' => $complaints,
    		'strCRDiagnosis' => Request::input('desc'),
    		'strCRPrescriptions' => Request::input('asc'),
    		'dcCRFee' => Request::input('fee')
		]);
		
		if(Request::input('OD') != "" && Request::input('ODAdd') != "" && Request::input('OS') != "" && Request::input('OSAdd') != "" && Request::input('CLOD') != "" && Request::input('CLOS') != "")
		{
		DB::table('tblPatientRX')
		->insert([
			'intRXPatID' 	=> Request::input('patient'),
			'strSOD' => Request::input('OD'),
			'strSODAdd' => Request::input('ODAdd'),
			'strSOS' => Request::input('OS'),
			'strSOSAdd' => Request::input('OSAdd'),
			'strCLOD' => Request::input('CLOD'),
			'strCLOS' => Request::input('CLOS'),
			'intRXPatStatus' => 1
		]);
		}

		DB::table('tblServiceHeader')
				->where('tblServiceHeader.strSHCode','=',Request::input('user_id'))
				->update([
					'intSHServiceID' => 3
				]);

		return Redirect::to('/sec-add-payment');
		}
	}

	public function showInv() {
		/*$data = DB::table('tblInventory')
			->join('tblInvStatus', 'tblInventory.intInvStatus', '=', 'tblInvStatus.intISID')
			->join('tblItems', 'tblInventory.intInvPID', '=', 'tblItems.intItemID')
			->join('tblPrice', 'tblItems.intItemID', '=', 'tblPrice.intPriceItemID')
			->join('tblItemType', 'tblItems.intItemType', '=', 'tblItemType.intITID')
			->where('tblInventory.intInvBranch', '=', Session::get('user_bc'))
			->get();
		

		return View::make('inventory')->with('data',$data);*/


		$data = DB::table('tblInventory')
			->join('tblItems', 'tblInventory.intInvPID', '=', 'tblItems.intItemID')
			->join('tblPrice', 'tblItems.intItemID', '=', 'tblPrice.intPriceItemID')
			->join('tblInvStatus', 'tblInventory.intInvStatus', '=', 'tblInvStatus.intISID')
			->join('tblItemType', 'tblItems.intItemType', '=', 'tblItemType.intITID')
			->where('tblInventory.intInvBranch', '=', Session::get('user_bc'))
			->where('tblInventory.intInvStatus','!=',3)
			->where('tblItemType.intITSType', '=', 1)
			->where('tblItemType.intIsPerishable', '!=', 1)
			->groupby('tblInventory.intInvPID')
			->selectRaw('*, sum(intInvQty) as sum')
			->get();

		$data2 = DB::table('tblInventory')
			->join('tblItems', 'tblInventory.intInvPID', '=', 'tblItems.intItemID')
			->join('tblPrice', 'tblItems.intItemID', '=', 'tblPrice.intPriceItemID')
			->join('tblInvStatus', 'tblInventory.intInvStatus', '=', 'tblInvStatus.intISID')
			->join('tblItemType', 'tblItems.intItemType', '=', 'tblItemType.intITID')
			->where('tblInventory.intInvBranch', '=', Session::get('user_bc'))
			->where('tblInventory.intInvStatus','!=',3)
			->where('tblItemType.intITSType', '=', 1)
			->where('tblItemType.intIsPerishable', '=', 1)
			//->groupby('tblInventory.intInvPID')
			//->selectRaw('*, sum(intInvQty) as sum')
			->get();

		$mats = DB::table('tblInventory')
			->join('tblItems', 'tblInventory.intInvPID', '=', 'tblItems.intItemID')
			->join('tblPrice', 'tblItems.intItemID', '=', 'tblPrice.intPriceItemID')
			->join('tblInvStatus', 'tblInventory.intInvStatus', '=', 'tblInvStatus.intISID')
			->join('tblItemType', 'tblItems.intItemType', '=', 'tblItemType.intITID')
			->where('tblInventory.intInvBranch', '=', Session::get('user_bc'))
			->where('tblInventory.intInvStatus','!=',3)
			->where('tblItemType.intITSType', '=', 2)
			->groupby('tblInventory.intInvPID')
			->selectRaw('*, sum(intInvQty) as sum')
			->get();

		$branch = DB::table('tblBranch')
			->where('tblBranch.intBStatus', '=', 1)
			->where('tblBranch.intBranchID', '!=', 1)
			->get();

		$ct = 1 + DB::table('tblAdjustments')
			->count();

		if($ct < 10)
			$count = "ADJ00" . $ct;
		else if($ct < 100)
			$count = "ADJ0" . $ct;
		else if($ct < 1000)
			$count = "ADJ" . $ct;


		/*$data = DB::table('tblInventory')
			->join('tblInvStatus', 'tblInventory.intInvStatus', '=', 'tblInvStatus.intISID')
			->join('tblItems', 'tblInventory.intInvPID', '=', 'tblItems.intItemID')
			->join('tblItemType', 'tblItems.intItemType', '=', 'tblItemType.intITID')
			->where('tblInventory.intInvBranch', '=', Session::get('user_bc'))
			->where('tblInvStatus.intISID','!=',3)
			->get();*/

			return View::make('doc-inventory')
			->with('data',$data)
			->with('data2',$data2)
			->with('mats',$mats)
			->with('count',$count)
			->with('branch',$branch);
	}

	public function openOrdList() {
		$data = DB::table('tblItems')
			->join('tblItemType', 'tblItems.intItemType', '=', 'tblItemType.intITID')
			->where('tblItems.intItemStatus', '=', 1)
			->get();

		$type = DB::table('tblItemType')
			->where('tblItemType.intITStatus', '=', 1)
			->get();

		$ct = 1 + DB::table('tblOrders')
			->where('tblOrders.intStatus', '!=', 5)
			->count();


		if($ct < 10)
			$count = "BTH00" . $ct;
		else if($ct < 100)
			$count = "BTH0" . $ct;
		else if($ct < 1000)
			$count = "BTH" . $ct;

		Session::put('ord_sess',$count);

		$list = DB::table('tblOrders')
			->join('tblOrderDetails', 'tblOrderDetails.intODCode', '=', 'tblOrders.intOID')
			->join('tblItems', 'tblOrderDetails.intOProdID', '=', 'tblItems.intItemID')
			->join('tblOrdStatus', 'tblOrders.intStatus', '=', 'tblOrdStatus.intOSID')
			->where('tblOrders.intOBranch', '=', Session::get('user_bc'))
			->where('tblOrders.strOCode', '=', Session::get('ord_sess'))
			->where('tblOrders.intStatus', '=', 5)		
			->get();
					
			return View::make('order')->with('data',$data)->with('count',$count)->with('type',$type)->with('list',$list);
	}

	public function addToList()
	{
		//dd(Request::input('qty'));
		$sess = DB::table('tblOrders')
			->where('tblOrders.strOCode', '=', Session::get('ord_sess'))
			->where('tblOrders.intStatus', '=', 5)		
			->first();

		if($sess == NULL)
		{
		DB::table('tblOrders')
		->insert([
			'strOCode'			=> Session::get('ord_sess'),
			'dtOReceived'	=> null,
			'intOBranch'	=> Session::get('user_bc'),			
			'intStatus' => 5
		]);
		}

		$data = DB::table('tblOrders')
			->where('tblOrders.strOCode', '=',Request::input('user_id'))
			->first();

		$ex = DB::table('tblOrders')
			->join('tblOrderDetails', 'tblOrderDetails.intODCode', '=', 'tblOrders.intOID')
			->where('tblOrderDetails.intODCode', '=', $data->intOID)
			->where('tblOrderDetails.intOProdID', '=', Request::input('name'))
			->first();

		if($ex !=null)
		{
			DB::table('tblOrderDetails')
			->where('tblOrderDetails.intODCode', '=', $data->intOID)
			->where('tblOrderDetails.intOProdID', '=', Request::input('name'))
			->update([
				'intOQty' 	=> $ex->intOQty + Request::input('qty'),
			]);
		}
		else
		{
			DB::table('tblOrderDetails')
			->insert([
				'intOProdID' 		=> Request::input('name'),
				'intODCode'			=> $data->intOID,
				'intOQty' 	=> Request::input('qty'),
			]);
		}

		return Redirect::to('/inventory/order');
	}

	public function removeToList($id)
	{
		//dd(Request::input('qty'));
		$sess = DB::table('tblOrders')
			->where('tblOrders.strOCode', '=', Session::get('ord_sess'))
			->where('tblOrders.intStatus', '=', 5)		
			->first();


		DB::table('tblOrderDetails')
					->join('tblOrders', 'tblOrderDetails.intODCode', '=', 'tblOrders.intOID')
					->where('tblOrderDetails.intODCode', '=', $sess->intOID)
					->where('tblOrderDetails.intOProdID', '=', $id)
					->delete();

		return Redirect::to('/inventory/order');
	}


	public function addOrd() {

		DB::table('tblOrders')
				->where('tblOrders.strOCode', '=', Session::get('ord_sess'))
				->update([
					'intStatus' => 2,
				]);

		return Redirect::to('/inventory');
	}

	public function showSales() {
		$this->doPayCheck();

		$data = DB::table('tblSales')
			->join('tblServiceHeader','tblSales.strSServCode','=','tblServiceHeader.strSHCode')
			->join('tblPatientInfo', 'tblServiceHeader.intSHPatID','=','tblPatientInfo.intPatID')
			->join('tblPayType', 'tblServiceHeader.intSHPaymentType','=','tblPayType.intPayTID')
			->join('tblSalesStatus', 'tblSales.intSStatus','=','tblSalesStatus.intSaleSID')
			->join('tblPayment', 'tblSales.intSaleID','=','tblPayment.intPymServID')
			->join('tblEmployeeInfo', 'tblServiceHeader.intSHEmpID','=','tblEmployeeInfo.intEmpID')
			->where('tblEmployeeInfo.intEmpBranch', '=', Session::get('user_bc'))
			->groupby('tblSales.intSaleID')
			->selectRaw('*, sum(dcmPymPayment) as sum')
			->get();

		$data2 = DB::table('tblSales')
			->join('tblServiceHeader','tblSales.strSServCode','=','tblServiceHeader.strSHCode')
			->join('tblPatientInfo', 'tblServiceHeader.intSHPatID','=','tblPatientInfo.intPatID')
			->join('tblPayType', 'tblServiceHeader.intSHPaymentType','=','tblPayType.intPayTID')
			->join('tblSalesStatus', 'tblSales.intSStatus','=','tblSalesStatus.intSaleSID')
			->join('tblPayment', 'tblSales.intSaleID','=','tblPayment.intPymServID')
			//->where('tblPatientInfo.intPatID', '=',  Session::get('user_code'))
			->get();

		return View::make('sales')->with('data',$data)->with('data2',$data2);
	}

	public function openJO() {
		$ct = 1 + DB::table('tblServiceHeader')
			->where('tblServiceHeader.intSHStatus', '!=', 2)
			->count();

		if($ct < 10)
			$count = "SRV00" . $ct;
		else if($ct < 100)
			$count = "SRV0" . $ct;
		else if($ct < 1000)
			$count = "SRV" . $ct;

		return View::make('job-order')->with('count',$count);
	}

	public function showSched() {
		$data = DB::table('tblSchedules')
				->where('tblSchedules.intSchedDoctor', '=',  Session::get('user_code'))
				->get();

		return View::make('schedule')->with('data',$data);
	}

	public function addSched() {
		$data = DB::table('tblPatientInfo')
			->where('tblPatientInfo.intPatStatus', '=', 1)
			->where('tblPatientInfo.intPatID', '!=', 1)
			->get();

		return View::make('add-sched')->with('data',$data);
	}

	public function saveSched() {

	DB::table('tblSchedules')
		->insert([
			'dtSchedDate' 		=> Request::input('date'),
			'tmSchedTime'			=> Request::input('time'),
			'strSchedHeader' 	=> Request::input('name'),
			'strSchedDetails'	=> Request::input('desc'),
			'intSchedPatient'	=> Request::input('patient'),			
			'intSchedDoctor' => Session::get('user_code'),
			'intSchedFrequencyType' => Request::input('time_frequency'),
			'intSchedType' => 2,
			'intSchedStatus' => 1,
		]);

		return Redirect::to('/schedules');
	}

	public function appSched($id) {
		//dd($id);
		DB::table('tblSchedules')
		->where('tblSchedules.intSchedID','=',$id)
		->update([
			'intSchedStatus' => 1
		]);

		return Redirect::to('/schedules');
	}

	public function decSched($id) {

		DB::table('tblSchedules')
		->where('tblSchedules.intSchedID','=',$id)
		->update([
			'intSchedStatus' => 3
		]);

		return Redirect::to('/schedules');
	}

	public function canSched($id) {

		DB::table('tblSchedules')
		->where('tblSchedules.intSchedID','=',$id)
		->update([
			'intSchedStatus' => 6
		]);

		return Redirect::to('/schedules');
	}


	public function showPayment() {

		$data = DB::table('tblSales')
			->where('tblSales.intSStatus','!=',1)
			->get();
		
		return View::make('try-payment')->with('data',$data);
		//return View::make('add-payment');
	}

	public function addPayment() {

		DB::table('tblPayment')
		->insert([
    		'intPymServID' => Request::input('data'),
    		'dcmPymPayment' => Request::input('number')
		]);
		

		return Redirect::to('/sec-home');
	}
	
	public function showPaymentForExisting() {

		$data = DB::table('tblSales')
			->where('tblSales.intSStatus','!=',1)
			->get();

		return View::make('add-payment-for-existing')->with('data',$data);
		//return View::make('add-payment');
	}

	public function addPaymentForExisting() {

		DB::table('tblPayment')
		->insert([
    		'intPymServID' => Request::input('data'),
    		'dcmPymPayment' => Request::input('number')
		]);
		

		return Redirect::to('/sec-home');
	}
	
	

	public function doPayCheck() {
		$paid = DB::table('tblSales')
			->join('tblPayment', 'tblSales.intSaleID','=','tblPayment.intPymServID')
			->groupby('tblSales.intSaleID')
			->selectRaw('*, sum(dcmPymPayment) as sum')
			->get();

		foreach($paid as $paid)
		{
			if($paid->dcmSBalance <= $paid->sum)
			{
				DB::table('tblSales')
						->where('tblSales.intSaleID', '=', $paid->intSaleID)
						->update([
							'intSStatus' => 1,
						]);
			}
		}
	}

	public function generateReport()
	{
		Session::forget('rec-bn');
		Session::forget('rec-ba');
		Session::forget('rec-bc');

		$queryResult = 
			DB::table('tblSales')
			->join('tblServiceHeader','tblSales.strSServCode','=','tblServiceHeader.strSHCode')
			->join('tblPatientInfo', 'tblServiceHeader.intSHPatID','=','tblPatientInfo.intPatID')
			->join('tblPayType', 'tblServiceHeader.intSHPaymentType','=','tblPayType.intPayTID')
			->join('tblSalesStatus', 'tblSales.intSStatus','=','tblSalesStatus.intSaleSID')
			->join('tblPayment', 'tblSales.intSaleID','=','tblPayment.intPymServID')
			->join('tblEmployeeInfo', 'tblServiceHeader.intSHEmpID','=','tblEmployeeInfo.intEmpID')
			->where('tblEmployeeInfo.intEmpBranch', '=', Session::get('user_bc'))
			->groupby('tblSales.intSaleID')
			->selectRaw('*, sum(dcmPymPayment) as sum')
			->get();

		$branch = DB::table('tblDocInfo')
			->join('tblBranch', 'tblDocInfo.intDocBranch', '=', 'tblBranch.intBranchID')
			->where('tblDocInfo.intDocID', '=', Session::get('user_code'))
			->first(); 

		$total = 0;
		foreach($queryResult as $data)
		{	
			if($data->dcmSBalance > $data->sum)
			$total=$total + $data->sum;
			else if($data->dcmSBalance <= $data->sum)
			$total=$total + $data->dcmSBalance;
		}
		Session::put('sales-total',$total);

		Session::put('rec-bn',$branch->strBranchName);
		Session::put('rec-ba',$branch->strBranchAddress);
		Session::put('rec-bc',$branch->strBContactNumb);
		$pdf = PDF::loadView('reports-test', array('data'=>$queryResult));
		return $pdf->stream();
		//return View::make('reports');
	}


	public function generateInv()
	{
		Session::forget('rec-bn');
		Session::forget('rec-ba');
		Session::forget('rec-bc');

		$queryResult = DB::table('tblInventory')
			->join('tblInvStatus', 'tblInventory.intInvStatus', '=', 'tblInvStatus.intISID')
			->join('tblItems', 'tblInventory.intInvPID', '=', 'tblItems.intItemID')
			->join('tblPrice', 'tblItems.intItemID', '=', 'tblPrice.intPriceItemID')
			->join('tblItemType', 'tblItems.intItemType', '=', 'tblItemType.intITID')
			->where('tblInventory.intInvBranch', '=', Session::get('user_bc'))
			->get();

		$branch = DB::table('tblDocInfo')
			->join('tblBranch', 'tblDocInfo.intDocBranch', '=', 'tblBranch.intBranchID')
			->where('tblDocInfo.intDocID', '=', Session::get('user_code'))
			->first(); 

		Session::put('rec-bn',$branch->strBranchName);
		Session::put('rec-ba',$branch->strBranchAddress);
		Session::put('rec-bc',$branch->strBContactNumb);

		$pdf = PDF::loadView('reports-inv', array('data'=>$queryResult));
		return $pdf->stream();
		//return View::make('reports');
	}
}
