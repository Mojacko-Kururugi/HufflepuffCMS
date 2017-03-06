<?php

class PatientController extends BaseController {
	public function openPat() {
		
			return View::make('patient-home');
	}

	public function showSched() {
			return View::make('patient-sched');
	}

	public function showRec() {
		
			return View::make('patient-record');
	}

	public function showAcc() {
		
			return View::make('patient-sales');
	}

}