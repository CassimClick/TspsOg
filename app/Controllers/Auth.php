<?php namespace App\Controllers;

class Auth extends BaseController
{


	public function logIn()
	{
		$data['page']=[
			'title'=>'Login',
		
		];
		return view('Admin/login',$data);
	}

	public function signUp()
	{
		$data['page']=[
			'title'=>'Login',
		
		];
		return view('Admin/signUp',$data);
	}

	
	

	

}