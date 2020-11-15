<?php

/**
* 
*/
class Pengajuan_financial extends MY_Model
{
	public $return_type = 'array';
	public $primary_key = 'id_pengajuan';
	function __construct()
	{
		parent::__construct();
	}

	public function get_pengajuan()
	{
		return $this->db->query('SELECT pengajuan_financial.*, permintaan_financial.id_permintaan, permintaan_financial.no_permintaan, daftar_permintaan.jenis_pengajuan FROM pengajuan_financial LEFT JOIN daftar_permintaan ON pengajuan_financial.id_item = daftar_permintaan.id_item LEFT JOIN permintaan_financial ON permintaan_financial.id_permintaan = daftar_permintaan.id_permintaan WHERE pengajuan_financial.teruskan = "Tidak" ORDER BY pengajuan_financial.id_pengajuan ASC');
	}

	public function tanggapi_pengajuan($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function set_ajukan($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function get_teruskan()
	{
		return $this->db->query('SELECT pengajuan_financial.*, permintaan_financial.id_permintaan, permintaan_financial.no_permintaan, daftar_permintaan.jenis_pengajuan FROM pengajuan_financial LEFT JOIN daftar_permintaan ON pengajuan_financial.id_item = daftar_permintaan.id_item LEFT JOIN permintaan_financial ON permintaan_financial.id_permintaan = daftar_permintaan.id_permintaan WHERE pengajuan_financial.teruskan = "Ya" ORDER BY pengajuan_financial.id_pengajuan DESC');
	}

	public function get_pengajuan_direksi()
	{
		return $this->db->query('SELECT pengajuan_financial.*, permintaan_financial.id_permintaan, permintaan_financial.no_permintaan, daftar_permintaan.jenis_pengajuan FROM pengajuan_financial LEFT JOIN daftar_permintaan ON pengajuan_financial.id_item = daftar_permintaan.id_item LEFT JOIN permintaan_financial ON permintaan_financial.id_permintaan = daftar_permintaan.id_permintaan WHERE pengajuan_financial.teruskan = "Ya" AND pengajuan_financial.status="Diajukan" ORDER BY pengajuan_financial.id_pengajuan DESC');
	}

	public function get_notifikasi()
	{
		return $this->db->query('SELECT * FROM pengajuan_financial WHERE status="Diajukan" AND teruskan="Tidak"');
	}

	public function get_diterima()
	{
		return $this->db->query('SELECT pengajuan_financial.*, permintaan_financial.id_permintaan, permintaan_financial.no_permintaan, daftar_permintaan.jenis_pengajuan FROM pengajuan_financial LEFT JOIN daftar_permintaan ON pengajuan_financial.id_item = daftar_permintaan.id_item LEFT JOIN permintaan_financial ON daftar_permintaan.id_permintaan = permintaan_financial.id_permintaan WHERE pengajuan_financial.status="Diterima" ORDER BY pengajuan_financial.id_pengajuan DESC ');
	}

	
}