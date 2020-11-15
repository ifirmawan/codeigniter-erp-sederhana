<?php

/**
* 
*/
class Daftar_revisi extends MY_Model
{
	public $return_type = 'array';
	public $primary_key = 'id_revisi';
	
	function __construct()
	{
		parent::__construct();
	}

	public function get_revisi_dana($id_item)
	{
		return $this->db->query('SELECT pengajuan_financial.*, permintaan_financial.id_permintaan, permintaan_financial.no_permintaan, daftar_permintaan.id_item FROM pengajuan_financial LEFT JOIN daftar_permintaan ON pengajuan_financial.id_item = daftar_permintaan.id_item LEFT JOIN permintaan_financial ON permintaan_financial.id_permintaan = daftar_permintaan.id_permintaan WHERE pengajuan_financial.id_item='.$id_item);
	}

	public function get_revisi_barang($id_item)
	{
		return $this->db->query('SELECT daftar_belanja.* ,permintaan_financial.id_permintaan, permintaan_financial.no_permintaan, daftar_permintaan.id_item FROM daftar_belanja LEFT JOIN daftar_permintaan ON daftar_belanja.id_item = daftar_permintaan.id_item LEFT JOIN permintaan_financial ON daftar_permintaan.id_permintaan = permintaan_financial.id_permintaan WHERE daftar_belanja.id_item = '.$id_item);
	}
}