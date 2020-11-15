<?php

/**
* 
*/
class General_affair extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('financial/daftar_belanja','financial/permintaan_financial','financial/users_groups'));
		$this->load->library('template');

		if (is_null($this->session->userdata('user_id'))) {
			redirect('auth/index','refresh');
		}

		$this->template->set_layout('ui_dropbox');
	}

	public function index()
	{
		//seleksi GA
		$user_id = $this->session->userdata('user_id');
		$group = $this->users_groups->get_affair($user_id)->result();
		$kep_dep = count($group);
		if ($kep_dep != 0) {
			$notif = $this->daftar_belanja->get_notifikasi()->result();
			$data['count'] = count($notif);

			$data['type'] = "general_affair";
			$data['pengajuan'] = $this->daftar_belanja->get_pengajuan()->result();
			$data['riwayat'] = $this->daftar_belanja->pengajuan_barang()->result();
			$id_user = $this->session->userdata('user_id');
			$data['username'] = $this->permintaan_financial->index($id_user)->result();
			$data['btn'] = "Belanjakan";
			$this->template->set_content('financial/index_ga',$data)->render();
			//$this->load->view('financial/pengajuan_ke_direksi',$data);
		}else{
			echo "Anda Bukan General affair";
		}

		
	}

	public function ajukan($id_item)
	{
		$where = array(
			'id_item' => $id_item
		);

		$data = array (
			'teruskan' => "Ya",
		);

		$this->daftar_belanja->set_ajukan($where,$data,'daftar_belanja');
		redirect('general_affair/index','refresh');
	}
}