<?php defined("BASEPATH") OR exit ('No direct script access allowed');

/**
* 
*/
class Kepala_departement extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('financial/daftar_permintaan','financial/permintaan_financial','financial/pengajuan_financial','financial/users_groups','financial/daftar_belanja'));
		$this->load->helper('url');
		$this->load->library(array('ion_auth','template'));
		//var_dump($this->session->userdata('id'));
		if (is_null($this->session->userdata('user_id'))) {
			redirect('auth/index','refresh');
		}

		$this->template->set_layout('ui_dropbox');
	}

	public function index()
	{
		$id_user = $this->session->userdata('user_id');
		//seleksi kepala departement
		$group = $this->users_groups->get_departement($id_user)->result();
		$kep_dep = count($group);
		if ($kep_dep != 0) {
			//redirect('members/index','refresh');
			$data['item'] = $this->daftar_permintaan->get_direview()->result();
			$notif = $this->permintaan_financial->get_notifikasi()->result();
			$data['count'] = count($notif);
			
			$data['username'] = $this->permintaan_financial->index($id_user)->result();
			$data['permintaan'] = $this->permintaan_financial->get_permintaan()->result();
			$data['pengajuan'] = $this->daftar_permintaan->get_direview()->result();
			$this->template->set_content('financial/index_permintaan', $data)->render();
		}else{
			$this->template->set_alert('warning',"Anda Bukan Kepala Departement");
		}	
	}


	//function baru pengajuan
	public function get_direview()
	{
		$data['pengajuan'] = $this->daftar_permintaan->get_direview()->result();
		$id_user = $this->session->userdata('user_id');
		$data['username'] = $this->permintaan_financial->index($id_user)->result();
		$this->template->set_content('financial/daftar_pengajuan', $data)->render();
	}

	public function post_pengajuan()
	{

		if ($this->form_validation->run('post_pengajuan')) {
			
			$id_item = $this->input->post('id_item');
			$nama_item = $this->input->post('nama_item');
			$description = $this->input->post('description');
			$jumlah = $this->input->post('jumlah');
			$satuan = $this->input->post('satuan');
			$id_permintaan = $this->input->post('id_permintaan');
			//$jenis_pengajuan = $this->input->post('jenis_pengajuan');

			$data = array(
				'id_item' => $id_item,
				'nama_item' => $nama_item,
				'description' => $description,
				'qty' => $jumlah,
				'satuan' => $satuan,		
			);

			if ($satuan == 'Rupiah') { //dana
				
				$this->pengajuan_financial->insert($data);
								
			}elseif (in_array($satuan, array('Unit','Pcs'))) { //barang
				
				$this->daftar_belanja->insert($data);

			}

		}else{

			$this->session->set_flashdata('message',validation_errors());

		}

 		redirect('kepala_departement/set_status/'.$id_item.'/'.$id_permintaan,'refresh');
	}

	public function get_notification()
	{
		$notif = $this->permintaan_financial->get_notifikasi()->result();
		$data['permintaan'] = $notif;
		$this->template->set_content('financial/index_permintaan', $data)->render();
	}

	public function set_status($id_item, $id_permintaan)
	{
		$status = array(
					'status' => "Diajukan"
				);

		$where = array(
			'id_item' => $id_item
		);

		$this->daftar_permintaan->update_status($where, $status, 'daftar_permintaan');

		//update status permintaan financial
		$whr = array(
			'id_permintaan' => $id_permintaan
		);
		$status_permintaan = array(
			'status_permintaan' => "Diajukan"
		);

		$this->db->where($whr);
		$this->permintaan_financial->update_status($whr, $status_permintaan, 'permintaan_financial');

		//update status

		redirect('kepala_departement/index','refresh');
	}


}