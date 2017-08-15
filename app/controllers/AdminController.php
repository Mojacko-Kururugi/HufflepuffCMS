<?php

class AdminController extends BaseController {

	public function openAdmin() {

		$data = DB::table('tblInventory')
			->join('tblProducts', 'tblInventory.intInvPID', '=', 'tblProducts.intProdID')
			->join('tblInvStatus', 'tblInventory.intInvStatus', '=', 'tblInvStatus.intISID')
			->join('tblProdType', 'tblProducts.intProdType', '=', 'tblProdType.intPTID')
			->where('tblInventory.intInvBranch', '=', 1)
			->where('tblInventory.intInvStatus','!=',3)
			->groupby('tblInventory.intInvPID')
			->selectRaw('*, sum(intInvQty) as sum')
			->get();

		$alls = DB::table('tblInventory')
			->join('tblProducts', 'tblInventory.intInvPID', '=', 'tblProducts.intProdID')
			->join('tblInvStatus', 'tblInventory.intInvStatus', '=', 'tblInvStatus.intISID')
			->join('tblProdType', 'tblProducts.intProdType', '=', 'tblProdType.intPTID')
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
			->join('tblProducts', 'tblInventory.intInvPID', '=', 'tblProducts.intProdID')
			->join('tblProdType', 'tblProducts.intProdType', '=', 'tblProdType.intPTID')
			->join('tblAdjustments', 'tblInventory.intInvID', '=', 'tblAdjustments.intAdjInvID')
			->where('tblInventory.intInvBranch', '=', 1)
			->where('tblInvStatus.intISID','!=',3)
			->get();	


		$ct = 1 + DB::table('tblOrders')
			->count();

		if($ct < 10)
			$count = "BTH00" . $ct;
		else if($ct < 100)
			$count = "BTH0" . $ct;
		else if($ct < 1000)
			$count = "BTH" . $ct;

		$ord = DB::table('tblOrders')
			->join('tblOrderDetails', 'tblOrderDetails.intODCode', '=', 'tblOrders.intOID')
			->join('tblProducts', 'tblOrderDetails.intOProdID', '=', 'tblProducts.intProdID')
			->join('tblOrdStatus', 'tblOrders.intStatus', '=', 'tblOrdStatus.intOSID')	
			->join('tblBranch', 'tblOrders.intOBranch', '=', 'tblBranch.intBranchID')	
			->get();

		$prod = DB::table('tblInventory')
			->join('tblProducts', 'tblInventory.intInvPID', '=', 'tblProducts.intProdID')
			->join('tblInvStatus', 'tblInventory.intInvStatus', '=', 'tblInvStatus.intISID')
			->join('tblProdType', 'tblProducts.intProdType', '=', 'tblProdType.intPTID')
			->where('tblInventory.intInvBranch', '=', 1)
			->where('tblInventory.intInvStatus','!=',3)
			->groupby('tblInventory.intInvPID')
			->selectRaw('*, sum(intInvQty) as sum')
			->get();

		return View::make('dash-admin')
		->with('data',$data)
		->with('ord',$ord)
		->with('count',$count)
		->with('stock',$stock)
		->with('prod',$prod)
		->with('alls',$alls)
		->with('branch',$branch);
	}	

	public function openAddItem() {
		$data = DB::table('tblProducts')
			->where('tblProducts.intProdStatus', '=', 1)
			->get();

		$ct = 1 + DB::table('tblAdjustments')
			->count();

		if($ct < 10)
			$count = "AMN00" . $ct;
		else if($ct < 100)
			$count = "AMN0" . $ct;
		else if($ct < 1000)
			$count = "AMN" . $ct;

			return View::make('add-order')->with('data',$data)->with('count',$count);
	}

	public function addItem() {

		$inv = DB::table('tblInventory')
			->where('tblInventory.intInvPID', '=', Request::input('name'))
			->where('tblInventory.intInvBranch', '=', 1)
			->where('tblInventory.intInvStatus','!=',3)
			->groupby('tblInventory.intInvPID')
			->selectRaw('*, sum(intInvQty) as sum')
			->first();

		$new_qty = Request::input('qty');
		$curr_qty =  $inv->intInvQty;
		$total;

		$total = $curr_qty + $new_qty;

				DB::table('tblAdjustments')
					->insert([
						'strAdjCode'  => Request::input('user_id'),
						'intAdjInvID' => $inv->intInvPID,
					    'intAdjQty' => Request::input('qty'),
					    'strAdjReason' => "BOUGHT BY MAIN",
					    'intAdjStatus' => 1,
					    'intAdjBranch' => 1
					]);		

				DB::table('tblInventory')
						->where('tblInventory.intInvID', '=', $inv->intInvPID)
						->update([
							'intInvQty' => $total,
						]);

		return Redirect::to('/admin');
	}

