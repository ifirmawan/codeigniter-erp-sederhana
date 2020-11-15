<?php


function tautan_berkas($id,$kolom='tautan_berkas',$output=false)
{
	$ci =&get_instance();
	$ci->load->model('berkas');
	$link	= '';
	$data 	= $ci->berkas->get($id);
	if (!is_null($data)) {
		$link ='<a href="'.$data[$kolom].'" target="blank">'.$data[$kolom].'</a>';
	}
	if ($output) {
		return $data[$kolom];
	}else{
		echo $link;
	}
}





function get_audit_value($id_post,$id_seeker)
{
	$ci =&get_instance();
	$where = array(
		'id_post' =>$id_post,
		'id_seeker'=>$id_seeker
	);
	$query = $ci->db->get_where('post_audit',$where);
	if ($query->num_rows() > 0) {
		$data = $query->row();
		if (isset($data->penilaian)) {
			return $data->penilaian;
		}
	}
	return 0;
}


	function set_datatables_column($field='')
	{
    	if (!empty($field)) {
        	$field = str_replace(array('proyek_','quotation_','_'), array('','',' '), $field);
        	$field = strtoupper($field);
        	return $field;
    	}
	}

	function set_datatables_action($action=array(),$_id=0,$value=array())
	{
		$color = array('default','primary','warning','info');
		
		if (isset($action) && $action) {
		 				
		 				$button_action 	= '<div class="btn-group btn-group-xs" role="group" >';
		 				$x 				= 0;

		 				foreach ($action as $label => $url) {

		 					$btn_color  = 'btn btn-';

		 					if (isset($color[$x])) {
		 						$btn_color.=$color[$x];
		 					}else{
		 						$btn_color.=$color[0];
		 					}

		 					if (is_array($url)) {
		 						if (isset($value[$label])) {
		 							$value_condition = $value[$label];
		 							if (isset($url[$value_condition])) {
		 								if (is_array($url[$value_condition])) {
		 									$collection = $url[$value_condition];
		 									foreach ($collection as $index => $data) {
		 										$button_action .= anchor(
		 												$data.$_id
		 												,ucfirst($index)
		 												,array(
		 													'class'=>$btn_color
		 												)
		 											);
		 									}
		 								}
		 							}
		 						}
		 						
		 					}elseif ($label == 'hapus' || $label =='delete') {
		 						$button_action .= anchor(
		 							$url.$_id
		 							,ucfirst($label)
		 							,array('class'=>'btn btn-danger btn-confirm-link')
		 						);
		 					}else{
		 						$button_action .= anchor(
		 							$url.$_id
		 							,ucfirst($label)
		 							,array('class'=>$btn_color)
		 						);
		 					}
		 					$x++;
		 				}

		 				if (isset($value['url_post'])) {
		 					$button_action .= anchor($value['url_post'],'pratinjau ',array(
		 						'target'=>'_blank',
		 						'class'=>'btn btn-xs btn-primary'
		 					));
		 				}
		 				$button_action .='</div>';
		 				echo $button_action;
		}
	}


	function get_controllers_names()
	{
		$files =  get_files_in(APPPATH.'controllers');
		$names = array();
		if ($files) {
			foreach ($files as $key => $name) {
				$names[] = removeFromEnd($name,'.php');
			}
		}
		return $names;
	}

	function get_data_type($table_name='',$column='')
	{
		$ci =&get_instance();
		$models = get_files_in(APPPATH.'models');
		if (in_array($table_name.'.php', $models)) {
			$ci->load->model($table_name);
			if ($data = $ci->$table_name->get_type_data($column)) {
				if (isset($data[0]) && isset($data[0]['DATA_TYPE'])) {
					$type = $data[0]['DATA_TYPE'];
					if ($type == 'enum') {
				return $ci->$table_name->get_enum_values($column);
					}
					return $type;
				}
			}
		}else{
			$query 	="SELECT DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '";
			$query .=$table_name."' AND COLUMN_NAME = '".$column."';";
			$data 	= $ci->db->query($query)->row();
			
			if (!is_null($data)) {
				
				$type = $data->DATA_TYPE;
				
				if ($type == 'enum') {
					
					$sql 	="SHOW COLUMNS FROM ".$ci->db->dbprefix."{$table_name} WHERE Field = '{$column}'";
					
					$query2 = $ci->db->query($sql)->row(0);

					if (!is_null($query2)) {
						$type2 = $query2->Type;

						preg_match("/^enum\(\'(.*)\'\)$/", $type2, $matches); 

						$enum = explode("','", $matches[1]);
						return $enum;
					}
				}else{
					return $type;
				}
			}
		}		
	}

	function get_last_uri()
	{
		$ci 			=&get_instance();
		$list_uri 		= $ci->uri->segment_array();
		$last_uri 		= end($list_uri); 
		return $last_uri;
	}

	function get_menu_by_current_user(){
		$ci 			=&get_instance();
  		$send 			= array();
  		if ($ci->logged_in) {
  			if(in_array('group_id',array_keys($ci->logged_in))) {
				$menu 		= $ci->config->item('menu','custom_template');
				$group_id 	= $ci->logged_in['group_id']-1;
				if (isset($menu[$group_id])) {
					$send 	= $menu[$group_id];
				}
			}
  		}
		return $send;
  	}

	function render_top_navigation($data=array()){
		$ci 		=&get_instance();
		$me 		= $ci->router->fetch_class();
		$last_uri 	= get_last_uri();
		
		$ci->load->library('datatables');

		if (isset($data) && $last_uri ) {
			if ($data) {
				$nav     ='';
				foreach ($data as $key => $value) {
					$explode  = explode('/', $value);
					$method   = $explode[0];

					$tables = $ci->datatables->get_tables();
					if (in_array($method, $tables)) {
						$controller = $me.'/daftar/'.$method;
					}else{
						if ($ci->logged_in) {
							$me = $ci->logged_in['is'];
						}
						$controller = $me.'/'.$method;
					}
					if (isset($explode[1])) {
                        $method   = $explode[1];
                        $controller = $explode[0].'/'.$method;

					}
					$label = str_replace('_', ' ', $method);
					$label = ucwords($label);
					$nav   .= '<li > ';
					if ($last_uri == $method) {
                          $nav   .= '<li class="active"> ';
					}
					$nav .= anchor($controller,$label,array('class'=>''));
					$nav .= '</li> ';
                }
                echo $nav;
			}
		}
	}

	function set_class_name(&$item,$key)
	{
		$item = str_replace(array('.php','_'), array('',' '), $item);
		return $item;
	}



