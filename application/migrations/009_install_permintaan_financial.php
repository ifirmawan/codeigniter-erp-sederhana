<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Install_permintaan_financial extends CI_Migration {

	public function up()
	{
		// Drop table 'permintaan_financial' if it exists
		$this->dbforge->drop_table('permintaan_financial', TRUE);

		// Table structure for table 'permintaan_financial'
		$this->dbforge->add_field(array(
			'id_permintaan' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'auto_increment' => TRUE
			),
			'no_permintaan' => array(
				'type' => 'VARCHAR',
				'constraint' => '25',
				'null' => TRUE,
			),
			'id_user' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'null' => TRUE,
			),
			'judul_permintaan' => array(
				'type' => 'VARCHAR',
				'constraint' => '225',
				'null' => TRUE
			),
			'keperluan' => array(
				'type' => 'VARCHAR',
				'constraint' => '225',
				 'null' => TRUE,
			),
			'tgl_permintaan' => array(
				'type' => 'date',
				 'null' => TRUE,
			),
			'no_revisi' => array(
				'type' => 'VARCHAR',
				'constraint' => '25',
				 'null' => TRUE,
			),
			'status_permintaan' => array(
				'type' => 'ENUM("Pending","Direview","Diajukan","Direvisi","Diterima","Ditolak","Cair")',
				'default' => 'Pending'
			),
			'catatan' => array(
				'type' => 'VARCHAR',
				'constraint' => '225',
				'null' => TRUE
			)
		));
		$this->dbforge->add_key('id_permintaan', TRUE);
		$this->dbforge->create_table('permintaan_financial');

	}

	public function down()
	{
		$this->dbforge->drop_table('permintaan_financial', TRUE);
	}
}
