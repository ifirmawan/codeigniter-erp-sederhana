<?php

/**
* 
*/
class Finance extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('financial/pengajuan_financial','financial/permintaan_financial','financial/users_groups'));

		$this->load->library('template');
		$this->template->set_layout('ui_dropbox');

		if (is_null($this->session->userdata('user_id'))) {
			redirect('auth/index','refresh');
		}
		
	}

	public function index()
	{
		$id_user = $this->session->userdata('user_id');
		//seleksi finance
		$group = $this->users_groups->get_finance($id_user)->result();
		$kep_dep = count($group);
		if ($kep_dep != 0) {
			$notif 				= $this->pengajuan_financial->get_notifikasi()->result();
			$data['count'] 		= count($notif);
 
			$data['type'] 		= "finance";
			$data['pengajuan']	= $this->pengajuan_financial->get_pengajuan()->result();
			$data['username'] 	= $this->permintaan_financial->index($id_user)->result();
			$data['riwayat'] 	= $this->pengajuan_financial->get_teruskan()->result();
			$data['btn'] 		= "Cairkan";

			$this->template->set_content('financial/index_finance',$data)->render();
		}else{
			echo "Anda Bukan Finance";
		}		
	}

	public function ajukan($id_item)
	{
		$where = array(
			'id_item' => $id_item
		);

		$data = array (
			'teruskan' => "Ya"
		);

		$this->pengajuan_financial->set_ajukan($where,$data,'pengajuan_financial');
		redirect('finance/index','refresh');
	}

	public function cairkan($id_item)
	{
		$where = array (
			'id_item' => $id_item
		);

		$data = array (
			'amount' => $_POST['amount'],
			'status' => "Cair"
		);

		$status_permintaan = array (
			'status_permintaan' => "Cair"
		);

		$id_permintaan = array (
			'id_permintaan' => $_POST['id_permintaan']
		);

		$status = array (
			'status' => "Cair"
		);

		$this->pengajuan_financial->set_ajukan($id_permintaan, $status_permintaan, 'permintaan_financial');
		$this->pengajuan_financial->set_ajukan($where, $status, 'daftar_permintaan');
		$this->pengajuan_financial->set_ajukan($where, $data, 'pengajuan_financial');
		//$this->pengajuan_financial->set_ajukan($where, $data, 'daftar_belanja');

		redirect('finance/index','refresh');
	}
}