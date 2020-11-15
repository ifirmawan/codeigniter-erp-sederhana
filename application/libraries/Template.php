<?php

/**
* 
*/
class Template 
{
	protected $layout;
	protected $content;
	protected $ci;	
	
	function __construct()
	{
		$this->ci =&get_instance();
	}

	public function set_layout($view=''){
		$this->layout = $view;
		return $this;
	}

	public function set_content($content='',$data=array())
	{
		

		$data['me'] 	= $this->ci->router->fetch_class();
		$view_path 		= APPPATH.'views/'.$content.'.php';
		if ($this->ci->logged_in) {
			$data 			= array_merge($data,$this->ci->logged_in);
			$controllers 	= get_files_in(APPPATH.'/controllers');
		
			//if (in_array($data['is'].'.php', $controllers)) {
			//	$data['me'] = $data['is'];
			//}
		}
		$this->content 	= $content;
		if (file_exists($view_path)) {
			$this->content = $this->ci->load->view($content,$data,true);
		} 
		return $this;
	}
	public function render($custom=array())
	{
		$this->ci->load->model(array('financial/permintaan_financial','financial/Users_groups','financial/notification'));
		$session				= $this->ci->session->userdata('user_id');
		if (!is_null($session)) {

			$users_group 			= $this->ci->Users_groups->get_departement($session)->result();
		
			if (count($users_group) != 0) {
				$notification		= $this->ci->permintaan_financial->get_notifikasi()->result();
				$data['count']		= count($notification);
				$data['target']		= "kepala_departement/get_notification";
			}else{
				$data['count']		= 0;
			}
			$data['notifikasi']		= $this->ci->notification->get_belum_dibaca($session)->result();
		}
 	
		$data['me'] 			= $this->ci->router->fetch_class();
		$data['content'] 		= $this->content;
		$data['alert']			= $this->ci->session->flashdata('alert'); 
		$data['navigasi']		= get_menu_by_current_user();
		$data['my'] 			= $this->ci->logged_in;
		$data['default_c']		= $this->ci->router->default_controller;
		//
		//$data['count']			= count($this->ci->permintaan_financial->get_notifikasi()->result());

		if ($custom) {
			$data = array_merge($data,$custom);
		}

		if ($this->ci->logged_in) {
			$data 			= array_merge($data,$this->ci->logged_in);
			$controllers 	= get_files_in(APPPATH.'/controllers');
		
			/*if (in_array($data['is'].'.php', $controllers)) {
				$data['me'] = $data['is'];
			}*/
		}

		if (!is_null($this->layout) || !empty($this->layout)) {
			$this->ci->load->view($this->layout,$data);
		}else{
			echo 'set layout terlebih dahulu';
		}
		
	}
	
	public function set_alert($status='',$pesan='')
	{
		$data['status'] = $status;
		$data['alert']	= (is_array($pesan))? implode(' ', $pesan) : $pesan;
		$pesan 			= $this->ci->load->view('pages/alert_view',$data,true);
		$this->ci->session->set_flashdata('alert',$pesan);
		return $this;
	}


}