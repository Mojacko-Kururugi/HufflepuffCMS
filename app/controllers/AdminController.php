<?php

class AdminController extends BaseController {

	public function openAdmin() {

		$data = DB::table('tblInventory')
			->join('tblItems', 'tblInventory.intInvPID', '=', 'tblItems.intItemID')
			->join('tblPrice', 'tblItems.intItemID', '=', 'tblPrice.intPriceItemID')
			->join('tblInvStatus', 'tblInventory.intInvStatus', '=', 'tblInvStatus.intISID')
			->join('tblItemType', 'tblItems.intItemType', '=', 'tblItemType.intITID')
			->where('tblInventory.intInvBranch', '=', 1)
			->where('tblInventory.intInvStatus','!=',3)
			->where('tblItemType.intITSType', '=', 1)
			->where('tblItemType.intIsPerishable', '!=', 1)
			->where('tblItems.intItemStatus', '=', 1)
			->groupby('tblInventory.intInvPID')
			->selectRaw('*, sum(intInvQty) as sum')
			->get();

		$data2 = DB::table('tblInventory')
			->join('tblItems', 'tblInventory.intInvPID', '=', 'tblItems.intItemID')
			->join('tblPrice', 'tblItems.intItemID', '=', 'tblPrice.intPriceItemID')
			->join('tblInvStatus', 'tblInventory.intInvStatus', '=', 'tblInvStatus.intISID')
			->join('tblItemType', 'tblItems.intItemType', '=', 'tblItemType.intITID')
			->where('tblInventory.intInvBranch', '=', 1)
			->where('tblInventory.intInvStatus','!=',3)
			->where('tblItemType.intITSType', '=', 1)
			->where('tblItemType.intIsPerishable', '=', 1)
			->where('tblItems.intItemStatus', '=', 1)
			//->groupby('tblInventory.intInvPID')
			//->selectRaw('*, sum(intInvQty) as sum')
			->get();

		$mat = DB::table('tblInventory')
			->join('tblItems', 'tblInventory.intInvPID', '=', 'tblItems.intItemID')
			->join('tblPrice', 'tblItems.intItemID', '=', 'tblPrice.intPriceItemID')
			->join('tblInvStatus', 'tblInventory.intInvStatus', '=', 'tblInvStatus.intISID')
			->join('tblItemType', 'tblItems.intItemType', '=', 'tblItemType.intITID')
			->where('tblInventory.intInvBranch', '=', 1)
			->where('tblInventory.intInvStatus','!=',3)
			->where('tblItemType.intITSType', '=', 2)
			->where('tblItems.intItemStatus', '=', 1)
			->groupby('tblInventory.intInvPID')
			->selectRaw('*, sum(intInvQty) as sum')
			->get();

		$alls = DB::table('tblInventory')
			->join('tblItems', 'tblInventory.intInvPID', '=', 'tblItems.intItemID')
			->join('tblPrice', 'tblItems.intItemID', '=', 'tblPrice.intPriceItemID')
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

		$stock = DB::table('tblInventory')
			->join('tblInvStatus', 'tblInventory.intInvStatus', '=', 'tblInvStatus.intISID')
			->join('tblItems', 'tblInventory.intInvPID', '=', 'tblItems.intItemID')
			->join('tblItemType', 'tblItems.intItemType', '=', 'tblItemType.intITID')
			->join('tblAdjustments', 'tblInventory.intInvID', '=', 'tblAdjustments.intAdjInvID')
			->where('tblInventory.intInvBranch', '=', 1)
			->where('tblInvStatus.intISID','!=',3)
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

		$ord = DB::table('tblOrders')
			->join('tblOrderDetails', 'tblOrderDetails.intODCode', '=', 'tblOrders.intOID')
			->join('tblItems', 'tblOrderDetails.intOProdID', '=', 'tblItems.intItemID')
			->join('tblOrdStatus', 'tblOrders.intStatus', '=', 'tblOrdStatus.intOSID')	
			->join('tblBranch', 'tblOrders.intOBranch', '=', 'tblBranch.intBranchID')
			->where('tblOrders.intOBranch', '!=', 1)
			->where('tblOrders.intStatus', '!=', 5)
			->groupby('tblOrders.strOCode')	
			->get();

		$test = DB::table('tblOrders')
			->join('tblOrdStatus', 'tblOrders.intStatus', '=', 'tblOrdStatus.intOSID')	
			->join('tblBranch', 'tblOrders.intOBranch', '=', 'tblBranch.intBranchID')
			->where('tblOrders.intOBranch', '!=', 1)
			->where('tblOrders.intStatus', '!=', 5)
			->groupby('tblOrders.strOCode')	
			->get();

		$list = DB::table('tblOrders')
			->join('tblOrderDetails', 'tblOrderDetails.intODCode', '=', 'tblOrders.intOID')
			->join('tblItems', 'tblOrderDetails.intOProdID', '=', 'tblItems.intItemID')
			->join('tblItemType', 'tblItems.intItemType', '=', 'tblItemType.intITID')
			->join('tblOrdStatus', 'tblOrders.intStatus', '=', 'tblOrdStatus.intOSID')	
			->join('tblBranch', 'tblOrders.intOBranch', '=', 'tblBranch.intBranchID')
			->where('tblOrders.intOBranch', '!=', 1)
			->where('tblOrders.intStatus', '!=', 5)	
			->get();

		$prod = DB::table('tblInventory')
			->join('tblItems', 'tblInventory.intInvPID', '=', 'tblItems.intItemID')
			->join('tblInvStatus', 'tblInventory.intInvStatus', '=', 'tblInvStatus.intISID')
			->join('tblItemType', 'tblItems.intItemType', '=', 'tblItemType.intITID')
			->where('tblInventory.intInvBranch', '=', 1)
			->where('tblInventory.intInvStatus','!=',3)
			->groupby('tblInventory.intInvPID')
			->selectRaw('*, sum(intInvQty) as sum')
			->get();

		$del = DB::table('tblDelivery')
			->join('tblOrders', 'tblDelivery.intDelCode', '=', 'tblOrders.intOID')
			->join('tblItems', 'tblDelivery.intDelProdID', '=', 'tblItems.intItemID')
                        ->join('tblItemType', 'tblItems.intItemType', '=', 'tblItemType.intITID')
			//->crossjoin('tblOrderDetails', 'tblOrderDetails.intODCode', '=', 'tblOrders.intOID')
			->get();

		return View::make('dash-admin')
		->with('del',$del)
		->with('data',$data)
		->with('data2',$data2)
		->with('ord',$ord)
		->with('list',$list)
		->with('test',$test)
		->with('count',$count)
		->with('stock',$stock)
		->with('prod',$prod)
		->with('alls',$alls)
		->with('branch',$branch)
		->with('mat',$mat);
	}	

