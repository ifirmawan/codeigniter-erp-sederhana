<?php

/**
* 
*/

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel {
	
	protected $book = array();
	protected $ci;	

	function __construct()
	{
		$this->ci  =&get_instance();
	}

	public function read($file)
	{
		$finfo 	= new finfo(FILEINFO_MIME_TYPE);
		
		
		if (in_array($finfo->file($file), array(
			'application/octet-stream',
			'application/vnd.oasis.opendocument.spreadsheet',
        	'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
		))) {
			
			$reader 		= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			
			$worksheetData = $reader->listWorksheetInfo($file);
			foreach ($worksheetData as $worksheet) {
				$reader->setReadDataOnly(true);
				$reader->setLoadSheetsOnly($worksheet['worksheetName']);
				$spreadsheet 	= $reader->load($file);

				
				$catch 		= array();
				$heading 	= array();
				$rows 		= array();
				for ($n=1; $n <= $worksheet['totalRows']; $n++) {

					for($alfa = 'A';$alfa <= $worksheet['lastColumnLetter'] ; $alfa++){
						$key_cell 	= $alfa.$n;
						$cellValue 	= $spreadsheet->getActiveSheet()->getCell($key_cell)->getValue();
						if ($n != 1) {
							$heading 		= $spreadsheet->getActiveSheet()->getCell($alfa.'1')->getValue();
							$cellValue 		= trim($cellValue);
							if (!empty($cellValue)) {
								$catch[$heading] = $cellValue;
							}
						}
						
					}
					if ($catch) {
						$rows[] = $catch;
					}
				}
				if ($rows) {
					$tables 	= $this->ci->datatables->get_tables();
					$table_name = trim($worksheet['worksheetName']);
					$table_name = strtolower($table_name);

					if (in_array($table_name, $tables)) {
						$this->book[$table_name] = $rows;
					}else{
						$this->ci->template->set_alert('warning','sheet '.$table_name.' bukan nama tabel yang sah');	
					}

				}

			}
		}else{
			$this->ci->template->set_alert('warning','maaf, file hanya boleh berformat xlsx');
		}
		return $this;
	}
	
	public function insert_to_add()
	{
		
		if ($this->book) {
			$book_amount = count($this->book);
			$match 		 = 1;
			foreach ($this->book as $key => $value) {
				$config = $this->ci->config->item($key,'custom_records');
				if (is_array($value)) {
					$all 		= count($value);
					$success 	= 1;
					foreach ($value as $index => $data) {
						$exist_count  = 0;
						if (isset($config['unique'])) {
								$unique_column 	= $config['unique'];
								$exist 			= $this->ci->db->get_where($key,array(
									$unique_column => $data[$unique_column]
								));
							$exist_count = $exist->num_rows();
						}

						if ($exist_count == 0 ) {
							if ($this->ci->db->insert($key,$data)) {
								$success++;
							}
							
						}
					}
					if ($all == $success) {
						$match++;
					}else{
						$this->ci->template->set_alert('success','berhasil menambahkan '.$success.' data pada tabel '.$key);
					}
					
				}else{
					$this->ci->template->set_alert('danger','tidak ada data untuk disisipkan pada tabel '.$key
					);
				}
			}
			if ($match == $book_amount) {
				$this->ci->template->set_alert('success','import untuk menambahkan data berhasil :D');
			}else{
				$this->ci->template->set_alert('danger','import untuk menambahkan data gagal dilakukan :(');
			}
		}else{
			$this->ci->template->set_alert('warning','tidak ada data untuk disisipkan');
		}
	}

	public function insert_to_update()
	{

		if ($this->book) {
			$book_amount = count($this->book);
			$match 		 = 1;
			foreach ($this->book as $key => $value) {
				$config = $this->ci->config->item($key,'custom_records');
				if (is_array($value)) {
					$all 		= count($value);
					$success 	= 1;
					foreach ($value as $index => $data) {
						$exist 			= array();
						$exist_count  	= 0;
						$primary_key  	= $this->ci->datatables->get_primary_key($key);
						//(isset($config['primary_key']))? $config['primary_key'] : 'id';
						$primary_value	= '';

						if (isset($config['unique'])) {
							$unique_column 	= $config['unique'];
							$exist 			= $this->ci->db->get_where($key,array(
									$unique_column => $data[$unique_column]
							));
							if ($exist->num_rows() > 0) {
								$details 		= $exist->row();
								$primary_value 	= $details->$primary_key;
							}
						}elseif (isset($config['primary_key']) && isset($data[$config['primary_key']])) {
							$primary_value = $data[$config['primary_key']];
							unset($data[$config['primary_key']]);
						}
						$this->ci->db->where($primary_key,$primary_value);
						if ($this->ci->db->update($key,$data)) {
							$success++;
						}

					}
					if ($all == $success) {
						$match++;
					}else{
						$this->ci->template->set_alert('danger','berhasil menambahkan '.$success.' data pada tabel '.$key);
					}
					
				}else{
					$this->ci->template->set_alert('warning','tidak ada data untuk disisipkan pada tabel '.$key);
				}
			}
			if ($match == $book_amount) {
				$this->ci->template->set_alert('success','import untuk memperbaharui berhasil :D');
			}else{
				$this->ci->template->set_alert('danger','import untuk memperbaharui gagal dilakukan :(');
			}
		}else{
			$this->ci->template->set_alert('warning','tidak ada data untuk disisipkan');
		}
	}

	public function create_format($table_name='',$fields=array())
	{
		$tables = $this->ci->datatables->get_tables();
		if (in_array($table_name, $tables)) {
			$heading = $this->ci->db->list_fields($table_name);
			if ($fields) {
				$heading = $fields;
			}
			if ($heading) {
				$spreadsheet 	= new Spreadsheet();
				// Create a new worksheet called "My Data"
				$myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet($spreadsheet, $table_name);

				// Attach the "My Data" worksheet as the first worksheet in the Spreadsheet object
				$spreadsheet->addSheet($myWorkSheet, 0);
				$sheet 			= $spreadsheet->getSheetByName($table_name);//$spreadsheet->getActiveSheet();
				$alfa 			= 'A';
				foreach ($heading as $key => $value) {
					$key_cell 	= $alfa."1";
					$sheet->setCellValue($key_cell, $value);
					$alfa++;
				}
				$writer = new Xlsx($spreadsheet);
				try {
					if ($writer->save('format_data_'.$table_name.'.xlsx')) {
						return true;
					}
					return true;
				}catch(\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
    				
    				// $this->ci->template->set_alert('warning'array(
    				//	'status'=>'danger',
    				//	'alert'=>'Error loading file: '.$e->getMessage()
    				//));
				}
			}
		}else{
			return false;
		}

	}

}