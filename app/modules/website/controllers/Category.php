<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Category Class
 *
 * @package		Codifire
 * @version		1.0
 * @author 		Randy Nivales <randynivales@gmail.com>
 * @copyright 	Copyright (c) 2014-2015, Randy Nivales
 * @link		
 */
class Category extends CI_Controller 
{
	/**
	 * Constructor
	 *
	 * @access	public
	 *
	 */
	public function __construct()
	{
		parent::__construct();

		// check for dependencies
		if (! $this->db->table_exists('metatags'))
		{
			show_error('This page requires the Metatags module');
		}

		$this->load->driver('cache', $this->config->item('cache_drivers'));
		$this->load->helper('text');
		$this->load->library('pagination');
		$this->config->load('pagination');
		// $this->load->model('navigations_model');
		$this->load->model('categories_model');
		$this->load->model('posts_model');
	}
	
	// --------------------------------------------------------------------

	/**
	 * _remap
	 *
	 * @access	public
	 * @param	string $method
	 * @param	array $params
	 * @author 	Randy Nivales <randynivales@gmail.com>
	 */
	public function _remap($method, $params = array())
	{
		$this->$method($params);
	}


	// --------------------------------------------------------------------

	/**
	 * posts
	 *
	 * @access	public
	 * @param	string $slug1
	 * @param	string $slug2
	 * @param	string $slug3
	 * @author 	Randy Nivales <randynivales@gmail.com>
	 */
	private function posts($params)
	{
		// should have at least one param
		if (count($params) === 0) redirect(base_url().'page-not-found');

		// combine the slugs
		array_unshift($params, 'category');
		$uri = implode('/', $params);

		// get the category info
		$category = $this->categories_model->find_by('category_uri', $uri);

		if (! $category) redirect(base_url().'page-not-found');

		// breadcrumbs
		$breadcrumbs = array();
		$this->breadcrumbs->push(lang('crumb_home'), site_url(''));
		$breadcrumbs[lang('crumb_home')] = site_url('');
		$crumbs = $this->categories_model->get_category_crumbs($category->category_id);
		if ($crumbs)
		{
			foreach ($crumbs as $crumb)
			{
				$this->breadcrumbs->push($crumb['name'], site_url($crumb['uri']));
				$breadcrumbs[$crumb['name']] = site_url($crumb['uri']);
			}
		}

		// save the breadcrumbs to session
		$this->session->set_userdata('breadcrumbs', $breadcrumbs);


		// page title
		$data['page_heading'] = $category->category_name;

		// for the pagination
		$per_page = 10;
		$offset = ($this->input->get('page')) ? ($this->input->get('page') - 1) * $per_page : 0;

		// total
		$total_posts = $this->posts_model
			->join('post_categories', 'post_category_post_id = post_id', 'LEFT')
			->join('categories', 'category_id = post_category_category_id')
			->join('users', 'id = post_created_by', 'LEFT')
			->where('category_id', $category->category_id)
			->where('post_status', 'Posted')
			->order_by('post_posted_on', 'desc')
			->count_all();

		// posts
		$data['posts'] = $this->posts_model
			->join('post_categories', 'post_category_post_id = post_id', 'LEFT')
			->join('categories', 'category_id = post_category_category_id')
			->join('users', 'id = post_created_by', 'LEFT')
			->where('category_id', $category->category_id)
			->where('post_status', 'Posted')
			->order_by('post_posted_on', 'desc')
			->limit($per_page)
			->offset($offset)
			->find_all();

		// pagination
		$config = config_item('pagination');
		$config['base_url'] = site_url($uri);
		$config['total_rows'] = $total_posts;	
		$config['per_page'] = $per_page;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'page';
		$config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config);

		// page layout
		$data['page_layout'] = $category->category_layout;

		// page sidebar
		// $data['page_sidebar'] = $category->category_sidebar_id;

		// meta tags
		$this->load->model('metatags_model');
		$metatags = $this->metatags_model->get_metatags($category->category_metatag_id);

		// template
		$this->template->set_template(config_item('website_theme'));
		$this->template->write('head', $metatags);
		$this->template->add_css(module_css('frontend', 'category_posts'), 'embed');
		$this->template->add_js(module_js('frontend', 'category_posts'), 'embed');
		$this->template->write_view('content', 'category_posts', $data);
		$this->template->render();
	}
}

/* End of file Category.php */
/* Location: ./application/modules/frontend/controllers/Category.php */