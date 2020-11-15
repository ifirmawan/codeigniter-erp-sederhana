<?php defined('BASEPATH') OR exit ('No direct script access allowed');

/**
* 
*/
class Migration_Install_daftar_permintaan extends CI_Migration
{
	
	public function up()
	{
		//menghapus tabel 'daftar_permintaan' jika sudah ada
		$this->dbforge->drop_table('daftar_permintaan', TRUE);

		//menambahkan field ke database
		$this->dbforge->add_field(array(
			'id_item' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'auto_increment' => TRUE
			),
			'id_permintaan' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'null' => TRUE
			),
			'nama_item' => array(
				'type' => 'VARCHAR',
				'constraint' => '225',
				'null' => TRUE
			),
			'description' => array(
				'type' => 'VARCHAR',
				'constraint' => '225',
				'null' => TRUE,
			),
			
			'jumlah' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'null' => TRUE,
			),
			'satuan' => array(
				'type' => 'ENUM("Rupiah","Unit","Pcs","Pack")',
				'null' => TRUE
			),
			'kontrol_qty' => array(
				'type' => 'VARCHAR',
				'constraint' => '225',
				'null' => TRUE
			),
			'gudang' => array(
				'type' => 'VARCHAR',
				'constraint' => '225',
				'null' => TRUE
			), 
			'status' => array(
				'type' => 'ENUM("Pending","Direview","Diajukan","Direvisi","Diterima","Ditolak","Cair")',
				'default' => "Pending"
			),
			'sn' => array(
				'type' => 'VARCHAR',
				'constraint' => '225',
				'null' => TRUE
			),
			'aktiva_tetap_enum' => array(
				'type' => 'ENUM("Pembelian Baru","Perbaikan","Sewa","Penghapusan","Penjualan","Mutasi","Subtitusi Karena Hilang/Rusak")',
				'null' => TRUE
			),
			'aktiva_tetap_text' => array(
				'type' => 'VARCHAR',
				'constraint' => '125',
				'null' => TRUE
			),
			'golongan_aktiva_enum' => array(
				'type' => 'ENUM("Computer","Genset","Furniture and Fixture","Tools","Vehicle","Building")',
				'null' => TRUE
			),
			'golongan_aktiva_text' => array(
				'type' => 'VARCHAR',
				'constraint' => '225',
				'null' => TRUE
			)
		));
		$this->dbforge->add_key('id_item', TRUE);
		$this->dbforge->create_table('daftar_permintaan');
	}

	public function down()
	{
		$this->dbforge->drop_table('daftar_permintaan', TRUE);
	}
}