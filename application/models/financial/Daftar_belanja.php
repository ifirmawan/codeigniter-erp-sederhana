<?php

/**
* 
*/
class Daftar_belanja extends MY_Model
{
	public $return_type="array";
	public $primary_key="id_belanja";
	function __construct()
	{
		parent::__construct();
	}

	public function get_pengajuan()
	{
		return $this->db->query('SELECT daftar_belanja.*, permintaan_financial.id_permintaan, permintaan_financial.no_permintaan, daftar_permintaan.jenis_pengajuan FROM daftar_belanja LEFT JOIN daftar_permintaan ON daftar_belanja.id_item = daftar_permintaan.id_item LEFT JOIN permintaan_financial ON permintaan_financial.id_permintaan = daftar_permintaan.id_permintaan WHERE Daftar_belanja.teruskan = "Tidak" and daftar_belanja.status="Diajukan" ORDER BY Daftar_belanja.id_belanja ASC');
	}

	public function pengajuan_barang()
	{
		return $this->db->query('SELECT daftar_belanja.*, permintaan_financial.id_permintaan, permintaan_financial.no_permintaan, daftar_permintaan.jenis_pengajuan FROM daftar_belanja LEFT JOIN daftar_permintaan ON daftar_belanja.id_item = daftar_permintaan.id_item LEFT JOIN permintaan_financial ON permintaan_financial.id_permintaan = daftar_permintaan.id_permintaan WHERE Daftar_belanja.teruskan = "Ya" and daftar_belanja.status="Diajukan" ORDER BY Daftar_belanja.id_belanja ASC');
	}

	public function set_ajukan($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function get_notifikasi()
	{
		return $this->db->query('SELECT * FROM daftar_belanja WHERE status="Diajukan" AND teruskan="Tidak"');
	}

	public function get_diterima()
	{
		return $this->db->query('SELECT daftar_belanja.*, permintaan_financial.id_permintaan, permintaan_financial.no_permintaan, daftar_permintaan.jenis_pengajuan FROM Daftar_belanja LEFT JOIN daftar_permintaan ON daftar_belanja.id_item = daftar_permintaan.id_item LEFT JOIN permintaan_financial ON daftar_permintaan.id_permintaan = permintaan_financial.id_permintaan WHERE daftar_belanja.status="Diterima" ORDER BY daftar_belanja.id_belanja DESC');
	}
		
}