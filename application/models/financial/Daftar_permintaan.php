<?php

/**
* 
*/
class Daftar_permintaan extends MY_Model
{
	public $return_type = 'array';
	public $primary_key = 'id_item';

	function __construct()
	{
		parent::__construct();
	}

	public function get_item($id_permintaan)
	{
		return $this->db->query('SELECT * FROM daftar_permintaan WHERE id_permintaan='.$id_permintaan);
	}

	public function get_pending($id_permintaan)
	{
		return $this->db->query('SELECT * FROM daftar_permintaan WHERE status="Pending" AND id_permintaan='.$id_permintaan);
	}

	public function hapus_semua($id_permintaan)
	{
		return array(
			$this->db->query('DELETE FROM daftar_permintaan WHERE id_permintaan='.$id_permintaan),
			$this->db->query('DELETE FROM rincian_aktiva WHERE id_permintaan='.$id_permintaan)
		);
		
	}

	public function update_review($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	public function get_direview()
	{
		return $this->db->query('SELECT permintaan_financial.id_permintaan, permintaan_financial.no_permintaan, permintaan_financial.judul_permintaan, daftar_permintaan.id_item, daftar_permintaan.nama_item, daftar_permintaan.description, daftar_permintaan.jumlah, daftar_permintaan.satuan FROM permintaan_financial JOIN daftar_permintaan ON permintaan_financial.id_permintaan = daftar_permintaan.id_permintaan WHERE daftar_permintaan.status="Direview" ORDER BY daftar_permintaan.id_permintaan ASC');
	}

	public function update_status($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	public function get_edit($id_item)
	{
		return $this->db->query('SELECT permintaan_financial.*,daftar_permintaan.*,users.username FROM permintaan_financial JOIN daftar_permintaan ON permintaan_financial.id_permintaan = daftar_permintaan.id_permintaan JOIN users ON permintaan_financial.id_user = users.id WHERE daftar_permintaan.id_item='.$id_item);	
	}

	public function update_item($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	public function get_notifikasi($user_id)
	{
		return $this->db->query('SELECT daftar_permintaan.* , permintaan_financial.id_user FROM daftar_permintaan LEFT JOIN permintaan_financial ON daftar_permintaan.id_permintaan = permintaan_financial.id_permintaan LEFT JOIN users ON permintaan_financial.id_user = users.id WHERE daftar_permintaan.status="Direview" AND users.id='.$user_id);
	}


}