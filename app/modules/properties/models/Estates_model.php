<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Estates_model Class
 *
 * @package		Codifire
 * @version		1.0
 * @author 		Gutzby Marzan <gutzby.marzan@digify.com.ph>
 * @copyright 	Copyright (c) 2018, Digify, Inc.
 * @link		http://www.digify.com.ph
 */
class Estates_model extends BF_Model {

	protected $table_name			= 'estates';
	protected $key					= 'estate_id';
	protected $date_format			= 'datetime';
	protected $log_user				= TRUE;

	protected $set_created			= TRUE;
	protected $created_field		= 'estate_created_on';
	protected $created_by_field		= 'estate_created_by';

	protected $set_modified			= TRUE;
	protected $modified_field		= 'estate_modified_on';
	protected $modified_by_field	= 'estate_modified_by';

	protected $soft_deletes			= TRUE;
	protected $deleted_field		= 'estate_deleted';
	protected $deleted_by_field		= 'estate_deleted_by';

	// --------------------------------------------------------------------

	/**
	 * get_datatables
	 *
	 * @access	public
	 * @param	none
	 * @author 	Gutzby Marzan <gutzby.marzan@digify.com.ph>
	 */
	public function get_datatables()
	{
		$fields = array(
			'estate_id',
			'estate_name',
			'estate_slug',
			'estate_text',
			'estate_latitude',
			'estate_longtitude',
			'estate_logo',
			'estate_status',

			'estate_created_on', 
			'concat(creator.first_name, " ", creator.last_name)', 
			'estate_modified_on', 
			'concat(modifier.first_name, " ", modifier.last_name)'
		);

		return $this->join('users as creator', 'creator.id = estate_created_by', 'LEFT')
					->join('users as modifier', 'modifier.id = estate_modified_by', 'LEFT')
					->datatables($fields);
	}

	public function get_estates($fields = null){

		if(isset($fields['limit'])){ 
			$this->limit($fields['limit']);
		}

		if(isset($fields['sort'])){
			$this->order_by('estate_modified_on', 'DESC');
		}	

		if(isset($fields['rand'])){ 
			$this->order_by('RAND()');
		}
				

		if(isset($fields['estate_id'])){ 
			$this->where('estate_id', $fields['estate_id']);
		}

		if(isset($fields['estate_slug'])){
			$this->where('estate_slug', $fields['estate_slug']);
		}	

		if(isset($fields['estate_is_featured'])){
			$this->where('estate_is_featured', $fields['estate_is_featured']);
		}	

		$query = $this->where('estate_status', 'Active')
					->where('estate_deleted', 0)
					->find_all();	

		return $query;	
	}

	public function get_select_estates(){
		$query = $this
				->where('estate_status', 'Active')
				->where('estate_deleted', 0)
				->order_by('estate_name', 'ASC')
				->format_dropdown('estate_id', 'estate_name', TRUE);
		return $query;		
	}
}