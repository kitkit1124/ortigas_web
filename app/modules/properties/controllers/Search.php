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
		// page title
		$data['page_heading'] = lang('index_heading');
		$data['page_subhead'] = lang('index_subhead');
		$data['page_layout'] = 'full_width';
		
		// breadcrumbs
		$this->breadcrumbs->push(lang('crumb_home'), site_url(''));
		$this->breadcrumbs->push(lang('crumb_module'), site_url('estates'));
		
		// session breadcrumb
		$this->session->set_userdata('redirect', current_url());

		$data['categories'] = $this->categories_model->where_not_in('category_id',1)->find_all();
		
		if($_POST){
			echo json_encode(array('success' => true, 'filter' => $_POST['q'].'&'.$_POST['filter_by'])); exit;			
		}
		if(isset($_GET['q']) && $_GET['q']){
			if(isset($_GET['r'])){
				$fields = ['filter' => $_GET['q'], 'category_id' => 2 ];
				$data['residences'] = $this->properties_model->get_search($fields);		
			}
			if (isset($_GET['m'])){
				$fields = ['filter' => $_GET['q'], 'category_id' => 3 ];
				$data['malls'] = $this->properties_model->get_search($fields);	
			}
			if(isset($_GET['o'])){
				$fields = ['filter' => $_GET['q'], 'category_id' => 4 ];
				$data['offices'] = $this->properties_model->get_search($fields);	
			}
		}

		// render the page
		$this->template->add_css(module_css('properties', 'estates_index'), 'embed');
		$this->template->add_css(module_css('properties', 'search_index'), 'embed');
		$this->template->add_js(module_js('properties', 'search_index'), 'embed');
		$this->template->write_view('content', 'search_index', $data);
		$this->template->render();
	}
}

/* End of file Search.php */
/* Location: ./application/modules/properties/controllers/Search.php */