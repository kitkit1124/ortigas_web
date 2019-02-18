<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Careers Class
 *
 * @package		Codifire
 * @version		1.0
 * @author 		Gutzby Marzan <gutzby.marzan@digify.com.ph>
 * @copyright 	Copyright (c) 2018, Digify, Inc.
 * @link		http://www.digify.com.ph
 */
class Careers extends MX_Controller {
	
	/**
	 * Constructor
	 *
	 * @access	public
	 *
	 */
	function __construct()
	{
		parent::__construct();

	
		$this->load->model('careers_model');
		$this->load->model('departments_model');
		$this->load->model('divisions_model');
		$this->load->model('jobs_model');
		$this->load->model('properties/related_links_model');
		$this->load->model('website/banners_model');
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
		$data['page_heading'] = 'Careers';
		$data['page_subhead'] = lang('index_subhead');
		$data['page_layout'] = 'full_width';
		
		// breadcrumbs
		$this->breadcrumbs->push(lang('crumb_home'), site_url(''));
		$this->breadcrumbs->push(lang('crumb_module'), site_url('estates'));
		
		// session breadcrumb
		$this->session->set_userdata('redirect', current_url());

		$careers_page = $this->pages_model->find(5); 

			$data['breadcrumbs']['heading'] = 'home';
			$data['breadcrumbs']['subhead'] = $careers_page->page_title;

			$data['careers_page'] = $careers_page;

			$data['careers_landing'] = $this->partials_model->find(4); 

			$data['sliders'] = $this->banners_model->get_banners(5);

			$data['careers'] = $this->careers_model->get_careers();

	        $metatags = "";
	        if(isset($careers_page->page_metatag_id) && $careers_page->page_metatag_id){
	        	$metatags = $this->metatags_model->get_metatags($careers_page->page_metatag_id);
	        }

	        $meta_title = $this->metatags_model->find($careers_page->page_metatag_id); 
			$data['page_heading'] = isset($meta_title->metatag_title) ? $meta_title->metatag_title : $careers_page->page_title;

			$careers = $this->careers_model->get_select_careers();
			$careers[''] = "ALL";
			$data['select_careers'] = $careers;


			$locations = $this->careers_model->get_select_careers_location();
			$locations[''] = "ALL";
			$data['select_locations'] = $locations;

			$departments = $this->departments_model->get_active_departments();
			$departments[''] = "ALL";
			$data['select_departments'] = $departments;

			$data['found_no_career'] = $this->partials_model->find(12); 

			$data['recommended_links'] = $this->related_links_model->find_all_by(array('related_link_section_id' => $data['careers_page']->page_id, 'related_link_section_type' => 'pages'));

			// render the page
			$this->template->write('head', $metatags);
			$this->template->add_css('npm/dropzone/dropzone.min.css');
			$this->template->add_js('npm/dropzone/dropzone.min.js');
			$this->template->add_css(module_css('careers', 'careers_document'), 'embed');
			$this->template->add_js(module_js('careers', 'careers_document'), 'embed');
			$this->template->add_css(module_css('careers', 'careers_index'), 'embed');
			$this->template->add_js(module_js('careers', 'careers_index'), 'embed');
			$this->template->write_view('content', 'careers_index', $data);
			$this->template->render();
	
	}


