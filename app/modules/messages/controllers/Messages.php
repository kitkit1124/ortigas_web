<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Messages Class
 *
 * @package		Codifire
 * @version		1.0
 * @author 		Gutzby Marzan <gutzby.marzan@digify.com.ph>
 * @copyright 	Copyright (c) 2018, Digify, Inc.
 * @link		http://www.digify.com.ph
 */
class Messages extends MX_Controller {
	
	/**
	 * Constructor
	 *
	 * @access	public
	 *
	 */
	function __construct()
	{
		parent::__construct();

		$this->load->model('messages_model');
		$this->load->model('properties/estates_model');
		$this->load->model('properties/property_lease_spaces_model');
		$this->load->model('careers/careers_model');
		$this->load->model('properties/properties_model');
		
		$this->load->language('messages');
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

	// --------------------------------------------------------------------


	function form($action = 'add', $id = FALSE)
	{

		if ($this->input->post())
		{
			if ($this->_save($action, $id))
			{
				echo json_encode(array('success' => true, 'message' => lang($action . '_success'))); exit;
			}
			else
			{	
				$response['success'] = FALSE;
				$response['message'] = lang('validation_error');
				$response['errors'] = array(					
					'message_type'			=> form_error('message_type'),			
					'message_section'		=> form_error('message_section'),
					'message_section_id'	=> form_error('message_section_id'),
					'message_name'			=> form_error('message_name'),
					'message_email'			=> form_error('message_email'),
					'message_mobile'		=> form_error('message_mobile'),
					'message_location'		=> form_error('message_location'),
					'message_content'		=> form_error('message_content'),
					'message_status'		=> form_error('message_status'),
					'message_agreement'		=> form_error('message_agreement'),
					'message_captcha'		=> form_error('message_captcha'),
				);
				echo json_encode($response);
				exit;
			}
		}

		if ($action != 'add') $data['record'] = $this->messages_model->find($id);

	}


	// --------------------------------------------------------------------

	/**
	 * _save
	 *
	 * @access	private
	 * @param	string $action
	 * @param 	integer $id
	 * @author 	Gutzby Marzan <gutzby.marzan@digify.com.ph>
	 */
	private function _save($action = 'add', $id = 0)
	{
		// validate inputs
		$this->form_validation->set_rules('message_type', lang('message_type'), 'required');
		$this->form_validation->set_rules('message_section', lang('message_section'), 'required');
		$this->form_validation->set_rules('message_section_id', lang('message_section_id'), 'required');
		$this->form_validation->set_rules('message_name', lang('message_name'), 'required|min_length[1]|max_length[255]|alpha_dash_spaces');
		$this->form_validation->set_rules('message_email', lang('message_email'), 'required|valid_email|min_length[6]|max_length[255]');
		$this->form_validation->set_rules('message_mobile', lang('message_mobile'), 'required|min_length[1]|max_length[11]|numeric');
		$this->form_validation->set_rules('message_location', lang('message_location'), 'required|min_length[1]|max_length[255]');
		$this->form_validation->set_rules('message_content', lang('message_content'), 'min_length[1]|max_length[2000]');
		$this->form_validation->set_rules('message_status', lang('message_status'), 'required');
		$this->form_validation->set_rules('message_agreement', lang('message_agreement'), 'required');
		
		if ($this->input->post('message_type') == "Contact") {
			// $this->form_validation->set_rules('message_captcha', 'reCAPTCHA', 'required');
		}
		

		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');	

		if ($this->form_validation->run($this) == FALSE)
		{
			return FALSE;
		}

		$data = array(
			'message_type'			=> $this->input->post('message_type'),
			'message_section'		=> $this->input->post('message_section'),
			'message_section_id'	=> $this->input->post('message_section_id'),
			'message_name'			=> $this->input->post('message_name'),
			'message_email'			=> $this->input->post('message_email'),
			'message_mobile'		=> $this->input->post('message_mobile'),
			'message_location'		=> $this->input->post('message_location'),
			'message_content'		=> $this->input->post('message_content'),
			'message_status'		=> $this->input->post('message_status'),
		);
		

		if ($action == 'add')
		{
			$insert_id = $this->messages_model->insert($data);
			$return = (is_numeric($insert_id)) ? $insert_id : FALSE;

			$post_subject = '';
			if($this->input->post('message_type') != "Contact"){ $post_subject = ' Inquiry'; }


			$config['smtp_host'] = '192.168.6.163';
			$config['protocol'] = 'smtp';
			$config['smtp_timeout'] = 10;
            $config['smtp_port'] = 25;
            $config['smtp_user'] = '';
            $config['smtp_pass'] = '';
            $config['mailtype'] = 'html';
            $config['charset'] ='utf-8';
            $config['newline'] ='\r\n';
            $config['validation'] = true;
            $config['email_debug'] ='y';
        
            $this->load->library('email');

            $this->email->initialize($config);


            $section = $this->input->post('message_section');
            $section_id = $this->input->post('message_section_id');

            if(isset($section_id) && $section_id > 0){
				if($section == 'Estates'){
					$sec_data = $this->estates_model->find($section_id);
					$message_section_id = $sec_data->estate_name;
				}
				else if($section == 'Leasing Inquiry'){
					$sec_data = $this->property_lease_spaces_model->find($section_id);
					$message_section_id = $sec_data->lease_name;
				}
				else if($section == 'Career Inquiry'){
					$sec_data = $this->careers_model->find($section_id);
					$message_section_id = $sec_data->career_position_title;
				}
				else if($section == 'Residences' || $section == 'Malls' || $section == 'Offices' || $section == 'Sales Inquiry'){
					$sec_data = $this->properties_model->find($section_id);
					$message_section_id = $sec_data->property_name;
				}
			}
			else{
				$message_section_id = 'General';
			}


            
			$edata['message_type']			= $this->input->post('message_type');
			$edata['message_section']		= $this->input->post('message_section');
			$edata['message_section_id']	= $message_section_id;
			$edata['message_name']			= $this->input->post('message_name');
			$edata['message_email']			= $this->input->post('message_email');
			$edata['message_mobile']		= $this->input->post('message_mobile');
			$edata['message_location']		= $this->input->post('message_location');
			$edata['message_content']		= $this->input->post('message_content');
			$edata['message_status']		= $this->input->post('message_status');
		
            $message_content = $this->load->view('messages_email', $edata, TRUE);

            $this->email->clear();
            $this->email->set_newline("\r\n");
            $this->email->to(config_item('app_email'));
            $this->email->from(config_item('website_email'),config_item('website_name'));
            $this->email->subject($this->input->post('message_section').$post_subject);
            $this->email->set_mailtype("html");
            $this->email->message($message_content);
            $this->email->send();
		}
		else if ($action == 'edit')
		{
			$return = $this->messages_model->update($id, $data);
		}

		return $return;

	}
}

/* End of file Messages.php */
/* Location: ./application/modules/messages/controllers/Messages.php */