<?php

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

	public function openJO() {

		return View::make('sec-job-order');
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

		$serv = DB::table('tblServiceHeader')
			->join('tblPatientInfo', 'tblServiceHeader.intSHPatID','=','tblPatientInfo.intPatID')
		//	->join('tblDocInfo', 'tblServiceHeader.intSHDocID','=','tblDocInfo.intDocID')
			->join('tblServices', 'tblServiceHeader.intSHServiceID','=','tblServices.intServID')
			->join('tblPayType', 'tblServiceHeader.intSHPaymentType','=','tblPayType.intPayTID')
			->join('tblServiceStatus', 'tblServiceHeader.intSHStatus','=','tblServiceStatus.intServStatID')
			->join('tblConsultationRecords', 'tblServiceHeader.strSHCode','=','tblConsultationRecords.strCRHeaderCode')
			->join('tblServiceDetails', 'tblServiceHeader.strSHCode','=','tblServiceDetails.strHeaderCode')
			->join('tblInventory', 'tblServiceDetails.intHInvID','=','tblInventory.intInvID')
			->join('tblItems','tblInventory.intInvPID','=','tblItems.intItemID')
			->where('tblInventory.intInvBranch', '=', Session::get('user_bc'))
			->get();


			return View::make('dash-sec')->with('data',$data)->with('serv',$serv);
	}

	public function openSecInv() {
		$this->doExpiryCheck();

		$alls = DB::table('tblInventory')
			->join('tblItems', 'tblInventory.intInvPID', '=', 'tblItems.intItemID')
			->join('tblInvStatus', 'tblInventory.intInvStatus', '=', 'tblInvStatus.intISID')
			->join('tblItemType', 'tblItems.intItemType', '=', 'tblItemType.intITID')
			->where('tblInventory.intInvBranch', '!=', 1)
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


		$data = DB::table('tblInventory')
			->join('tblInvStatus', 'tblInventory.intInvStatus', '=', 'tblInvStatus.intISID')
			->join('tblItems', 'tblInventory.intInvPID', '=', 'tblItems.intItemID')
			->join('tblItemType', 'tblItems.intItemType', '=', 'tblItemType.intITID')
			->where('tblInventory.intInvBranch', '=', Session::get('user_bc'))
			->where('tblInvStatus.intISID','!=',3)
			->get();

			return View::make('sec-inv')->with('data',$data)->with('count',$count)->with('alls',$alls)->with('branch',$branch);
	}

	public function openAddOrd() {
		$data = DB::table('tblItems')
			->where('tblItems.intItemStatus', '=', 1)
			->get();

		$ct = 1 + DB::table('tblOrders')
			->count();

		if($ct < 10)
			$count = "BTH00" . $ct;
		else if($ct < 100)
			$count = "BTH0" . $ct;
		else if($ct < 1000)
			$count = "BTH" . $ct;

			return View::make('try-sec-ord')->with('data',$data)->with('count',$count);
	}

	public function openOrdList() {
		$data = DB::table('tblOrders')
			->join('tblOrderDetails', 'tblOrderDetails.intODCode', '=', 'tblOrders.intOID')
			->join('tblItems', 'tblOrderDetails.intOProdID', '=', 'tblItems.intItemID')
			->join('tblOrdStatus', 'tblOrders.intStatus', '=', 'tblOrdStatus.intOSID')
			->where('tblOrders.intOBranch', '=', Session::get('user_bc'))		
			->get();
		
			return View::make('sec-order')->with('data',$data);
	}

	public function addOrd() {

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

		$data = DB::table('tblOrders')
			->join('tblOrderDetails', 'tblOrderDetails.intODCode', '=', 'tblOrders.intOID')
			->join('tblItems', 'tblOrderDetails.intOProdID', '=', 'tblItems.intItemID')
			->where('tblOrders.intOID', '=', $id)
			->first();

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

		DB::table('tblInventory')
			->insert([
				'intInvPID' => $data->intOProdID,
				'strInvCode' => $data->strOCode,
			    'intInvQty' => $data->intOQty,
			    'dtInvExpiry' => NULL,
			    'intInvStatus' => 1,
				'intInvBranch' => Session::get('user_bc')
			]);

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

		return View::make('sec-unc')->with('data',$data);	
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

}