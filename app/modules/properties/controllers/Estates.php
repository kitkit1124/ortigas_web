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
		$this->load->model('website/metatags_model');
		$this->load->model('website/posts_model');
		$this->load->model('website/news_tags_model');
		$this->load->model('website/post_tags_model');
		$this->load->model('website/partials_model');
		$this->load->model('website/pages_model');
		$this->load->model('website/banners_model');
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

		$data['breadcrumbs']['heading'] = 'home';
		$data['breadcrumbs']['subhead'] = lang('crumb_module');


		$this->breadcrumbs->push(lang('crumb_home'), site_url(''));
		$this->breadcrumbs->push(lang('crumb_module'), site_url('estates'));

		
		// session breadcrumb
		$this->session->set_userdata('redirect', current_url());

		$category = $this->pages_model->find_by('page_uri','estates'); //get estate name = 'estate'
		$data['sliders'] = $this->banners_model->get_banners(2);
		$estates = $this->estates_model->get_estates();

		$data['section_id'] = $category->page_id;
		$data['section'] = $category->page_title;
		

		$meta_title = $this->metatags_model->find($category->page_metatag_id); 
		$data['page_heading'] = isset($meta_title->metatag_title) ? $meta_title->metatag_title : $category->page_title;


		if($estates && $category){
			$data['estates'] = $estates;
			$data['category'] = $category;

		}
		// else{
		// 	redirect(base_url().'page-not-found');
		// }

        $metatags = "";
        if(isset($category->page_metatag_id) && $category->page_metatag_id){
        	$metatags = $this->metatags_model->get_metatags($category->page_metatag_id);
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

		$fields = ['limit' => 4, 'page_related_news' => 2 ];
		$news = $this->posts_model->get_active_news($fields);
		if($news){
			foreach ($news as $key => $result) {
				$result->post_tags= $this->post_tags_model->get_current_tags($result->post_id);
			}
		}
		$data['news_result'] = $news;

		$data['recommended_links'] = $this->related_links_model->find_all_by(array('related_link_section_id' => 2, 'related_link_section_type' => 'pages'));

		// render the page
		$this->template->write('head', $metatags);
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


		$data['enable_map'] = true;
		
		$fields = [ 'estate_slug' => $params ];
		$estates = $this->estates_model->get_estates($fields);

		// page title


		$data['page_heading'] = $estates[0]->estate_name;

		$meta_title = $this->metatags_model->find($estates[0]->estate_metatag_id); 
		$data['page_heading'] = isset($meta_title->metatag_title) ? $meta_title->metatag_title :  $estates[0]->estate_name;

		$data['page_subhead'] = lang('index_subhead');
		$data['page_layout'] = 'full_width';

		
		if($estates){
			$data['estates'] = $estates[0];
		}
		else{
			redirect(base_url().'page-not-found');
			// exit();
		}

		$estates_page = $this->pages_model->find_by('page_uri','estates');
		$data['breadcrumbs']['heading'] = 'home';
		$data['breadcrumbs']['page_subhead'] = $estates_page->page_title;
		$data['breadcrumbs']['page_subhead_link'] = strtolower($estates_page->page_title);
		$data['breadcrumbs']['subhead'] = $estates[0]->estate_name;

		$data['sliders'] = $this->image_sliders_model->find_all_by(
			array(
				'image_slider_section_id'=> $estates[0]->estate_id,
				'image_slider_section_type'=>'estates',
				'image_slider_deleted' => 0,
				'image_slider_status' => 'Active',
			)
		);
		
		$fields = [
		    'rand'	=> true,
		    'limit'	=> 2,
		    'estate_id' => $estates[0]->estate_id,
		    'category_id' => 1 //residences
		];

		$data['residences'] = $this->properties_model->get_properties($fields);

		$fields = [
		    'rand'	=> true,
		    'limit'	=> 3,
		    'estate_id' => $estates[0]->estate_id,
		    'category_id' => 2 //malls
		];

		$data['malls'] = $this->properties_model->get_properties($fields);

		$fields = [
		    'rand'	=> true,
		    'limit'	=> 2,
		    'estate_id' => $estates[0]->estate_id,
		    'category_id' => 3 //offices
		];

		$data['offices'] = $this->properties_model->get_properties($fields);

		$data['category_residence'] = $this->categories_model->find(1);
		$data['category_mall'] = $this->categories_model->find(2);
		$data['category_office'] = $this->categories_model->find(3);

		$data['news_tags']	= $this->news_tags_model->find_all_by(array('news_tag_status' => 'Active', 'news_tag_deleted' => 0));

		$fields = ['limit' => 4];
		$news = $this->posts_model->get_active_news($fields);

		if($news){
			foreach ($news as $key => $result) {
				$result->post_tags= $this->post_tags_model->get_current_tags($result->post_id);
			}

			$data['news_result'] = $news;
		}

		$data['section_id'] = $estates[0]->estate_id;
		$data['section'] = 'Estates';

		$data['recommended_links'] = $this->related_links_model->find_all_by(array('related_link_section_id' => $estates[0]->estate_id, 'related_link_section_type' => 'estates'));
		

		// breadcrumbs
		$this->breadcrumbs->push(lang('crumb_home'), site_url(''));
		$this->breadcrumbs->push(lang('crumb_module'), site_url('estates'));
		//$this->breadcrumbs->push($data['article']->article_title, site_url('estates'));

        $metatags = $this->metatags_model->get_metatags($estates[0]->estate_metatag_id);
       
		// render the page
		$this->template->write('head', $metatags);
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