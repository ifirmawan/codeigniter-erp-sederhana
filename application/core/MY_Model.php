<?php

/**
* 
*/
require_once 'Jamie_Model.php';

class MY_Model extends Jamie_Model
{
	/**
	 * [$list_join larik pernyataan perintah join sql]
	 * @var array
	 */
	public $list_join;
	/**
	 * [$column larik daftar kolom dari table yang sedang digunakan]
	 * @var [array]
	 */
	public $column;
	/**
	 * [$condition larik pernyataan kondisi perintah join sql]
	 * @var array
	 */
	public $condition = array();
	/**
	 * [$select_join pernyataan perintah sql untuk meyeleksi kolom yang akan digunakan]
	 * @var [type]
	 */
	protected $select_join;
	/**
	 * [$from_join pernyataan perintah ]
	 * @var [string]
	 */
	protected $from_join;
	
	function __construct()	
	{
		parent::__construct();
		/**
		 * [$this->column mengisikan default column dari fields table yang sedang digunakan]
		 * @var [type]
		 */
		$this->column = $this->db->list_fields($this->_table);
	}
	/**
	 * [check_query_statement memeriksa isi pernyataan query terakhir yang dijalankan]
	 * @return [string] [pernyataan sql]
	 */
	public function check_query_statement()
	{
		return $this->db->last_query();
	}
	/**
	 * [set_query_like membuat pernyataan perintah like dalam pencarian data pada tabel]
	 */
	public function set_query_like()
	{
		$find		='';//default empty 
		$this->_database->query(" SET collation_connection = 'utf8_general_ci'"); //mengurangi resiko gagal pada perintah like
		if (isset($_REQUEST['searchPhrase'])) {//jika menggunakan request jquerybootgrid
			$find 	= $_REQUEST['searchPhrase'];//ambil data keyword dari pengguna
		}
		if (isset($_POST['search'])) { //jika menggunakan request datatables
			$query 	= $_POST['search'];
			$find 	= $query['value'];//ambil data keyword dari pengguna
		}
		$find		= trim($find); //menghilangkan spasi kosong dengan trim
		if (isset($find) && !empty($find)) {//
			foreach ($this->column as $key => $item) {
				if ($item !='id') { //selain column id
					//memisahkan kolom pertama yang menggunakan syntax like dengan syntax selanjutnya menggunakan or like.
					($key == 1 )? $this->_database->like($item, $find) : $this->_database->or_like($item, $find); 
				}
			}
		}
	}
	/**
	 * [set_query_limit membuat query untuk membuat halaman pada tampilan tabel]
	 */
	public function set_query_limit()
	{
		$page 			= 1;
		if (isset($_POST['length']) && isset($_POST['start'])) {
			if($_POST['length'] != -1)
				$this->_database->limit($_POST['length'], $_POST['start']);
		}elseif (isset($_REQUEST['current']) && isset($_REQUEST['rowCount']))  {
			$limit 		= $_REQUEST['rowCount'];
			$page 		= $_REQUEST['current'];
			$start_from = ($page-1) * $limit;
			if($limit != -1)
				$this->_database->limit($limit,$start_from);
		}
	}
	/**
	 * [show_all query select yang dapat digunakan sebagai resource datatables atau jquerybootgrid.]
	 * @return [array] [larik semua data]
	 */
	public function show_all()
	{
		$this->set_query_like();
		$this->set_query_limit();
		return $this->as_array()->get_all();
	}
	/**
	 * [get_join description]
	 * @param  string $output [description]
	 * @return [type]         [description]
	 */
	public function get_join($output = 'result_array')
	{

		$join_table = $this->config->item('table')['join'];
		$select 	= (is_null($this->select_join))? '*' 		: $this->select_join;
		$from 		= (is_null($this->from_join))? $this->_table 	: $this->from_join;
		$this->db->select($select);
		$this->db->from($from);
		if ($this->condition) {
			$this->db->where($this->condition); //
		}
		if ($this->list_join) {
			foreach ($this->list_join as $key => $value) {
				if (in_array($key, $join_table)) {
					$this->db->join($key,$value);
				}
			}
		}
		return $this->db->get()->$output();
	}

	/**
	 * [get_enum_values ambil isi data pada kolom yang bertype ENUM]
	 * @param  [string] $field [nama kolom yang bertype ENUM]
	 * @return [array] [data]
	 */
	public function get_enum_values($field)
	{
		$query = $this->db
			->query( "SHOW COLUMNS FROM ".$this->db->dbprefix."{$this->_table} WHERE Field = '{$field}'" )
			->row(0);
		if (!is_null($query)) {
			$type = $query->Type;
			preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches); //mengekstraksi data enum dari kolom
			$enum = explode("','", $matches[1]);//memecah hasil ekstrasi dengan koma untuk mendapatkan nilai enumnya.
			return $enum;
		}
		return false;
	}
	

	public function last_id()
	{
		$db_name = $this->_database->database;
		$sql 	 = "SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$db_name' AND   TABLE_NAME   = '".$this->_table."';";
		$result = $this->_database->query($sql)->row();
		if (!is_null($result->AUTO_INCREMENT)) {
			return intval($result->AUTO_INCREMENT);
		}else{
			return 1;	
		}
		
	}

	public function get_type_data($column='')
	{
		$query ="SELECT DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '";
		$query .=$this->_table."' AND COLUMN_NAME = '".$column."';";
		return $this->db->query($query)->result_array();
	}

	public function set_creator($data=array())
	{
		if (isset($this->logged_in['user_id'])) {
			$creteria = array(
				'dibuat_oleh_id'
				,'id_tanggapi_oleh'
				,'id_user'
				,'proyek_dari_id'
				,'id_pembuat'
			);
			foreach ($this->column as $key => $value) {
				if (in_array($value, $creteria)) {
					$data[$value] = $this->logged_in['user_id'];
				}
			}
		}
		return $data;
	}
}