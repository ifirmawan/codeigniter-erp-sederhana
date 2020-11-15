<?php defined('BASEPATH') OR exit ('No direct script access allowed');

/**
* 
*/
class Migration_Install_message extends CI_Migration
{
	public function up()
	{
		$this->dbforge->drop_table('message',TRUE);

		$this->dbforge->add_field(array(
			'id' 	=> array(
				'type'			=> 'BIGINT',
				'constraint'	=> '20',
				'auto_increment'=> TRUE
			),
			'name' => array(
				'type'			=> 'VARCHAR',
				'constraint'	=> '125',
				'null'			=> TRUE
			),
			'email'	=> array(
				'type'			=> 'VARCHAR',
				'constraint'	=> '175',
				'null'			=> TRUE,
			),
			'subject'	=> array(
				'type'			=> 'VARCHAR',
				'constraint'	=> '175',
				'null'			=> TRUE
			),
			'message'	=> array(
				'type'			=> 'VARCHAR',
				'constraint'	=> '225',
				'null'			=> TRUE
			),
			'created_at'	=> array(
				'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
			),
			'status'			=> array(
				'type'			=> 'ENUM("Dibaca","Belum")',
				'default'		=> "Belum"
			)
		));

		$this->dbforge->add_key('id',TRUE);
		$this->dbforge->create_table('message');
	}

	public function down()
	{
		$this->dbforge->drop_table('message',TRUE);
	}
}