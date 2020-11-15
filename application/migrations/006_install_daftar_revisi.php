<?php defined('BASEPATH') OR exit ('No direct script access allowed');

/**
* 
*/
class Migration_Install_daftar_revisi extends CI_Migration
{
	public function up()
	{
		$this->dbforge->drop_table('daftar_revisi', TRUE);
		$this->dbforge->add_field(array(
			'id_revisi' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'auto_increment' => TRUE
			),
			'id_permintaan' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'null' => TRUE,
			),
			'id_item' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'null' => TRUE,
			),
			'no_revisi' => array(
				'type' => 'VARCHAR',
				'constraint' => '75',
				'null' => TRUE,
			),
			'keterangan_revisi' => array(
				'type' => 'VARCHAR',
				'constraint' => '225',
				'null' => TRUE,
			),
			'status_revisi' => array(
				'type' => 'ENUM("Pending","Proses","Selesai","Acc")',
				'default' => 'Pending'
			),
			'tanggal_revisi' => array(
				'type' => 'DATE',
				'null' => TRUE,
			) 
		));
		$this->dbforge->add_key('id_revisi', TRUE);
		$this->dbforge->create_table('daftar_revisi');
	}

	public function down()
	{
		$this->dbforge->drop_table('daftar_revisi', TRUE);
	}
}