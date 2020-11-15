<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Auth
 * @property Ion_auth|Ion_auth_model $ion_auth        The ION Auth spark
 * @property CI_Form_validation      $form_validation The form validation library
 */
class Roles extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('permissions');

		$this->load->library(array('template','ion_auth'));

		$this->template->set_layout('ui_bootstrap');
		
		if (is_null($this->session->userdata('user_id'))) {
			redirect('auth/index','refresh');
		}
		//var_dump(!$this->ion_auth->is_admin());
	}

	public function index()
	{
		$this->load->library('datatables');
		$this->datatables->set_sources('permissions','get_by_groups')->show();
	}

	public function set_permission()
	{
		$data['groups'] 	= $this->db->get('groups')->result_array();
		$data['modules'] 	= get_files_in(APPPATH.'controllers/');
		array_walk_recursive($data['modules'], 'set_class_name');
		$this->template->set_content('roles/set_permission',$data)->render();
	}

	public function submit_permission()
	{
		if ($this->form_validation->run('set_permission')) {

			$data = $this->input->post(NULL,true);
			if (!$this->permissions->insert($data)) {
				$this->template->set_alert('danger','permission failed to save :(');
				$this->go_back();
			}
			$this->go_to('index');
		}else{
			$this->template->set_alert('warning',validation_errors());
		}
		$this->go_back();
	}

}