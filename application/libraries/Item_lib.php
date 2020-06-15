<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Item library
 *
 * Library with utilities to manage items
 */

class Item_lib
{
	private $CI;

  	public function __construct()
	{
		$this->CI =& get_instance();
	}

	public function get_item_location()
	{
		if(!$this->CI->session->userdata('item_location'))
		{
			$location_id = $this->CI->Stock_location->get_default_location_id();
			$this->set_item_location($location_id);
		}

		return $this->CI->session->userdata('item_location');
	}

	public function set_item_location($location)
	{
		$this->CI->session->set_userdata('item_location',$location);
	}

	public function clear_item_location()
	{
		$this->CI->session->unset_userdata('item_location');
	}

	/**
	 * Recursively filters out unacceptable values (NULL and '') from Array
	 *
	 * @param	array|string	$input	The array or array value to analize
	 * @return	array|string			The resulting array element or array
	 */
	public function custom_array_filter($input)
	{
		foreach($input as $key => &$value)
		{
			if(in_array($value,array(NULL,'')) && $value !== 0)
			{
				unset($input[$key]);
			}
		}

		return $input;
	}
}
?>