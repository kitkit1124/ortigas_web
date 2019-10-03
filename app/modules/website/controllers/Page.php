<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Page Class
 *
 * @package		Codifire
 * @version		1.0
 * @author 		Randy Nivales <randynivales@gmail.com>
 * @copyright 	Copyright (c) 2014-2015, Randy Nivales
 * @link		
 */
class Page extends CI_Controller 
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
		if (! $this->db->table_exists('pages'))
		{
			show_error('This page requires the Websites module');
		}

		// check for dependencies
		if (! $this->db->table_exists('metatags'))
		{
			show_error('This page requires the Metatags module');
		}

		$this->load->driver('cache', $this->config->item('cache_drivers'));
		// $this->load->model('navigations_model');
		$this->load->model('pages_model');
		$this->load->language('page');

		if (! $this->db->table_exists('properties'))
		{
			show_error('This page requires the Properties module');
		}

		$this->load->model('partials_model');
		$this->load->model('posts_model');
		$this->load->model('news_tags_model');
		$this->load->model('post_tags_model');
		$this->load->model('banners_model');
		$this->load->model('metatags_model');
		$this->load->model('properties/categories_model');
		$this->load->model('properties/price_range_model');
		$this->load->model('properties/locations_model');
		$this->load->model('properties/estates_model','estates');
		$this->load->model('properties/properties_model','properties');
		$this->load->model('properties/image_sliders_model');
		$this->load->model('properties/property_types_model');
		$this->load->model('files/video_uploads_model');
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
	 * index
	 *
	 * @access	public
	 * @param	none
	 * @author 	Randy Nivales <randynivales@gmail.com>
	 */
	private function index()
	{
		// if (ENVIRONMENT == 'production')
		// {
		// 	$this->output->cache(5);
		// }

		if ($page = $this->pages_model->find_by(array('page_uri' => 'home', 'page_status' => 'Posted', 'page_deleted' => 0)))
		{
			//page_title
			$meta_title = $this->metatags_model->find($page->page_metatag_id); 
			$data['page_heading'] = isset($meta_title->metatag_title) ? $meta_title->metatag_title : $page->page_title ;

			$data['record'] = $page;
		}
		else
		{
			redirect(base_url().'page-not-found');
			// redirect('notfound', 'refresh');
		}
		
		// page layout
		$data['page_layout'] = $page->page_layout;

		// homepage
		$data['page_content'] = $this->pages_model->find_by('page_uri','home'); 

		$data['is_home'] = TRUE;

		$data['video'] = $this->video_uploads_model->where('video_status','Active')->find(1);

		$data['video_details'] = $this->video_uploads_model->find(1);

		$data['sliders'] = $this->banners_model->get_banners(1);

		$data['page_estates'] = $this->pages_model->find_by('page_uri','estates');
		$data['category_residence'] = $this->categories_model->find(1);
		$data['category_mall'] = $this->categories_model->find(2);
		$data['category_office'] = $this->categories_model->find(3);

		$category = $this->categories_model->get_active_categories();
		$category[''] = "ALL";
		$data['select_categories'] = $category;

		$dev_types = $this->property_types_model->get_active_property_types();
		$data['select_dev_types'] = $dev_types;		

		$locations = $this->locations_model->get_active_locations();
		$data['select_locations'] = $locations;

		$range = $this->price_range_model->get_active_price_range();
		$range[''] = "ALL";
		$data['select_price_range'] = $range;
		
       // meta tags
        $metatags = "";
        if(isset($page->page_metatag_id) && $page->page_metatag_id){
        	$metatags = $this->metatags_model->get_metatags($page->page_metatag_id);
        }

		$fields = ['rand'=>true,'limit'=>3, 'estate_is_featured'=>1, 'sort'=>'true'];
		$data['estates'] = $this->estates->get_estates($fields);

		$fields = ['featured'=>1, 'rand'=>true,'limit'=>1,'category_id'=>1];
		$residence = $this->properties->get_properties($fields);

		$data['residence'] = $residence[0];

		if($residence){
			$data['carousel'] = $this->image_sliders_model->find_all_by(
			array(
				'image_slider_section_type' => 'properties',
				'image_slider_section_id' => $residence[0]->property_id,
				'image_slider_deleted' => 0,'image_slider_status' => 'Active')
			); //$residence[0]->property_id
		}
		$fields = ['rand'=>true,'limit'=>1,'category_id'=>2];
		$data['malls'] 		= $this->properties->get_properties($fields);

		$fields = ['rand'=>true,'limit'=>1,'category_id'=>3];
		$data['offices'] 	= $this->properties->get_properties($fields);
		
		$data['news_tags']	= $this->news_tags_model->find_all_by(array('news_tag_status' => 'Active', 'news_tag_deleted' => 0));

		$fields = ['limit' => 1];
		$news = $this->posts_model->get_active_news($fields);

		foreach ($news as $key => $result) {
			$result->post_tags= $this->post_tags_model->get_current_tags($result->post_id);
		}

		$data['news_result'] = $news;

		// template
		$this->template->write('head', $metatags);
		$this->template->add_css(module_css('website', 'page_index'), 'embed');
		$this->template->add_js(module_js('website', 'page_index'), 'embed');
		$this->template->write_view('content', 'page_index', $data);
		$this->template->render();
	}

	// --------------------------------------------------------------------

	/**
	 * view
	 *
	 * @access	public
	 * @param	string $slug
	 * @author 	Randy Nivales <randynivales@gmail.com>
	 */
	private function view($params)
	{
		// if (ENVIRONMENT == 'production')
		// {
		// 	$this->output->cache(5);
		// }

		// should have at least one param
		if (count($params) === 0) redirect('notfound', 'refresh');

		// combine the slugs
		$uri = implode('/', $params);

		// if homepage
		if ($uri == 'home')
		{
			redirect('', 'refresh');
		}

		// get the page content
		if ($page = $this->pages_model->find_by(array('page_uri' => $uri, 'page_status' => 'Posted', 'page_deleted' => 0)))
		{
			// page title
			$meta_title = $this->metatags_model->find($page->page_metatag_id); 
			$data['page_heading'] = isset($meta_title->metatag_title) ? $meta_title->metatag_title : $page->page_title ;
			$data['record'] = $page;

			$data['sliders'] = $this->banners_model->get_banners($page->page_id);
		}
		else
		{
			redirect(base_url().'page-not-found');
			// redirect('notfound', 'refresh');
		}

		// breadcrumbs
		$this->breadcrumbs->push(lang('crumb_home'), site_url(''));
		$crumbs = $this->pages_model->get_page_crumbs($page->page_id);
		if ($crumbs)
		{
			foreach ($crumbs as $crumb)
			{
				$this->breadcrumbs->push($crumb['name'], site_url($crumb['uri']));
			}
		}


		$data['breadcrumbs']['heading'] = 'home';
		$data['breadcrumbs']['subhead'] = $page->page_title;

		// page layout
		$data['page_layout'] = $page->page_layout;


		// template
		$this->template->set_template(config_item('website_theme'));

        $metatags = "";
        if(isset($page->page_metatag_id) && $page->page_metatag_id){
        	$metatags = $this->metatags_model->get_metatags($page->page_metatag_id);
        }

		$fields = ['limit' => 4, 'page_related_news' => $page->page_id ];
		$news = $this->posts_model->get_active_news($fields);

		if($news){
			foreach ($news as $key => $result) {
				$result->post_tags= $this->post_tags_model->get_current_tags($result->post_id);
			}

			$data['news_result'] = $news;
		}

		//if($page->page_uri == 'about-us'){
		if($page->page_id == 7){

			$data['projects'] = $this->pages_model->find_by('page_uri','projects');

			$fields = ['rand'=>true,'limit'=>4,'category_id'=>1];
			$data['residences'] = $this->properties->get_properties($fields);	

			$this->template->add_css(module_css('website', 'page_view/abouts_us'), 'embed');
			$this->template->add_js(module_js('website', 'page_view/about_us'), 'embed');
		}

		//if($page->page_uri == 'established-communities'){
		if($page->page_id == 8){
			$this->template->add_css(module_css('website', 'page_view/established_communites'), 'embed');
			$this->template->add_js(module_js('website', 'page_view/about_us'), 'embed');
		}

		//if($page->page_uri == 'supplier-and-contractor-accreditation'){
		if($page->page_id == 10){
			$this->template->add_css(module_css('website', 'page_view/supplier'), 'embed');
			$this->template->add_js(module_js('website', 'page_view/about_us'), 'embed');
			//$this->template->add_css(module_css('website', 'page_view/established_communites'), 'embed');
		}

		$this->template->write('head', $metatags);
		$this->template->add_css(module_css('website', 'page_view'), 'embed');
		$this->template->add_js(module_js('website', 'page_view'), 'embed');
		$this->template->write_view('content', 'page_view', $data);
		$this->template->render();
	}

	
	public function show_modal(){

		// page title
		$data['page_heading'] = '';
		$data['page_subhead'] = '';
		$data['action'] = '';


		$content = $this->partials_model->find($this->input->get('id')); 
		$data['content'] = parse_content($content->partial_content);

		$this->template->set_template('modal');
		$this->template->write_view('content', 'website/modal', $data);
		$this->template->render();
	}


	public function page_not_found(){

		// page title
		$data['page_heading'] = 'Page Not Found';
		$data['page_subhead'] = '';
		$data['action'] = '';

		$data['partials'] = $this->partials_model->find(13);

		$this->template->add_css(module_css('website', 'page_view'), 'embed');
		$this->template->add_css(module_css('website', 'page_404'), 'embed');
		$this->template->add_js(module_js('website', 'page_view'), 'embed');
		$this->template->write_view('content', 'page_404', $data);
		$this->template->render();
	}

	// --------------------------------------------------------------------

}

/* End of file Page.php */
/* Location: ./application/modules/page/controllers/Page.php */