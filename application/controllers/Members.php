<?php

/**
* 
*/
class Members extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('financial/permintaan_financial','financial/daftar_permintaan','financial/users_groups','financial/rincian_aktiva','financial/notification'));
		$this->load->helper('url');
		$this->load->library(array('ion_auth','template'));

		if (is_null($this->session->userdata('user_id'))) {
			redirect('auth/index','refresh');
		}

		$sesi = $this->session->userdata('permintaan');
		if ($sesi) {
			$method = $this->router->fetch_method();
			if ($method != 'submit_item') {
				//$this->template->set_alert('warning','selesaikan input permintaan');
				//redirect('members/tambah_permintaan','refresh');
			}else{
				//redirect('members/index','refresh');
			}
		}

		$user_id = $this->session->userdata('user_id');
		$group = $this->users_groups->get_departement($user_id)->result();

		$this->template->set_layout('ui_dropbox');

	}

	public function index()
	{
		$user_id 	= $this->session->userdata('user_id');
		$group 		= $this->users_groups->get_departement($user_id)->result();
		$kep_dep 	= count($group);
		if ($kep_dep != 0) {
			$notif = $this->permintaan_financial->get_notifikasi()->result();
			//$data['count'] = count($notif);
		}else{
			//$data['count'] = "0";
		}
		
		$data['permintaan'] = $this->permintaan_financial->get_permintaan()->result();
		$data['riwayat'] 	= $this->permintaan_financial->get_history($user_id)->result();

		$this->template->set_content('financial/index', $data)->render();

		//$this->load->view('financial/index', $data);
	}

	public function detail_permintaan($id_permintaan)
	{
		$user_id 	= $this->session->userdata('user_id');
		$group 		= $this->users_groups->get_departement($user_id)->result();
		$kep_dep 	= count($group);
		
		if ($kep_dep != 0) {
			$data['dept'] = "Kepala Departement";
			//$notif = $this->permintaan_financial->get_notifikasi()->result();
			//$data['count'] = count($notif);
		}else
		{
			$data['btn_review'] = "hidden";
			$data['count'] 		= "0";
		}
		
		$id_user 				= $this->session->userdata('user_id');
		//$data['username'] = $this->permintaan_financial->index($id_user)->result();
		$data['permintaan'] 	= $this->permintaan_financial->get_detail($id_permintaan)->result();
		$data['item'] 			= $this->daftar_permintaan->get_item($id_permintaan)->result();
		$data['oleh'] 			= $this->permintaan_financial->get_oleh($id_permintaan)->result();
		//$this->session->set_userdata('permintaan', $data['permintaan']);
		$this->template->set_content('financial/detail_permintaan', $data)->render();

	}

	public function tambah_permintaan()
	{

		$user_id 	= $this->session->userdata('user_id');
		$group 		= $this->users_groups->get_departement($user_id)->result();
		$kep_dep 	= count($group);
		if ($kep_dep != 0) {
			$notif = $this->permintaan_financial->get_notifikasi()->result();
			$data['count'] = count($notif);
		}else{
			$data['count'] = "0";
		}
		
		$sesi_permintaan 	= $this->session->userdata('permintaan');
		$data['alert'] 		= $this->session->flashdata('message');
		if ($sesi_permintaan) {



			$id_permintaan 			= $this->session->userdata['permintaan']['id_permintaan'];
			$no_permintaan 			= $this->permintaan_financial->last_id();
			$id_user 				= $this->session->userdata('user_id');

			$data['username'] 		= $this->permintaan_financial->index($id_user)->result();
			$data['no_permintaan'] 	= 'FINT/'.date('Y-m-d').'/'.$id_permintaan;
			$data['item'] 			= $this->daftar_permintaan->get_item($id_permintaan)->result();
			$data['permintaan'] 	= $this->session->userdata('permintaan');
			$data['table_hide'] 	= "";
			$data['control'] 		= "hidden";
			$data['id_permintaan']	= $id_permintaan;
			
			$data['satuan'] 		= $this->daftar_permintaan->get_enum_values('satuan');
			

			$this->template->set_content('financial/tambah_permintaan', $data)->render();
		}else{
			$id_permintaan = $this->permintaan_financial->last_id();
			$no_permintaan = $this->permintaan_financial->last_id();
			$id_user = $this->session->userdata('user_id');
			$data['username'] = $this->permintaan_financial->index($id_user)->result();
			$data['no_permintaan'] = 'FINT/'.date('Y-m-d').'/'.$id_permintaan;
			$data['item'] = $this->daftar_permintaan->get_item($id_permintaan)->result();
			$data['permintaan'] = $this->session->userdata('permintaan');
			$data['table_hide'] = "hidden";
			$data['control'] ="";
			$data['id_permintaan'] = $id_permintaan;
			$this->template->set_content('financial/tambah_permintaan', $data)->render();;
		}
		
	}

	public function post_permintaan()
	{
		if ($_POST['btn_function']=='Batal') {
			redirect('members/index', 'refresh');
		}elseif ($_POST['btn_function']=='Kirim') {
			if (is_null($this->session->userdata('permintaan'))) {
				//$data = $this->input->post(NULL,true);
				if ($this->form_validation->run('post_permintaan')) {
					$no_permintaan = $this->permintaan_financial->last_id();
					$data['id_user'] = $this->session->userdata('user_id');
					$data['tgl_permintaan'] = date('Y-m-d H:i:s');
					$data['no_permintaan'] = 'FINT/'.date('Y-m-d').'/'.$no_permintaan;
					$data['judul_permintaan'] = $this->input->post('judul_permintaan');
					$data['keperluan'] = $this->input->post('keperluan');
					if ($id_permintaan = $this->permintaan_financial->insert($data)) {
						$data['id_permintaan'] = $id_permintaan;

						//kirim notifikasi ke kepala departement
						$notif = array(
							'id_permintaan' 	=> $id_permintaan,
							'notifikasi_dari'	=> $this->session->userdata('user_id'),
							'notifikasi_untuk'	=> "2",
							'pesan_notifikasi'	=> "telah membuat pengajuan financial."
						);
						$this->notification->insert($notif);
					}
					$this->session->set_userdata('permintaan', $data);
					redirect('members/tambah_permintaan', 'refresh');
				}else{
					$this->template->set_alert('warning',validation_errors());
				}
				
			}
			redirect('members/tambah_permintaan', 'refresh');
				
		}
	}

	public function post_item()
	{
		if ($this->form_validation->run('post_pengajuan')) {

			$post = $this->input->post(NULL,true);

			$data = array(
				'nama_item' => $post['nama_item'],
				'jumlah' => $post['jumlah'],
				'description' => $post['description'],
				'satuan' => $post['satuan']
			);
 
			$data['id_permintaan'] = $this->session->userdata['permintaan']['id_permintaan'];
			if ($id_item=$this->daftar_permintaan->insert($data)) {
				$data['id_item'] = $id_item;
			}

			if ($_POST['btn']=="tambah") {
				redirect('members/tambah_permintaan','refresh');
			}else{
				redirect('members/tambah_aktiva/'.$id_item,'refresh');
			}

		}else{

			$this->template->set_alert('warning',validation_errors());
			redirect('members/tambah_permintaan','refresh');
		}
		
		
		
	}

	public function selesai()
	{
		$this->session->unset_userdata('permintaan');
		redirect('members/index', 'refresh');
	}

	public function hapus_item($id_item)
	{
		
		$this->daftar_permintaan->delete($id_item);
		$this->db->query('DELETE FROM rincian_aktiva WHERE id_item='.$id_item);
		redirect('members/tambah_permintaan', 'refresh');
	}

	public function hapus_semua($id_permintaan)
	{
		$this->daftar_permintaan->hapus_semua($id_permintaan);
		redirect('members/tambah_permintaan','refresh');			
	}

	public function edit($id_permintaan)
	{

		$notif = $this->permintaan_financial->get_notifikasi()->result();
		$data['count'] = count($notif);

		$this->session->set_userdata('id_permintaan',$id_permintaan);
		$id_user = $this->session->userdata('user_id');
		$data['username'] = $this->permintaan_financial->index($id_user)->result();
		$data['permintaan'] = $this->permintaan_financial->get_detail($id_permintaan)->result();
		$data['item'] = $this->daftar_permintaan->get_pending($id_permintaan)->result();
		$data['oleh'] = $this->permintaan_financial->get_oleh($id_permintaan)->result();
		$data['id_permintaan'] = $id_permintaan;
		$this->template->set_content('financial/review_permintaan', $data)->render();
	}

	public function update_review($id_item)
	{
		$status = $this->input->post('status');
		$data = array(
			'status' => $status
		);

		$where = array(
			'id_item' => $id_item 
		);

		$id_permintaan = $this->session->userdata('id_permintaan');
		$this->daftar_permintaan->update_review($where,$data,'daftar_permintaan');

		redirect('members/edit/'.$id_permintaan, 'refresh');
	}

	public function selesai_review($id_permintaan)
	{
		$catatan = $this->input->post('catatan');
		$data = array(
			'catatan' => $catatan,
			'status_permintaan' => "Direview"
		);

		$where = array(
			'id_permintaan' => $id_permintaan
		);

		$this->permintaan_financial->update_review($where, $data, 'permintaan_financial');
		redirect('members/detail_permintaan/'.$id_permintaan, 'refresh');
	}

	public function edit_item($id_item, $satuan)
	{
		$id_user 						= $this->session->userdata('user_id');
		$data['username'] 				= $this->permintaan_financial->index($id_user)->result();		
		$data['item'] 					= $this->rincian_aktiva->detail_aktiva($id_item)->result();
		$data['dana']					= $this->daftar_permintaan->get_edit($id_item)->result();
		$data['id_item'] 				= $id_item;
		$data['satuan'] 				= $this->daftar_permintaan->get_enum_values('satuan');
		$data['aktiva_tetap_enum'] 		= $this->daftar_permintaan->get_enum_values('aktiva_tetap_enum');
		$data['golongan_aktiva_enum'] 	= $this->daftar_permintaan->get_enum_values('golongan_aktiva_enum');

		if ($satuan=="Rupiah") { //dana
			$this->template->set_content('financial/edit_financial', $data)->render();
		}else{ // barang
			$this->template->set_content('financial/edit_item', $data)->render();	
		}
		 

	}

	public function update_item($id_item)
	{
		if ($_POST['btn_function']=='Batal') {
			redirect('members/tambah_permintaan','refresh');
		}else{
			$post = $this->input->post(null,true);
			$jenis_pengajuan = $this->input->post('jenis_pengajuan');
			$nama_item = $this->input->post('nama_item');
			$jumlah = $this->input->post('jumlah');
			$satuan = $this->input->post('satuan');
			$description = $this->input->post('description');

			$data = array(
				'jenis_pengajuan' 		=> $jenis_pengajuan,
				'nama_item' 			=> $nama_item,
				'jumlah' 				=> $jumlah,
				'satuan' 				=> $satuan,
				'description' 			=> $description,
				'aktiva_tetap_enum' 	=> $post['aktiva_tetap_enum'],
				'aktiva_tetap_text' 	=> $post['aktiva_tetap_text'],
				'golongan_aktiva_enum' 	=> $post['golongan_aktiva_enum'],
				'golongan_aktiva_text' 	=> $post['golongan_aktiva_text']
			);

			$aktiva = array(
				'jenis' 			=> $post['nama_item'],
				'type' 				=> $post['description'],
				'untuk_lokasi' 		=> $post['untuk_lokasi'],
				'estimasi_biaya' 	=> $post['estimasi_biaya'],
				'alasan'			=> $post['alasan'],
				'catatan' 			=> $post['catatan'],
			);

			$where = array(
				'id_item' => $id_item
			);

			$this->daftar_permintaan->update_item($where,$data,'daftar_permintaan');
			$this->rincian_aktiva->update_aktiva($where,$aktiva,'rincian_aktiva');
			redirect('members/tambah_permintaan','refresh');
			
		}
	}

	public function back()
	{
		$user_id 	= $this->session->userdata('user_id');
		$group 		= $this->users_groups->get_departement($user_id)->result();
		$kep_dep 	= count($group);

		if ($kep_dep != 0) {
			redirect('kepala_departement/index','refresh');
		}else{
			redirect('members/index','refresh');
		}
	}

	public function menu()
	{
		$menu = array(
			'daftar_pengajuan' 	=> "Daftar Pengajuan",
			'direvisi' 			=> "Direvisi",
			'diterima' 			=> "Diterima",
			'ditolak' 			=> "Ditolak",
			'cair' 				=> "Cair"
		);
	}

	public function tambah_aktiva($id_item)
	{
		
		$id_user 						= $this->session->userdata('user_id');
		$data['username'] 				= $this->permintaan_financial->index($id_user)->result();	
		$data['item'] 					= $this->daftar_permintaan->get_edit($id_item)->result();
		$data['id_item'] 				= $id_item;
		$data['satuan'] 				= $this->daftar_permintaan->get_enum_values('satuan');
		$data['aktiva_tetap_enum'] 		= $this->daftar_permintaan->get_enum_values('aktiva_tetap_enum');
		$data['golongan_aktiva_enum'] 	= $this->daftar_permintaan->get_enum_values('golongan_aktiva_enum');

		$this->template->set_content('financial/rincian_aktiva',$data)->render();
		
		
	}

	public function simpan_aktiva($id_item)
	{

		$id_permintaan = $this->session->userdata['permintaan']['id_permintaan'];
		$golongan_aktiva_enum="";
		$aktiva_tetap_enum="";
		$this->load->model('financial/rincian_aktiva');
		$data = $this->input->post(NULL,true);

		$where = array(
			'id_item' => $id_item
		);
		//seleksi aktifa tetap
		if ($_POST['aktiva_tetap_enum'] != "lainya") {
			$aktiva_tetap_enum=$_POST['aktiva_tetap_enum'];
		}
		//seleksi golongan aktifa
		if ($_POST['golongan_aktiva_enum']!="lainya") {
			$golongan_aktiva_enum=$_POST['golongan_aktiva_enum'];
		}
		
		$item = array(			
			'aktiva_tetap_enum'			=> $aktiva_tetap_enum,
			'golongan_aktiva_enum'		=> $golongan_aktiva_enum,
			'aktiva_tetap_text' 		=> $data['aktiva_tetap_text'],
			'golongan_aktiva_text'		=> $data['golongan_aktiva_text']
		);

		$aktiva = array(
			'id_permintaan'		=> $id_permintaan,
			'id_item'			=> $id_item,
			'jenis' 			=> $data['nama_item'],
			'type' 				=> $data['description'],
			'untuk_lokasi' 		=> $data['untuk_lokasi'],
			'estimasi_biaya' 	=> $data['estimasi_biaya'],
			'alasan'			=> $data['alasan'],
			'catatan' 			=> $data['catatan']
		);

		if ($this->form_validation->run('aktiva')) {
			$this->daftar_permintaan->update_item($where,$item,'daftar_permintaan');
			$this->rincian_aktiva->insert($aktiva);
		}else{
			$this->template->set_alert('warning',validation_errors());
		}
		
		redirect('members/tambah_permintaan','refresh');

	}

	public function detail_aktiva($id_item)
	{
		$count 				= $this->rincian_aktiva->detail_aktiva($id_item)->result();
		$id_user 			= $this->session->userdata('user_id');
		$data['username'] 	= $this->permintaan_financial->index($id_user)->result();		
		$data['item'] 		= $this->rincian_aktiva->detail_aktiva($id_item)->result();
		
		if (count($count) != 0) {
			$this->template->set_content('financial/detail_aktiva', $data)->render();
		}else{
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function detail_user($id)
	{
		$data['user_data'] 		= $this->users_groups->get_user_data($id)->result();
		$data['group'] 			= $this->users_groups->get_group($id)->result();
		$data['permintaan'] 	= $this->permintaan_financial->get_mine($id)->result();
		$data['direvisi']		= $this->permintaan_financial->get_direvisi($id)->result();
		$data['diterima']		= $this->permintaan_financial->get_diterima($id)->result();
		$data['ditolak']		= $this->permintaan_financial->get_ditolak($id)->result();

		$this->template->set_content('financial/detail_user',$data)->render();
	}

	public function on_click_notification($id_permintaan,$id_notification)
	{
		$where = array(
			'id_notification' => $id_notification
		);

		$data = array(
			'status' => "Dibaca"
		);

		$this->notification->update_notification($where,$data,'notification');
		redirect('members/detail_permintaan/'.$id_permintaan, 'refresh');
	}

	public function update_item_financial($id_item)
	{
		if ($_POST['btn_function']=="batal") {
			redirect('members/tambah_permintaan','refresh');
		}elseif ($_POST['btn_function']=="simpan") {
			if ($this->form_validation->run('post_pengajuan')) {
				$input 	= $this->input->post(null,true);
				$where 	= array(
					'id_item'		=> $id_item
				);
				$data 	= array(
					'nama_item'		=> $input['nama_item'],
					'jumlah'		=> $input['jumlah'],
					'satuan'		=> $input['satuan'],
					'description'	=> $input['description']
				);
				if ($this->daftar_permintaan->update_item($where, $data, 'daftar_permintaan')) {
					$this->template->set_alert('info',"Data berhasil diubah");
				}else{
					$this->template->set_alert('warning',"Data gagal diubah");
				}
				redirect('members/tambah_permintaan','refresh');
			}else{
				$this->template->set_alert('warning',validation_errors());
			}
		}
	}


}

?>