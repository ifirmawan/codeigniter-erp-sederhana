<?php

/**
* 
*/
class Notification extends MY_Model
{
	public $return_type = 'array';
	public $primary_key = 'id_notifikasi';

	function __construct()
	{
		parent::__construct();

	}

	public function get_notifikasi($user_id)
	{
		return $this->db->query('SELECT notification.*, users.username FROM notification JOIN users ON notification.notifikasi_dari = users.id WHERE notification.notifikasi_untuk='.$user_id.' ORDER BY id_notification DESC LIMIT 3');
	}

	public function get_belum_dibaca($user_id)
	{
		return $this->db->query('SELECT notification.*, users.username FROM notification JOIN users ON notification.notifikasi_dari = users.id WHERE notification.status="Belum" AND notification.notifikasi_untuk='.$user_id.' ORDER BY id_notification DESC');
	}

	public function get_dibaca($user_id)
	{
		return $this->db->query('SELECT * FROM notification WHERE status="Dibaca" AND notifikasi_untuk='.$user_id.' ORDER BY id_notification DESC');
	}

	public function get_username($user_id)
	{
		return $this->db->query('SELECT username FROM users WHERE id='.$user_id);
	}

	public function update_notification($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}



}