<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Jobs_model Class
 *
 * @package		Codifire
 * @version		1.0
 * @author 		Gutzby Marzan <gutzby.marzan@digify.com.ph>
 * @copyright 	Copyright (c) 2018, Digify, Inc.
 * @link		http://www.digify.com.ph
 */
class Jobs_model extends BF_Model {

	protected $table_name			= 'career_applicants';
	protected $key					= 'job_id';
	protected $date_format			= 'datetime';
	protected $log_user				= TRUE;

	protected $set_created			= TRUE;
	protected $created_field		= 'job_created_on';
	protected $created_by_field		= 'job_created_by';

	protected $set_modified			= TRUE;
	protected $modified_field		= 'job_modified_on';
	protected $modified_by_field	= 'job_modified_by';

	protected $soft_deletes			= TRUE;
	protected $deleted_field		= 'job_deleted';
	protected $deleted_by_field		= 'job_deleted_by';

	// --------------------------------------------------------------------

	/**
	 * get_datatables
	 *
	 * @access	public
	 * @param	none
	 * @author 	Gutzby Marzan <gutzby.marzan@digify.com.ph>
	 */
}