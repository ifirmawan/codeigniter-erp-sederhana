<?php

/**
* 
*/
class permintaan_financial extends MY_Model
{
	public $return_type = 'array';
	public $primary_key = 'id_permintaan';
	function __construct()
	{
		parent::__construct();
	}

	public function index($id_user)
	{
		return $this->db->query('SELECT username FROM users WHERE id ='.$id_user);
	}

	public function get_permintaan()
	{
		return $this->db->query('SELECT permintaan_financial.*, users.username FROM permintaan_financial JOIN users ON permintaan_financial.id_user = users.id ORDER BY id_permintaan DESC');
	}

	public function get_detail($id_permintaan)
	{
		return $this->db->query('SELECT * FROM permintaan_financial WHERE id_permintaan='.$id_permintaan);
	}

	public function get_oleh($id_permintaan)
	{
		return $this->db->query('SELECT users.username,users.id FROM users JOIN permintaan_financial ON permintaan_financial.id_user = users.id WHERE permintaan_financial.id_permintaan ='.$id_permintaan);
	}

	public function update_review($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	public function update_status($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	public function get_notifikasi()
	{
		return $this->db->query('SELECT permintaan_financial.*, users.username FROM permintaan_financial JOIN users ON permintaan_financial.id_user = users.id WHERE status_permintaan = "Pending" ORDER BY id_permintaan DESC');
	}

	public function get_history($user_id)
	{
		return $this->db->query('SELECT * FROM permintaan_financial WHERE permintaan_financial.id_user ='.$user_id.' ORDER BY id_permintaan DESC');
	}

	public function get_mine($id_user)
	{
		return $this->db->query('SELECT * FROM permintaan_financial WHERE id_user='.$id_user);
	}

	public function get_direvisi($id_user)
	{
		return $this->db->query('SELECT * FROM permintaan_financial WHERE status_permintaan="Direvisi" AND id_user='.$id_user);
	}

	public function get_diterima($id_user)
	{
		return $this->db->query('SELECT * FROM permintaan_financial WHERE status_permintaan="Diterima" AND id_user='.$id_user);
	}

	public function get_ditolak($id_user)
	{
		return $this->db->query('SELECT * FROM permintaan_financial WHERE status_permintaan="Ditolak" AND id_user='.$id_user);
	}
	

}
