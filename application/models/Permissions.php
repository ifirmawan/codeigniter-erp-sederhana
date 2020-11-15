<?php
/**
* 
*/
class Permissions extends MY_Model
{
	public $primary_key = 'id_permission';

	
	function __construct()
	{
		parent::__construct();
		
	}

	public function get_by_groups()
	{
		$this->db->select(array(
				$this->_table.'.id_permission',
				'groups.name AS group user',
				$this->_table.'.modul',
				$this->_table.'.aksi',
				$this->_table.'.permission_status'
			));
		$this->db->from($this->_table);
		$this->db->join('groups',$this->_table.'.group_id =  groups.id','left');

		return $this->db->get()->result_array();
	}
	
}