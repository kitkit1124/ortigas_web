<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Search Class
 *
 * @package		Codifire
 * @version		1.0
 * @author 		Gutzby Marzan <gutzby.marzan@digify.com.ph>
 * @copyright 	Copyright (c) 2018, Digify, Inc.
 * @link		http://www.digify.com.ph
 */
class Search extends MX_Controller {
	
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
		$this->load->model('price_range_model');
		$this->load->model('locations_model');
		$this->load->model('properties_model');
		$this->load->model('property_types_model');
		$this->load->model('searches_model');
		$this->load->model('room_types_model');

		$this->load->model('careers/careers_model');
		$this->load->model('careers/departments_model');
		$this->load->model('careers/divisions_model');
		$this->load->model('careers/jobs_model');

		$this->load->model('website/pages_model');
		$this->load->model('website/posts_model');
		$this->load->model('website/news_tags_model');
		$this->load->model('website/post_tags_model');
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
		// page title
		$data['page_heading'] = 'Search';
		$data['page_subhead'] = lang('index_subhead');
		$data['page_layout'] = 'full_width';
		
		// breadcrumbs
		$this->breadcrumbs->push(lang('crumb_home'), site_url(''));
		$this->breadcrumbs->push(lang('crumb_module'), site_url('estates'));
		
		// session breadcrumb
		$this->session->set_userdata('redirect', current_url());

		$data['categories'] = $this->categories_model->where_not_in('category_id',1)->find_all();

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

		if($_POST){
			$data = array(
				'search_loc_id' 	 => $_POST['location_id'],
				'search_dev_id' 	 => $_POST['dev_id'],
			);
			// $this->searches_model->insert($data);
			echo json_encode(
				array(
					'success' 	 => true,
					'location' 	 => $_POST['location_id'],
					'dev' 	 	 => $_POST['dev_id'],
				)
			); 
			exit;			
		}

		if($_GET){

			$fields = [
				// 'category_id' 	 => 2, 
				'location_id' 	 => isset($_GET['loc']) ? $_GET['loc'] : '', 
				'dev_type_id'	 => isset($_GET['dev']) ? $_GET['dev'] : ''
			];
			$result = $this->properties_model->get_search($fields);	
			
			if($result){
				foreach ($result as $key => $value) {
					$result[$key]->unit_types = $this->room_types_model->get_active_room_types($value->property_id);
				}
				
				$data['residences'] = $result;
			}
			$data['page_content'] = $this->pages_model->find(12); 
			 
				
					
			// $fields = [
			// 	'category_id' 	 => 3, 
			// 	'location_id' 	 => isset($_GET['loc']) ? $_GET['loc'] : '', 
			// 	'dev_type_id'	 => isset($_GET['dev']) ? $_GET['dev'] : '',
			// ];
			// $data['malls'] = $this->properties_model->get_search($fields);	
	
			// $fields = [
			// 	'category_id' 	 => 4, 
			// 	'location_id' 	 => isset($_GET['loc']) ? $_GET['loc'] : '', 
			// 	'dev_type_id' 	 => isset($_GET['dev']) ? $_GET['dev'] : '',
			// ];
			// $data['offices'] = $this->properties_model->get_search($fields);	
			

		}

		// render the page
		$this->template->add_css(module_css('properties', 'estates_index'), 'embed');
		$this->template->add_css(module_css('properties', 'search_index'), 'embed');	
		$this->template->write_view('content', 'search_index', $data);
		$this->template->render();
	}


	public function sglobal()
	{

		// page title
		$data['page_heading'] = 'Search';
		$data['page_subhead'] = lang('index_subhead');
		$data['page_layout'] = 'full_width';
		$data['is_sGlobal'] = TRUE;
		
		// breadcrumbs
		$this->breadcrumbs->push(lang('crumb_home'), site_url(''));
		$this->breadcrumbs->push(lang('crumb_module'), site_url('estates'));
		
		// session breadcrumb
		$this->session->set_userdata('redirect', current_url());

		$data['categories'] = $this->categories_model->where_not_in('category_id',1)->find_all();
		
		$data['select_categories'] = $this->categories_model->get_active_categories();

		$data['select_locations']  = $this->locations_model->get_active_locations();
		
		$data['select_price_range'] = $this->price_range_model->get_active_price_range();

		$data['page_content'] = $this->pages_model->find(13); 

		
		
		if($_POST){
			$data = array(
				'search_keyword'	 => $_POST['keyword']
			);

			$this->searches_model->insert($data);
			echo json_encode(
				array(
					'success' 	 		 => true,
					'keyword'			 => $_POST['keyword'],
					'search_filter' 	 => $_POST['search_filter']
				)
			); 
			exit;			
		}

		if($_GET){

			if($_GET['search_filter'] == "search_properties" || $_GET['search_filter'] == "search_any"){
			$fields = [
				'filter'		 => $_GET['keyword'],
				'category_id' 	 => 1, 
				'location_id' 	 => isset($_GET['location']) ? $_GET['location'] : '', 
				'price_range_id' => isset($_GET['range']) ? $_GET['range'] : ''
			];
			$data['residences'] = $this->properties_model->get_search($fields);	
	
			$fields = [
				'filter'		 => $_GET['keyword'],
				'category_id' 	 => 2, 
				'location_id' 	 => isset($_GET['location']) ? $_GET['location'] : '', 
				'price_range_id' => isset($_GET['range']) ? $_GET['range'] : '',
			];
			$data['malls'] = $this->properties_model->get_search($fields);	
	

	
			$fields = [
				'filter'		 => $_GET['keyword'],
				'category_id' 	 => 3, 
				'location_id' 	 => isset($_GET['lid']) ? $_GET['lid'] : '', 
				'price_range_id' => isset($_GET['range']) ? $_GET['range'] : '',
			];

			$data['offices'] = $this->properties_model->get_search($fields);	
			}

			$fields = [
				'keyword'		 => $_GET['keyword'],
			];

			if($_GET['search_filter'] == "search_articles" || $_GET['search_filter'] == "search_any"){
				$data['news_result'] = $this->posts_model->get_active_news($fields);
			}

			$fields = [
				'keyword'		 => $_GET['keyword'],
			];

			if($_GET['search_filter'] == "search_careers" || $_GET['search_filter'] == "search_any"){
				$data['careers'] = $this->careers_model->get_careers($fields);
			}

		}

		// render the page
		$this->template->add_css(module_css('properties', 'estates_index'), 'embed');
		$this->template->add_css(module_css('properties', 'search_index'), 'embed');
		$this->template->add_css(module_css('website', 'global_search_result'), 'embed');
		$this->template->add_css(module_css('careers', 'careers_index'), 'embed');
		$this->template->add_js(module_js('properties', 'search_index'), 'embed');
		$this->template->write_view('content', 'website/global_search_view', $data);
		$this->template->render();
	}

	public function encrypt( $q ) {
	    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
	    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
	    return( $qEncoded );
	}

	public function decrypt( $q ) {
	    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
	    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
	    return( $qDecoded );
	}

}

/* End of file Search.php */
/* Location: ./application/modules/properties/controllers/Search.php */