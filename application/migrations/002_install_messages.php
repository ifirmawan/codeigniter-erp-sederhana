<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Install_messages extends CI_Migration {
	
	

	public function __construct() {
		parent::__construct();
		
	}

	public function up() {
		// Drop table 'messages' if it exists
		$this->dbforge->drop_table('messages', TRUE);

		// Table structure for table 'messages'
		$this->dbforge->add_field(array(
			'id' => array(
				'type'           => 'BIGINT',
				'constraint'     => '20',
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			),
			'to_id' => array(
				'type'       => 'BIGINT',
				'constraint' => '20',
				'null'=>TRUE
			),
			'from_id' => array(
				'type'       => 'BIGINT',
				'constraint' => '20',
				'null'=>TRUE
			),
			'message' => array(
				'type'       => 'TEXT',
				'null'=>TRUE
			),
			'created_at' => array(
				'type'=>'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
				'null'=>TRUE
			),
			'read_status' => array(
				'type'       => 'ENUM("1","0")',
				'default' => '0'
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('messages');		
	}

	public function down() {
		$this->dbforge->drop_table('messages', TRUE);
		
	}
}