	public function view($params1,$params2)
	{
				
		$data['page_heading'] = $params2;


		// breadcrumbs
		$this->breadcrumbs->push(lang('crumb_home'), site_url(''));
		$this->breadcrumbs->push(lang('crumb_module'), site_url('estates'));
		
		// session breadcrumb
		$this->session->set_userdata('redirect', current_url());

		
			$fields = ['division_slug' => $params1, 'career_slug' => $params2];
			$career = $this->careers_model->get_careers($fields);
			if($career){
				$data['career'] = $career[0];

				// page title
				$meta_title = $this->metatags_model->find($career[0]->career_metatag_id); 
				$data['page_heading'] = isset($meta_title->metatag_title) ? $meta_title->metatag_title :  $career[0]->career_position_title;	
				$data['page_subhead'] = lang('index_subhead');
				$data['page_layout'] = 'full_width';


				$careers_page = $this->pages_model->find(5); 
				$data['breadcrumbs']['heading'] = 'home';
				$data['breadcrumbs']['page_subhead'] = $careers_page->page_title;
				$data['breadcrumbs']['page_subhead_link'] = $careers_page->page_slug;
				$data['breadcrumbs']['page_subhead_inner'] = $career[0]->division_name;
				$data['breadcrumbs']['page_subhead_inner_link'] = $careers_page->page_slug.'/'.strtolower($career[0]->division_slug);
				$data['breadcrumbs']['subhead'] = $career[0]->career_position_title;



				$data['sliders'] = $this->banners_model->get_banners(5);
				
				$data['careers_landing'] = $this->partials_model->find(4); 

		        $metatags = $this->metatags_model->get_metatags($career[0]->career_metatag_id);

				// render the page
				$this->template->write('head', $metatags);
				$this->template->add_css('npm/dropzone/dropzone.min.css');
				$this->template->add_js('npm/dropzone/dropzone.min.js');
				$this->template->add_css(module_css('careers', 'careers_document'), 'embed');
				$this->template->add_js(module_js('careers', 'careers_document'), 'embed');
				$this->template->add_css(module_css('careers', 'careers_view'), 'embed');
				$this->template->add_js(module_js('careers', 'careers_view'), 'embed');
				$this->template->write_view('content', 'careers_view', $data);
				$this->template->render();
			}
			else{
				redirect(base_url().'page-not-found');
			}
		
	}

	public function view_division($params)
	{
				
		$fields = [ 'division_slug' => $params ];

		$division = $this->divisions_model->find_by('division_slug',$params);

		if($division){

			$data['breadcrumbs']['heading'] = 'home';
			$data['breadcrumbs']['subhead'] = $division->division_name;

			$data['division'] = $division;

	        $metatags = "";
	        if(isset($division->division_metatag_id) && $division->division_metatag_id){
	        	$metatags = $this->metatags_model->get_metatags($division->division_metatag_id);
	        }

	        $meta_title = $this->metatags_model->find($division->division_metatag_id); 
			$data['page_heading'] = isset($meta_title->metatag_title) ? $meta_title->metatag_title : $division->division_name;

			$fields = [ 'division_slug' => $params ];
			$data['careers'] = $this->careers_model->get_careers($fields);

			$careers = $this->careers_model->get_select_careers();
			$careers[''] = "ALL";
			$data['select_careers'] = $careers;

			$locations = $this->careers_model->get_select_careers_location();
			$locations[''] = "ALL";
			$data['select_locations'] = $locations;

			$departments = $this->departments_model->get_active_departments();
			$departments[''] = "ALL";
			$data['select_departments'] = $departments;

			$data['recommended_links'] = $this->related_links_model->find_all_by(array('related_link_section_id' => $data['division']->division_id, 'related_link_section_type' => 'divisions', 'related_link_status' => 'Active','related_link_deleted' => 0));

			// render the page
			// $this->template->write('head', $metatags);
			$this->template->add_css('npm/dropzone/dropzone.min.css');
			$this->template->add_js('npm/dropzone/dropzone.min.js');
			$this->template->add_css(module_css('careers', 'careers_document'), 'embed');
			$this->template->add_js(module_js('careers', 'careers_document'), 'embed');
			$this->template->add_css(module_css('careers', 'careers_index'), 'embed');
			$this->template->add_js(module_js('careers', 'careers_index'), 'embed');
			$this->template->write_view('content', 'careers_view_division', $data);
			$this->template->render();
		}
		else{
			redirect(base_url().'page-not-found');
		}
	}


}

/* End of file Careers.php */
/* Location: ./application/modules/careers/controllers/Careers.php */