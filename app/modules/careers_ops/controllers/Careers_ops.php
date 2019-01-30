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
class Careers_ops extends MX_Controller {
	
	/**
	 * Constructor
	 *
	 * @access	public
	 *
	 */
	function __construct()
	{
		parent::__construct();

	
		$this->load->model('careers/careers_model');
		$this->load->model('careers/departments_model');
		$this->load->model('careers/divisions_model');
		$this->load->model('careers/jobs_model');
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
					'job_agreement'			=> form_error('job_agreement'),
					'job_captcha'			=> form_error('job_captcha'),
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
		$this->form_validation->set_rules('job_agreement', 'terms of agreement', 'required');
		$this->form_validation->set_rules('job_captcha', 'reCAPTCHA', 'required');

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