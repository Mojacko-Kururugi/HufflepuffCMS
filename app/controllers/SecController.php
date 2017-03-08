<?php

class SecController extends BaseController {

	public function openSec() {
		
		$data = DB::table('tblEmployeeInfo')
			->join('tblBranch', 'tblEmployeeInfo.strEmpBranch', '=', 'tblBranch.strBranchCode')
			->where('tblEmployeeInfo.strEmpEmail', '=', Session::get('user_type'))
			->first();

		Session::put('user_name',$data->strEmpLast . ', ' . $data->strEmpFirst);
		Session::put('user_b',$data->strBranchName);
		Session::put('user_bc',$data->strBranchCode);

			return View::make('layouts/secretary-master');
	}

	public function openSecInv() {
		$data = DB::table('tblInventory')
			->join('tblInvStatus', 'tblInventory.intInvStatus', '=', 'tblInvStatus.strISCode')
			->join('tblProducts', 'tblInventory.strInvPCode', '=', 'tblProducts.strProdCode')
			->join('tblProdType', 'tblProducts.intProdType', '=', 'tblProdType.strPTCode')
			->where('tblInventory.strInvBranch', '=', Session::get('user_bc'))
			->get();
		
			return View::make('sec-inv')->with('data',$data);
	}

	public function openAddOrd() {
		$data = DB::table('tblProducts')
			->where('tblProducts.intProdStatus', '=', 1)
			->get();
		
			return View::make('sec-ord')->with('data',$data);
	}

	public function openOrdList() {
		$data = DB::table('tblOrders')
			->join('tblProducts', 'tblOrders.strOProdCode', '=', 'tblProducts.strProdCode')
			->join('tblOrdStatus', 'tblOrders.intStatus', '=', 'tblOrdStatus.strOSCode')
			->where('tblOrders.strOBranch', '=', Session::get('user_bc'))
			->get();
		
			return View::make('sec-order')->with('data',$data);
	}

	public function addOrd() {

		DB::table('tblOrders')
		->insert([
			'strOProdCode' 		=> Request::input('name'),
			'intOQty' 	=> Request::input('qty'),
			'dtOReceived'	=> null,
			'strOBranch'	=> Session::get('user_bc'),			
			'intStatus' => 2
		]);

		return Redirect::to('/sec-order');
	}

	public function receiveOrd($id) {

		$ldate = date('Y-m-d H:i:s');

		DB::table('tblOrders')
				->where('tblOrders.strOCode', '=', $id)
				->update([
					'dtOReceived' => $ldate,
					'intStatus' => 1,
				]);

		$data = DB::table('tblOrders')
			->join('tblProducts', 'tblOrders.strOProdCode', '=', 'tblProducts.strProdCode')
			->where('tblOrders.strOCode', '=', $id)
			->first();

		DB::table('tblInventory')
			->insert([
				'strInvPCode' => $data->strOProdCode,
			    'dcInvPPrice' => 0.50,
			    'intInvQty' => $data->intOQty,
			    'intInvStatus' => 1,
				'strInvBranch' => Session::get('user_bc')
			]);

		return Redirect::to('/sec-inv');
	}
	

	public function openSecProd() {
		$data = DB::table('tblProducts')
			->join('tblProdType', 'tblProducts.intProdType', '=', 'tblProdType.strPTCode')
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
			'intProdStatus' => 1
		]);

		return Redirect::to('/sec-prod');
	}

}