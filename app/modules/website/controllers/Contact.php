<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Contact Class
 *
 * @package		Codifire
 * @version		1.0
 * @author 		Randy Nivales <randynivales@gmail.com>
 * @copyright 	Copyright (c) 2017, Randy Nivales
 * @link		randynivales@gmail.com
 */
class Contact extends MX_Controller 
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

		$this->load->language('contact');
		$this->load->model('pages_model');
		$this->load->model('posts_model');
		$this->load->model('post_tags_model');
		$this->load->model('partials_model');
		$this->load->model('banners_model');
		$this->load->model('website/metatags_model');
		$this->load->model('properties/properties_model');
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
		$data['page_layout'] = 'full_width';

		$this->breadcrumbs->push(lang('crumb_home'), site_url(''));
		$this->breadcrumbs->push(lang('index_heading'), current_url());

		if ($this->input->post('submit'))
		{
			if ($this->_send_message())
			{
				$this->session->set_flashdata('flash_message', lang('index_success'));

				redirect(current_url(), 'refresh');
			}
			else
			{	
				$data['error_message'] = lang('validation_error');
			}
		}

		$data['sliders'] = $this->banners_model->get_banners(6);
		$page = $this->pages_model->find_by(array('page_uri' => 'contact-us', 'page_status' => 'Posted', 'page_deleted' => 0));
		$data['page_content'] = $page;

		$data['breadcrumbs']['heading'] = 'home';
		$data['breadcrumbs']['subhead'] = $page->page_title;



		$data['contact_address'] = $this->partials_model->find(1);
		$data['properties'] = $this->properties_model->get_select_properties();

        $metatags = "";
        if(isset($page->page_metatag_id) && $page->page_metatag_id){
        	$metatags = $this->metatags_model->get_metatags($page->page_metatag_id);
        }

        $meta_title = $this->metatags_model->find($page->page_metatag_id); 
		$data['page_heading'] = isset($meta_title->metatag_title) ? $meta_title->metatag_title : $page->page_title;

		$fields = ['limit' => 4, 'page_related_news' => 6 ];
		$news = $this->posts_model->get_active_news($fields);

		if($news){
			foreach ($news as $key => $result) {
				$result->post_tags= $this->post_tags_model->get_current_tags($result->post_id);
			}

			$data['news_result'] = $news;
		}

		$data['enable_map'] = true;

		// $this->template->add_css('npm/bootstrap-float-label/bootstrap-float-label.min.css');
		$this->template->write('head', $metatags);
		$this->template->add_css(module_css('website', 'contact_index'), 'embed');
		$this->template->add_js(module_js('website', 'contact_index'), 'embed');
		$this->template->write_view('content', 'contact_index', $data);
		$this->template->render();
	}

	// --------------------------------------------------------------------

	/**
	 * _send_message
	 *
	 * @access	private
	 * @param	none
	 * @author 	Randy Nivales <randynivales@gmail.com>
	 */
	private function _send_message()
	{
		// validate inputs
		$this->form_validation->set_rules('name', lang('name'), 'required|max_length[150]');
		$this->form_validation->set_rules('email', lang('email'), 'required|valid_email');
		$this->form_validation->set_rules('phone', lang('phone'), 'required|max_length[150]');
		$this->form_validation->set_rules('subject', lang('subject'), 'required|max_length[150]');
		$this->form_validation->set_rules('content', lang('content'), 'required');
		// $this->form_validation->set_rules('g-recaptcha-response', 'reCAPTCHA', 'required');

		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

		if ($this->form_validation->run($this) == FALSE)
		{
			return FALSE;
		}
		else
		{
			// send the email
			$edata = array(
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'subject' => $this->input->post('subject'),
				'content' => $this->input->post('content'),
			);

			$content = $this->load->view('emails/contact_form', $edata, TRUE);

			$this->load->library('email');
			$this->email->from(config_item('website_email'), config_item('website_name'));
			$this->email->to(config_item('email_notifications_bcc'));
			$this->email->subject('Message from ' . $this->input->post('name'));
			$this->email->message($content);
			$this->email->send();

			// echo $this->email->print_debugger(array('headers'));
			// exit;
		}

		return TRUE;
	}


	public function get_projects(){
		if (!$this->input->is_ajax_request()) {	redirect(base_url().'page-not-found');	}
		
		$message_section = $_POST['message_section'];
		if($message_section == 'Estates'){
		
			$result = $this->estates_model->get_estates();
			echo json_encode($result);
		}

		if($message_section == 'Properties'){
		
			$result = $this->properties_model->get_select_properties();
			echo json_encode($result);
		}

		return $result;
	}

}