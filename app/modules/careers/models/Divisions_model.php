<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Divisions_model Class
 *
 * @package		Codifire
 * @version		1.0
 * @author 		Gutzby Marzan <gutzby.marzan@digify.com.ph>
 * @copyright 	Copyright (c) 2018, Digify, Inc.
 * @link		http://www.digify.com.ph
 */
class Divisions_model extends BF_Model {

	protected $table_name			= 'career_divisions';
	protected $key					= 'division_id';
	protected $date_format			= 'datetime';
	protected $log_user				= TRUE;

	protected $set_created			= TRUE;
	protected $created_field		= 'division_created_on';
	protected $created_by_field		= 'division_created_by';

	protected $set_modified			= TRUE;
	protected $modified_field		= 'division_modified_on';
	protected $modified_by_field	= 'division_modified_by';

	protected $soft_deletes			= TRUE;
	protected $deleted_field		= 'division_deleted';
	protected $deleted_by_field		= 'division_deleted_by';

	// --------------------------------------------------------------------

	/**
	 * get_datatables
	 *
	 * @access	public
	 * @param	none
	 * @author 	Gutzby Marzan <gutzby.marzan@digify.com.ph>
	 */

	public function get_select_divisions($department_id = null){

		if($department_id){

			$this->where('division_department_id', $department_id);
		}

		$query = $this->where('division_status', 'Active')
				->where('division_deleted', 0)
				->order_by('division_name', 'ASC')
				->format_dropdown('division_id', 'division_name', TRUE);

		return $query;		
	}


	public function get_active_divisions($department_id = null){
	$query = $this->where('division_status', 'Active')
			->where('division_deleted', 0)
			->where('division_department_id', $department_id)
			->order_by('division_name', 'ASC')
			->find_all();

	return $query;		
	}

}