<?php

/**
* 
*/
class Direksi extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('financial/permintaan_financial','financial/daftar_permintaan','financial/pengajuan_financial','financial/daftar_revisi','financial/daftar_belanja','financial/users_groups','financial/rincian_aktiva'));

		$this->load->library('template');

		$this->template->set_layout('ui_dropbox');

		if (is_null($this->session->userdata('user_id'))) {
			redirect('auth/index','refresh');
		}

	}
 
	public function index()
	{
		$id_user = $this->session->userdata('user_id');
		//seleksi direksi
		$group = $this->users_groups->get_direksi($id_user)->result();
		$kep_dep = count($group);
		if ($kep_dep != 0) {

			$data['dana'] = $this->pengajuan_financial->get_pengajuan_direksi()->result();
			$data['barang'] = $this->daftar_belanja->pengajuan_barang()->result();
			$id_user = $this->session->userdata('user_id');
			$data['username'] = $this->permintaan_financial->index($id_user)->result();
			$this->template->set_content('financial/index_direksi', $data)->render();
		}else{
			echo "Anda Bukan Direksi";
		}
		
	}

	public function detail_pengajuan($id_item)
	{
		$count = $this->rincian_aktiva->detail_aktiva($id_item)->result();
		$id_user = $this->session->userdata('user_id');
		$data['username'] = $this->permintaan_financial->index($id_user)->result();		
		$data['item'] = $this->rincian_aktiva->detail_aktiva($id_item)->result();
		$data['id_item'] = $id_item;
		$data['hide'] = "hidden";
		if (count($count) != 0) {
			$this->template->set_content('financial/detail_aktiva', $data)->render();
		}else{
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function get_pengajuan()
	{
		$id_user = $this->session->userdata('user_id');
		$data['username'] = $this->permintaan_financial->index($id_user)->result();
		$data['pengajuan'] = $this->pengajuan_financial->get_pengajuan()->result();
		
	}

	public function tanggapi_pengajuan($id_item)
	{
		$catatan = $this->input->post('catatan');
		$jenis_pengajuan = $this->input->post('jenis_pengajuan');
		$id_permintaan = $this->input->post('id_permintaan');
		$where = array(
			'id_item' => $id_item
		);

		$whr = array(
					'id_permintaan' => $id_permintaan
			);

		if ($_POST['btn_function']=='tolak') {
			if ($catatan=="") {
				$message = $this->session->set_flashdata('message','Beri alasan penolakan pada kolom catatan');
				redirect('direksi/index','refresh');
			}else{

				$dt = array(
					'status_permintaan' => "Ditolak",
					'catatan' => $catatan
				);

				$data = array(
					'status' => "Ditolak",
					'catatan' => $catatan
				);

				$daf = array (
					'status' => "Ditolak"
				);

				$this->pengajuan_financial->tanggapi_pengajuan($where, $data, 'pengajuan_financial');
				$this->pengajuan_financial->tanggapi_pengajuan($where, $data, 'daftar_belanja');
				$this->permintaan_financial->update_status($whr,$dt,'permintaan_financial');	
				$this->daftar_permintaan->update_review($where,$daf,'daftar_permintaan');
			}
			redirect('direksi/index','refresh');
			
		}elseif ($_POST['btn_function']=="revisi") {
			$data = array(
				'status' => "Direvisi",
				'catatan' => $_POST['catatan']
			);

			$dt = array (
				'status_permintaan' => "Direvisi",
				'catatan' => $_POST['catatan']
			);
 
			$this->pengajuan_financial->tanggapi_pengajuan($where, $data, 'pengajuan_financial');
			$this->pengajuan_financial->tanggapi_pengajuan($where, $data, 'daftar_belanja');
			$this->pengajuan_financial->tanggapi_pengajuan($whr, $dt, 'permintaan_financial');		

			$last_id = $this->daftar_revisi->last_id();
			$value = $this->input->post(NUll,true);
			$data_revisi = array(
				'id_permintaan' => $value['id_permintaan'],
				'id_item' => $id_item,
				'no_revisi' => "REV/".date('Y-m-d')."/".$last_id,
				'keterangan_revisi' => $value['catatan'],
				'tanggal_revisi' => date('Y-m-d H:i:s')
			);

			$daf = array(
				'status' => "Direvisi"
			);

			$this->daftar_permintaan->update_review($where,$daf, 'daftar_permintaan');
			$this->daftar_revisi->insert($data_revisi);
			redirect('direksi/index','refresh');
		}else{
			redirect('direksi/index','refresh');
		}

	}

	public function terima_pengajuan($id_item, $id_permintaan)
	{
		$where = array(
			'id_item' => $id_item
		);

		$whr = array(
				'id_permintaan' => $id_permintaan
			);

		
			$data = array(
				'status' => "Diterima",
			);

			$dt = array(
				'status_permintaan' => "Diterima"
			);

			$this->pengajuan_financial->tanggapi_pengajuan($where, $data, 'pengajuan_financial');
			$this->pengajuan_financial->tanggapi_pengajuan($where, $data, 'daftar_belanja');
			$this->pengajuan_financial->tanggapi_pengajuan($whr, $dt, 'permintaan_financial');
			$this->daftar_permintaan->update_review($where,$data,'daftar_permintaan');
			redirect('direksi/index','refresh');
		
	}

	public function revisi_dana($id_item)
	{
		$last_id = $this->daftar_revisi->last_id();
		$data['tgl_revisi'] = date('Y-m-d H:i:s');
		$data['no_revisi'] = 'REV/'.date('Y-m-d').'/'.$last_id;
		$data['revisi'] = $this->daftar_revisi->get_revisi_dana($id_item)->result();
		$id_user = $this->session->userdata('user_id');
		$data['username'] = $this->permintaan_financial->index($id_user)->result();


		$this->template->set_content('financial/revisi_pengajuan', $data)->render();
	}

	public function revisi_barang($id_item)
	{
		$last_id = $this->daftar_revisi->last_id();
		$data['tgl_revisi'] = date('Y-m-d H:i:s');
		$data['no_revisi'] = 'REF/'.date('Y-m-d').'/'.$last_id;
		$data['revisi'] = $this->daftar_revisi->get_revisi_barang($id_item)->result();
		$id_user = $this->session->userdata('user_id');
		$data['username'] = $this->permintaan_financial->index($id_user)->result();
		$this->template->set_content('financial/revisi_pengajuan', $data)->result();
	}

	public function simpan_revisi($id_item)
	{
		$last_id = $this->daftar_revisi->last_id();
		$value = $this->input->post(NUll,true);
		$data = array(
			'id_permintaan' => $value['id_permintaan'],
			'id_item' => $id_item,
			'no_revisi' => "REV/".date('Y-m-d')."/".$last_id,
			'keterangan_revisi' => $value['catatan'],
			'tanggal_revisi' => date('Y-m-d H:i:s')
		);
		$where = array(
			'id_item' => $id_item
		);

		$whr = array(
			'id_permintaan' => $value['id_permintaan']
		);

		$dt = array(
			'status_permintaan' => "Direvisi"
		);

		$daf = array(
			'status' => "Direvisi"
		);

		$this->daftar_permintaan->update_review($where,$daf, 'daftar_permintaan');
		$this->daftar_revisi->insert($data);
		redirect('direksi/index','refresh');
		
		
	}


}