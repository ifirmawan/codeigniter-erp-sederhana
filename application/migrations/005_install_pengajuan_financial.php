<?php defined('BASEPATH') OR exit ('No direct script access allowed');

/**
* 
*/
class Migration_Install_pengajuan_financial extends CI_Migration
{
	
	public function up()
	{
		$this->dbforge->drop_table('pengajuan_financial', TRUE);
		$this->dbforge->add_field(array(
			'id_pengajuan' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'auto_increment' => TRUE
			),
			'id_item' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'null' => TRUE
			),
			'po_number' => array(
				'type' => 'VARCHAR',
				'constraint' => '75',
				'null' => TRUE,
			),
			'po_date' => array(
				'type' => 'DATE',
				'null' => TRUE
			),
			'vendor' => array(
				'type' => 'VARCHAR',
				'constraint' => '225',
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
				'null' => TRUE
			),
			'qty' => array(
				'type' => 'VARCHAR',
				'constraint' => '175',
				'null' => TRUE
			),
			'satuan' => array(
				'type' => 'ENUM("Rupiah","Unit","Pcs")',
				'null' => TRUE
			),
			'unit_price' => array(
				'type' => 'BIGINT',
				'constraint' => '25',
				'null' => TRUE
			),
			'disc' => array(
				'type' => 'BIGINT',
				'constraint' => '3',
				'null' => TRUE
			),
			'amount' => array(
				'type' => 'BIGINT',
				'constraint' => '20',
				'null' => TRUE
			),
			'status' => array(
				'type' => 'ENUM("Diajukan","Direvisi","Diterima","Ditolak","Cair")',
				'default' => "Diajukan"
			),
			'catatan' => array(
				'type' => 'VARCHAR',
				'constraint' => '225',
				'null' => TRUE
			),
			'teruskan' => array(
				'type' => 'ENUM("Ya", "Tidak")',
				'default' => "Tidak"
			)
		));
		$this->dbforge->add_key('id_pengajuan', TRUE);
		$this->dbforge->create_table('pengajuan_financial');
	}

	public function down(){
		$this->dbforge->drop_table('pengajuan_financial', TRUE);
	}
}
