<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Subscribers Class
 *
 * @package		Codifire
 * @version		1.0
 * @author 		Gutz Marzan <webdevs@digify.com.ph>
 * @copyright 	Copyright (c) 2019, Digify, Inc.
 * @link		http://www.digify.com.ph
 */
class Subscribers extends MX_Controller {
	
	/**
	 * Constructor
	 *
	 * @access	public
	 *
	 */
	function __construct()
	{
		parent::__construct();

		$this->load->model('subscribers_model');
		$this->load->model('website/partials_model');
		$this->load->language('subscribers');
	}
	
	// --------------------------------------------------------------------

	/**
	 * index
	 *
	 * @access	public
	 * @param	none
	 * @author 	Gutz Marzan <webdevs@digify.com.ph>
	 */
	public function index()
	{

		
	}

	// --------------------------------------------------------------------

	/**
	 * datatables
	 *
	 * @access	public
	 * @param	mixed datatables parameters (datatables.net)
	 * @author 	Gutz Marzan <webdevs@digify.com.ph>
	 */
	public function datatables()
	{
		$this->acl->restrict('subscribers.subscribers.list');

		echo $this->subscribers_model->get_datatables();
	}

	// --------------------------------------------------------------------

	/**
	 * form
	 *
	 * @access	public
	 * @param	$action string
	 * @param   $id integer
	 * @author 	Gutz Marzan <webdevs@digify.com.ph>
	 */
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
				echo json_encode($response);
				exit;
			}
		}

		if ($action != 'add') $data['record'] = $this->subscribers_model->find($id);


		// render the page
		// $this->template->set_template('modal');
		// $this->template->add_css(module_css('subscribers', 'subscribers_form'), 'embed');
		// $this->template->add_js(module_js('subscribers', 'subscribers_form'), 'embed');
		// $this->template->write_view('content', 'subscribers_form', $data);
		// $this->template->render();
	}

	// --------------------------------------------------------------------

	/**
	 * delete
	 *
	 * @access	public
	 * @param	integer $id
	 * @author 	Gutz Marzan <webdevs@digify.com.ph>
	 */
	function delete($id)
	{
		$this->acl->restrict('subscribers.subscribers.delete', 'modal');

		$data['page_heading'] = lang('delete_heading');
		$data['page_confirm'] = lang('delete_confirm');
		$data['page_button'] = lang('button_delete');
		$data['datatables_id'] = '#datatables';

		if ($this->input->post())
		{
			$this->subscribers_model->delete($id);

			echo json_encode(array('success' => true, 'message' => lang('delete_success'))); exit;
		}

		$this->load->view('../../modules/core/views/confirm', $data);
	}


	// --------------------------------------------------------------------

	/**
	 * _save
	 *
	 * @access	private
	 * @param	string $action
	 * @param 	integer $id
	 * @author 	Gutz Marzan <webdevs@digify.com.ph>
	 */
	private function _save($action = 'add', $id = 0)
	{
		// validate inputs
		$this->form_validation->set_rules('subscriber_email', lang('subscriber_email'), 'required|valid_email');

		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
		
		if ($this->form_validation->run($this) == FALSE)
		{
			return FALSE;
		}

		$data = array(
			'subscriber_email'		=> $this->input->post('subscriber_email'),
			'subscriber_status'		=> 'Active',
		);
		

		if ($action == 'add')
		{
			$insert_id = $this->subscribers_model->insert($data);
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

            $edata['subscriber_email']	=  $this->input->post('subscriber_email');
            $edata['cms_site'] = getenv('UPLOAD_ROOT');

            $message_content = $this->load->view('messages/messages_subscribe_email', $edata, TRUE);

            $this->email->clear();
            $this->email->set_newline("\r\n");
            $this->email->to(config_item('app_email'));
            $this->email->from(config_item('website_email'),config_item('website_name'));
            $this->email->subject('Client Subscription');
            $this->email->set_mailtype("html");
            $this->email->message($message_content);
            $this->email->send();

		}
		else if ($action == 'edit')
		{
			$return = $this->subscribers_model->update($id, $data);
		}

		return $return;

	}
}

/* End of file Subscribers.php */
/* Location: ./application/modules/subscribers/controllers/Subscribers.php */