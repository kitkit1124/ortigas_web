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

	/**
	 * get_active_news
	 *
	 * @access	public
	 * @param	
	 * @return 	array
	 * @author 	Gutz Marzan <gutzby.marzan@digify.com.ph>
	 */
	public function get_active_news($fields = null)
	{
		if(isset($fields['limit']) && $fields['limit']){
			$this->limit($fields['limit']);
		}
		$result = $this
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
