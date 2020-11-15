<?php defined('BASEPATH') OR exit ('No direct script access allowed');

/**
* 
*/
class Migration_Install_notification extends CI_Migration
{
	public function up()
	{
		$this->dbforge->drop_table('notification',TRUE);

		$this->dbforge->add_field(array(
			'id_notification' 	=> array(
				'type'			=> 'BIGINT',
				'constraint'	=> '20',
				'auto_increment'=> TRUE
			),
			'id_permintaan'		=> array(
				'type'			=> 'BIGINT',
				'constraint'	=> '20',
				'null'			=> TRUE
			),
			'notifikasi_dari'	=> array(
				'type'			=> 'BIGINT',
				'constraint'	=> '20',
				'null'			=> TRUE,
			),
			'notifikasi_untuk'	=> array(
				'type'			=> 'BIGINT',
				'constraint'	=> '20',
				'null'			=> TRUE
			),
			'pesan_notifikasi'	=> array(
				'type'			=> 'VARCHAR',
				'constraint'	=> '225',
				'null'			=> TRUE
			),
			'status'			=> array(
				'type'			=> 'ENUM("Dibaca","Belum")',
				'default'		=> "Belum"
			)
		));

		$this->dbforge->add_key('id_notification',TRUE);
		$this->dbforge->create_table('notification');
	}

	public function down()
	{
		$this->dbforge->drop_table('notification',TRUE);
	}
}