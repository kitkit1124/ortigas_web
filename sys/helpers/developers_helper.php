<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter XML Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Gutz Marzan
 * @link		https://codeigniter.com/user_guide/helpers/developers_helper.html
 */

// ------------------------------------------------------------------------


if ( ! function_exists('pr'))
{
	/**
	 * Display array in rows
	 *
	 * @param	array
	 * @return	array
	 */
	function pr($array)
	{
		echo "<pre>";
		print_r($array);
		echo "</pre>";
	}
}

if ( ! function_exists('img_selector'))
{
	/**
	 * Display array in rows
	 *
	 * @param	array
	 * @return	array
	 */
	function img_selector($img,$size)
	{
		if(substr($img,-3) == 'png') {
		$src = str_replace(".png", "_".$size.".png", $img, $count); 
		}
		else{
		$src = str_replace(".jpg", "_".$size.".jpg", $img, $count); 
		}

		return $src;
	}
}

