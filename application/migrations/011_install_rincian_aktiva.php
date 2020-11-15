<?php

/**
* 
*/
class Migration_Install_rincian_aktiva extends CI_Migration
{
	
	public function up()
	{
		$this->dbforge->drop_table('rincian_aktiva',true);

		$this->dbforge->add_field(array(
			'id_rincian' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'auto_increment' => TRUE
 			),
 			'id_permintaan' => array (
 				'type' => 'BIGINT',
 				'constraint' => '20',
 				'null' => true
 			),
 			'id_item' => array(
 				'type' => 'BIGINT',
 				'constraint' => '20',
 				'null' => TRUE
 			),
 			'jenis' => array(
 				'type' => 'VARCHAR',
 				'constraint' => '225',
 				'null' => TRUE
 			),
 			'type' => array(
 				'type' => 'VARCHAR',
 				'constraint' => '225',
 				'null' => TRUE
 			),
 			'untuk_lokasi' => array(
 				'type' => 'VARCHAR',
 				'constraint' => '225',
 				'null' => TRUE
 			),
 			'estimasi_biaya' => array(
 				'type' => 'BIGINT',
 				'constraint' => '20',
 				'null' => TRUE
 			),
 			'alasan' => array (
 				'type' => 'VARCHAR',
 				'constraint' => '225',
 				'null' => TRUE
 			),
 			'catatan' => array(
 				'type' => 'VARCHAR',
 				'constraint' => '225',
 				'null' => TRUE
 			)
		));

		$this->dbforge->add_key('id_rincian', TRUE);
		$this->dbforge->create_table('rincian_aktiva');
	}

	public function down()
	{
		$this->dbforge->drop_table('rincian_aktiva',true);
	}
}