	public function deliverOrd($id) {

		$ldate = date('Y-m-d H:i:s');

		$ct = 1 + DB::table('tblAdjustments')
			->count();

		if($ct < 10)
			$count = "MMN00" . $ct;
		else if($ct < 100)
			$count = "MMN0" . $ct;
		else if($ct < 1000)
			$count = "MMN" . $ct;

		DB::table('tblOrders')
				->where('tblOrders.intOID', '=', $id)
				->update([
					'dtOReceived' => $ldate,
					'intStatus' => 4,
				]);

		$data = DB::table('tblOrders')
			->join('tblOrderDetails', 'tblOrderDetails.intODCode', '=', 'tblOrders.intOID')
			->join('tblProducts', 'tblOrderDetails.intOProdID', '=', 'tblProducts.intProdID')
			->join('tblBranch', 'tblOrders.intOBranch', '=', 'tblBranch.intBranchID')
			->where('tblOrders.intOID', '=', $id)
			->first();

		$inv = DB::table('tblInventory')
			->where('tblInventory.intInvPID', '=', $data->intOProdID)
			->where('tblInventory.intInvBranch', '=', 1)
			->where('tblInventory.intInvStatus','!=',3)
			->groupby('tblInventory.intInvPID')
			->selectRaw('*, sum(intInvQty) as sum')
			->first();

		$new_qty = $data->intOQty;
		$curr_qty =  $inv->intInvQty;
		$total;
		$string = "ORDER BY " . $data->strBranchName . "(" . $data->strOCode . ")";
			if($new_qty <= $inv->sum)
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
					return Redirect::to('/admin');
				}


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
		$data = DB::table('tblProdType')
			->where('tblProdType.intPTStatus', '=', 1)
			->get();

			return View::make('admin-product-types')->with('data',$data);
	}

	
	public function openAddProdType() {
		
			return View::make('add-product-type');
	}

	public function addProdType() {

		DB::table('tblProdType')
		->insert([
		    'strPTDesc' => Request::input('name'),
		    'intPTStatus'  => 1
		]);

		return Redirect::to('/product-type');
	}

	public function showUpPT($id) {

		$data = DB::table('tblProdType')
			->where('tblProdType.intPTID', '=', $id)
			->first();

	    return View::make('update-product-type')->with('data',$data)->with('id',$id);
	}

	public function updatePT() {
			DB::table('tblProdType')
				->where('tblProdType.intPTID', '=', Session::get('upId'))
				->update([
					'strPTDesc' => Request::input('name'),
				]);

		return Redirect::to('/product-type');
	}

	public function deactPT($id) {
			DB::table('tblProdType')
				->where('tblProdType.intPTID', '=', $id)
				->update([
						'intPTStatus'  => 0,
				]);

		return Redirect::to('/product-type');
	}

	public function openProd() {
		$data = DB::table('tblProducts')
			->join('tblProdType', 'tblProducts.intProdType', '=', 'tblProdType.intPTID')
			->where('tblProducts.intProdStatus', '=', 1)
			->get();
		
			return View::make('admin-products')->with('data',$data);
	}


	public function openAddProd() {
		
		$data = DB::table('tblProdType')
			->where('tblProdType.intPTStatus', '=', 1)
			->get();

			return View::make('add-product')->with('data',$data);
	}

	public function addProd() {

		$ct = 1 + DB::table('tblProducts')
			->count();

		if($ct < 10)
			$count = "MN00" . $ct;
		else if($ct < 100)
			$count = "MN0" . $ct;
		else if($ct < 1000)
			$count = "MN" . $ct;


		DB::table('tblProducts')
		->insert([
			'strProdName' 		=> Request::input('name'),
			'strProdModel' 	=> Request::input('model'),
			'strProdBrand' =>  Request::input('brand'),
			'intProdType'	=> Request::input('type'),
			'dcInvPPrice' => Request::input('price'),
			'intProdStatus' => 1
		]);

		$ldate = date('Y-m-d H:i:s');

		DB::table('tblInventory')
			->insert([
				'intInvPID' => $ct,
				'strInvCode' => $count,
			    'intInvQty' => 0,
			    'dtInvExpiry' => NULL,
			    'intInvStatus' => 1,
				'intInvBranch' => 1
			]);

		return Redirect::to('/products');
	}

	public function showUpProd($id) {
		$prod = DB::table('tblProducts')
			->where('tblProducts.intProdID', '=', $id)
			->first();

		$data = DB::table('tblProdType')
			->get();

	    return View::make('update-product')->with('data',$data)->with('prod',$prod)->with('id',$id);
	}

	public function updateProd() {
			DB::table('tblProducts')
				->where('tblProducts.intProdID', '=', Session::get('upId'))
				->update([
					'strProdName' 		=> Request::input('name'),
					'strProdModel' 	=> Request::input('model'),
					'strProdBrand' =>  Request::input('brand'),
					'intProdType'	=> Request::input('type'),
					'dcInvPPrice' => Request::input('price')
				]);

		return Redirect::to('/products');
	}

	public function deactProd($id) {
			DB::table('tblProducts')
				->where('tblProducts.intProdID', '=', $id)
				->update([
					'intProdStatus' => 0,
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