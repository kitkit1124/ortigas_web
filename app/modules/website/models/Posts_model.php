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

	// --------------------------------------------------------------------

	public function get_datatables($fields_data = null)
	{
		$fields = array(
			'post_id', 
			'post_title',
			'post_slug',
			'post_posted_on',
			'post_status',
			'post_image',
			'post_alt_image',
			'post_content',
			'DATE_FORMAT(post_posted_on, "%M %d, %Y")',
			'post_tag_post_id',
			'news_tag_name',


			'post_created_on', 
			'concat(creator.first_name, " ", creator.last_name)', 
			'post_modified_on', 
			'concat(modifier.first_name, " ", modifier.last_name)'
		);

		if(isset($fields_data['tags']) && $fields_data['tags']){
			$this->where('news_tag_slug', $fields_data['tags']);
		}
		elseif(isset($fields_data['year']) && $fields_data['year'] && isset($fields_data['month']) && $fields_data['month']){
			$this->where('year(post_posted_on)', $fields_data['year']);
			$this->where('DATE_FORMAT(post_posted_on, "%M")'." = '".$fields_data["month"]."'");
		}
		else{
			$this->group_by('post_id');
		}

		return $this->join('users as creator', 'creator.id = post_created_by', 'LEFT')
					->join('users as modifier', 'modifier.id = post_modified_by', 'LEFT')
					->join('post_tags', 'post_tags.post_tag_post_id = post_id')
					->join('news_tags', 'news_tags.news_tag_id = post_tags.post_tag_tag_id')
					->order_by('post_posted_on','desc')
					->where('post_deleted','0')
					->where('post_status','Posted')
					->datatables($fields);
	}

	public function get_active_news($fields = null)
	{
		if(isset($fields['keyword']) && $fields['keyword']){
			$f = $fields['keyword'];
			$this->where('('.
				'post_title like "%'.$f.'%"'.' or '.
				'post_content like "%'.$f.'%"'.
			')');
		}

		if(isset($fields['related_property']) && $fields['related_property']){
			$this->where('property_id', $fields['related_property'])
			->join('post_properties', 'post_properties_post_id = posts.post_id')
			->join('properties', 'post_properties_property_id = property_id');
			
		}

		if(isset($fields['page_related_news']) && $fields['page_related_news']){
			$this->where('page_tagposts_page_id', $fields['page_related_news'])
			->join('page_tagposts', 'page_tagposts_post_id = posts.post_id');			
		}



		if(isset($fields['limit']) && $fields['limit']){
			$this->limit($fields['limit']);
		}
		$result = $this
					->order_by('post_posted_on','DESC')
					->where('post_deleted',0)
					->where('post_status', 'Posted')
					->find_all();

		return $result;
	}

	public function get_specific_news($fields = null)
	{	
		if(isset($fields['news_tag_id']) && $fields['news_tag_id']){
			$this->where('news_tag_id', $fields['news_tag_id']);
		}

		if(isset($fields['post_slug']) && $fields['post_slug']){
			$this->where('post_slug', $fields['post_slug']);
		}

		if(isset($fields['without_this_post_id']) && $fields['without_this_post_id']){
			$this->where_not_in('post_id', $fields['without_this_post_id']);
		}

		$result = $this
					->where('post_deleted',0)
					->where('post_status', 'Posted')
					->join('post_tags', 'post_tag_post_id = post_id')
					->join('news_tags', 'news_tag_id = post_tag_tag_id')
					->find_all();

		return $result;
	}

	public function get_archive_year()
	{
		$result = $this->select('distinct(year(post_posted_on)) as "archive_year"')
					->where('post_deleted',0)
					->where('post_status', 'Posted')
					->order_by('post_posted_on', 'DESC')
					->find_all();

		return $result;
	}

	public function get_archive_month($year = null)
	{
		$result = $this->select('distinct(monthname(post_posted_on)) as "archive_month"')
					->where('post_deleted',0)
					->where('post_status', 'Posted')
					->where('year(post_posted_on)', $year)
					->order_by('post_posted_on', 'ASC')
					->find_all();

		return $result;
	}


}
