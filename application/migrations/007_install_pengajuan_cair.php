<?php defined('BASEPATH') OR exit ('No direct script access allowed');

/**
* 
*/
class Migration_Install_pengajuan_cair extends CI_Migration
{
	
	public function up(){
		$this->dbforge->drop_table('pengajuan_cair', TRUE);
		$this->dbforge->add_field(array(
			'id_pencairan' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'auto_increment' => TRUE
			),
			'id_permintaan' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'null' => TRUE,
			),
			'invoice_no' => array(
				'type' => 'VARCHAR',
				'constraint' => '75',
				'null' => TRUE,
			),
			'date' => array(
				'type' => 'DATE',
				'null' => TRUE,
			),
			'doe' => array(
				'type' => 'VARCHAR',
				'constraint' => '225',
				'null' => TRUE,
			),
			'amount' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'null' => TRUE,				
			),
			'owing' => array(
				'type' => 'VARCHAR',
				'constraint' => '225',
				'null' => TRUE,
			),
			'payment_amount' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'null' => TRUE,
			),
			'disc_amount' => array(
				'type' => 'INT',
				'constraint' => '3',
				'null' => TRUE,
			),
			'status' => array(
				'type' => 'ENUM("Proses","Cair")',
				'null' => TRUE,
			)
		));
		$this->dbforge->add_key('id_pencairan', TRUE);
		$this->dbforge->create_table('pengajuan_cair');
	}

	public function down(){
		$this->dbforge->drop_table('pengajuan_cair', TRUE);
	}
}