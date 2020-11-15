<?php

/**
* 
*/
require APPPATH.'third_party/api/Rest_Controller.php';

class Grid_Controller extends Rest_Controller
{
	public $resource;

	function __construct()
	{
		parent::__construct();
	}
	/**
	 * [set_resource_grid description : Membuat data berformat Json yang mendukung permintaan Jquerybootrid]
	 * @see http://jquerybootgrid.com [Jquery plug-in untuk menampilkan data dalam bentuk tabel dan memiliki jumlah yang cukup besar]
	 * @param string  $model  [nama file dalam folder models]
	 * @param string  $method [nama method yang sesuai dengan model yang digunakan]
	 * @param boolean $id     [berisi benar jika ingin menampilkan data berdasarkan id / primary key]
	 */
	protected function set_resource_grid($model = NULL,$method ='show_all',$id=FALSE)
	{
		$this->load->model($model);
		if (isset($_REQUEST['sort']) && isset($_REQUEST['searchPhrase'])) {
			$column = array_keys($_REQUEST['sort'])[0];
			$type 	= $_REQUEST['sort'][$column];
			if (in_array($column, $this->$model->column)) {
				$this->db->order_by($column,$type);
			}
		}
		$rows				= $this->$model->$method($id);
		$table_name 		= $this->$model->_table;
		$data['current'] 	= (isset($_REQUEST['current']))? intval($_REQUEST['current']) : 1;
		$data['rowCount']	= count($rows);
		$data['rows']		= $rows;
		$data['total']		= $this->db->count_all_results($table_name);
		$this->resource 	= $data;	
	}

	protected function set_resource_json($data=array())
	{
		$this->resource 	= $data;
	}

	protected function export($type = 'json')
	{
		$this->response($this->resource);
	}

}