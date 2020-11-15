<?php
/**
* 
*/
class MY_Form_validation extends CI_Form_validation
{
	
	function __construct($rules = array())
	{
		parent::__construct($rules);
		$this->ci =& get_instance();
	}
	public function get_errors_as_array()
	{
		return $this->_error_array();
	}
	public function get_config_rules()
	{
		return $this->_config_rules;
	}
	public function get_field_names($form)
	{
		$field_names 	= array();
		$rules 			= $this->get_config_rules();
		$rules 			= $rules[$form];
		foreach ($rules as $index => $info) {
			$field_names[] = $info['field'];
		}
		return $field_names;
	}
	

	public function custom_set_data(array $data = array())
	{
		$config 	= $this->ci->config->item('serialize');
		$keys 		= array_keys($data);
		if ($unset 	= array_intersect($keys , $config['unset']) ) {
			if ($unset) {
				foreach ($unset as $key => $value) {
					unset($data[$value]);
				}
			}
		}
		$this->set_data($data);
	}

	function valid_url($url)
	{
    	//$pattern = "/^((ht|f)tp(s?)\:\/\/|~/|/)?([w]{2}([\w\-]+\.)+([\w]{2,5}))(:[\d]{1,5})?/";
    	//if (!preg_match($pattern, $url))
    	if (filter_var($url, FILTER_VALIDATE_URL))
    	{
        	return TRUE;
    	}

    	return FALSE;
	}

	// --------------------------------------------------------------------

	/**
 	* Real URL
 	*
 	* @access    public
 	* @param    string
 	* @return    string
 	*/
	function real_url($url)
	{
    	return @fsockopen("$url", 80, $errno, $errstr, 30);
	} 
}
