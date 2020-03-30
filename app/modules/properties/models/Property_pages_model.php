<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Property_pages_model Class
 *
 * @package		Codifire
 * @version		1.0
 * @author 		Gutz Marzan <gutzby.marzan@digify.com.ph>
 * @copyright 	Copyright (c) 2020, Digify, Inc.
 * @link		http://www.digify.com.ph
 */
class Property_pages_model extends BF_Model {

	protected $table_name			= 'property_pages';
	protected $key					= 'page_id';
	protected $date_format			= 'datetime';
	protected $log_user				= TRUE;

	protected $set_created			= TRUE;
	protected $created_field		= 'page_created_on';
	protected $created_by_field		= 'page_created_by';

	protected $set_modified			= TRUE;
	protected $modified_field		= 'page_modified_on';
	protected $modified_by_field	= 'page_modified_by';

	protected $soft_deletes			= TRUE;
	protected $deleted_field		= 'page_deleted';
	protected $deleted_by_field		= 'page_deleted_by';

	// --------------------------------------------------------------------
}