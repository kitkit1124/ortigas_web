<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * @package		Codifire
 * @version		1.0
 * @author 		Gutzby Marzan <gutzby.marzan@digify.com.ph>
 * @copyright 	Copyright (c) 2018, Digify, Inc.
 * @link		http://www.digify.com.ph
 */
class Permanent_redirect_model extends BF_Model {


	public function redirect_url()
	{
		if($_SERVER['REQUEST_URI'] == '/estate/capitol-commons/entertainment-hub'){ redirect(base_url().'/malls/estancia-mall'); }

	}
}