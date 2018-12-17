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
			// page title
			$data['page_heading'] = $page->page_title;
			$data['record'] = $page;
		}
		else
		{
			show_404();
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
		$dev_types[''] = "ALL";
		$data['select_dev_types'] = $dev_types;		

		$locations = $this->locations_model->get_active_locations();
		$locations[''] = "ALL";
		$data['select_locations'] = $locations;

		$range = $this->price_range_model->get_active_price_range();
		$range[''] = "ALL";
		$data['select_price_range'] = $range;

		// meta tags
		$page_description = $this->metatags_model->clean_page_description($page->page_content);

        $metafields = [
        	'metatag_title'					=> config_item('website_name') . ' | ' . $page->page_title,
        	'metatag_description'			=> $page_description,
        	'metatag_keywords'				=> 'greenhills, shopping, center, tiendesitas, circulo, verde, frontera, verde, luntala, valle, verde, viridian, capitol, commons, royalton, imperium,maven',
        	'metatag_author'				=> config_item('website_name'),
        	'metatag_og_title'				=> config_item('website_name') . ' | ' . $page->page_title,
        	'metatag_og_image'				=> isset($data['sliders'][0]->banner_thumb) ? $data['sliders'][0]->banner_thumb : '',
        	'metatag_og_url'				=> current_url(),
        	'metatag_og_description'		=> $page_description,
        	'metatag_twitter_card'			=> 'photo',
        	'metatag_twitter_title'			=> config_item('website_name') . ' | ' . $page->page_title,
        	'metatag_twitter_image'			=> isset($data['sliders'][0]->banner_thumb) ? $data['sliders'][0]->banner_thumb : '',
        	'metatag_twitter_url'			=> current_url(),
        	'metatag_twitter_description'	=> $page_description,
        ];

        $metatags = $this->metatags_model->get_metatags($metafields);

		$fields = ['rand'=>true,'limit'=>3];
		$data['estates'] = $this->estates->get_estates($fields);

		$fields = ['featured'=>1, 'rand'=>true,'limit'=>1,'category_id'=>1];
		$residence = $this->properties->get_properties($fields);

		$this->properties->get_properties($fields);

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

		$fields = ['limit' => 2];
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
			$data['page_heading'] = $page->page_title;
			$data['record'] = $page;

			$data['sliders'] = $this->banners_model->get_banners($page->page_id);
		}
		else
		{
			show_404();
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

		// page layout
		$data['page_layout'] = $page->page_layout;

		// page sidebar
		// $data['page_sidebar'] = $page->page_sidebar_id;

		// template
		$this->template->set_template(config_item('website_theme'));

		$page_description = $this->metatags_model->clean_page_description($page->page_content);

        $metafields = [
        	'metatag_title'					=> config_item('website_name') . ' | ' . $page->page_title,
        	'metatag_description'			=> $page_description,
        	'metatag_keywords'				=> 'greenhills, shopping, center, tiendesitas, circulo, verde, frontera, verde, luntala, valle, verde, viridian, capitol, commons, royalton, imperium,maven',
        	'metatag_author'				=> config_item('website_name'),
        	'metatag_og_title'				=> config_item('website_name') . ' | ' . $page->page_title,
        	'metatag_og_image'				=> isset($data['sliders'][0]->banner_thumb) ? $data['sliders'][0]->banner_thumb : '',
        	'metatag_og_url'				=> current_url(),
        	'metatag_og_description'		=> $page_description,
        	'metatag_twitter_card'			=> 'photo',
        	'metatag_twitter_title'			=> config_item('website_name') . ' | ' . $page->page_title,
        	'metatag_twitter_image'			=> isset($data['sliders'][0]->banner_thumb) ? $data['sliders'][0]->banner_thumb : '',
        	'metatag_twitter_url'			=> current_url(),
        	'metatag_twitter_description'	=> $page_description,
        ];

        $metatags = $this->metatags_model->get_metatags($metafields);


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
			$this->template->add_css(module_css('website', 'page_view/established_communites'), 'embed');
		}

		$this->template->write('head', $metatags);
		$this->template->add_css(module_css('website', 'page_view'), 'embed');
		$this->template->add_js(module_js('website', 'page_view'), 'embed');
		$this->template->write_view('content', 'page_view', $data);
		$this->template->render();
	}

	// --------------------------------------------------------------------

}

/* End of file Page.php */
/* Location: ./application/modules/page/controllers/Page.php */