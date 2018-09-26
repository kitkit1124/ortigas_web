<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Posts_model Class
 *
 * @package		Codifire
 * @version		1.0
 * @author 		Randy Nivales <randy.nivales@digify.com.ph>
 * @copyright 	Copyright (c) 2015, Digify, Inc.
 * @link		http://www.digify.com.ph
 */
class Posts_model extends BF_Model 
{

	protected $table_name			= 'posts';
	protected $key					= 'post_id';

	protected $date_format			= 'datetime';
	protected $log_user				= TRUE;

	protected $set_created			= TRUE;
	protected $created_field		= 'post_created_on';
	protected $created_by_field		= 'post_created_by';

	protected $set_modified			= TRUE;
	protected $modified_field		= 'post_modified_on';
	protected $modified_by_field	= 'post_modified_by';

	protected $soft_deletes			= TRUE;
	protected $deleted_field		= 'post_deleted';
	protected $deleted_by_field		= 'post_deleted_by';

	public $metatag_key				= 'post_metatag_id';
}