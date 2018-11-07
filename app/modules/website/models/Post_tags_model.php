<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Post_tags_model Class
 *
 * @package		Codifire
 * @version		1.0
 * @author 		Gutzby Marzan <gutzby.marzan@digify.com.ph>
 * @copyright 	Copyright (c) 20185, Digify, Inc.
 * @link		http://www.digify.com.ph
 */
class Post_tags_model extends BF_Model 
{

	protected $table_name			= 'post_tags';
	protected $key					= 'post_tag_id';

	protected $log_user				= FALSE;
	protected $set_created			= FALSE;
	protected $set_modified			= FALSE;
	protected $soft_deletes			= FALSE;

	// --------------------------------------------------------------------

	/**
	 * 
	 *
	 * @access	public
	 * @param	none
	 * @author 		Gutzby Marzan <gutzby.marzan@digify.com.ph>
	 */
	public function get_current_tags($id)
	{
		$result = $this->select('news_tag_id, news_tag_name')	
			->join('news_tags', 'news_tags.news_tag_id = post_tag_tag_id', 'LEFT')
			->join('posts', 'posts.post_id = post_tag_post_id', 'LEFT')
			->where('post_id', $id)
			->find_all();

		return $result;
	}
}