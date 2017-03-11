<?php

class SecController extends BaseController {

	public function openSec() {
		
		$data = DB::table('tblEmployeeInfo')
			->join('tblBranch', 'tblEmployeeInfo.intEmpBranch', '=', 'tblBranch.intBranchID')
			->where('tblEmployeeInfo.strEmpEmail', '=', Session::get('user_type'))
			->first();

		Session::put('user_name',$data->strEmpLast . ', ' . $data->strEmpFirst);
		Session::put('user_b',$data->strBranchName);
		Session::put('user_bc',$data->intBranchID);

			return View::make('layouts/secretary-master');
	}

	public function openSecInv() {
		$data = DB::table('tblInventory')
			->join('tblInvStatus', 'tblInventory.intInvStatus', '=', 'tblInvStatus.intISID')
			->join('tblProducts', 'tblInventory.intInvPID', '=', 'tblProducts.intProdID')
			->join('tblProdType', 'tblProducts.intProdType', '=', 'tblProdType.intPTID')
			->where('tblInventory.intInvBranch', '=', Session::get('user_bc'))
			->get();
		
			return View::make('sec-inv')->with('data',$data);
	}

	public function openAddOrd() {
		$data = DB::table('tblProducts')
			->where('tblProducts.intProdStatus', '=', 1)
			->where('tblProducts.intProdBranch', '=', Session::get('user_bc'))	
			->get();
		
			return View::make('sec-ord')->with('data',$data);
	}

	public function openOrdList() {
		$data = DB::table('tblOrders')
			->join('tblProducts', 'tblOrders.intOProdID', '=', 'tblProducts.intProdID')
			->join('tblOrdStatus', 'tblOrders.intStatus', '=', 'tblOrdStatus.intOSID')
			->where('tblOrders.intOBranch', '=', Session::get('user_bc'))		
			->get();
		
			return View::make('sec-order')->with('data',$data);
	}

	public function addOrd() {

		DB::table('tblOrders')
		->insert([
			'intOProdID' 		=> Request::input('name'),
			'intOQty' 	=> Request::input('qty'),
			'dtOReceived'	=> null,
			'intOBranch'	=> Session::get('user_bc'),			
			'intStatus' => 2
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
			->join('tblProducts', 'tblOrders.intOProdID', '=', 'tblProducts.intProdID')
			->where('tblOrders.intOID', '=', $id)
			->first();

		DB::table('tblInventory')
			->insert([
				'intInvPID' => $data->intOProdID,
			    'dcInvPPrice' => Request::input('price'),
			    'intInvQty' => $data->intOQty,
			    'intInvStatus' => 1,
				'intInvBranch' => Session::get('user_bc')
			]);

		return Redirect::to('/sec-inv');
	}
	

	public function openSecProd() {
		$data = DB::table('tblProducts')
			->join('tblProdType', 'tblProducts.intProdType', '=', 'tblProdType.intPTID')
			->where('tblProducts.intProdBranch', '=', Session::get('user_bc'))
			->where('tblProducts.intProdStatus', '=', 1)
			->get();
		
			return View::make('sec-prod')->with('data',$data);
	}

	public function openAddProd() {
		
		$data = DB::table('tblProdType')
			->get();

			return View::make('add-product')->with('data',$data);
	}

	public function addProd() {

		DB::table('tblProducts')
		->insert([
			'strProdName' 		=> Request::input('name'),
			'strProdModel' 	=> Request::input('model'),
			'intProdType'	=> Request::input('type'),
			'intProdStatus' => 1,
			'intProdBranch' => Session::get('user_bc')
		]);

		return Redirect::to('/sec-prod');
	}

}