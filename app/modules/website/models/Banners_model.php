<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Banners_model Class
 *
 * @package		Codifire
 * @version		1.0
 * @author 		Gutzby Marzan <gutzby.marzan@digify.com.ph>
 * @copyright 	Copyright (c) 2018, Digify, Inc.
 * @link		http://www.digify.com.ph
 */
class Banners_model extends BF_Model {

	protected $table_name			= 'banners';
	protected $key					= 'banner_id';
	protected $date_format			= 'datetime';
	protected $log_user				= TRUE;

	protected $set_created			= TRUE;
	protected $created_field		= 'banner_created_on';
	protected $created_by_field		= 'banner_created_by';

	protected $set_modified			= TRUE;
	protected $modified_field		= 'banner_modified_on';
	protected $modified_by_field	= 'banner_modified_by';

	protected $soft_deletes			= TRUE;
	protected $deleted_field		= 'banner_deleted';
	protected $deleted_by_field		= 'banner_deleted_by';

	// --------------------------------------------------------------------

	/**
	 * get_datatables
	 *
	 * @access	public
	 * @param	none
	 * @author 	Gutzby Marzan <gutzby.marzan@digify.com.ph>
	 */
	public function get_banners($banner_group_id = null)
	{
		return $this->where('banner_group_id', $banner_group_id)
					->join('banner_groups', 'banner_groups.banner_group_id = banner_banner_group_id')
					->find_all();
	}
}