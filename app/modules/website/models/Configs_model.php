<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

/**
 * Configs_model Class
 *
 * @package		Codifire
 * @version		1.0
 * @author 		Robert Christian Obias <robert.obias@digify.com.ph>
 * @copyright 	Copyright (c) 2015, Digify, Inc.
 * @link		http://www.digify.com.ph
 */

class Configs_model extends BF_Model 
{
	protected $table_name			= 'configs';
	protected $key					= 'config_id';
	protected $date_format			= 'datetime';
	protected $log_user				= TRUE;

	protected $set_created			= TRUE;
	protected $created_field		= 'config_created_on';
	protected $created_by_field		= 'config_created_by';

	protected $set_modified			= TRUE;
	protected $modified_field		= 'config_modified_on';
	protected $modified_by_field	= 'config_modified_by';

	protected $soft_deletes			= TRUE;
	protected $deleted_field		= 'config_deleted';
	protected $deleted_by_field		= 'config_deleted_by';
}