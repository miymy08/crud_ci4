<?php namespace App\Controllers;

class Home extends BaseController
{
	public function __construct()
    {
		$this->session = service('session');
		$this->auth = service('authentication');
    	helper('sn');
    }
	
	public function index()
	{
		//jika belum login, tak boleh masuk
		if (!$this->auth->check())
		{
			$redirectURL = session('redirect_url') ?? '/login';
			unset($_SESSION['redirect_url']);

			return redirect()->to($redirectURL);
		}


		$data = [
			'tajuk' => 'Homepage'
		];

		tampilan('home/index', $data);
		
	}

	//--------------------------------------------------------------------

}