	public function setExp($id) {

		DB::table('tblInventory')
							->where('tblInventory.intInvID', '=', $id)
							->update([
								'dtInvExpiry' => Request::input('date')
							]);

		return Redirect::to('/admin');
	}

	public function openAddItem() {
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
			$count = "BAT00" . $ct;
		else if($ct < 100)
			$count = "BAT0" . $ct;
		else if($ct < 1000)
			$count = "BAT" . $ct;

		Session::put('ord_sess',$count);


		$list = DB::table('tblOrders')
			->join('tblOrderDetails', 'tblOrderDetails.intODCode', '=', 'tblOrders.intOID')
			->join('tblItems', 'tblOrderDetails.intOProdID', '=', 'tblItems.intItemID')
			->join('tblOrdStatus', 'tblOrders.intStatus', '=', 'tblOrdStatus.intOSID')
			->where('tblOrders.intOBranch', '=', 1)
			->where('tblOrders.strOCode', '=', Session::get('ord_sess'))
			->where('tblOrders.intStatus', '=', 5)		
			->get();

			return View::make('try-add-order')->with('data',$data)->with('count',$count)->with('type',$type)->with('list',$list);
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
			'intOBranch'	=> 1,			
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

		return Redirect::to('/admin/ord');
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

		return Redirect::to('/admin/ord');
	}

