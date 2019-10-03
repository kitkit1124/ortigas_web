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
		$this->load->model('image_sliders_model');
		$this->load->model('amenities_model');
		$this->load->model('room_types_model');
		$this->load->model('units_model');
		$this->load->model('floors_model');
		$this->load->model('reservations_model');
		$this->load->model('categories_model');
		$this->load->model('price_range_model');
		$this->load->model('locations_model');
		$this->load->model('property_types_model');
		$this->load->model('settings_model');
		$this->load->model('related_links_model');
		$this->load->model('property_lease_spaces_model');
		$this->load->model('website/banners_model');
		$this->load->model('website/posts_model');
		$this->load->model('website/news_tags_model');
		$this->load->model('website/post_tags_model');
		$this->load->model('website/pages_model');
		$this->load->model('website/partials_model');
		$this->load->model('website/metatags_model');
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
		
		$projects = $this->pages_model->find_by('page_uri','projects'); 
		$data['sliders'] = $this->banners_model->get_banners(3);
		$data['projects'] = $projects;


		$data['breadcrumbs']['heading'] = 'home';
		$data['breadcrumbs']['subhead'] = $projects->page_title;


		$meta_title = $this->metatags_model->find($projects->page_metatag_id); 
		$data['page_heading'] = isset($meta_title->metatag_title) ? $meta_title->metatag_title : $projects->page_title;

        $metatags = "";
        if(isset($projects->page_metatag_id) && $projects->page_metatag_id){
        	$metatags = $this->metatags_model->get_metatags($projects->page_metatag_id);
        }

		$dev_types = $this->property_types_model->get_active_property_types();
	  	$dev_types[''] = "ALL";
	  	$data['select_dev_types'] = $dev_types;		

		$category = $this->categories_model->get_active_categories();
		$category[''] = "ALL";
		$data['select_categories'] = $category;

		$locations = $this->locations_model->get_active_locations();
		$locations[''] = "ALL";
		$data['select_locations'] = $locations;

		$range = $this->price_range_model->get_active_price_range();
		$range[''] = "ALL";
		$data['select_price_range'] = $range;


		$fields = [	'category_id' 	 => 1 ];
		$data['residences'] = $this->properties_model->get_search($fields);	

		$fields = [	'category_id' 	 => 2 ];
		$data['malls'] = $this->properties_model->get_search($fields);	

		$fields = [	'category_id' 	 => 3 ];
		$data['offices'] = $this->properties_model->get_search($fields);	


		$data['news_tags']	= $this->news_tags_model->find_all_by(array('news_tag_status' => 'Active', 'news_tag_deleted' => 0));

		$fields = ['limit' => 4, 'page_related_news' => 3 ];
		$news = $this->posts_model->get_active_news($fields);

		if($news){
			foreach ($news as $key => $result) {
				$result->post_tags= $this->post_tags_model->get_current_tags($result->post_id);
			}
		}

		$data['news_result'] = $news;

		$data['button_text'] = $this->partials_model->find(3);

		$data['recommended_links'] = $this->related_links_model->find_all_by(array('related_link_section_id' => 3, 'related_link_section_type' => 'pages', 'related_link_status' => 'Active', 'related_link_deleted' => 0));

		$data['section_id'] = 0;
		$data['section'] = 'Projects';

		// render the page
		$this->template->write('head', $metatags);
		$this->template->add_css(module_css('properties', 'properties_index'), 'embed');
		$this->template->add_js(module_js('properties', 'properties_index'), 'embed');
		$this->template->write_view('content', 'properties_index', $data);
		$this->template->render();
	}


	public function view($params)
	{
		if($params){
			$fields = [ 'property_slug' => $params ];
			$properties = $this->properties_model->get_properties($fields);
			if($properties){
				if($properties[0]->property_category_id==1){
					redirect(base_url().'residences/'.$params);
				}
				if($properties[0]->property_category_id==2){
					redirect(base_url().'malls/'.$params);
				}
				if($properties[0]->property_category_id==3){
					redirect(base_url().'offices/'.$params);
				}
				if($properties[0]->property_category_id==4){
					redirect(base_url().'amenities/'.$params);
				}
			}
			else{
				redirect(base_url().'page-not-found');
			}
		}
		else{
			redirect(base_url().'page-not-found');
		}
	}

	public function view_specific_property($params)
	{
				
		$data['enable_map'] = true;
				
		// breadcrumbs
		$this->breadcrumbs->push(lang('crumb_home'), site_url(''));
		$this->breadcrumbs->push(lang('crumb_module'), site_url('estates'));
		
		// session breadcrumb
		$this->session->set_userdata('redirect', current_url());

		if($params){

		$fields = [ 'property_slug' => $params ];
		$properties = $this->properties_model->get_properties($fields);
			
			if($properties){

				// page title
				$meta_title = $this->metatags_model->find($properties[0]->property_metatag_id); 
				$data['page_heading'] = isset($meta_title->metatag_title) ? $meta_title->metatag_title :  $properties[0]->property_name;

				$data['page_subhead'] = lang('index_subhead');
				$data['page_layout'] = 'full_width';


				$estates_page = $this->pages_model->find_by('page_uri','estates');  
				
				$subhead = $properties[0]->category_name;	
				$subhead_link = $estates_page->page_title.'/category/'.$properties[0]->category_name;
				$subhead_link = $properties[0]->category_name;
					
				$data['breadcrumbs']['heading'] = 'home';
				$data['breadcrumbs']['page_subhead'] = $subhead;
				$data['breadcrumbs']['page_subhead_link'] = strtolower($subhead_link);
				$data['breadcrumbs']['subhead'] = $properties[0]->property_name;

				$id = $properties[0]->property_id;
				
				$data['properties'] = $properties[0];
				
				$data['sliders'] = $this->image_sliders_model->find_all_by(
					array(
						'image_slider_section_id'=> $id,
						'image_slider_section_type'=>'properties',
						'image_slider_deleted' => 0,
						'image_slider_status' => 'Active'
					)
				);
				
				$data['room_types'] = $this->room_types_model->where('room_type_deleted',0)->where('room_type_status','Active')->find_all_by('room_type_property_id', $id);	
				
				$data['floors'] = $this->floors_model->get_floors_dropdown($id);
		
				$fields = [ 'rand' => true, 'limit'	=> 2, 'estate_id' => $properties[0]->property_estate_id,'wo_property_id' => $id, 'category_id' => 1];

				$data['other_residences'] = $this->properties_model->get_properties($fields);

				$data['amenities'] = $this->amenities_model->find_all_by(array('amenity_property_id'=> $id, 'amenity_status'=>'Active', 'amenity_deleted'=>0));

				$data['news_tags']	= $this->news_tags_model->find_all_by(array('news_tag_status' => 'Active', 'news_tag_deleted' => 0));

				$data['division_order'] = $this->settings_model->order_by('setting_order')->find_all();

				$fields = ['related_property' => $id];
				$news = $this->posts_model->get_active_news($fields);
				
				if($news){
					foreach ($news as $key => $result) {
						$result->post_tags= $this->post_tags_model->get_current_tags($result->post_id);
					}

					$data['news_result'] = $news;
				}
				
				$fields = ['rand'=>true,'limit'=>4,'category_id'=>1, 'estate_id' => $properties[0]->property_estate_id, 'wo_property_id' => $id];
				$data['residences'] = $this->properties_model->get_properties($fields);

				/*$fields = ['rand'=>true,'limit'=>4,'category_id'=>2];
				$data['malls'] 		= $this->properties_model->get_properties($fields);

				$fields = ['rand'=>true,'limit'=>4,'category_id'=>3];
				$data['offices'] 	= $this->properties_model->get_properties($fields);*/

	        	$metatags = $this->metatags_model->get_metatags($properties[0]->property_metatag_id);
	      


				$data['section_id'] = $id;
				$data['section'] = $properties[0]->category_name;

				$data['recommended_links'] = $this->related_links_model->find_all_by(array('related_link_section_id' => $id, 'related_link_section_type' => 'properties', 'related_link_status' => 'Active', 'related_link_deleted' => 0));

			}
			else{
				redirect(base_url().'page-not-found');
			}

		}
				
		// render the page
		$this->template->write('head', $metatags);
		$this->template->add_css(module_css('properties', 'properties_view'), 'embed');
		$this->template->add_js(module_js('properties', 'properties_view'), 'embed');
		$this->template->write_view('content', 'properties_view', $data);
		$this->template->render();
	}

	public function save(){
		$data = array(
			'reservation_code'				=> 'code',
			'reservation_property_id'		=> $this->input->post('pid'),
			'reservation_unit_id'			=> $this->input->post('uid'),
			'reservation_inquiry_type'		=> $this->input->post('inq'),
			'reservation_client_name'		=> $this->input->post('nam'),
			'reservation_client_email'		=> $this->input->post('ema'),
			'reservation_client_mobile'		=> $this->input->post('mob'),
			'reservation_client_address'	=> $this->input->post('add'),
			'reservation_payment_value'		=> 0,
			'reservation_payment_method'	=> $this->input->post('pyg'),
			'reservation_status'			=> 'Active',
		);
	
		$insert_id = $this->reservations_model->insert($data);
		$return = (is_numeric($insert_id)) ? $insert_id : FALSE;
	
		return $return;
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

	public function get_available_units(){
		$floor_id = $_GET['floor_id'];
		$units = $this->units_model->find_all_by('unit_floor_id',$floor_id);	
		echo json_encode($units); exit;
	}

	public function get_select_properties(){

		$fields =[];
		if($_GET['property_availability']){
			$fields = ['property_availability' => true];
		}
		$properties = $this->properties_model->get_properties($fields);	
		echo json_encode($properties);
	}

	public function get_prop_lease(){
		$fields = [];
		$query = $this->property_lease_spaces_model->find_all();	
		echo json_encode($query);
	}

	public function floorplan_image(){

		// page title
		$data['page_heading'] = '';
		$data['page_subhead'] = '';
		$data['action'] = '';

		$data['floorplan_image'] = $_GET['img'];

		$this->template->set_template('modal');
		$this->template->write_view('content', 'specific_properties/floorplan_image', $data);
		$this->template->render();
	}

	public function construction_timeline_modal(){
		// page title
		$data['page_heading'] = '';
		$data['page_subhead'] = '';
		$data['action'] = '';

		$data['content'] = '';

		if($this->input->get('id')):
			$data['sliders'] = $this->image_sliders_model->find_all_by(
				array(
					'image_slider_section_id'=> $this->input->get('id'),
					'image_slider_section_type'=>'properties',
					'image_slider_deleted' => 0,
					'image_slider_status' => 'Active'
				)
			);
		endif;
		
		$this->template->set_template('modal');
		$this->template->write_view('content', 'properties/construction_timeline_modal', $data);
		$this->template->render();
	}



}

/* End of file Properties.php */
/* Location: ./application/modules/properties/controllers/Properties.php */