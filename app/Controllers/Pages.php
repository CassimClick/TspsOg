<?php namespace App\Controllers;
use App\Models\JoiningInstruction;
use App\Models\Downloads;
use App\Models\Results;

class Pages extends BaseController

{
	public $downloads;
	public $joiningInstruction ;
	public $results ;
	public function __construct()
	{
		$this->downloads = new Downloads();
		$this->results = new Results();
		$this->joiningInstruction  = new JoiningInstruction();
		
		helper(['date','form']);
	}
	public function aboutUs()
	{
		$data['page']=[
			'title'=>'About Us'
		];
		return view('pages/about',$data);
	}

	
	public function preSchool()
	{
		$data['page']=[
			'title'=>'Pre School'
		];
		return view('pages/preSchool',$data);
	}
	public function primarySchool()
	{
		$data['page']=[
			'title'=>'Primary School'
		];
		return view('pages/primary',$data);
	}
	
	public function secondarySchool()
	{
		$data['page']=[
			'title'=>'Secondary School'
		];
		return view('pages/secondary',$data);
	}
	public function journey()
	{
		$data['page']=[
			'title'=>'Our Journey'
		];
		return view('pages/journey',$data);
	}
	public function sports()
	{
		$data['page']=[
			'title'=>'Sports'
		];
		return view('pages/sports',$data);
	}
	public function achievements()
	{
		$data['page']=[
			'title'=>'Achievements'
		];
		return view('pages/achievements',$data);
	}
	public function environment()
	{
		$data['page']=[
			'title'=>'School Environment'
		];
		return view('pages/environment',$data);
	}
	public function downloads()
	{
		$data['page']=[
			'title'=>'Document Downloads'
		];
		$data['downloads'] = $this->downloads->getFiles();
		return view('pages/downloads',$data);
	}
	public function joiningInstruction()
	{
		$data['page']=[
			'title'=>'joining Instruction'
		];
		$year = date('Y');
		$data['joining'] = $this->joiningInstruction->getFiles($year);
		return view('pages/joiningInstruction',$data);
	}
	public function selfReliance()
	{
		$data['page']=[
			'title'=>'Self Reliance'
		];
		
		return view('pages/selfReliance',$data);
	}
	public function nurturing()
	{
		$data['page']=[
			'title'=>'Giving Back To The Community'
		];
		
		return view('pages/nurturing',$data);
	}
	//=================results====================
	public function results()
	{
		$data['page']=[
			'title'=>'Examination Results'
		];

		$data['results'] = $this->results->getFiles();
		
		return view('pages/examResults',$data);
	}



	

}