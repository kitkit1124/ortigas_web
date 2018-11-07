<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Categories Class
 *
 * @package		Codifire
 * @version		1.0
 * @author 		Gutzby Marzan <gutzby.marzan@digify.com.ph>
 * @copyright 	Copyright (c) 2018, Digify, Inc.
 * @link		http://www.digify.com.ph
 */
class Categories extends MX_Controller {
	
	/**
	 * Constructor
	 *
	 * @access	public
	 *
	 */
	function __construct()
	{
		parent::__construct();

		// $this->load->library('users/acl');
		$this->load->model('categories_model');
		$this->load->language('categories');
		$this->load->model('properties_model');
		$this->load->model('price_range_model');
		$this->load->model('locations_model');
		$this->load->model('related_links_model');
		$this->load->model('website/posts_model');
		$this->load->model('website/news_tags_model');
		$this->load->model('website/post_tags_model');
		$this->load->model('website/partials_model');

	}
	
	// --------------------------------------------------------------------

	/**
	 * index
	 *
	 * @access	public
	 * @param	none
	 * @author 	Gutzby Marzan <gutzby.marzan@digify.com.ph>
	 */

	public function index()
	{



	}

	public function view($params)
	{
		// page title
		$data['page_heading'] = lang('index_heading');
		$data['page_subhead'] = lang('index_subhead');
		$data['page_layout'] = 'full_width';
		

		$category = $this->categories_model->get_active_categories();
		$category[''] = "ALL";
		$data['select_categories'] = $category;


		$locations = $this->locations_model->get_active_locations();
		$locations[''] = "ALL";
		$data['select_locations'] = $locations;

		$range = $this->price_range_model->get_active_price_range();
		$range[''] = "ALL";
		$data['select_price_range'] = $range;


		// breadcrumbs
		$this->breadcrumbs->push(lang('crumb_home'), site_url(''));
		$this->breadcrumbs->push(lang('crumb_module'), site_url('estates'));
		
		// session breadcrumb
		$this->session->set_userdata('redirect', current_url());


		if($params){
		
		$data['button_text'] = $this->partials_model->find(3); 

		$data['news_tags']	= $this->news_tags_model->find_all_by(array('news_tag_status' => 'Active', 'news_tag_deleted' => 0));

		$fields = ['limit' => 4];
		$news = $this->posts_model->get_active_news($fields);

		if($news){
		foreach ($news as $key => $result) {
			$result->post_tags= $this->post_tags_model->get_current_tags($result->post_id);
		}

		$data['news_result'] = $news;

		

		}

		$locations = $this->locations_model->get_active_locations();
		$locations[''] = "VIEW ALL ".strtoupper($params);
		$data['select_locations'] = $locations;


		$fields = [ 'category_name' => $params ];
		$properties = $this->properties_model->get_properties($fields);
		
			if($properties){
				$data['properties'] = $properties;
				$data['category'] = $properties[0];
			}
			else{
				show_404();
			}

		$data['recommended_links'] = $this->related_links_model->find_all_by(array('related_link_section_id' => $properties[0]->category_id, 'related_link_section_type' => 'categories'));

		}
				
		// render the page
		$this->template->add_css(module_css('properties', 'property_style'), 'embed');
		$this->template->add_css(module_css('properties', 'categories_view'), 'embed');
		$this->template->add_js(module_js('properties', 'estates_index'), 'embed');
		$this->template->write_view('content', 'estates_index', $data);
		$this->template->render();
	}

	// --------------------------------------------------------------------

}

/* End of file Categories.php */
/* Location: ./application/modules/properties/controllers/Categories.php */