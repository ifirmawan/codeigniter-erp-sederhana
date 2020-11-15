<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Install_permissions extends CI_Migration {
	
	

	public function __construct() {
		parent::__construct();
		
	}

	public function up() {
		// Drop table 'permission' if it exists
		$this->dbforge->drop_table('permissions', TRUE);

		// Table structure for table 'permission'
		$this->dbforge->add_field(array(
			'id_permission' => array(
				'type'           => 'BIGINT',
				'constraint'     => '20',
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			),
			'group_id' => array(
				'type'       => 'MEDIUMINT',
				'constraint' => '8',
				'unsigned'   => TRUE
			),
			'modul' => array(
				'type'       => 'VARCHAR',
				'constraint' => '175',
				'null'=>TRUE
			),
			'aksi' => array(
				'type'       => 'VARCHAR',
				'constraint' => '175',
				'null'=>TRUE
			),
			'created_at' => array(
				'type'=>'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
				'null'=>TRUE
			),
			'permission_status' => array(
				'type'       => 'ENUM("enable","disable")',
				'default' => 'enable'
			)
		));
		$this->dbforge->add_key('id_permission', TRUE);
		$this->dbforge->create_table('permissions');		
	}

	public function down() {
		$this->dbforge->drop_table('permissions', TRUE);
		
	}
}
