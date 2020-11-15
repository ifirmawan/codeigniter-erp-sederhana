<?php

	function get_files_in($path)
	{
		$data = scandir($path);
		$send = array();
		if ($data) {
			$unset_list 	= array('.','..','index.html');
			foreach ($data as $key => $name) {
				if (in_array($name, $unset_list)) {
					unset($data[$key]);
				}else{
					$send[] = strtolower($name);
				}

			}
		}
		return $send;
	}

	function removeFromEnd($string, $stringToRemove) {
    	$stringToRemoveLen 	= strlen($stringToRemove);
    	$stringLen 			= strlen($string);
    	$pos 				= $stringLen - $stringToRemoveLen;
    	$out 				= substr($string, 0, $pos);
    	return $out;
	}

	

	function get_interval_week($amount=1)
	{
		for ($i=1; $i <= $amount; $i++) { 
			$counter 			= 7 * $i;
			$saturdaytimestamp 	= strtotime("last Saturday");
			$saturdaytimestamp 	= strtotime("+$counter days", $saturdaytimestamp);
			$mondaytimestamp 	= strtotime("-5 days",$saturdaytimestamp);
			$send[] = array(
				'begin' => date('Y-m-d',$mondaytimestamp)
				,'end' => date('Y-m-d',$saturdaytimestamp)
			);
		}
		
		return $send;
	}


	function render_input_html($type='',$name='',$data='')
	{
		$input 			= '';
		$input_class 	= '';
		
		
		if (is_array($type)) {
				$count 	= count($type);
				$input 	.='<br/>';
				$select = '<select name="'.$name.'" class="form-control" value="'.$data.'">';
				$select .= '<option value="0">'.ucfirst('pilih salah satu').'</option>';
				foreach ($type as $index => $option) {
			if ($count == 1) {
				$input .= '<input type="checkbox" name="'.$name.'" value="'.$option.'" ';
				$input .= ($data == $option)? ' checked="checked" />' : ' />';
				$input .= '&nbsp;'.ucwords($option);
			}elseif ($count > 1 && $count <= 3) {
				$input .= '<input type="radio" name="'.$name.'" value="'.$option.'" ';
				$input .= ($data == $option)? ' checked="checked" />' : ' />';
				$input .= '&nbsp;'.ucwords($option);
			}else{

				if ($data == $option) {
					$select .='<option value="'.$option.'" selected>';
				}else{
					$select .='<option value="'.$option.'">';
				}
				$select .= ucfirst($option);
				$select .='</option>';
			}
				}
				if ($count > 3) {
			$select .='</select>';
			$input .=  $select;
				}
		}elseif (strpos($name,'id_') !== false) {
			
			$input .='<input type="hidden" class="form-control" value="'.$data.'" name="'.$name.'">';

		}
		elseif (in_array($name, array('surat_permintaan'))) {
			$input .='<input type="file" class="form-control" value="'.$data.'" name="berkas"/>';
		}else{
			
			
			$input_class = 'form-control';

			switch ($type) {
				case 'text':
					$input .='<textarea class="'.$input_class.'" value="'.$data.'" name="'.$name.'">'.$data.'</textarea>';
			break;
				case 'date':
			
			$input .='<input type="text" class="form-control datepicker" name="'.$name.'" value="'.$data.'">';

			break;
				case 'int':
				
			$input .='<input type="number" class="'.$input_class.'" value="'.$data.'" name="'.$name.'">';
			break;
				case 'tinyint':
				$checked = (isset($data) && $data == 1)? 'checked' : '';
			$input .= '<br/><input type="checkbox" value="'.$data.'" name="'.$name.'" '.$checked.' />&nbspYes';
			break;
				default:
			$input .='<input type="text" class="'.$input_class.'" value="'.$data.'" name="'.$name.'">';
			break;
			}
		}
		return $input;
	}

	function get_countdown($duedate,$only=false)
	{
		$now 		= time(); // or your date as well
		$duedate 	= strtotime($duedate);
		$newformat	= date('l, d F Y',$duedate);
		$datediff 	= $now - $duedate;
		$result 	= floor($datediff/(60*60*24));
		$msg 		= '<i class="fa fa-hourglass-half"></i>&nbsp;<p class="label label-warning" >';
		$length 	= strlen($result);
		if ($result >= 0) {
			$msg	= '<i class="fa fa-hourglass"></i>&nbsp;<p class="label label-danger">expired';
		}else{
			$int	= substr($result,1,$length);
			$msg 	.= $int.' hari lagi';
		
		}
		$msg 		.='('.$newformat.')</p>';
		if ($only) {
			return $result;
		}else{
			echo $msg;	
		}
		
	}

	function show_date_human_format($original,$time=false)
	{
		
		date_default_timezone_set('Asia/Jakarta');
    	if (!is_numeric($original)) {
    		$original = strtotime($original);
    	}
    	$newDate = date('l, d F Y', $original).' ';
    	$newDate .= ($time)? date('h : i :s ',$original) : '';
    	return $newDate;
	}

	function show_currency_format($nominal,$simbol='Rp')
	{
    	$money = $simbol.' ';
    	$money.= number_format($nominal,2,',','.');
    	return $money;
	}



	function push_to_download($file_name)
	{
		// make sure it's a file before doing anything!
    	if(is_file($file_name)) {

	   			/*
			  	Do any processing you'd like here:
		  		1.  Increment a counter
		  		2.  Do something with the DB
		  		3.  Check user permissions
		  		4.  Anything you want!
	   			*/

	   			// required for IE
	   			if(ini_get('zlib.output_compression')) { ini_set('zlib.output_compression', 'Off');	}

	   			// get the file mime type using the file extension
	   			switch(strtolower(substr(strrchr($file_name, '.'), 1))) {
					case 'pdf': $mime = 'application/pdf'; break;
		  			case 'zip': $mime = 'application/zip'; break;
		  			case 'jpeg':
		  			case 'jpg': $mime = 'image/jpg'; break;
		  			default: $mime = 'application/force-download';
	   			}
	   			header('Pragma: public'); 	// required
	   			header('Expires: 0');		// no cache
	   			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	   			header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime ($file_name)).' GMT');
	   			header('Cache-Control: private',false);
	   			header('Content-Type: '.$mime);
	   			header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
	   			header('Content-Transfer-Encoding: binary');
	   			header('Content-Length: '.filesize($file_name));	// provide file size
	   			header('Connection: close');
	   			readfile($file_name);		// push it out
	   			exit();
    		}
	}

	function get_client_ip() {
    	$ipaddress = '';
	    if (getenv('HTTP_CLIENT_IP'))
        	$ipaddress = getenv('HTTP_CLIENT_IP');
    	else if(getenv('HTTP_X_FORWARDED_FOR'))
        	$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    	else if(getenv('HTTP_X_FORWARDED'))
        	$ipaddress = getenv('HTTP_X_FORWARDED');
    	else if(getenv('HTTP_FORWARDED_FOR'))
        	$ipaddress = getenv('HTTP_FORWARDED_FOR');
    	else if(getenv('HTTP_FORWARDED'))
       		$ipaddress = getenv('HTTP_FORWARDED');
    	else if(getenv('REMOTE_ADDR'))
        	$ipaddress = getenv('REMOTE_ADDR');
    	else
        	$ipaddress = 'UNKNOWN';
    	return $ipaddress;
	}

	function force_download($path,$filename='')
	{
		$fp = @fopen($path, 'rb');
		
		if (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE"))
		{
    		header('Content-Type: "application/octet-stream"');
    		header('Content-Disposition: attachment; filename="'.$filename.'"');
    		header('Expires: 0');
    		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    		header("Content-Transfer-Encoding: binary");
    		header('Pragma: public');
    		header("Content-Length: ".filesize($path));
		}
		else
		{
    		header('Content-Type: "application/octet-stream"');
    		header('Content-Disposition: attachment; filename="'.$filename.'"');
    		header("Content-Transfer-Encoding: binary");
    		header('Expires: 0');
    		header('Pragma: no-cache');
    		header("Content-Length: ".filesize($path));
		}
		fpassthru($fp);
		fclose($fp);
	}