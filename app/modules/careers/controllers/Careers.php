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

	public function search()
	{

		$fields = [
			'keyword' 		 	=> $this->input->post('keyword'),
			'career_id' 	 	=> $this->input->post('career_id'),
			'career_location'   => $this->input->post('career_location'),
			'department_id' 	=> $this->input->post('department_id')
		];
				
		$result = $this->careers_model->get_careers($fields);
		echo json_encode(array('success' => true, 'result' => $result)); exit;		
	}

	public function view($params)
	{
				
		$data['page_heading'] = $params;


		// breadcrumbs
		$this->breadcrumbs->push(lang('crumb_home'), site_url(''));
		$this->breadcrumbs->push(lang('crumb_module'), site_url('estates'));
		
		// session breadcrumb
		$this->session->set_userdata('redirect', current_url());

		
			$fields = ['career_slug' => $params];
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
				$data['breadcrumbs']['page_subhead_link'] = strtolower($careers_page->page_title);
				$data['breadcrumbs']['page_subhead_inner'] = $career[0]->division_name;
				$data['breadcrumbs']['page_subhead_inner_link'] = strtolower($career[0]->division_name);
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


	public function valdidate_save(){


		if ($this->input->post())
		{
			if ($this->_save())
			{
				echo json_encode(array('success' => true)); exit;
			}
			else
			{	
				$response['success'] = FALSE;
				$response['message'] = lang('validation_error');
				$response['errors'] = array(					
					'job_career_id'			=> form_error('job_career_id'),
					'job_applicant_name'	=> form_error('job_applicant_name'),
					'job_email'				=> form_error('job_email'),
					'job_mobile'			=> form_error('job_mobile'),
					'job_document'			=> form_error('job_document'),
				);
				echo json_encode($response);
				exit;
			}
		}
	
	}

	public function get_careers(){
		$fields = [];
		$careers = $this->careers_model->get_careers($fields);	
		echo json_encode($careers);
	}


	function _save(){

		$this->form_validation->set_rules('job_career_id', lang('job_career_id'), 'required');
		$this->form_validation->set_rules('job_applicant_name', 'Applicant Name', 'required');
		$this->form_validation->set_rules('job_email', 'E-mail', 'required');
		$this->form_validation->set_rules('job_mobile', 'Mobile', 'required');
		$this->form_validation->set_rules('job_document', 'File / Document', 'required');

		if ($this->form_validation->run($this) == FALSE)
		{
			return FALSE;
		}

		$data = array(
			'job_career_id'				=> $this->input->post('job_career_id'),
			'job_applicant_name'		=> $this->input->post('job_applicant_name'),
			'job_email'					=> $this->input->post('job_email'),
			'job_mobile'				=> $this->input->post('job_mobile'),
			'job_document'				=> $this->input->post('job_document'),
			'job_referred'				=> $this->input->post('job_referred'),
		);

		$insert_id = $this->jobs_model->insert($data);
		$return = (is_numeric($insert_id)) ? $insert_id : FALSE;
	
		return $return;
	}


}

/* End of file Careers.php */
/* Location: ./application/modules/careers/controllers/Careers.php */