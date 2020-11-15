<?php
/**
* 
*/
class MY_Custom extends CI_Controller
{
	public $logged_in = array();
	public $input_additional = array();
	public $events;
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('template','migration'));
		
		$this->load->config('custom_records',true);
		$this->load->config('custom_template',true);
		$this->load->config('custom_glite',true);
		
		$this->load->helper(array('tools','glite'));

		$this->do_migration();
		
		$this->set_logged_in();
		
		
		
	}


	private function set_upload_path($model_name)
	{
		$pecah_path 	= explode('_', $model_name);
		$path 			= implode('/', $pecah_path);
		$path 			='unggahan/'.$path.'/';
		$upload_path 	= FCPATH.$path;
		if (!file_exists($upload_path)) {
    		mkdir($upload_path, 0777, true);
		}
		return $path;
	}

	private function set_logged_in(){
		$this->load->model(array('ion_auth_model','users'));
		if (!is_null($this->session->userdata('user_id'))) {
			$this->logged_in 			= $this->session->userdata();
			$user_id 					= $this->logged_in['user_id'];
	
			$group						= $this->ion_auth_model->get_users_groups($user_id)->row();
			
			$account 			  		= $this->users->get($user_id);

			if ($account && !is_null($group)) {

				$this->logged_in['group_id']= $group->id;
				$this->logged_in['is']		= $group->name;
				$this->logged_in 			= array_merge($this->logged_in,$account);
			}
		}
	}

	protected function do_migration($version = NULL){
    	
    	if(isset($version) && ($this->migration->version($version) === FALSE)){
      		$this->template->set_alert('warning','message',$this->migration->error_string());
      	}elseif(is_null($version) && $this->migration->latest() === FALSE){
      		$this->template->set_alert('warning','message',$this->migration->error_string());
    	}
  	}

  	protected function go_back($method='index')
  	{
  		if (isset($_SERVER['HTTP_REFERER'])) {
  			header('Location: ' . $_SERVER['HTTP_REFERER']);
  			exit;
  		}else{
  			$this->go_to($method);
  		}
  	}

  	protected function go_to($method='index')
  	{
  		$controller = $this->router->fetch_class();
  		redirect($controller.'/'.$method,'refresh');
  	}

  	protected function set_indonesian_lang()
  	{
  		$this->lang->load(array(
  			'auth',
  			'db',
  			'ion_auth',
  			'form_validation',
  			'migration',
  			'rest_controller',
  			'upload',
  			'calendar',
  			'email',
  			'date',
  			'ftp',
  			'imglib',
  			'number',
  			'profiler',
  			'unit_test'
  		));
  	}

  	protected function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	protected function _valid_csrf_nonce()
	{
		$csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
		if ($csrfkey && $csrfkey == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	protected function upload_file($model_name,$filename='')
	{
		$this->load->model('berkas');
		
		$user_id 						= $this->logged_in['user_id'];
		$last_id						= $this->berkas->get_next_id();
		$new_file_name 					= $last_id.'_'.$user_id.'_'.time();
		
		if (!empty($filename)) {
			$new_file_name 				= $last_id.'_'.$filename.'_'.$user_id.'_'.time();
		}

		$path 							= $this->set_upload_path($model_name);
		$config							= $this->config->item('format','custom_glite');
		$upload_config					= $config['unggah'];
		$upload_config['upload_path'] 	= FCPATH.$path;
		$upload_config['upload_url']	= base_url($path);
		$upload_config['file_name']		= $new_file_name;
		$this->load->library('upload',$upload_config);	
		if ($this->upload->do_upload('berkas')) {
			
			$file_name				= $this->upload->data('file_name');
			$data['nama_berkas'] 	= $file_name;
			$data['jenis_berkas']	= $model_name;
			$data['path_berkas'] 	= $this->upload->data('full_path'); 
			$data['tautan_berkas'] 	= base_url($path.$file_name);
			$data['dibuat_oleh'] 	= $this->logged_in['username'];

			if ($id_berkas  = $this->berkas->insert($data)) {
				return $id_berkas;
			}
		}

		return false;
	}
	

	protected function send_mail($to,$subject,$message)
	{
		$this->load->helper('email');
		
		if (valid_email($to)) {
			$config 				 = $this->config->item('smtp','custom_glite');
			$value_config 			 = array_values($config);
			$key_config 			 = array('smtp_host','smtp_user','smtp_pass','smtp_crypto','smtp_port');
			$mail_config 			 = array_combine($key_config, $value_config);
			$mail_config['mailtype'] = 'html';
			$mail_config['charset'] = 'utf-8';
			$mail_config['wordwrap'] = TRUE;
			$this->load->library('email',$mail_config);
			$this->email->set_mailtype("html");
			$this->email->from($mail_config['smtp_user'], 'Admin Glite');
			$this->email->to($to);
			$this->email->subject($subject);
			$this->email->message($message);
			return $this->email->send();
			//$this->email->print_debugger();
		}	
	}


	protected function trigger($data = FALSE, $last = TRUE)
    {

        if (isset($this->events) && is_array($this->events))
        {
            foreach ($this->events as $method)
            {
                if (strpos($method, '('))
                {
                    preg_match('/([a-zA-Z0-9\_\-]+)(\(([a-zA-Z0-9\_\-\., ]+)\))?/', $method, $matches);

                    $method = $matches[1];
                    $this->callback_parameters = explode(',', $matches[3]);
                }

                $data = call_user_func_array(array($this, $method), array($data, $last));
            }
        }

        return $data;
    }

    protected function proceed_to_save($length_id,$table_name,$primary_key,$data)
    {
    	if ($id_berkas  = $this->upload_file($table_name,$table_name)) {
			$fields 	= $this->db->list_fields($table_name);
  			if (in_array('id_berkas', $fields)) {
  				$data['id_berkas'] = $id_berkas;	
  			}
  		}	
		if ($length_id > 0) {
			$this->db->where($primary_key,$_POST[$primary_key]);
			if ($this->db->update($table_name,$data)) {
				$this->go_to('daftar/'.$table_name);	
			}	
		}else{
			if ($last_id = $this->datatables->insert($table_name,$data)) {
  				$this->go_to('daftar/'.$table_name);
			}
		}
    }

}