	public function addItem() {
		$ord = DB::table('tblOrders')
			->join('tblOrderDetails', 'tblOrderDetails.intODCode', '=', 'tblOrders.intOID')
			->join('tblItems', 'tblOrderDetails.intOProdID', '=', 'tblItems.intItemID')
			->join('tblItemType', 'tblItems.intItemType', '=', 'tblItemType.intITID')
			->where('tblOrders.strOCode', '=', Session::get('ord_sess'))
			->where('tblOrders.intStatus', '=', 5)		
			->get();
	
		foreach($ord as $o)
		{
			if($o->intIsPerishable == 1)
			{
					$ct = 1 + DB::table('tblInventory')
							->count();

					if($ct < 10)
						$count = "LOT00" . $ct;
					else if($ct < 100)
						$count = "LOT0" . $ct;
					else if($ct < 1000)
						$count = "LOT" . $ct;

					DB::table('tblInventory')
						->insert([
							'intInvPID' => $o->intOProdID,
							'strInvBatCode' => Session::get('ord_sess'),
							'strInvLotNum' => $count,
						    'intInvQty' => $o->intOQty,
						    'dtInvExpiry' => NULL,
						    'intInvStatus' => 1,
							'intInvBranch' => 1
						]);

					$inv = DB::table('tblInventory')
						->where('tblInventory.intInvPID', '=', $o->intOProdID)
						->where('tblInventory.intInvBranch', '=', 1)
						->where('tblInventory.intInvStatus','!=',3)
						->where('tblInventory.strInvLotNum','=',$count)
						->first();

					DB::table('tblAdjustments')
						->insert([
							'strAdjCode'  => Session::get('ord_sess'),
							'intAdjInvID' => $inv->intInvID,
						    'intAdjQty' => $o->intOQty,
						    'strAdjReason' => "BOUGHT BY MAIN",
						    'intAdjStatus' => 1,
						    'intAdjBranch' => 1
						]);
			}
			else
			{
			$inv = DB::table('tblInventory')
				->where('tblInventory.intInvPID', '=', $o->intOProdID)
				->where('tblInventory.intInvBranch', '=', 1)
				->where('tblInventory.intInvStatus','!=',3)
				->groupby('tblInventory.intInvPID')
				->selectRaw('*, sum(intInvQty) as sum')
				->first();

			$new_qty = $o->intOQty;
			$curr_qty =  $inv->intInvQty;
			$total;

			$total = $curr_qty + $new_qty;		

					DB::table('tblInventory')
							->where('tblInventory.intInvID', '=', $inv->intInvID)
							->update([
								'strInvBatCode' => Session::get('ord_sess'),
								'intInvQty' => $total,
							]);

					DB::table('tblAdjustments')
						->insert([
							'strAdjCode'  => Session::get('ord_sess'),
							'intAdjInvID' => $inv->intInvID,
						    'intAdjQty' => $o->intOQty,
						    'strAdjReason' => "BOUGHT BY MAIN",
						    'intAdjStatus' => 1,
						    'intAdjBranch' => 1
						]);
			}
		}//foreach

		DB::table('tblOrders')
				->where('tblOrders.strOCode', '=', Session::get('ord_sess'))
				->update([
					'intStatus' => 1,
				]);

		return Redirect::to('/admin');
	}

	public function deliverOrd($id) {
		

		$ldate = date('Y-m-d H:i:s');


		DB::table('tblOrders')
				->where('tblOrders.intOID', '=', $id)
				->update([
					'dtOReceived' => $ldate,
					'intStatus' => 4,
				]);

		$data = DB::table('tblOrderDetails')
			->join('tblOrders', 'tblOrderDetails.intODCode', '=', 'tblOrders.intOID')
			->join('tblItems', 'tblOrderDetails.intOProdID', '=', 'tblItems.intItemID')
			->join('tblBranch', 'tblOrders.intOBranch', '=', 'tblBranch.intBranchID')
			->where('tblOrderDetails.intODCode', '=', $id)
			->get();


		$ct = 1 + DB::table('tblAdjustments')
			->count();

		if($ct < 10)
			$count = "DEL00" . $ct;
		else if($ct < 100)
			$count = "DEL0" . $ct;
		else if($ct < 1000)
			$count = "DEL" . $ct;

		foreach($data as $data)
		{

		$inv = DB::table('tblInventory')
			->where('tblInventory.intInvPID', '=', $data->intOProdID)
			->where('tblInventory.intInvBranch', '=', 1)
			->where('tblInventory.intInvStatus','!=',3)
			->orderBy('tblInventory.dtInvExpiry', 'ASC')
			//->groupby('tblInventory.intInvPID')
			//->selectRaw('*, sum(intInvQty) as sum')
			->first();

		$new_qty = $data->intOQty;
		$curr_qty =  $inv->intInvQty;
		$total;
		//$string = "ORDER BY BRANCH";
		$string = "ORDER BY " . $data->strBranchName . "(" . $data->strOCode . ")";
		//$string =  $data->intODCode;
			if($new_qty <= $inv->intInvQty)
				{
				$total = $curr_qty - $new_qty;
				DB::table('tblAdjustments')
					->insert([
						'strAdjCode'  => $count,
						'intAdjInvID' => $inv->intInvID,
					    'intAdjQty' => $new_qty,
					    'strAdjReason' => $string,
					    'intAdjStatus' => 2,
					    'intAdjBranch' => 1
					]);		

				DB::table('tblInventory')
						->where('tblInventory.intInvID', '=', $inv->intInvID)
						->update([
							'intInvQty' => $total,
						]);

				DB::table('tblDelivery')
					->insert([
						'intDelCode' => $id,
					    'intDelProdID' => $inv->intInvPID,
					    'intDelQty' => $data->intOQty,
						'strDelLotNum' => $inv->strInvLotNum
					]);
				}//sundan ng else para sa CONDITION
			else
			{
				$total = $curr_qty;
				DB::table('tblAdjustments')
					->insert([
						'strAdjCode'  => $count,
						'intAdjInvID' => $inv->intInvID,
					    'intAdjQty' => $total,
					    'strAdjReason' => $string,
					    'intAdjStatus' => 2,
					    'intAdjBranch' => 1
					]);		

				DB::table('tblInventory')
						->where('tblInventory.intInvID', '=', $inv->intInvID)
						->update([
							'intInvQty' => 0,
						]);

				DB::table('tblDelivery')
					->insert([
						'intDelCode' => $id,
					    'intDelProdID' => $inv->intInvPID,
					    'intDelQty' => $total,
						'strDelLotNum' => $inv->strInvLotNum,
						'strDelReason' => "Its the Max Stocks Available"
					]);
			}
			}//foreach

		return Redirect::to('/admin');
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
			->where('tblBranch.intBranchID', '!=', 1)
			->get();

		return View::make('admin-branches')->with('data',$data);
		
		}

