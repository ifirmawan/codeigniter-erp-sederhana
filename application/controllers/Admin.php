<?php defined("BASEPATH") OR exit ('No direct script access allowed');

/**
* 
*/
class Admin extends MY_Controller
{
	//protected me;
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('ion_auth');
		
	}

	public function index(){
		
	}

}