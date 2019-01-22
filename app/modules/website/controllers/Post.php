<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Post Class
 *
 * @package		Codifire
 * @version		1.0
 * @author 		Randy Nivales <randynivales@gmail.com>
 * @copyright 	Copyright (c) 2014-2015, Randy Nivales
 * @link		
 */
class Post extends CI_Controller 
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

		$this->load->dbutil();
		if (! $this->db->table_exists('posts'))
		{
			redirect('dashboard');
		}

		// check for dependencies
		if (! $this->db->table_exists('metatags'))
		{
			show_error('This page requires the Metatags module');
		}

		$this->load->driver('cache', $this->config->item('cache_drivers'));
		// $this->load->model('navigations_model');
		$this->load->model('posts_model');
	}
	
	// --------------------------------------------------------------------

	/**
	 * index
	 *
	 * @access	public
	 * @param	none
	 * @author 	Randy Nivales <randynivales@gmail.com>
	 */
	public function view($slug = FALSE)
	{
		// if (ENVIRONMENT == 'production')
		// {
		// 	$this->output->cache(5);
		// }

		if (! $slug) redirect(base_url().'page-not-found');

		// get the post info
		$post = $this->posts_model
			->join('users', 'id = post_created_by', 'LEFT')
			->find_by('post_slug', $slug);

		$data['post'] = $post;

		if (! $post) redirect(base_url().'page-not-found');

		// page title
		$data['page_heading'] = $post->post_title;

		// breadcrumbs
		if ($this->session->userdata('breadcrumbs'))
		{
			foreach ($this->session->userdata('breadcrumbs') as $text => $link)
			{
				$this->breadcrumbs->push($text, $link);
			}
			$this->breadcrumbs->push($post->post_title, site_url($post->post_slug));
		}
		else
		{
			$this->breadcrumbs->push(lang('crumb_home'), site_url(''));
			$this->breadcrumbs->push($post->post_title, site_url($post->post_slug));
		}

		// page layout
		$data['page_layout'] = $post->post_layout;

		// page sidebar
		// $data['page_sidebar'] = $post->post_sidebar_id;

		// meta tags
		$this->load->model('metatags_model');
		$metatags = $this->metatags_model->get_metatags($post->post_metatag_id);

		// template
		$this->template->set_template(config_item('website_theme'));
		$this->template->write('head', $metatags);
		$this->template->add_css(module_css('frontend', 'post_view'), 'embed');
		$this->template->add_js(module_js('frontend', 'post_view'), 'embed');
		$this->template->write_view('content', 'post_view', $data);
		$this->template->render();
	}
}

/* End of file Post.php */
/* Location: ./application/modules/frontend/controllers/Post.php */