<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Customers_model Class
 *
 * @package		Codifire
 * @version		1.0
 * @author 		Robert Christian Obias <robert.obias@digify.com.ph>
 * @copyright 	Copyright (c) 2019, Digify, Inc.
 * @link		http://www.digify.com.ph
 */
class Customers_model extends BF_Model {

	protected $table_name			= 'customers';
	protected $key					= 'customer_id';
	protected $date_format			= 'datetime';
	protected $log_user				= TRUE;

	protected $set_created			= TRUE;
	protected $created_field		= 'customer_created_on';
	protected $created_by_field		= 'customer_created_by';

	protected $set_modified			= TRUE;
	protected $modified_field		= 'customer_modified_on';
	protected $modified_by_field	= 'customer_modified_by';

	protected $soft_deletes			= TRUE;
	protected $deleted_field		= 'customer_deleted';
	protected $deleted_by_field		= 'customer_deleted_by';
}