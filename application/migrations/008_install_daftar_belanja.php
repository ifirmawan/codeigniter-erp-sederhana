<?php defined('BASEPATH') OR exit ('No direct script access allowed');

/**
* 
*/
class Migration_Install_daftar_belanja extends CI_Migration
{
	public function up()
	{
		$this->dbforge->drop_table('daftar_belanja', TRUE);
		$this->dbforge->add_field(array(
			'id_belanja' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'auto_increment' => TRUE
			),
			'id_item' =>array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'null' => TRUE
			),
			'id_pencairan' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'null' => TRUE,
			),
			'vendor' => array(
				'type' => 'VARCHAR',
				'constraint' => '175',
				'null' => TRUE,
			),
			'nama_item' => array(
				'type' => 'VARCHAR',
				'constraint' => '225',
				'null' => TRUE,
			),
			'description' => array(
				'type' => 'VARCHAR',
				'constraint' => '225',
				'null' => TRUE,
			),
			'qty' => array(
				'type' => 'VARCHAR',
				'constraint' => '175',
				'null' => TRUE,
			),
			'satuan' => array(
				'type' => 'ENUM("Rupiah","Unit","Pcs")',
				'null' => TRUE,
			),
			'kontrol_qty' => array(
				'type' => 'VARCHAR',
				'constraint' => '175',
				'null' => TRUE,
			),
			'gudang' => array(
				'type' => 'VARCHAR',
				'constraint' => '175',
				'null' => TRUE,
			),
			'SN' => array(
				'type' => 'VARCHAR',
				'constraint' => '75',
				'null' => TRUE,
			),
			'date' => array(
				'type' => 'DATE',
				'null' => TRUE,
			),
			'dibeli' => array(
				'type' => 'ENUM("Sudah","Belum")',
				'default' => "Belum"
			),
			'teruskan' =>array(
				'type' => 'ENUM("Ya","Tidak")',
				'default' => "Tidak"
			),
			'status' => array(
				'type' => 'ENUM("Diajukan","Direvisi","Diterima","Ditolak","Cair")',
				'default' => "Diajukan"
			),
			'catatan' => array(
				'type' => 'VARCHAR',
				'constraint' => '225',
				'null' => TRUE
			)

		));
		$this->dbforge->add_key('id_belanja', TRUE);
		$this->dbforge->create_table('daftar_belanja');
	}

	public function down()
	{
		$this->dbforge->drop_table('daftar_belanja', TRUE);
	}
	
}