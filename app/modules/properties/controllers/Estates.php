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
		$this->load->model('estates_model');
		$this->load->language('estates');
		$this->load->model('categories_model');
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

				
		// render the page
		$this->template->add_css(module_css('properties', 'estates_index'), 'embed');
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
		
		$fields = [
		    'rand'	=> true,
		    'limit'	=> 2,
		    'category_id' => 2 //residences
		];

		$data['residences'] = $this->properties_model->get_properties($fields);

		$fields = [
		    'rand'	=> true,
		    'limit'	=> 3,
		    'category_id' => 3 //residences
		];

		$data['malls'] = $this->properties_model->get_properties($fields);

		$fields = [
		    'rand'	=> true,
		    'limit'	=> 2,
		    'category_id' => 4 //residences
		];

		$data['offices'] = $this->properties_model->get_properties($fields);


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
}

/* End of file Estates.php */
/* Location: ./application/modules/properties/controllers/Estates.php */