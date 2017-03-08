<?php

class DoctorController extends BaseController {
		
	public function index(){

		$data = DB::table('tblDocInfo')
			->join('tblBranch', 'tblDocInfo.strDocBranch', '=', 'tblBranch.strBranchCode')
			->where('tblDocInfo.strDocEmail', '=', Session::get('user_type'))
			->first();

		Session::put('user_name',$data->strDocLast . ', ' . $data->strDocFirst);
		Session::put('user_b',$data->strBranchName);
		Session::put('user_bc',$data->strBranchCode);

		$inv = DB::table('tblInventory')
			->join('tblProducts', 'tblInventory.strInvPCode', '=', 'tblProducts.strProdCode')
			->where('tblInventory.strInvBranch', '=', Session::get('user_bc'))
			->groupby('tblInventory.strInvPCode')
			->selectRaw('*, sum(intInvQty) as sum')
			->get();

		return View::make('index')->with('inv',$inv);

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
			->where('tblPatientInfo.strPatCode', '=', $id)
			->first();

	    return View::make('update-patient')->with('data',$data)->with('id',$id);
	}

	public function updatePat() {
			DB::table('tblPatientInfo')
				->where('tblPatientInfo.strPatCode', '=', Session::get('upId'))
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
				->where('tblPatientInfo.strPatCode', '=', $id)
				->update([
					'intPatStatus' => 0,
				]);

	    return Redirect::to('/records');
	}

	public function showInv() {
		$data = DB::table('tblInventory')
			->join('tblInvStatus', 'tblInventory.intInvStatus', '=', 'tblInvStatus.strISCode')
			->join('tblProducts', 'tblInventory.strInvPCode', '=', 'tblProducts.strProdCode')
			->join('tblProdType', 'tblProducts.intProdType', '=', 'tblProdType.strPTCode')
			->where('tblInventory.strInvBranch', '=', Session::get('user_bc'))
			->get();
		

		return View::make('inventory')->with('data',$data);
	}

	public function showSales() {
		return View::make('sales');
	}

	public function showSched() {
		$try = DB::table('tblBranch')
				->where('tblBranch.intBStatus', '=', 1)
				->get();
		return View::make('schedule')->with('try',$try);
	}
	public function addSched() {
		$data = DB::table('tblPatientInfo')
			->where('tblPatientInfo.intPatStatus', '=', 1)
			->get();

		return View::make('add-sched')->with('data',$data);
	}

	public function showPayment() {
		return View::make('add-payment');
	}

}