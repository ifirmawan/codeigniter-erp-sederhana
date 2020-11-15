<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'third_party/api/Rest_Controller.php';
/**
* 
*/
class Json extends Rest_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('controllerList');
	}

	public function get_class_methods_get($class_name='')
	{
		$data = $this->controllerlist->getControllers();
		$send = array();
		if ($data) {
			$key 		= ucwords($class_name);
			if (isset($data[$key])) {	
				$send 	= $data[$key];
			}
		}
		$this->response($send);
	}
}