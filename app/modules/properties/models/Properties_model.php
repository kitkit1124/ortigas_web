<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Properties_model Class
 *
 * @package		Codifire
 * @version		1.0
 * @author 		Gutzby Marzan <gutzby.marzan@digify.com.ph>
 * @copyright 	Copyright (c) 2018, Digify, Inc.
 * @link		http://www.digify.com.ph
 */
class Properties_model extends BF_Model {

	protected $table_name			= 'properties';
	protected $key					= 'property_id';
	protected $date_format			= 'datetime';
	protected $log_user				= TRUE;

	protected $set_created			= TRUE;
	protected $created_field		= 'property_created_on';
	protected $created_by_field		= 'property_created_by';

	protected $set_modified			= TRUE;
	protected $modified_field		= 'property_modified_on';
	protected $modified_by_field	= 'property_modified_by';

	protected $soft_deletes			= TRUE;
	protected $deleted_field		= 'property_deleted';
	protected $deleted_by_field		= 'property_deleted_by';

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
			'property_id',
			'property_name',
			'estate_name',
			'category_name',
			'location_name',
			'property_slug',
			'property_overview',
			'property_image',
			'property_website',
			'property_facebook',
			'property_twitter',
			'property_instagram',
			'property_linkedin',
			'property_youtube',
			'property_latitude',
			'property_longitude',
			'property_nearby_malls',
			'property_nearby_markets',
			'property_nearby_hospitals',
			'property_nearby_schools',
			'property_tags',
			'property_status',


			'property_created_on', 
			'concat(creator.first_name, " ", creator.last_name)', 
			'property_modified_on', 
			'concat(modifier.first_name, " ", modifier.last_name)',


			'property_estate_id',
			'property_category_id',
			'property_location_id'
		);

		return $this->join('users as creator', 'creator.id = property_created_by', 'LEFT')
					->join('users as modifier', 'modifier.id = property_modified_by', 'LEFT')
					->join('estates', 'estates.estate_id = property_estate_id', 'LEFT')
					->join('property_categories', 'property_categories.category_id = property_category_id', 'LEFT')
					->join('property_locations', 'property_locations.location_id = property_location_id', 'LEFT')
					->datatables($fields);
	}


	public function get_properties($fields){
		
				if(isset($fields['property_id'])){ 
					$this->where('property_id', $fields['property_id']);
				}

				if(isset($fields['property_slug'])){ 
					$this->where('property_slug', $fields['property_slug']);
				}

				if(isset($fields['category_id'])){
					$this->where('property_category_id', $fields['category_id']);
				}

				if(isset($fields['category_name'])){
					$this->where('category_name', $fields['category_name']);
				}

				if(isset($fields['estate_id'])){ 
					$this->where('property_estate_id', $fields['estate_id']);
				}

				if(isset($fields['estate_slug'])){ 
					$this->where('estate_slug', $fields['estate_slug']);
				}

				if(isset($fields['location_id']) && $fields['location_id']){
					$this->where('location_id', $fields['location_id']);
				}

				if(isset($fields['limit'])){ 
					$this->limit($fields['limit']);
				}

				if(isset($fields['rand'])){ 
					$this->order_by('RAND()');
				}
				else{
					$this->order_by('property_id','ASC');
				}

				if(isset($fields['group_by'])){ 
					$this->group_by($fields['group_by']);
				}

				if(isset($fields['featured']) && $fields['featured']){
					$this->where('property_is_featured', $fields['featured']);
				}

				$query  =  $this->where('property_status', 'Active')
								->where('property_deleted', 0)
								->join('estates', 'estates.estate_id = property_estate_id', 'LEFT')
								->join('property_locations', 'property_locations.location_id = property_location_id', 'LEFT')
								->join('property_categories', 'property_categories.category_id = property_category_id', 'LEFT')
								->find_all();

		return $query;		
	}

	public function get_search($fields){

		if(isset($fields['filter'])){
			$f = $fields['filter'];
			$this->where('('.
				'property_name like "%'.$f.'%"'.' or '.
				'property_slug like "%'.$f.'%"'.' or '.
				'property_website like "%'.$f.'%"'.' or '.
				'property_facebook like "%'.$f.'%"'.' or '.
				'property_twitter like "%'.$f.'%"'.' or '.
				'property_instagram like "%'.$f.'%"'.' or '.
				'property_linkedin like "%'.$f.'%"'.' or '.
				'property_youtube like "%'.$f.'%"'.' or '.
				'property_nearby_malls like "%'.$f.'%"'.' or '.
				'property_nearby_markets like "%'.$f.'%"'.' or '.
				'property_nearby_hospitals like "%'.$f.'%"'.' or '.
				'property_nearby_schools like "%'.$f.'%"'.' or '.
				'estate_name like "%'.$f.'%"'.' or '.
				'estate_slug like "%'.$f.'%"'.' or '.
				'location_name like "%'.$f.'%"'.' or '.
				'category_name like "%'.$f.'%"'.
			')');
		}	


		if(isset($fields['location_id']) && $fields['location_id']){
			$this->where('location_id', $fields['location_id']);
		}	

		if(isset($fields['dev_type_id']) && $fields['dev_type_id']){
			$this->where('property_prop_type_id', $fields['dev_type_id']);
		}	

		if(isset($fields['location_id']) && $fields['location_id']){
			$this->where('location_id', $fields['location_id']);
		}

		if(isset($fields['price_range_id']) && $fields['price_range_id']){
			$this->where('price_range_id', $fields['price_range_id']);
		}

		if(isset($fields['category_id']) && $fields['category_id']){
			$this->where('category_id', $fields['category_id']);
		}
	
		$query  =  $this
						->where('property_status', 'Active')
						->where('property_deleted', 0)
						->join('estates', 'estates.estate_id = property_estate_id', 'LEFT')
						->join('property_locations', 'property_locations.location_id = property_location_id', 'LEFT')
						->join('property_categories', 'property_categories.category_id = property_category_id', 'LEFT')
						->join('price_range', 'price_range.price_range_id = property_price_range_id', 'LEFT')
						->join('property_types', 'property_types.property_type_id = property_prop_type_id', 'LEFT')
						->find_all();

		return $query;		
	}


	public function get_select_properties(){
		$query = $this
				->where('property_status', 'Active')
				->where('property_deleted', 0)
				->order_by('property_name', 'ASC')
				->format_dropdown('property_id', 'property_name', TRUE);

		return $query;
		
	}
}