	public function addBranchForm() {

		return View::make('add-branch');
	}

	public function openUpBranch($id) {
		$data = DB::table('tblBranch')
			->where('tblBranch.intBranchID', '=', $id)
			->first();

	    return View::make('update-branch')->with('data',$data)->with('id',$id);
	}

	public function updateBranch()	{
			DB::table('tblBranch')
				->where('tblBranch.intBranchID', '=', Session::get('upId'))
				->update([
				'strBranchAddress' 		=> Request::input('address'),
				'strBContactNumb' 	=> Request::input('stud_id_no'),
				'strBranchName'	=> Request::input('number')
				]);

		return Redirect::to('/branches');
	}

	public function deactBranch($id) {
		DB::table('tblBranch')
				->where('tblBranch.intBranchID', '=', $id)
				->update([
					'intBStatus' => 0,
				]);

	    return Redirect::to('/branches');
	}

	public function showDoctors() {
		$data = DB::table('tblDocInfo')
			->join('tblBranch', 'tblDocInfo.intDocBranch', '=', 'tblBranch.intBranchID')
			->where('tblDocInfo.intDocStatus', '=', 1)
			->get();

			return View::make('admin-doctors')->with('data',$data);
	}

	public function addDoctorForm() {

		$branch = DB::table('tblBranch')
			->where('tblBranch.intBStatus', '=', 1)
			->where('tblBranch.intBranchID', '!=', 1)
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
			'intDocBranch' => Request::input('branch'),
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
			->join('tblBranch', 'tblDocInfo.intDocBranch', '=', 'tblBranch.intBranchID')
			->where('tblDocInfo.intDocID', '=', $id)
			->first();

		$branch = DB::table('tblBranch')
			->where('tblBranch.intBStatus', '=', 1)
			->where('tblBranch.intBranchID', '!=', 1)
			->get();

	    return View::make('update-doctor')->with('data',$data)->with('branch',$branch)->with('id',$id);
	}

	public function updateDoctor(){
			DB::table('tblDocInfo')
				->where('tblDocInfo.intDocID', '=', Session::get('upId'))
				->update([
					'strDocLicNumb' 	=> Request::input('user_id'),
					'strDocLast' 	=> Request::input('last_name_sa'),
					'strDocFirst' => Request::input('first_name_sa'),
					'strDocMiddle' => Request::input('middle_name_sa'),
					'intDocGender' => Request::input('gender'),
					'strDocContactNumb' => Request::input('stud_id_no'),
					'intDocBranch' => Request::input('branch')
				]);

		return Redirect::to('/doctors');
	}

