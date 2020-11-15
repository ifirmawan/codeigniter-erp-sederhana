<?php
/**
* 
*/

class Datatables 
{
	protected $sources = array();
	protected $columns = array();
	protected $table_name;
	protected $ci;


	function __construct()
	{
		//parent::__construct();
		$this->ci =&get_instance();
	}

	public function get_tables()
	{
		$records 		= $this->ci->db->query('SHOW TABLES')->result_array();
		$key_record 	= 'Tables_in_'.$this->ci->db->database;
		$tables 		= array();
		if ($records) {
			foreach ($records as $key => $value) {
				$tables[] 	= $value[$key_record];
			}
		}
		return $tables;
	}

	public function set_sources($table_name='users',$method_model='get_all',$param='')
	{
		
		$tables = $this->get_tables();
		$models = get_files_in(APPPATH.'models');
		if (in_array($table_name, $tables)) {
			

			$this->table_name 	= $table_name;

			$this->columns  	= $this->ci->db->list_fields($table_name);
			$this->sources 		= $this->ci->db->get($table_name)->result_array();
			if (in_array($table_name.'.php', $models)) {
				$this->ci->load->model($table_name);
				$this->table_name 	= $table_name;
				$this->sources 		= $this->ci->$table_name->$method_model($param);
				$this->columns  	= $this->ci->$table_name->column;
				
				
			}
		}
		
		return $this;
	}


	public function show()
	{
		$config					= $this->ci->config->item($this->table_name,'custom_records');
		if ($config) {
			$data 				= $config;
		}
		$data['columns'] 		= $this->columns;
		$data['sources'] 		= $this->sources;
		$data['table_name']		= $this->table_name;
		$data['primary_key'] 	= $this->get_primary_key($this->table_name);
		$data['me'] 			= $this->ci->router->fetch_class();
		$data['alert']			= $this->ci->session->flashdata('alert'); 
		
		if (function_exists('get_menu_by_current_user')) {
			$data['navigasi']	= get_menu_by_current_user();
		}


		if ($this->ci->logged_in) {
			$data = array_merge($data,$this->ci->logged_in);
			if (isset($this->ci->logged_in['group_id'])) {

			$data['group_id'] 	= $this->ci->logged_in['group_id'];
			if (isset($data['toolbar'])) {
				$toolbar 		= $data['toolbar'];
				
				if (isset($toolbar[$data['group_id']])) {
					$tools 		 	= $toolbar[$data['group_id']];
					$data['tools'] 	= $tools;
					}
				}
			}
		}

		
		$this->ci->load->view('ui_datatables',$data);
		
	}


	public function update($table_name='',$id='',$data=array())
	{
		
		$config 		= $this->ci->config->item($table_name,'custom_records');
		$primary_key 	= $this->get_primary_key($table_name);
		//(isset($config['primary_key']))? $config['primary_key'] : 'id';
		$models 		= get_files_in(APPPATH.'models');
		
		if (in_array($table_name.'.php', $models)) {
			
			$this->ci->load->model($table_name);
			
			if (in_array($primary_key, $this->ci->$table_name->column)) {
				$this->ci->$table_name->primary_key = $primary_key;
			}

			return $this->ci->$table_name->update($id,$data);

		}else{

			return $this->ci->db->update($table_name,array($primary_key => $id),$data);

		}
		return false;
	}

	public function insert($table_name='',$data=array())
	{
		$models = get_files_in(APPPATH.'models');
		if (in_array($table_name.'.php', $models)) {
			$this->ci->load->model($table_name);
			return $this->ci->$table_name->insert($data);
		}else{
			$this->ci->db->insert($table_name,$data);
			return $this->ci->db->insert_id();
		}
	}
		
	

	public function delete($table_name='',$id='')
	{
		
		$config 		= $this->ci->config->item($table_name,'custom_records');
		$primary_key 	= $this->get_primary_key($table_name);
		//(isset($config['primary_key']))? $config['primary_key'] : 'id';
		$models 		= get_files_in(APPPATH.'models');
		
		if (in_array($table_name.'.php', $models)) {
			$this->ci->load->model($table_name);
			return $this->ci->$table_name->delete($id);
		}else{
			return $this->ci->db->delete($table_name,array($primary_key => $id));
		}
		return false;
	}

	public function get_details($table_name='',$id='')
	{
		$data 				= array();
		$config 			= $this->ci->config->item($table_name,'custom_records');
		
		$primary_key 		= $this->get_primary_key($table_name);
		
		$data['primary_key']= $primary_key;
		$data['table_name'] = $table_name;
		$models 			= get_files_in(APPPATH.'models');
		if (in_array($table_name.'.php', $models)) {
			$this->ci->load->model($table_name);
			if (in_array($primary_key, $this->ci->$table_name->column)) {
				$this->ci->$table_name->primary_key = $primary_key;
			}
			$data['detail'] = $this->ci->$table_name->get($id);
			$data['fields'] = $this->ci->$table_name->column;
		}else{
			$data['detail'] = $this->ci->db->get_where($table_name,array($primary_key => $id))->row();
			$data['fields'] = $this->ci->db->list_fields($table_name);
		}	
		
		if (isset($config['input'])) {
			$data['fields'] = $config['input'];
		}

		return $data;
	}

	public function get_primary_key($table_name='')
  	{
  		$tables = $this->get_tables();
  		if (in_array($table_name, $tables)) {
  			$query 	= "SHOW KEYS FROM $table_name WHERE Key_name = 'PRIMARY'";
  			$result = $this->ci->db->query($query)->row();
  			if ($result) {
  				return $result->Column_name;
  			}
  		}
  		return false;
  	}
	
}