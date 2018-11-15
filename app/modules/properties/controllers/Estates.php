<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Estates Class
 *
 * @package		Codifire
 * @version		1.0
 * @author 		Gutzby Marzan <gutzby.marzan@digify.com.ph>
 * @copyright 	Copyright (c) 2018, Digify, Inc.
 * @link		http://www.digify.com.ph
 */
class Estates extends MX_Controller {
	
	/**
	 * Constructor
	 *
	 * @access	public
	 *
	 */
	function __construct()
	{
		parent::__construct();

		//$this->load->library('users/acl');

		$this->load->language('estates');
		$this->load->model('estates_model');
		$this->load->model('categories_model');
		$this->load->model('properties_model');
		$this->load->model('price_range_model');
		$this->load->model('locations_model');
		$this->load->model('related_links_model');
		$this->load->model('image_sliders_model');
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
		//$this->acl->restrict('properties.estates.list');
		
		// page title
		$data['page_heading'] = lang('index_heading');
		$data['page_subhead'] = lang('index_subhead');
		$data['page_layout'] = 'full_width';
		
		// breadcrumbs
		$this->breadcrumbs->push(lang('crumb_home'), site_url(''));
		$this->breadcrumbs->push(lang('crumb_module'), site_url('estates'));

		
		// session breadcrumb
		$this->session->set_userdata('redirect', current_url());

		$category = $this->categories_model->find(1); //get estate name = 'estate'
		$estates = $this->estates_model->get_estates();
		
		if($estates && $category){
			$data['estates'] = $estates;
			$data['category'] = $category;

		}
		else{
			show_404();
		}

		$category = $this->categories_model->get_active_categories();
		$category[''] = "ALL";
		$data['select_categories'] = $category;

		$locations = $this->locations_model->get_active_locations();
		$locations[''] = "VIEW ALL";
		$data['select_locations'] = $locations;

		$range = $this->price_range_model->get_active_price_range();
		$range[''] = "ALL";
		$data['select_price_range'] = $range;

		$data['button_text'] = $this->partials_model->find(3); 

		$data['news_tags']	= $this->news_tags_model->find_all_by(array('news_tag_status' => 'Active', 'news_tag_deleted' => 0));

		$fields = ['limit' => 4];
		$news = $this->posts_model->get_active_news($fields);

		foreach ($news as $key => $result) {
			$result->post_tags= $this->post_tags_model->get_current_tags($result->post_id);
		}

		$data['news_result'] = $news;

		$data['recommended_links'] = $this->related_links_model->find_all_by(array('related_link_section_id' => 1, 'related_link_section_type' => 'categories'));

		// render the page
		
		$this->template->add_css(module_css('properties', 'estates_index'), 'embed');
		$this->template->add_css(module_css('properties', 'estates_index'), 'embed');
		$this->template->add_css(module_css('properties', 'categories_view'), 'embed');
		$this->template->write_view('content', 'estates_index', $data);
		$this->template->render();

	}

	/**
	 * view
	 *
	 * @access	public
	 * @param	string $slug
	 */
	public function view($params)
	{
		// page title
		$data['page_heading'] = lang('index_heading');
		$data['page_subhead'] = lang('index_subhead');
		$data['page_layout'] = 'full_width';


		$fields = [ 'estate_slug' => $params ];
		$estates = $this->estates_model->get_estates($fields);
		//pr($estates[0]->estate_id);
		$data['sliders'] = $this->image_sliders_model->find_all_by(array('image_slider_section_id'=> $estates[0]->estate_id, 'image_slider_section_type'=>'estates'));
		
		$fields = [
		    'rand'	=> true,
		    'limit'	=> 2,
		    'estate_id' => $estates[0]->estate_id,
		    'category_id' => 2 //residences
		];

		$data['residences'] = $this->properties_model->get_properties($fields);

		$fields = [
		    'rand'	=> true,
		    'limit'	=> 3,
		    'estate_id' => $estates[0]->estate_id,
		    'category_id' => 3 //malls
		];

		$data['malls'] = $this->properties_model->get_properties($fields);

		$fields = [
		    'rand'	=> true,
		    'limit'	=> 2,
		    'estate_id' => $estates[0]->estate_id,
		    'category_id' => 4 //offices
		];

		$data['offices'] = $this->properties_model->get_properties($fields);

		$data['category_residence'] = $this->categories_model->find(2);
		$data['category_mall'] = $this->categories_model->find(3);
		$data['category_office'] = $this->categories_model->find(4);

		$data['news_tags']	= $this->news_tags_model->find_all_by(array('news_tag_status' => 'Active', 'news_tag_deleted' => 0));

		$fields = ['limit' => 4];
		$news = $this->posts_model->get_active_news($fields);

		foreach ($news as $key => $result) {
			$result->post_tags= $this->post_tags_model->get_current_tags($result->post_id);
		}

		$data['news_result'] = $news;

		$data['recommended_links'] = $this->related_links_model->find_all_by(array('related_link_section_id' => $estates[0]->estate_id, 'related_link_section_type' => 'estates'));
		
		if($estates){
			$data['estates'] = $estates[0];
		}
		else{
			show_404();
		}

		// breadcrumbs
		$this->breadcrumbs->push(lang('crumb_home'), site_url(''));
		$this->breadcrumbs->push(lang('crumb_module'), site_url('estates'));
		//$this->breadcrumbs->push($data['article']->article_title, site_url('estates'));
		
		// render the page
		$this->template->add_css(module_css('properties', 'estates_index'), 'embed');
		$this->template->add_css(module_css('properties', 'estates_view'), 'embed');
		$this->template->add_js(module_js('properties', 'estates_view'), 'embed');
		$this->template->write_view('content', 'estates_view', $data);
		$this->template->render();
	}


	// --------------------------------------------------------------------



	public function search()
	{

		$fields = [
			'location_id' => $this->input->post('location_id'),
		];
				
		$result = $this->properties_model->get_careers($fields);
		echo json_encode(array('success' => true, 'result' => $result)); exit;		
	}
}

/* End of file Estates.php */
/* Location: ./application/modules/properties/controllers/Estates.php */