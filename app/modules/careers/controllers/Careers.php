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
		$data['careers_page'] = $careers_page;

		$data['careers_landing'] = $this->partials_model->find(4); 

		$data['sliders'] = $this->banners_model->get_banners(5);

		$data['careers'] = $this->careers_model->get_careers();

		$page_description = $this->metatags_model->clean_page_description($careers_page->page_content);

        $metafields = [
        	'metatag_title'					=> config_item('website_name') . ' | ' . $careers_page->page_title,
        	'metatag_description'			=> $page_description,
        	'metatag_keywords'				=> 'greenhills, shopping, center, tiendesitas, circulo, verde, frontera, verde, luntala, valle, verde, viridian, capitol, commons, royalton, imperium,maven',
        	'metatag_author'				=> config_item('website_name'),
        	'metatag_og_title'				=> config_item('website_name') . ' | ' . $careers_page->page_title,
        	'metatag_og_image'				=> isset($data['sliders'][0]->banner_thumb) ? $data['sliders'][0]->banner_thumb : '',
        	'metatag_og_url'				=> current_url(),
        	'metatag_og_description'		=> $page_description,
        	'metatag_twitter_card'			=> 'photo',
        	'metatag_twitter_title'			=> config_item('website_name') . ' | ' . $careers_page->page_title,
        	'metatag_twitter_image'			=> isset($data['sliders'][0]->banner_thumb) ? $data['sliders'][0]->banner_thumb : '',
        	'metatag_twitter_url'			=> current_url(),
        	'metatag_twitter_description'	=> $page_description,
        ];

        $metatags = $this->metatags_model->get_metatags($metafields);

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
				
		// breadcrumbs
		$this->breadcrumbs->push(lang('crumb_home'), site_url(''));
		$this->breadcrumbs->push(lang('crumb_module'), site_url('estates'));
		
		// session breadcrumb
		$this->session->set_userdata('redirect', current_url());

		$fields = ['career_slug' => $params];
		$career = $this->careers_model->get_careers($fields);
		$data['career'] = $career[0];

		// page title
		$data['page_heading'] = $career[0]->career_position_title;
		$data['page_subhead'] = lang('index_subhead');
		$data['page_layout'] = 'full_width';

		$data['sliders'] = $this->banners_model->get_banners(5);
		
		$data['careers_landing'] = $this->partials_model->find(4); 

		$page_description = $this->metatags_model->clean_page_description($career[0]->career_res);

        $metafields = [
        	'metatag_title'					=> config_item('website_name') . ' | ' . $career[0]->career_position_title,
        	'metatag_description'			=> $page_description,
        	'metatag_keywords'				=> 'greenhills, shopping, center, tiendesitas, circulo, verde, frontera, verde, luntala, valle, verde, viridian, capitol, commons, royalton, imperium,maven',
        	'metatag_author'				=> config_item('website_name'),
        	'metatag_og_title'				=> config_item('website_name') . ' | ' . $career[0]->career_position_title,
        	'metatag_og_image'				=> isset($career[0]->career_image) ? $career[0]->career_image : '',
        	'metatag_og_url'				=> current_url(),
        	'metatag_og_description'		=> $page_description,
        	'metatag_twitter_card'			=> 'photo',
        	'metatag_twitter_title'			=> config_item('website_name') . ' | ' . $career[0]->career_position_title,
        	'metatag_twitter_image'			=> isset($career[0]->career_image) ? $career[0]->career_image : '',
        	'metatag_twitter_url'			=> current_url(),
        	'metatag_twitter_description'	=> $page_description,
        ];

        $metatags = $this->metatags_model->get_metatags($metafields);

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