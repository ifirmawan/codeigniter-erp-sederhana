<?php
/**
* 
*/
class Users extends MY_Model
{
	public $return_type = 'array';	
	public $after_get 	= array('forbidden_to_shown');
	
	function __construct()
	{
		parent::__construct();
		
	}

	public function forbidden_to_shown($users){
		$data = array('password','ip_address','forgotten_password_code','remember_code','salt','forgotten_password_time');
		foreach ($data as $key => $value) {
			
			if (isset($users[$value]) && !is_object($users)) {
				
				unset($users[$value]);
			}
			
		}
		return $users;
	}

	public function join_with_groupname()
	{
		$fields 		= array('gl_users.id','gl_users.created_on','gl_users.username','gl_users.email','gl_users.phone','gl_groups.name AS user_role');
		$this->column 		= array_merge(array('name'),$this->column);
		$this->_database->select($fields);
		$this->set_query_limit();
		$this->set_query_like();
		$this->_database->from('users_groups');
		$this->_database->join('users', 'gl_users.id = gl_users_groups.user_id');
		$this->_database->join('groups', 'gl_groups.id = gl_users_groups.group_id');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_by_join_groups()
	{
		$sql 	= 'SELECT groups.name, users.* FROM users,groups,users_groups ';
		$sql 	.= 'WHERE users_groups.user_id = users.id AND  ';
		$sql 	.= 'users_groups.group_id = groups.id ';
		$query 	= $this->_database->query($sql);
		$send 	= array();
		if ($query->num_rows() > 0) {
			$this->column 	= $query->list_fields();
			$send 			= $query->result_array();
		}
		return $send;
	}
	
}