	public function deactDoctor($id) {
		DB::table('tblDocInfo')
				->where('tblDocInfo.intDocID', '=', $id)
				->update([
					'intDocStatus' => 0,
				]);

	    return Redirect::to('/doctors');
	}

	public function showEmployees() {
		$data = DB::table('tblEmployeeInfo')
			->join('tblBranch', 'tblEmployeeInfo.intEmpBranch', '=', 'tblBranch.intBranchID')
			->where('tblEmployeeInfo.intEmpStatus', '=', 1)
			->get();
		
			return View::make('admin-emp')->with('data',$data);
	}	

	public function addEmpForm() {

		$branch = DB::table('tblBranch')
			->where('tblBranch.intBStatus', '=', 1)
			->where('tblBranch.intBranchID', '!=', 1)
			->get();

		return View::make('add-employee')->with('branch',$branch);
	}

	public function addEmp() {

		DB::table('tblEmployeeInfo')
		->insert([
			'strEmpLast' 	=> Request::input('last_name_sa'),
			'strEmpFirst' => Request::input('first_name_sa'),
			'strEmpMiddle' => Request::input('middle_name_sa'),
			'intEmpBranch' => Request::input('branch'),
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
			->where('tblEmployeeInfo.intEmpID', '=', $id)
			->first();


		$branch = DB::table('tblBranch')
				->where('tblBranch.intBStatus', '=', 1)
				->where('tblBranch.intBranchID', '!=', 1)
				->get();

	    return View::make('update-employee')->with('data',$data)->with('branch',$branch)->with('id',$id);
	}

	public function updateEmp() {
			DB::table('tblEmployeeInfo')
				->where('tblEmployeeInfo.intEmpID', '=', Session::get('upId'))
				->update([
				'strEmpLast' 	=> Request::input('last_name_sa'),
				'strEmpFirst' => Request::input('first_name_sa'),
				'strEmpMiddle' => Request::input('middle_name_sa'),
				'intEmpBranch' => Request::input('branch'),
				]);

		return Redirect::to('/employees');
	}

	public function deactEmp($id) {
		DB::table('tblEmployeeInfo')
				->where('tblEmployeeInfo.intEmpID', '=', $id)
				->update([
					'intEmpStatus' => 0,
				]);

	    return Redirect::to('/employees');
	}

	public function openProdType() {
		$data = DB::table('tblItemType')
			->where('tblItemType.intITStatus', '=', 1)
			->get();

			return View::make('admin-product-types')->with('data',$data);
	}

	
	public function openAddProdType() {
		
			return View::make('add-product-type');
	}

	public function addProdType() {

		DB::table('tblItemType')
		->insert([
		    'strITDesc' => Request::input('name'),
		    'intITSType'  => Request::input('stype'),
		    'intIsPerishable'  => Request::input('exp'),
		    'intITStatus'  => 1
		]);

		return Redirect::to('/product-type');
	}

	public function showUpPT($id) {

		$data = DB::table('tblItemType')
			->where('tblItemType.intITID', '=', $id)
			->first();

	    return View::make('update-product-type')->with('data',$data)->with('id',$id);
	}

	public function updatePT() {
			DB::table('tblItemType')
				->where('tblItemType.intITID', '=', Session::get('upId'))
				->update([
					'strITDesc' => Request::input('name'),
				]);

		return Redirect::to('/product-type');
	}

	public function deactPT($id) {
			DB::table('tblItemType')
				->where('tblItemType.intITID', '=', $id)
				->update([
						'intITStatus'  => 0,
				]);

		return Redirect::to('/product-type');
	}

	public function openProd() {
		$data = DB::table('tblItems')
			->join('tblItemType', 'tblItems.intItemType', '=', 'tblItemType.intITID')
			->where('tblItems.intItemStatus', '=', 1)
			->where('tblItemType.intITSType', '=', 1)
			->get();
		
		$mat = DB::table('tblItems')
			->join('tblItemType', 'tblItems.intItemType', '=', 'tblItemType.intITID')
			->where('tblItems.intItemStatus', '=', 1)
			->where('tblItemType.intITSType', '=', 2)
			->get();

			return View::make('admin-products')->with('data',$data)->with('mat',$mat);
	}


	public function openAddProd() {
		
		$data = DB::table('tblItemType')
			->where('tblItemType.intITStatus', '=', 1)
			->where('tblItemType.intITSType', '=', 1)
			->get();

			return View::make('add-product')->with('data',$data);
	}

	public function openAddMat() {
		
		$data = DB::table('tblItemType')
			->where('tblItemType.intITStatus', '=', 1)
			->where('tblItemType.intITSType', '=', 2)
			->get();

			return View::make('add-material')->with('data',$data);
	}

	public function addProd() {

		$it = 1 + DB::table('tblItems')
			->count();

		$ct = 1 + DB::table('tblInventory')
			->count();

		if($ct < 10)
			$count = "LOT00" . $ct;
		else if($ct < 100)
			$count = "LOT0" . $ct;
		else if($ct < 1000)
			$count = "LOT" . $ct;


		DB::table('tblItems')
		->insert([
			'strItemName' 		=> Request::input('name'),
			'strItemDesc' 	=> Request::input('model'),
			'strItemBrand' =>  Request::input('brand'),
			'intItemType'	=> Request::input('type'),
			'intItemStatus' => 1
		]);


		DB::table('tblPrice')
		->insert([
			'intPriceItemID' 	=> $it,
			'dcPrice' => Request::input('price')
		]);

		$data = DB::table('tblItemType')
			->where('tblItemType.intITID', '=', Request::input('type'))
			->first();

		if($data->intIsPerishable != 1)
		{
		DB::table('tblInventory')
			->insert([
				'intInvPID' => $it,
				'strInvBatCode' => NULL,
				'strInvLotNum' => $count,
			    'intInvQty' => 0,
			    'dtInvExpiry' => NULL,
			    'intInvStatus' => 1,
				'intInvBranch' => 1
			]);
		}
		return Redirect::to('/products');
	}

	public function showUpProd($id) {
		$prod = DB::table('tblItems')
			->join('tblPrice', 'tblItems.intItemID', '=', 'tblPrice.intPriceItemID')
			->where('tblItems.intItemID', '=', $id)
			->first();

		$data = DB::table('tblItemType')
			->where('tblItemType.intITStatus', '=', 1)
			->where('tblItemType.intITSType', '=', 1)
			->get();

	    return View::make('update-product')->with('data',$data)->with('prod',$prod)->with('id',$id);
	}

	public function showUpMat($id) {
		$prod = DB::table('tblItems')
			->join('tblPrice', 'tblItems.intItemID', '=', 'tblPrice.intPriceItemID')
			->where('tblItems.intItemID', '=', $id)
			->first();

		$data = DB::table('tblItemType')
			->where('tblItemType.intITStatus', '=', 1)
			->where('tblItemType.intITSType', '=', 2)
			->get();

	    return View::make('update-material')->with('data',$data)->with('prod',$prod)->with('id',$id);
	}

	public function updateProd() {
			DB::table('tblItems')
				->where('tblItems.intItemID', '=', Session::get('upId'))
				->update([
					'strItemName' 		=> Request::input('name'),
					'strItemDesc' 	=> Request::input('model'),
					'strItemBrand' =>  Request::input('brand'),
					'intItemType'	=> Request::input('type'),
				]);

		return Redirect::to('/products');
	}

	public function deactProd($id) {
			DB::table('tblItems')
				->where('tblItems.intItemID', '=', $id)
				->update([
					'intItemStatus' => 0,
				]);

	    return Redirect::to('/products');
	}

	public function openServ() {
		$data = DB::table('tblServices')
			->where('tblServices.intServStatus', '=', 1)
			->get();
		
			return View::make('admin-services')->with('data',$data);
	}

	public function openAddServ() {

			return View::make('add-services');
	}

	public function addServ() {

		DB::table('tblServices')
		->insert([
			'strServName'		=> Request::input('name'),
			'strServDesc' 		=> Request::input('desc'),
			'intServStatus' => 1
		]);

		return Redirect::to('/services');
	}

	public function openUpServ($id) {
		$data = DB::table('tblServices')
			->where('tblServices.intServID', '=', $id)
			->first();

			return View::make('update-services')->with('data',$data)->with('id',$id);
	}

	public function updateServ() {

		DB::table('tblServices')
		->where('tblServices.intServID', '=', Session::get('upId'))
				->update([
					'strServName'		=> Request::input('name'),
					'strServDesc' 		=> Request::input('desc')
				]);

		return Redirect::to('/services');
	}

	public function deactServ($id) {
		DB::table('tblServices')
		->where('tblServices.intServID', '=', $id)
				->update([
					'intServStatus' => 0
				]);

	    return Redirect::to('/services');
	}
}