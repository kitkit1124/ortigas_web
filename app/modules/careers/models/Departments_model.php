<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Departments_model Class
 *
 * @package		Codifire
 * @version		1.0
 * @author 		Gutzby Marzan <gutzby.marzan@digify.com.ph>
 * @copyright 	Copyright (c) 2018, Digify, Inc.
 * @link		http://www.digify.com.ph
 */
class Departments_model extends BF_Model {

	protected $table_name			= 'career_departments';
	protected $key					= 'department_id';
	protected $date_format			= 'datetime';
	protected $log_user				= TRUE;

	protected $set_created			= TRUE;
	protected $created_field		= 'department_created_on';
	protected $created_by_field		= 'department_created_by';

	protected $set_modified			= TRUE;
	protected $modified_field		= 'department_modified_on';
	protected $modified_by_field	= 'department_modified_by';

	protected $soft_deletes			= TRUE;
	protected $deleted_field		= 'department_deleted';
	protected $deleted_by_field		= 'department_deleted_by';

	// --------------------------------------------------------------------

	/**
	 * get_datatables
	 *
	 * @access	public
	 * @param	none
	 * @author 	Gutzby Marzan <gutzby.marzan@digify.com.ph>
	 */
	public function get_active_departments(){
		$query = $this->where('department_status', 'Active')
				->where('department_deleted', 0)
				->order_by('department_name', 'ASC')
				->format_dropdown('department_id', 'department_name', TRUE);

		return $query;		
	}
}