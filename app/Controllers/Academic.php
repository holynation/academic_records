<?php

namespace App\Controllers;

class Academic extends BaseController {

	public function index()
	{
		helper('form');
		return $this->home();
	}

	public function home(){
		$data = array();
		return view('academics/login',$data);
	}

	public function register(){
		
	}

}
