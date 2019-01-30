<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Careers_model Class
 *
 * @package		Codifire
 * @version		1.0
 * @author 		Gutzby Marzan <gutzby.marzan@digify.com.ph>
 * @copyright 	Copyright (c) 2018, Digify, Inc.
 * @link		http://www.digify.com.ph
 */
class Careers_model extends BF_Model {

	protected $table_name			= 'careers';
	protected $key					= 'career_id';
	protected $date_format			= 'datetime';
	protected $log_user				= TRUE;

	protected $set_created			= TRUE;
	protected $created_field		= 'career_created_on';
	protected $created_by_field		= 'career_created_by';

	protected $set_modified			= TRUE;
	protected $modified_field		= 'career_modified_on';
	protected $modified_by_field	= 'career_modified_by';

	protected $soft_deletes			= TRUE;
	protected $deleted_field		= 'career_deleted';
	protected $deleted_by_field		= 'career_deleted_by';

	// --------------------------------------------------------------------

	/**
	 * get_datatables
	 *
	 * @access	public
	 * @param	none
	 * @author 	Gutzby Marzan <gutzby.marzan@digify.com.ph>
	 */

	public function get_select_careers(){
	$query = $this->where('career_status', 'Active')
			->where('career_deleted', 0)
			->order_by('career_position_title', 'ASC')
			->format_dropdown('career_id', 'career_position_title', TRUE);

	return $query;		
	}

	public function get_select_careers_location(){
	$query = $this->where('career_status', 'Active')
			->where('career_deleted', 0)
			->order_by('career_location', 'ASC')
			->format_dropdown('career_location', 'career_location', TRUE);

	return $query;		
	}

	public function get_careers($fields = null){

		if(isset($fields['keyword']) && $fields['keyword']){
			$f = $fields['keyword'];
			$this->where('('.
				'career_position_title like "%'.$f.'%"'.' or '.
				'career_req like "%'.$f.'%"'.' or '.
				'career_res like "%'.$f.'%"'.' or '.
				'department_name like "%'.$f.'%"'.' or '.
				'division_name like "%'.$f.'%"'.
			')');
		}

		if(isset($fields['career_id']) && $fields['career_id']){ 
			$this->where('career_id', $fields['career_id']);
		}

		if(isset($fields['career_location']) && $fields['career_location']){
			$this->where('(career_location like "%'. $fields['career_location'] .'%")');
		}

		if(isset($fields['department_id']) && $fields['department_id']){
			$this->where('department_id', $fields['department_id']);
		}

		if(isset($fields['division_slug']) && $fields['division_slug']){
			$this->where('division_slug', $fields['division_slug']);
		}

		if(isset($fields['career_slug']) && $fields['career_slug']){ 
			$this->where('career_slug', $fields['career_slug']);
		}

	$query = $this->where('career_status', 'Active')
					->where('career_deleted', 0)
					->order_by('career_position_title', 'ASC')
					->join('career_departments', 'career_departments.department_id = career_dept')
					->join('career_divisions', 'career_divisions.division_id = career_div')
					->find_all();

	return $query;	
	}
}