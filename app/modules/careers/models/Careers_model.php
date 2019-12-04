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
				'career_location like "%'.$f.'%"'.' or '.
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
					// ->order_by('career_position_title', 'ASC')
					->order_by('career_created_on', 'DESC')
					->join('career_departments', 'career_departments.department_id = career_dept')
					->join('career_divisions', 'career_divisions.division_id = career_div')
					->find_all();

	return $query;	
	}

	public function get_careers_datatables($form = null){

		$fields = array(
			'career_id',
			'career_position_title',
			'career_slug',
			'career_dept',
			'career_departments.department_name',
			'career_div',
			'career_divisions.division_name',
			'career_divisions.division_slug',
			'career_req',
			'career_res',
			'career_location',
			'career_latitude',
			'career_longitude',
			'career_image',
			'career_alt_image',
			'career_status',

			'career_created_on', 
			'career_modified_on', 
		);

		if(isset($form['keyword']) && $form['keyword']){
			
			$f = $form['keyword'];
			$this->where('('.
				'career_position_title like "%'.$f.'%"'.' or '.
				'career_location like "%'.$f.'%"'.' or '.
				'career_req like "%'.$f.'%"'.' or '.
				'career_res like "%'.$f.'%"'.' or '.
				'department_name like "%'.$f.'%"'.' or '.
				'division_name like "%'.$f.'%"'.
			')');
		}


		if(isset($form['career_id']) && $form['career_id']){ 
			$this->where('career_id', $form['career_id']);
		}

		if(isset($form['career_location']) && $form['career_location']){
			$this->where('(career_location like "%'. $form['career_location'] .'%")');
		}

		if(isset($form['department_id']) && $form['department_id']){
			$this->where('department_id', $form['department_id']);
		}

		if(isset($form['division_slug']) && $form['division_slug']){
			$this->where('division_slug', $form['division_slug']);
		}

		if(isset($form['career_slug']) && $form['career_slug']){ 
			$this->where('career_slug', $form['career_slug']);
		}

	return $this->where('career_status', 'Active')
					->where('career_deleted', 0)
					// ->order_by('career_position_title', 'ASC')
					->order_by('career_created_on', 'DESC')
					->join('career_departments', 'career_departments.department_id = career_dept')
					->join('career_divisions', 'career_divisions.division_id = career_div')
					->datatables($fields);

	}
}