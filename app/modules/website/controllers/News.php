<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * News Class
 *
 * @package		Codifire
 * @version		1.0
 * @author 		Gutzby Marzan <gutzby.marzan@digify.com.ph>
 * @copyright 	Copyright (c) 2018, Digify, Inc.
 * @link		http://www.digify.com.ph
 */
class News extends MX_Controller 
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

		$this->load->driver('cache', $this->config->item('cache_drivers'));
	

		$this->load->model('posts_model');
		$this->load->model('banners_model');
		$this->load->model('news_tags_model');
		$this->load->model('post_tags_model');
		$this->load->model('partials_model');
		$this->load->model('pages_model');
		$this->load->model('partials_model');
		$this->load->model('metatags_model');
		$this->load->model('properties/related_links_model');
		$this->load->model('properties/properties_model');


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
		$data['page_layout'] = 'full_width';

		$this->breadcrumbs->push(lang('crumb_home'), site_url(''));
		$this->breadcrumbs->push(lang('index_heading'), current_url());

		$news_page = $this->pages_model->find_by('page_uri','news'); 
		$data['news_page'] = $news_page;


		if($this->input->get('q')){
			$data['param_date'] = $this->input->get('q'); 
		}

		$data['breadcrumbs']['heading'] = 'home';
		$data['breadcrumbs']['subhead'] = $news_page->page_title;

		//page_title
		$meta_title = $this->metatags_model->find($news_page->page_metatag_id); 
		$data['page_heading'] = isset($meta_title->metatag_title) ? $meta_title->metatag_title : $news_page->page_title;

		$data['sliders'] = $this->banners_model->get_banners(4);
		$data['news_tags']	= $this->news_tags_model->find_all_by(array('news_tag_status' => 'Active', 'news_tag_deleted' => 0));
		
		// $news = $this->posts_model->get_active_news();

		// foreach ($news as $key => $result) {
		// 	$result->post_tags= $this->post_tags_model->get_current_tags($result->post_id);
		// }

		// $data['news_result'] = $news;

        $metatags = "";
        if(isset($news_page->page_metatag_id) && $news_page->page_metatag_id){
        	$metatags = $this->metatags_model->get_metatags($news_page->page_metatag_id);
        }

		$fields = ['rand'=>true,'limit'=>4,'category_id'=>1];
		$data['residences'] = $this->properties_model->get_properties($fields);

		$fields = ['rand'=>true,'limit'=>4,'category_id'=>2];
		$data['malls'] 		= $this->properties_model->get_properties($fields);

		$fields = ['rand'=>true,'limit'=>4,'category_id'=>3];
		$data['offices'] 	= $this->properties_model->get_properties($fields);

		$data['section_id'] = 0;
		$data['section'] = 'News';

		$data['recommended_links'] = $this->related_links_model->find_all_by(array('related_link_section_id' => $data['news_page']->page_id, 'related_link_section_type' => 'pages', 'related_link_status' => 'Active', 'related_link_deleted' => 0));

		// add plugins
		$this->template->add_css('npm/datatables.net-bs4/css/dataTables.bootstrap4.css');
		$this->template->add_css('npm/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css');
		$this->template->add_js('npm/datatables.net/js/jquery.dataTables.js');
		$this->template->add_js('npm/datatables.net-bs4/js/dataTables.bootstrap4.js');
		$this->template->add_js('npm/datatables.net-responsive/js/dataTables.responsive.min.js');
		$this->template->add_js('npm/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js');

		$this->template->write('head', $metatags);
		$this->template->add_css(module_css('website', 'news_index'), 'embed');
		$this->template->add_css(module_css('website', 'news_result'), 'embed');
		$this->template->add_js(module_js('website', 'news_index'), 'embed');
		$this->template->write_view('content', 'news_index', $data);
		$this->template->render();
	}

	public function datatables()
	{

		$year = '';
		$month = '';
		if($this->input->get('qdate')){
			$date_str = explode("-",$this->input->get('qdate'));
			$year = $date_str[1];
			$month = $date_str[0];
		}

		$fields = [
			'tags' => $this->input->get('tags'),
			'year' => $year,
			'month' => $month,
		];
		echo $this->posts_model->get_datatables($fields);
	}

	public function get_current_tags()
	{	
		$current_tags = $this->post_tags_model->get_current_tags($_GET['post_id']);
		echo json_encode($current_tags); exit;
	}

	public function view($params)
	{
		
		$fields = [ 'post_slug' => $params ];
		$news = $this->posts_model->get_specific_news($fields);
		if($news){
			$data['news'] = $news[0];

			$data['page_heading'] = $news[0]->post_title;
			$data['page_subhead'] = lang('index_subhead');
			$data['page_layout'] = 'full_width';


			$news_page = $this->pages_model->find_by('page_uri','news');  
			$data['breadcrumbs']['heading'] = 'home';
			$data['breadcrumbs']['page_subhead'] = $news_page->page_title;
			$data['breadcrumbs']['page_subhead_link'] = strtolower($news_page->page_title);
			$data['breadcrumbs']['subhead'] = $news[0]->post_title;

			$data['news_tags'] = $this->news_tags_model->find_all();

			$fields = [ 'limit' => 4,
						'order_by' => 'post_posted_on',
						'without_this_post_id' => $news[0]->post_id
					];
			$data['latest_news'] = $this->posts_model->get_specific_news($fields);


			$archive = $this->posts_model->get_archive_year();
			foreach ($archive as $key => $value) {
				$archive[$key]->archive_month = $this->posts_model->get_archive_month($value->archive_year);
			}

			$data['archive'] = $archive;

	        $metatags = $this->metatags_model->get_metatags($news[0]->post_metatag_id);

			//page_title
			$meta_title = $this->metatags_model->find($news[0]->post_metatag_id); 
			$data['page_heading'] = isset($meta_title->metatag_title) ? $meta_title->metatag_title : $news[0]->post_title;



			$this->template->write('head', $metatags);
			$this->template->add_css(module_css('website', 'news_view'), 'embed');
			$this->template->add_js(module_js('website', 'news_view'), 'embed');
			$this->template->write_view('content', 'news_view', $data);
			$this->template->render();
		}
		else{
			redirect(base_url().'page-not-found');
		}
	}


	public function view_tags($params = null)
	{

		if($params){

			$tags = $this->news_tags_model->find_by(array('news_tag_slug' => $params));

			if($tags){

				$data['page_layout'] = 'full_width';

				$this->breadcrumbs->push(lang('crumb_home'), site_url(''));
				$this->breadcrumbs->push(lang('index_heading'), current_url());


				$find_params = substr($_SERVER['REQUEST_URI'],0,11);

				if($find_params == '/news/tags/'){
					$data['param_tags'] = $params; 
				}

				$news_page = $this->pages_model->find_by('page_uri','news'); 
				$data['news_page'] = $news_page;

				$data['breadcrumbs']['heading'] = 'home';
				$data['breadcrumbs']['subhead'] = $news_page->page_title;

				//page_title
				$meta_title = $this->metatags_model->find($news_page->page_metatag_id); 
				$data['page_heading'] = isset($meta_title->metatag_title) ? $meta_title->metatag_title : $news_page->page_title;

				$data['sliders'] = $this->banners_model->get_banners(4);
				$data['news_tags']	= $this->news_tags_model->find_all_by(array('news_tag_status' => 'Active', 'news_tag_deleted' => 0));
				

		        $metatags = "";
		        if(isset($news_page->page_metatag_id) && $news_page->page_metatag_id){
		        	$metatags = $this->metatags_model->get_metatags($news_page->page_metatag_id);
		        }

				$fields = ['rand'=>true,'limit'=>4,'category_id'=>1];
				$data['residences'] = $this->properties_model->get_properties($fields);

				$fields = ['rand'=>true,'limit'=>4,'category_id'=>2];
				$data['malls'] 		= $this->properties_model->get_properties($fields);

				$fields = ['rand'=>true,'limit'=>4,'category_id'=>3];
				$data['offices'] 	= $this->properties_model->get_properties($fields);

				$data['section_id'] = 0;
				$data['section'] = 'News';

				$data['recommended_links'] = $this->related_links_model->find_all_by(array('related_link_section_id' => $data['news_page']->page_id, 'related_link_section_type' => 'pages', 'related_link_status' => 'Active', 'related_link_deleted' => 0));

				// add plugins
				$this->template->add_css('npm/datatables.net-bs4/css/dataTables.bootstrap4.css');
				$this->template->add_css('npm/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css');
				$this->template->add_js('npm/datatables.net/js/jquery.dataTables.js');
				$this->template->add_js('npm/datatables.net-bs4/js/dataTables.bootstrap4.js');
				$this->template->add_js('npm/datatables.net-responsive/js/dataTables.responsive.min.js');
				$this->template->add_js('npm/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js');

				$this->template->write('head', $metatags);
				$this->template->add_css(module_css('website', 'news_index'), 'embed');
				$this->template->add_css(module_css('website', 'news_result'), 'embed');
				$this->template->add_js(module_js('website', 'news_index'), 'embed');
				$this->template->write_view('content', 'news_index', $data);
				$this->template->render();
			
			}
			else{
					redirect(base_url().'page-not-found');
				}
		}
		else{
			redirect(base_url().'page-not-found');
		}
		
	}

}