<?php

/**
* 
*/
class rincian_aktiva extends MY_Model
{
	public $return_type = 'array';
	public $primary_key = 'id_rincian';
	function __construct()
	{
		parent::__construct();
	}

	public function get_edit($id_item)
	{
		return $this->db->query('SELECT * FROM rincian_aktiva WHERE id_item='.$id_item);
	}

	public function update_aktiva($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function detail_aktiva($id_item)
	{
		return $this->db->query('SELECT rincian_aktiva.*, daftar_permintaan.*, users.*,permintaan_financial.* FROM rincian_aktiva LEFT JOIN daftar_permintaan ON rincian_aktiva.id_item = daftar_permintaan.id_item LEFT JOIN permintaan_financial ON daftar_permintaan.id_permintaan = permintaan_financial.id_permintaan LEFT JOIN users ON permintaan_financial.id_user = users.id  WHERE rincian_aktiva.id_item='.$id_item);
	}
} 