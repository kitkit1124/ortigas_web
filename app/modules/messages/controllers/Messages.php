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

            $this->email->clear();
            $this->email->set_newline("\r\n");
            $this->email->to('gutzby.nobleza.marzan@gmail.com');
            $this->email->from('no-reply@test.com');
            $this->email->subject('Subject');
            $this->email->set_mailtype("html");
            $this->email->message('Test Content Please');
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