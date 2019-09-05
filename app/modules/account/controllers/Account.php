<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Account Class
 *
 * @package		Codifire
 * @version		1.1
 * @author 		Randy Nivales <randynivales@gmail.com>
 * @copyright 	Copyright (c) 2014-2016, Randy Nivales
 * @link		randynivales@gmail.com
 */
class Account extends CI_Controller 
{
	/**
	 * Constructor
	 *
	 * @access	public
	 *
	 */
	function __construct()
	{
		parent::__construct();

		$this->load->model('account/users_model');
		$this->load->library('account/acl');

		$this->lang->load('account');
	}

	// --------------------------------------------------------------------

	/**
	 * index
	 *
	 * @access	public
	 * @param	none
	 * @author 	Randy Nivales <randynivales@gmail.com>
	 */
	public function index()
	{
		$this->acl->restrict('users.users.profile');
		
		$data['page_heading'] = 'Account Dashboard';
		$data['page_layout'] = 'full_width';

		// breadcrumbs
		$this->breadcrumbs->push(lang('crumb_home'), site_url(''));
		$this->breadcrumbs->push(lang('crumb_module'), site_url('account'));

		// session breadcrumb
		$this->session->set_userdata('redirect', current_url());

		// get the account info
		$this->load->model('account/users_model');
		$user = $this->users_model->find($this->session->userdata('user_id'));
		$data['user'] = $user;

		$this->template->add_css(module_css('account', 'account_index'), 'embed');
		$this->template->add_js(module_js('account', 'account_index'), 'embed');
		$this->template->write_view('content', 'account_index', $data);
		$this->template->render();
	}

	// --------------------------------------------------------------------

	/**
	 * profile
	 *
	 * @access	public
	 * @param	none
	 * @author 	Randy Nivales <randynivales@gmail.com>
	 */
	function profile($type = '')
	{
		$this->acl->restrict('users.users.profile');

		$data['page_heading'] = lang('profile_heading');
		$data['page_layout'] = 'full_width';

		// breadcrumbs
		$this->breadcrumbs->push(lang('crumb_home'), site_url(''));
		$this->breadcrumbs->push(lang('crumb_module'), site_url('account'));
		$this->breadcrumbs->push(lang('profile_heading'), site_url('account/profile'));

		$data['record'] = $this->users_model->find($this->session->userdata('user_id'));

		$data['type'] = $type; // wizard or normal

		// render the page
		$this->template->add_css(module_css('account', 'account_profile'), 'embed');
		$this->template->add_js(module_js('account', 'account_profile'), 'embed');
		$this->template->write_view('content', 'account_profile', $data);
		$this->template->render();
	}

	// --------------------------------------------------------------------

	/**
	 * edit
	 *
	 * @access	public
	 * @param	none
	 * @author 	Randy Nivales <randynivales@gmail.com>
	 */
	function edit()
	{
		$this->acl->restrict('users.users.profile');

		$data['page_heading'] = lang('edit_heading');

		if ($this->input->post())
		{
			if ($this->_save())
			{
				$this->session->set_flashdata('flash_message', lang('edit_success'));
				echo json_encode(array('success' => true, 'message' => lang('edit_success'))); exit;
			}
			else
			{	
				$response['success'] = FALSE;
				$response['message'] = lang('validation_error');
				$response['errors'] = array(
					'company' => form_error('company'),
					'first_name' => form_error('first_name'),
					'last_name' => form_error('last_name'),
					'phone' => form_error('phone')
				);
				echo json_encode($response); exit;
			}
		}

		$data['record'] = $this->users_model->find($this->session->userdata('user_id'));

		// render the page
		$this->template->set_template('modal');
		$this->template->add_css(module_css('account', 'account_edit'), 'embed');
		$this->template->add_js(module_js('account', 'account_edit'), 'embed');
		$this->template->write_view('content', 'account_edit', $data);
		$this->template->render();
	}

	// --------------------------------------------------------------------

	/**
	 * _save_bio
	 *
	 * @access	private
	 * @param	none
	 * @author 	Randy Nivales <randynivales@gmail.com>
	 */
	private function _save()
	{
		// validate inputs
		$this->form_validation->set_rules('company', lang('company'), 'required|max_length[150]');
		$this->form_validation->set_rules('first_name', lang('first_name'), 'required|max_length[150]');
		$this->form_validation->set_rules('last_name', lang('last_name'), 'required|max_length[150]');
		$this->form_validation->set_rules('phone', lang('phone'), 'required|max_length[150]');
		
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');		
		
		if ($this->form_validation->run($this) == FALSE) { return FALSE; }

		$data = array(
			'company' => $this->input->post('company'),
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'phone' => $this->input->post('phone'),
		);

		$this->users_model->update($this->session->userdata('user_id'), $data);

		return TRUE;
	}


	// --------------------------------------------------------------------

	/**
	 * login
	 *
	 * @access	public
	 * @param	none
	 * @author 	Randy Nivales <randynivales@gmail.com>
	 */
	function login()
	{
		$data['page_heading'] = "Login";
		$data['page_layout'] = 'full_width';

		//validate form input
		$this->form_validation->set_rules('identity', lang('identity'), 'required');
		$this->form_validation->set_rules('password', lang('password'), 'required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');


		// $this->template->set_template('default');
		$this->template->add_css(module_css('account', 'account_login'), 'embed');
		$this->template->write_view('content', 'account_login', $data);
		$this->template->render();
	}


	// --------------------------------------------------------------------

	/**
	 * logout
	 *
	 * @access	public
	 * @param	none
	 * @author 	Randy Nivales <randynivales@gmail.com>
	 */
	function logout()
	{
		//log the user out
		$this->ion_auth->logout();

		//redirect them to the login page
		$this->session->set_flashdata('flash_message', 'You have successfully logged out');
		// $this->session->set_flashdata('flash_message', '');
		redirect('account/login', 'refresh');
	}

}
