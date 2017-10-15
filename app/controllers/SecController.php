<?php
use Barryvdh\DomPDF\Facade as PDF;

class SecController extends BaseController {

	public function doExpiryCheck() {
		$exp = DB::table('tblInventory')
				->where('tblInventory.dtInvExpiry', '<', Carbon\Carbon::now())
				->get();

		foreach($exp as $exp)
		{
			DB::table('tblInventory')
						->where('tblInventory.intInvID', '=', $exp->intInvID)
						->update([
							'intInvStatus' => 3,
						]);
		}
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

	public function openJO() {
		$data = DB::table('tblItems')
			->join('tblItemType', 'tblItems.intItemType', '=', 'tblItemType.intITID')
			->join('tblInventory', 'tblInventory.intInvPID', '=', 'tblItems.intItemID')
			->where('tblItems.intItemStatus', '=', 1)
			->where('tblInventory.intInvBranch', '=', Session::get('user_bc'))
			->where('tblItems.intItemType', '=', 1)
			->groupby('tblInventory.intInvPID')
			->get();

		$data2 = DB::table('tblItems')
			->join('tblItemType', 'tblItems.intItemType', '=', 'tblItemType.intITID')
			->join('tblInventory', 'tblInventory.intInvPID', '=', 'tblItems.intItemID')
			->where('tblItems.intItemStatus', '=', 1)
			->where('tblInventory.intInvBranch', '=', Session::get('user_bc'))
			->where('tblItems.intItemType', '=', 2)
			->groupby('tblInventory.intInvPID')
			->get();

		$data3 = DB::table('tblServiceHeader')
			->join('tblPatientInfo', 'tblServiceHeader.intSHPatID','=','tblPatientInfo.intPatID')
			->where('tblServiceHeader.strSHCode', '=', Session::get('purch_sess'))
			->where('tblServiceHeader.intSHStatus', '=', 2)		
			->first();

		$pat = DB::table('tblPatientInfo')
			//->join('tblPatientRX', 'tblPatientRX.intRXPatID', '=', 'tblPatientInfo.intPatID')
			->where('tblPatientInfo.intPatStatus', '=', 1)
			->get();

		return View::make('sec-job-order')->with('data',$data)->with('data2',$data2)->with('data3',$data3)->with('pat',$pat);
	}

	public function addJOtoList() {
		
		$sess = DB::table('tblServiceHeader')
			->where('tblServiceHeader.strSHCode', '=', Session::get('purch_sess'))
			->where('tblServiceHeader.intSHStatus', '=', 2)		
			->first();

		if($sess == NULL)
		{
		DB::table('tblServiceHeader')
		->insert([
			'strSHCode' => Session::get('purch_sess'),
			'intSHPatID' 	=> Request::input('patient'),
			'intSHServiceID' => 4,
			'intSHPaymentType' => NULL,
			'intSHStatus' => 2
		]);
		}

		DB::table('tblJobOrder')
		->insert([
			'strJOHC' => Session::get('purch_sess'),
    		'strJODetails' => "JOB ORDER",
    		'intJOFrame' => Request::input('frames'),
    		'intJOLens' => Request::input('lens'),
    		'intJOAOD' => Request::input('addod'),
    		'intJOAOS' => Request::input('addos'),
    		'strJOODSC' => Request::input('odsc'),
		    'strJOODA' => Request::input('odax'),
		    'strJOODBC' => Request::input('odbc'),
		    'strJOODPD' => Request::input('odpd'),
		    'strJOOSSC' => Request::input('ossc'),
		    'strJOOSA' => Request::input('osax'),
		    'strJOOSBC' => Request::input('osbc'),
		    'strJOOSPD' => Request::input('ospd'),
		    'dcJOFee' =>  Request::input('amount'),
		    'intJOType' => 1,
		    'intJOStat' => 3
		]);

		return Redirect::to('/sec-add-payment');		
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

		return View::make('sec-serv-detail')->with('med',$med)->with('purch',$purch)->with('serv_id',$serv_id)->with('rx',$rx)->with('list2',$list2)->with('list3',$list3);
	}

	public function openPatView($id) {

		$data = DB::table('tblPatientInfo')
			//->join('tblPatientRX', 'tblPatientRX.intRXPatID', '=', 'tblPatientInfo.intPatID')
			->where('tblPatientInfo.intPatID', '=', $id)
			->first();

		$rx = DB::table('tblPatientRX')
			->where('tblPatientRX.intRXPatID', '=', $id)
			->get();

		$serv = DB::table('tblServiceHeader')
			->join('tblPatientInfo', 'tblServiceHeader.intSHPatID','=','tblPatientInfo.intPatID')
			->join('tblServices', 'tblServiceHeader.intSHServiceID','=','tblServices.intServID')
			->where('tblPatientInfo.intPatID', '=', $id)
			->orderby('tblServiceHeader.intSHID','asc')
			->get();

		$pay = DB::table('tblSales')
			->join('tblServiceHeader','tblSales.strSServCode','=','tblServiceHeader.strSHCode')
			->join('tblPatientInfo', 'tblServiceHeader.intSHPatID','=','tblPatientInfo.intPatID')
			->join('tblPayType', 'tblServiceHeader.intSHPaymentType','=','tblPayType.intPayTID')
			->join('tblSalesStatus', 'tblSales.intSStatus','=','tblSalesStatus.intSaleSID')
			->join('tblPayment', 'tblSales.intSaleID','=','tblPayment.intPymServID')
			->where('tblPatientInfo.intPatID', '=', $id)
			->groupby('tblSales.intSaleID')
			->selectRaw('*, sum(dcmPymPayment) as sum')
			->get();


		return View::make('pat-view-details')
		->with('data',$data)
		->with('rx',$rx)
		->with('serv',$serv)
		->with('pay',$pay);
	}

	public function showPayment() {
		$data = DB::table('tblItems')
			->join('tblItemType', 'tblItems.intItemType', '=', 'tblItemType.intITID')
			->join('tblInventory', 'tblInventory.intInvPID', '=', 'tblItems.intItemID')
			->where('tblItems.intItemStatus', '=', 1)
			->where('tblInventory.intInvBranch', '=', Session::get('user_bc'))
			->groupby('tblInventory.intInvPID')
			->get();

		$type = DB::table('tblItemType')
			->where('tblItemType.intITSType', '=', 1)
			->where('tblItemType.intITStatus', '=', 1)
			->get();

		$pat = DB::table('tblPatientInfo')
			//->join('tblPatientRX', 'tblPatientRX.intRXPatID', '=', 'tblPatientInfo.intPatID')
			->where('tblPatientInfo.intPatStatus', '=', 1)
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

		Session::put('purch_sess',$count);

		$list = DB::table('tblServiceHeader')
			->join('tblServiceDetails', 'tblServiceDetails.strHeaderCode', '=', 'tblServiceHeader.strSHCode')
			->join('tblInventory', 'tblServiceDetails.intHInvID', '=', 'tblInventory.intInvID')
			->join('tblItems', 'tblInventory.intInvPID', '=', 'tblItems.intItemID')
			->where('tblInventory.intInvBranch', '=', Session::get('user_bc'))
			->where('tblServiceHeader.strSHCode', '=', Session::get('purch_sess'))
			->where('tblServiceDetails.intSDStatus', '=', 3)		
			->get();

		$list2 = DB::table('tblJobOrder')
			->where('tblJobOrder.strJOHC','=',Session::get('purch_sess'))
			->where('tblJobOrder.intJOStat','=', 3)
			->get();

		$list3 = DB::table('tblConsultationRecords')
			->where('tblConsultationRecords.strCRHeaderCode','=',Session::get('purch_sess'))
			->get();

		return View::make('sec-add-payment')
		->with('data',$data)
		->with('type',$type)
		->with('list',$list)
		->with('list2',$list2)
		->with('list3',$list3)
		->with('pat',$pat)
		->with('count',$count);
	}

	public function addPurchToList()
	{
		$sess = DB::table('tblServiceHeader')
			->where('tblServiceHeader.strSHCode', '=', Session::get('purch_sess'))
			->where('tblServiceHeader.intSHStatus', '=', 2)		
			->first();

		if($sess == NULL)
		{
		DB::table('tblServiceHeader')
		->insert([
			'strSHCode' => Session::get('purch_sess'),
			'intSHPatID' 	=> Request::input('patient'),
			'intSHServiceID' => 4,
			'intSHPaymentType' => NULL,
			'intSHStatus' => 2
		]);
		}

		$price = DB::table('tblInventory')
			->join('tblItems', 'tblInventory.intInvPID', '=', 'tblItems.intItemID')
			->join('tblPrice', 'tblItems.intItemID', '=', 'tblPrice.intPriceItemID')
			->where('tblInventory.intInvID','=', Request::input('name'))
			->first();

		$total = 0;
		$subtotal = 0;

		$subtotal = $price->dcPrice * Request::input('qty');
		$total = $total + $subtotal;

		DB::table('tblServiceDetails')
		->insert([
			'strHeaderCode' => Session::get('purch_sess'),
    		'intHInvID' => Request::input('name'),
    		'intQty' => Request::input('qty'),
    		'dcTotPrice' => $total,
    		'intClaimStatus' => 2,
    		'intHWarranty' => 1,
    		'intSDStatus' => 3
		]); 

		return Redirect::to('/sec-add-payment');
	}

	public function showPayPurch() 
	{
		$lists = DB::table('tblServiceHeader')
			->join('tblServiceDetails', 'tblServiceDetails.strHeaderCode', '=', 'tblServiceHeader.strSHCode')
			->join('tblInventory', 'tblServiceDetails.intHInvID', '=', 'tblInventory.intInvID')
			->join('tblItems', 'tblInventory.intInvPID', '=', 'tblItems.intItemID')
			->where('tblInventory.intInvBranch', '=', Session::get('user_bc'))
			->where('tblServiceHeader.strSHCode', '=', Session::get('purch_sess'))
			->where('tblServiceDetails.intSDStatus', '=', 3)		
			->get();

		$total = 0;
		$subtotal = 0;

		foreach($lists as $list)
		{
			$subtotal = $list->dcTotPrice;
			$total = $total + $subtotal;
		}

		$list2 = DB::table('tblJobOrder')
			->where('tblJobOrder.strJOHC','=',Session::get('purch_sess'))
			->where('tblJobOrder.intJOStat','=', 3)
			->get();

		if($list2 != Null)
		{
			foreach($list2 as $list2)
			{
				$subtotal = $list2->dcJOFee;
				$total = $total + $subtotal;
			}
		}

		$list3 = DB::table('tblConsultationRecords')
			->where('tblConsultationRecords.strCRHeaderCode','=',Session::get('purch_sess'))
			->get();

		if($list3 != Null)
		{
			foreach($list3 as $list3)
			{
				$subtotal = $list3->dcCRFee;
				$total = $total + $subtotal;
			}
		}

		return View::make('pro-payment')->with('total',$total);
	}

	public function addPurchPay()
	{

		$lists = DB::table('tblServiceHeader')
			->join('tblServiceDetails', 'tblServiceDetails.strHeaderCode', '=', 'tblServiceHeader.strSHCode')
			->join('tblInventory', 'tblServiceDetails.intHInvID', '=', 'tblInventory.intInvID')
			->join('tblItems', 'tblInventory.intInvPID', '=', 'tblItems.intItemID')
			->where('tblInventory.intInvBranch', '=', Session::get('user_bc'))
			->where('tblServiceHeader.strSHCode', '=', Session::get('purch_sess'))
			->where('tblServiceDetails.intSDStatus', '=', 3)		
			->get();

		$total = 0;
		$subtotal = 0;

		foreach($lists as $list)
		{
				$subtotal = $list->dcTotPrice;
				$total = $total + $subtotal;

				$data = DB::table('tblInventory')
						->where('tblInventory.intInvID', '=', $list->intHInvID)
						->first();

				$new_qty = $list->intQty;
				$curr_qty =  $data->intInvQty;
				$total_qty;

				$total_qty = $curr_qty - $new_qty;

				DB::table('tblInventory')
				->where('tblInventory.intInvID', '=', $list->intHInvID)
				->update([
					'intInvQty' => $total_qty,
				]);
		}

		$list2 = DB::table('tblJobOrder')
			->where('tblJobOrder.strJOHC','=',Session::get('purch_sess'))
			->where('tblJobOrder.intJOStat','=', 3)
			->get();

		if($list2 != NUll)
		{
			foreach($list2 as $list2)
			{
				$subtotal = $list2->dcJOFee;
				$total = $total + $subtotal;

				$data = DB::table('tblInventory')
						->where('tblInventory.intInvID', '=', $list2->intJOFrame)
						->first();

				$new_qty = 1;
				$curr_qty =  $data->intInvQty;
				$total_qty;

				$total_qty = $curr_qty - $new_qty;

				DB::table('tblInventory')
				->where('tblInventory.intInvID', '=', $list2->intJOFrame)
				->update([
					'intInvQty' => $total_qty,
				]);

				$data = DB::table('tblInventory')
						->where('tblInventory.intInvID', '=', $list2->intJOLens)
						->first();

				$new_qty = 1;
				$curr_qty =  $data->intInvQty;
				$total_qty;

				$total_qty = $curr_qty - $new_qty;

				DB::table('tblInventory')
				->where('tblInventory.intInvID', '=', $list2->intJOLens)
				->update([
					'intInvQty' => $total_qty,
				]);
			}

			DB::table('tblJobOrder')
				->where('tblJobOrder.strJOHC', '=', Session::get('purch_sess'))
				->update([
					'intJOStat' => Request::input('claim')
				]);
		}

		$list3 = DB::table('tblConsultationRecords')
			->where('tblConsultationRecords.strCRHeaderCode','=',Session::get('purch_sess'))
			->get();

		if($list3 != null)
		{
			foreach($list3 as $list3)
			{
				$subtotal = $list3->dcCRFee;
				$total = $total + $subtotal;
			}
		}

		DB::table('tblSales')
				->insert([
		    		'strSServCode' => Session::get('purch_sess'),
		    		'dcmSBalance' => $total,
		    		'intSStatus' => 2
				]);
				
		$ct = DB::table('tblSales')
			->count();

		DB::table('tblPayment')
				->insert([
		    		'intPymServID' => $ct,
		    		'dcmPymPayment' => Request::input('amount-received')
				]);

		DB::table('tblServiceHeader')
				->where('tblServiceHeader.strSHCode', '=', Session::get('purch_sess'))
				->update([
					'intSHPaymentType' => Request::input('payment-mode'),
					'intSHStatus' => 1
				]);

		DB::table('tblServiceDetails')
				->where('tblServiceDetails.strHeaderCode', '=', Session::get('purch_sess'))
				->update([
					'intClaimStatus' => Request::input('claim'),
					'intSDStatus' => 1
				]);


		return Redirect::to('/sec-home');
	}

	public function addPaymentE($id) {

		$data = DB::table('tblSales')
			->join('tblPayment', 'tblSales.intSaleID','=','tblPayment.intPymServID')
			->where('tblSales.strSServCode','=',$id)
			->first();

		$bal = DB::table('tblPayment')
			->where('tblPayment.intPymServID','=',$data->intSaleID)
			->groupby('tblPayment.intPymServID')
			->selectRaw('*, sum(dcmPymPayment) as sum')
			->get();

		Session::put('sess_payex',$data->intSaleID);

		return View::make('pay-existing')->with('data',$data)->with('bal',$bal);

	}

	public function addPaymentEF()
	{

		DB::table('tblPayment')
				->insert([
		    		'intPymServID' => Session::get('sess_payex'),
		    		'dcmPymPayment' => Request::input('amount-received')
				]);

		return Redirect::to('/sec-home');
	}


	public function openSec() {
		
		$data = DB::table('tblEmployeeInfo')
			->join('tblBranch', 'tblEmployeeInfo.intEmpBranch', '=', 'tblBranch.intBranchID')
			->where('tblEmployeeInfo.strEmpEmail', '=', Session::get('user_type'))
			->first();

		Session::put('user_name',$data->strEmpLast . ', ' . $data->strEmpFirst);
		Session::put('user_b',$data->strBranchName);
		Session::put('user_bc',$data->intBranchID);

		$this->doExpiryCheck();


		/*$serv = DB::table('tblServiceHeader')
			->join('tblPatientInfo', 'tblServiceHeader.intSHPatID','=','tblPatientInfo.intPatID')
			->join('tblServices', 'tblServiceHeader.intSHServiceID','=','tblServices.intServID')
			->join('tblPayType', 'tblServiceHeader.intSHPaymentType','=','tblPayType.intPayTID')
			->join('tblServiceStatus', 'tblServiceHeader.intSHStatus','=','tblServiceStatus.intServStatID')
			->join('tblConsultationRecords', 'tblServiceHeader.strSHCode','=','tblConsultationRecords.strCRHeaderCode')
			->join('tblServiceDetails', 'tblServiceHeader.strSHCode','=','tblServiceDetails.strHeaderCode')
			->join('tblDocInfo', 'tblConsultationRecords.intCRDocID','=','tblDocInfo.intDocID')
			->join('tblInventory', 'tblServiceDetails.intHInvID','=','tblInventory.intInvID')
			->join('tblItems','tblInventory.intInvPID','=','tblItems.intItemID')
			->where('tblInventory.intInvBranch', '=', Session::get('user_bc'))
			->get();
			*/

			$serv = DB::table('tblServiceHeader')
			->join('tblPatientInfo', 'tblServiceHeader.intSHPatID','=','tblPatientInfo.intPatID')
			->join('tblServices', 'tblServiceHeader.intSHServiceID','=','tblServices.intServID')
			//->where('tblServiceHeader.intSHStatus', '!=', 2)
			//->join('tblConsultationRecords', 'tblServiceHeader.strSHCode','=','tblConsultationRecords.strCRHeaderCode')
			//->join('tblDocInfo', 'tblConsultationRecords.intCRDocID','=','tblDocInfo.intDocID')
			->get();

		$this->doPayCheck();

		$data2 = DB::table('tblSales')
			->join('tblServiceHeader','tblSales.strSServCode','=','tblServiceHeader.strSHCode')
			->join('tblPatientInfo', 'tblServiceHeader.intSHPatID','=','tblPatientInfo.intPatID')
			->join('tblPayType', 'tblServiceHeader.intSHPaymentType','=','tblPayType.intPayTID')
			->join('tblSalesStatus', 'tblSales.intSStatus','=','tblSalesStatus.intSaleSID')
			->join('tblPayment', 'tblSales.intSaleID','=','tblPayment.intPymServID')
			->where('tblSales.intSStatus','=',2)
			->groupby('tblSales.intSaleID')
			->selectRaw('*, sum(dcmPymPayment) as sum')
			->get();



			return View::make('dash-sec')->with('data',$data)->with('data2',$data2)->with('serv',$serv);
	}

	public function openSecInv() {
		$this->doExpiryCheck();

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

			return View::make('sec-inv')
			->with('data',$data)
			->with('data2',$data2)
			->with('mats',$mats)
			->with('count',$count)
			->with('branch',$branch);
	}

	public function openAddOrd() {
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

			return View::make('try-sec-ord')->with('data',$data)->with('count',$count)->with('type',$type)->with('list',$list);
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

		DB::table('tblOrderDetails')
		->insert([
			'intOProdID' 		=> Request::input('name'),
			'intODCode'			=> $data->intOID,
			'intOQty' 	=> Request::input('qty'),
		]);

		return Redirect::to('/sec-order/ord');
	}

	public function openOrdList() {
		$data = DB::table('tblOrders')
			->join('tblOrderDetails', 'tblOrderDetails.intODCode', '=', 'tblOrders.intOID')
			->join('tblItems', 'tblOrderDetails.intOProdID', '=', 'tblItems.intItemID')
			->join('tblOrdStatus', 'tblOrders.intStatus', '=', 'tblOrdStatus.intOSID')
			->where('tblOrders.intOBranch', '=', Session::get('user_bc'))
			->where('tblOrders.intStatus', '!=', 5)			
			->groupby('tblOrders.strOCode')	
			->get();

		$test = DB::table('tblOrders')
			->join('tblOrdStatus', 'tblOrders.intStatus', '=', 'tblOrdStatus.intOSID')	
			->join('tblBranch', 'tblOrders.intOBranch', '=', 'tblBranch.intBranchID')
			->where('tblOrders.intStatus', '!=', 5)
			->where('tblOrders.intOBranch', '=', Session::get('user_bc'))
			->groupby('tblOrders.strOCode')	
			->get();

		$list = DB::table('tblOrders')
			->join('tblOrderDetails', 'tblOrderDetails.intODCode', '=', 'tblOrders.intOID')
			->join('tblItems', 'tblOrderDetails.intOProdID', '=', 'tblItems.intItemID')
			->where('tblOrders.intStatus', '!=', 5)	
			->where('tblOrders.intOBranch', '=', Session::get('user_bc'))
			->get();
		
			return View::make('sec-order')->with('data',$data)->with('test',$test)->with('list',$list);
	}

	public function addOrd() {
		/*
		DB::table('tblOrders')
		->insert([
			'strOCode'			=> Request::input('user_id'),
			'dtOReceived'	=> null,
			'intOBranch'	=> Session::get('user_bc'),			
			'intStatus' => 2
		]);

		$data = DB::table('tblOrders')
			->where('tblOrders.strOCode', '=',Request::input('user_id'))
			->first();

		DB::table('tblOrderDetails')
		->insert([
			'intOProdID' 		=> Request::input('name'),
			'intODCode'			=> $data->intOID,
			'intOQty' 	=> Request::input('qty'),
		]);
		*/

		DB::table('tblOrders')
				->where('tblOrders.strOCode', '=', Session::get('ord_sess'))
				->update([
					'intStatus' => 2,
				]);

		return Redirect::to('/sec-order');
	}

	public function receiveOrd($id) {

		$ldate = date('Y-m-d H:i:s');

		DB::table('tblOrders')
				->where('tblOrders.intOID', '=', $id)
				->update([
					'dtOReceived' => $ldate,
					'intStatus' => 1,
				]);

		$data1 = DB::table('tblOrders')
			->join('tblOrderDetails', 'tblOrderDetails.intODCode', '=', 'tblOrders.intOID')
			->join('tblInventory', 'tblOrderDetails.strOLotNum', '=', 'tblInventory.strInvLotNum')
			->join('tblItems', 'tblOrderDetails.intOProdID', '=', 'tblItems.intItemID')
			->where('tblOrders.intOID', '=', $id)
			->get();

		foreach($data1 as $data)
		{
		DB::table('tblInventory')
			->insert([
				'intInvPID' => $data->intOProdID,
				'strInvBatCode' => $data->strOCode,
				'strInvLotNum' => $data->strOLotNum,
			    'intInvQty' => $data->intOQty,
			    'dtInvExpiry' => $data->dtInvExpiry,
			    'intInvStatus' => 1,
				'intInvBranch' => Session::get('user_bc')
			]);
		}
	/*	if($data->intProdType == 1)
		{
		DB::table('tblInventory')
			->insert([
				'intInvPID' => $data->intOProdID,
				'strInvCode' => $data->strOCode,
			    'dcInvPPrice' => Request::input('price'),
			    'intInvQty' => $data->intOQty,
			    'dtInvExpiry' => NULL,
			    'intInvStatus' => 1,
				'intInvBranch' => Session::get('user_bc')
			]);
		}
		else
		{
			DB::table('tblInventory')
			->insert([
				'intInvPID' => $data->intOProdID,
				'strInvCode' => $data->strOCode,
			    'dcInvPPrice' => Request::input('price'),
			    'intInvQty' => $data->intOQty,
			    'dtInvExpiry' => Request::input('date'),
			    'intInvStatus' => 1,
				'intInvBranch' => Session::get('user_bc')
			]);
		}
		*/

		return Redirect::to('/sec-inv');
	}
	
	public function openSecAdj() {
		$data = DB::table('tblInventory')
			->join('tblInvStatus', 'tblInventory.intInvStatus', '=', 'tblInvStatus.intISID')
			->join('tblItems', 'tblInventory.intInvPID', '=', 'tblItems.intItemID')
			->join('tblAdjustments', 'tblInventory.intInvID', '=', 'tblAdjustments.intAdjInvID')
			->where('tblInventory.intInvBranch', '=', Session::get('user_bc'))
			->get();
		
			return View::make('sec-adj')->with('data',$data);
	}

	public function openSecWar() {


		$data = DB::table('tblServiceHeader')
			->join('tblPatientInfo', 'tblServiceHeader.intSHPatID','=','tblPatientInfo.intPatID')
			->join('tblServiceStatus', 'tblServiceHeader.intSHStatus','=','tblServiceStatus.intServStatID')
			->join('tblServiceDetails', 'tblServiceHeader.strSHCode','=','tblServiceDetails.strHeaderCode')
			->join('tblWarranty', 'tblServiceDetails.intHWarranty','=','tblWarranty.intWID')
			->join('tblInventory', 'tblServiceDetails.intHInvID','=','tblInventory.intInvID')
			->join('tblItems','tblInventory.intInvPID','=','tblItems.intItemID')
			->where('tblInventory.intInvBranch', '=', Session::get('user_bc'))
			->get();

		return View::make('sec-warranty')->with('data',$data);	
	}

	public function replaceWar($id) {
		
		DB::table('tblServiceDetails')
			->where('tblServiceDetails.strHeaderCode', '=', $id)
			->update([
    			'intHWarranty' => 3
			]);

		return Redirect::to('/warranty');
	}

	public function openSecUnc() {


		$data = DB::table('tblServiceHeader')
			->join('tblPatientInfo', 'tblServiceHeader.intSHPatID','=','tblPatientInfo.intPatID')
			->join('tblServiceStatus', 'tblServiceHeader.intSHStatus','=','tblServiceStatus.intServStatID')
			->join('tblServiceDetails', 'tblServiceHeader.strSHCode','=','tblServiceDetails.strHeaderCode')
			->join('tblInventory', 'tblServiceDetails.intHInvID','=','tblInventory.intInvID')
			->join('tblItems','tblInventory.intInvPID','=','tblItems.intItemID')
			->where('tblInventory.intInvBranch', '=', Session::get('user_bc'))
			->get();

		$jo = DB::table('tblJobOrder')
			//->where('tblJobOrder.strJOHC','=',$serv_id)
			->get();

		return View::make('sec-unc')->with('data',$data)->with('jo',$jo);	
	}

	public function prodClaim($id) {
		
		DB::table('tblServiceDetails')
			->where('tblServiceDetails.strHeaderCode', '=', $id)
			->update([
    			'intClaimStatus' => 1
			]);

		return Redirect::to('/unclaimed');
	}


	public function adjInv($id) {
		$data = DB::table('tblInventory')
				->where('tblInventory.intInvID', '=', $id)
				->first();

		$new_qty = Request::input('qty');
		$curr_qty =  $data->intInvQty;
		$total;

		if(Request::input('type') == 2)
		{
			if($new_qty <= $curr_qty)
				{
				$total = $curr_qty - $new_qty;
				DB::table('tblAdjustments')
					->insert([
						'strAdjCode'  => Request::input('user_id'),
						'intAdjInvID' => $id,
					    'intAdjQty' => Request::input('qty'),
					    'strAdjReason' => Request::input('desc'),
					    'intAdjStatus' => Request::input('type'),
					    'intAdjBranch' => Session::get('user_bc')
					]);		

				DB::table('tblInventory')
						->where('tblInventory.intInvID', '=', $id)
						->update([
							'intInvQty' => $total,
						]);
					return Redirect::to('/adjustments');
				}
		}
		else if (Request::input('type') == 1)
		{
			$total = $curr_qty + $new_qty;
				DB::table('tblAdjustments')
					->insert([
						'strAdjCode'  => Request::input('user_id'),
						'intAdjInvID' => $id,
					    'intAdjQty' => Request::input('qty'),
					    'strAdjReason' => Request::input('desc'),
					    'intAdjStatus' => Request::input('type'),
					    'intAdjBranch' => Session::get('user_bc')
					]);		

				DB::table('tblInventory')
						->where('tblInventory.intInvID', '=', $id)
						->update([
							'intInvQty' => $total,
						]);
					return Redirect::to('/adjustments');
		}
		else
			return Redirect::to('/sec-inv');
	}

	public function openExp() {
		$this->doExpiryCheck();

		$data = DB::table('tblInventory')
			->join('tblInvStatus', 'tblInventory.intInvStatus', '=', 'tblInvStatus.intISID')
			->join('tblItems', 'tblInventory.intInvPID', '=', 'tblItems.intItemID')
			->join('tblItemType', 'tblItems.intItemType', '=', 'tblItemType.intITID')
			->where('tblInventory.intInvBranch', '=', Session::get('user_bc'))
			->where('tblInvStatus.intISID','=',3)
			->get();
		
			return View::make('sec-exp')->with('data',$data);
	}

	public function generateReceipt($id)
	{
		$qr= DB::table('tblServiceHeader')
			->join('tblServiceDetails', 'tblServiceDetails.strHeaderCode', '=', 'tblServiceHeader.strSHCode')
			->join('tblInventory', 'tblServiceDetails.intHInvID','=','tblInventory.intInvID')
			->join('tblItems','tblInventory.intInvPID','=','tblItems.intItemID')
			->where('tblInventory.intInvBranch', '=', Session::get('user_bc'))
			->where('tblServiceHeader.intSHID', '=', $id)
			->get();

		//dd($data);
		$total = 0;
		foreach($qr as $data)
		{
			$total=$total + $data->dcTotPrice;
		}
		Session::put('rec-total',$total);
		$pdf = PDF::loadView('receipt', array('data'=>$qr));
		return $pdf->stream();
		//return View::make('reports');
	}

}