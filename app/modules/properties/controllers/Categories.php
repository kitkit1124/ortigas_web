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
		
		// breadcrumbs
		$this->breadcrumbs->push(lang('crumb_home'), site_url(''));
		$this->breadcrumbs->push(lang('crumb_module'), site_url('estates'));
		
		// session breadcrumb
		$this->session->set_userdata('redirect', current_url());

		if($params){

		$fields = [ 'category_name' => $params ];
		$properties = $this->properties_model->get_properties($fields);
			
			if($properties){
				$data['properties'] = $properties;
				$data['category'] = $properties[0];
			}
			else{
				show_404();
			}

		}
				
		// render the page
		$this->template->add_css(module_css('properties', 'estates_index'), 'embed');
		$this->template->add_js(module_js('properties', 'estates_index'), 'embed');
		$this->template->write_view('content', 'estates_index', $data);
		$this->template->render();
	}

	// --------------------------------------------------------------------

}

/* End of file Categories.php */
/* Location: ./application/modules/properties/controllers/Categories.php */