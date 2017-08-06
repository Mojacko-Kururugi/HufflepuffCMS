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
			->join('tblProducts', 'tblInventory.intInvPID', '=', 'tblProducts.intProdID')
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
			->where('tblPatientInfo.intPatStatus', '=', 1)
			->get();
		
				return View::make('record')->with('data',$data);
	}	

	public function addPatForm() {

		return View::make('test');
	}

	public function addPat() {
		$history = Request::input('diabetes') . Request::input('glaucoma') . Request::input('asthma') . Request::input('highblood') . Request::input('goiter') . Request::input('kidneyprob'); 	
		$complaints = Request::input('BOVfar') . Request::input('BOVnear') . Request::input('headache') . Request::input('dizziness') . Request::input('glare') . Request::input('vomitting'); 	
		$oldrx = Request::input('OD') . '-' . Request::input('ODAdd') . ',' . Request::input('OS') . '-' . Request::input('OSAdd') . '/' . Request::input('CLOD') . '-' . Request::input('CLOS');

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
			'strPatComplaints' => $complaints,
			'strPatOldRX' => $oldrx,
			'strPatImagePath' => "",
			'strPatEmail' 	=> Request::input('email'),
			'intPatStatus' => 1
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
			->where('tblInventory.intInvBranch', '=', Session::get('user_bc'))
			->get();


				return View::make('services')->with('data',$data);
	}

	public function showAddServ() {

		$patient = DB::table('tblPatientInfo')
			->where('tblPatientInfo.intPatStatus', '=', 1)
			->get();

		$service = DB::table('tblServices')
			->where('tblServices.intServStatus', '=', 1)
			->get();

		$type = DB::table('tblPayType')
			->get();

		$status = DB::table('tblServiceStatus')
			->get();
		
		$product = DB::table('tblInventory')
			->join('tblProducts', 'tblInventory.intInvPID', '=', 'tblProducts.intProdID')
			->where('tblInventory.intInvBranch', '=', Session::get('user_bc'))
			->where('tblInventory.intInvStatus','!=',3)
			->get();

		$ct = 1 + DB::table('tblServiceHeader')
			->count();

		if($ct < 10)
			$count = "SRV00" . $ct;
		else if($ct < 100)
			$count = "SRV0" . $ct;
		else if($ct < 1000)
			$count = "SRV" . $ct;
				return View::make('add-service')->with('patient',$patient)->with('service',$service)->with('type',$type)->with('status',$status)->with('product',$product)->with('count',$count);
	}	

	public function saveServ() {
		
		DB::table('tblServiceHeader')
		->insert([
			'strSHCode' => Request::input('user_id'),
			'intSHPatID' 	=> Request::input('patient'),
			'intSHDocID' 	=> Session::get('user_code'),
			'intSHServiceID' => Request::input('service'),
			'intSHPaymentType' => Request::input('type'),
			'intSHStatus' => Request::input('status')
		]);

		DB::table('tblServiceDetails')
		->insert([
			'strHeaderCode' => Request::input('user_id'),
    		'intHInvID' => Request::input('product'),
    		'intQty' => Request::input('qty'),
    		'intClaimStatus' => Request::input('claim'),
    		'intHWarranty' => 1
		]);

		DB::table('tblConsultationRecords')
		->insert([
			'strCRHeaderCode' => Request::input('user_id'),
    		'strCRDesc' => Request::input('desc')
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

		return Redirect::to('/sec-home');
	}

	public function showInv() {
		$data = DB::table('tblInventory')
			->join('tblInvStatus', 'tblInventory.intInvStatus', '=', 'tblInvStatus.intISID')
			->join('tblProducts', 'tblInventory.intInvPID', '=', 'tblProducts.intProdID')
			->join('tblProdType', 'tblProducts.intProdType', '=', 'tblProdType.intPTID')
			->where('tblInventory.intInvBranch', '=', Session::get('user_bc'))
			->get();
		

		return View::make('inventory')->with('data',$data);
	}

	public function openOrdList() {
		$data = DB::table('tblOrders')
			->join('tblProducts', 'tblOrders.intOProdID', '=', 'tblProducts.intProdID')
			->join('tblOrdStatus', 'tblOrders.intStatus', '=', 'tblOrdStatus.intOSID')
			->where('tblOrders.intOBranch', '=', Session::get('user_bc'))		
			->get();
		
			return View::make('order')->with('data',$data);
	}

	public function addOrd() {

		DB::table('tblOrders')
		->insert([
			'intOProdID' 		=> Request::input('name'),
			'strOCode'			=> Request::input('user_id'),
			'intOQty' 	=> Request::input('qty'),
			'dtOReceived'	=> null,
			'intOBranch'	=> Session::get('user_bc'),			
			'intStatus' => 2
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
			->groupby('tblSales.intSaleID')
			->selectRaw('*, sum(dcmPymPayment) as sum')
			->get();


		return View::make('sales')->with('data',$data);
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

	public function doPayCheck() {
		$paid = DB::table('tblSales')
			->join('tblPayment', 'tblSales.intSaleID','=','tblPayment.intPymServID')
			->groupby('tblSales.intSaleID')
			->selectRaw('*, sum(dcmPymPayment) as sum')
			->get();

		foreach($paid as $paid)
		{
			if($paid->dcmSBalance == $paid->sum)
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
		$queryResult = 
			DB::table('tblSales')
			->join('tblServiceHeader','tblSales.strSServCode','=','tblServiceHeader.strSHCode')
			->join('tblPatientInfo', 'tblServiceHeader.intSHPatID','=','tblPatientInfo.intPatID')
			->join('tblPayType', 'tblServiceHeader.intSHPaymentType','=','tblPayType.intPayTID')
			->join('tblSalesStatus', 'tblSales.intSStatus','=','tblSalesStatus.intSaleSID')
			->join('tblPayment', 'tblSales.intSaleID','=','tblPayment.intPymServID')
			->groupby('tblSales.intSaleID')
			->selectRaw('*, sum(dcmPymPayment) as sum')
			->get();

		$total = 0;
		foreach($queryResult as $data)
		{
			$total=$total + $data->sum;
		}
		Session::put('sales-total',$total);
		$pdf = PDF::loadView('reports-test', array('data'=>$queryResult));
		return $pdf->stream();
		//return View::make('reports');
	}
}