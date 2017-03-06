<?php

class SecController extends BaseController {

	public function openSec() {
		
			return View::make('layouts/secretary-master');
	}

	public function openSecInv() {
		$data = DB::table('tblEmployeeInfo')
			->join('tblBranch', 'tblEmployeeInfo.strEmpBranch', '=', 'tblBranch.strBranchCode')
			->where('tblEmployeeInfo.intEmpStatus', '=', 1)
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
			->get();
		
			return View::make('sec-ord-list')->with('data',$data);
	}

	public function addOrd() {

		DB::table('tblOrders')
		->insert([
			'strOProdCode' 		=> Request::input('name'),
			'intOQty' 	=> Request::input('qty'),
			'dtOReceived'	=> null,
			'strOBranch'	=> 1,			
			'intStatus' => 2
		]);

		return Redirect::to('/sec-inv');
	}
	

	public function openSecProd() {
		$data = DB::table('tblProducts')
			->where('tblProducts.intProdStatus', '=', 1)
			->get();
		
			return View::make('sec-prod')->with('data',$data);
	}

	public function openAddProd() {
		
			return View::make('add-product');
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