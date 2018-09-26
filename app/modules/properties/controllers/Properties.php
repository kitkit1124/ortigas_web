<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Properties Class
 *
 * @package		Codifire
 * @version		1.0
 * @author 		Gutzby Marzan <gutzby.marzan@digify.com.ph>
 * @copyright 	Copyright (c) 2018, Digify, Inc.
 * @link		http://www.digify.com.ph
 */
class Properties extends MX_Controller {
	
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
		$this->load->model('properties_model');
		$this->load->language('properties');
		$this->load->model('property_sliders_model');
		$this->load->model('room_types_model');
		$this->load->model('units_model');
		$this->load->model('floors_model');
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

		$fields = [ 'property_slug' => $params ];
		$properties = $this->properties_model->get_properties($fields);
			
			if($properties){
				$id = $properties[0]->property_id;
				
				$data['properties'] = $properties[0];
				
				$data['sliders'] = $this->property_sliders_model->find_all_by('property_slider_property_id', $id);
				
				$data['room_types'] = $this->room_types_model->find_all_by('room_type_property_id', $id);	
				
				$data['floors'] = $this->floors_model->get_floors_dropdown($id);		

				$fields = [ 'rand' => true, 'limit'	=> 2, 'estate_id' => $properties[0]->property_estate_id];
				$data['residences'] = $this->properties_model->get_properties($fields);

			}
			else{
				show_404();
			}

		}
				
		// render the page
		$this->template->add_css(module_css('properties', 'estates_index'), 'embed');
		$this->template->add_css(module_css('properties', 'properties_view'), 'embed');
		$this->template->add_js(module_js('properties', 'properties_view'), 'embed');
		$this->template->write_view('content', 'properties_view', $data);
		$this->template->render();
	}

	public function get_unit_room_size_range(){
		$room_id = $_GET['room_id'];
		$range = $this->units_model->get_unit_room_size_range($room_id);	
		echo json_encode($range); exit;
	}

	public function get_specific_floor(){
		$floor_id = $_GET['floor_id'];
		$floor = $this->floors_model->find($floor_id);	
		echo json_encode($floor); exit;
	}



}

/* End of file Properties.php */
/* Location: ./application/modules/properties/controllers/Properties.php */