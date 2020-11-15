<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Install_keys extends CI_Migration {

	public function up()
	{
		// Drop table 'keys' if it exists
		// $this->dbforge->drop_table('keys', TRUE);
		
		// Table structure for table 'keys'
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'auto_increment' => TRUE
			),
			'id_user' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'null'=>TRUE
			),
			'key' => array(
				'type' => 'TEXT',
				'null' => TRUE,
			),
			'level' => array(
				'type' => 'INT',
				'constraint' => '2',
				'null'=>TRUE
			),
			'ignore_limits' => array(
				'type' => 'tinyint',
				'constraint' => '1',
				'null'=>TRUE
			),
			'is_private_key' => array(
				'type' => 'tinyint',
				'constraint' => '1',
				'null'=>TRUE
			),
			'ip_addresses' => array(
				'type' => 'text',
				'null'=>TRUE
			),
			'date_created' => array(
				'type' => 'TIMESTAMP',
				'null' => TRUE,
			)

		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('keys', TRUE);

		$data = array(
			'id_user'=>'1',
			'key'=>'W1th0utLo993d1n',
			'level'=>11,
			'is_private_key'=>true,
			'ip_addresses' => (isset($_SERVER['REMOTE_ADDR']))? $_SERVER['REMOTE_ADDR'] : 'http://127.0.0.1'
		);

		$this->db->insert('keys',$data);

	}

	public function down()
	{
		$this->dbforge->drop_table('keys', TRUE);
	}
}
