<?php
require_once 'MY_Custom.php';
/**
* 
*/
class MY_Controller extends MY_Custom
{
	public $logged_in;

	function __construct()
	{
		parent::__construct();

		//set migrasi
		$this->do_migration();

		//set bahasa indonesia
		$this->set_indonesian_lang();

		$this->set_global_var_views();

	}

	protected function set_global_var_views()
	{

		if (!is_null($this->session->userdata('user_id'))) {
			$user_id = $this->session->userdata('user_id');
			$this->load->model('users');
			$this->logged_in = $this->users->get($user_id);
		}
	}

}