<?php namespace App\Controllers;
 use App\Models\AnnouncementModel;
 use App\Models\EventsModel;
class HomePage extends BaseController
{
	public $announcementModel;
	public $eventsModal;
	public function __construct()
	{
		$this->announcementModel = new AnnouncementModel();
		$this->eventsModal = new EventsModel();
		
		helper('date');
	}
	public function index()
	{
		$data['page']=[
			'title'=>'Trust St Patrick School'
		];

		$data['announcements'] = $this->announcementModel->getAllAnnouncements();
		$data['events'] = $this->eventsModal->getSixEvents();
		return view('pages/index',$data);
	}

	public function allEvents(){
		$data['page']=[
			'title'=>'Trust St Patrick School',
			'heading'=>'All Events'
		];

		//$data['announcements'] = $this->announcementModel->getAllAnnouncements();
		$data['events'] = $this->eventsModal->getAllEvents();
		return view('pages/allEvents',$data);
	}
	public function aboutUs()
	{
		$data['page']=[
			'title'=>'About Us'
		];
		return view('pages/about',$data);
	}

	

}