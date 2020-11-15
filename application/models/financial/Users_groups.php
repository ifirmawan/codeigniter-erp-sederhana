<?php

/**
* 
*/
class Users_groups extends MY_Model
{
	public $return_type = 'array';
	public $primary_key = 'id_rincian';
	function __construct()
	{
		parent::__construct();

	}

	public function get_departement($user_id)
	{
		$query =  $this->db->query('SELECT groups.description FROM groups INNER JOIN users_groups ON groups.id = users_groups.group_id INNER JOIN users ON users.id = users_groups.user_id WHERE groups.description = "Kepala Departement" AND users.id='.$user_id);
		return $query;

	}

	public function get_direksi($user_id)
	{
		return $this->db->query('SELECT groups.description FROM groups INNER JOIN users_groups ON groups.id = users_groups.group_id INNER JOIN users ON users.id = users_groups.user_id WHERE groups.description = "Direksi" AND users.id='.$user_id);
	}

	public function get_administrstor($user_id)
	{
		return $this->db->query('SELECT groups.description FROM groups INNER JOIN users_groups ON groups.id = users_groups.group_id INNER JOIN users ON users.id = users_groups.user_id WHERE groups.description = "Administrator" AND users.id='.$user_id);
	}

	public function get_general_user($user_id)
	{
		return $this->db->query('SELECT groups.description FROM groups INNER JOIN users_groups ON groups.id = users_groups.group_id INNER JOIN users ON users.id = users_groups.user_id WHERE groups.description = "General User" AND users.id='.$user_id);
	}
	public function get_affair($user_id)
	{
		return $this->db->query('SELECT groups.description FROM groups INNER JOIN users_groups ON groups.id = users_groups.group_id INNER JOIN users ON users.id = users_groups.user_id WHERE groups.description = "General Affair" AND users.id='.$user_id);
	}

	public function get_finance($user_id)
	{
		return $this->db->query('SELECT groups.description FROM groups INNER JOIN users_groups ON groups.id = users_groups.group_id INNER JOIN users ON users.id = users_groups.user_id WHERE groups.description = "Finance" AND users.id='.$user_id);
	}

	public function get_user_data($id)
	{
		return $this->db->query('SELECT * FROM users WHERE users.id='.$id);
	}

	public function get_group($id)
	{
		return $this->db->query('SELECT groups.description from users LEFT JOIN users_groups ON users.id = users_groups.user_id LEFT JOIN groups ON users_groups.group_id = groups.id WHERE users.id='.$id);
	}
}