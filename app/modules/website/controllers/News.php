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
		$data['page_heading'] = 'News';
		$data['page_layout'] = 'full_width';

		$this->breadcrumbs->push(lang('crumb_home'), site_url(''));
		$this->breadcrumbs->push(lang('index_heading'), current_url());

		$news_page = $this->pages_model->find_by('page_uri','news'); 
		$data['news_page'] = $news_page;

		$data['sliders'] = $this->banners_model->get_banners(4);
		$data['news_tags']	= $this->news_tags_model->find_all_by(array('news_tag_status' => 'Active', 'news_tag_deleted' => 0));
		$news = $this->posts_model->get_active_news();

		foreach ($news as $key => $result) {
			$result->post_tags= $this->post_tags_model->get_current_tags($result->post_id);
		}

		$data['news_result'] = $news;

		$page_description = $this->metatags_model->clean_page_description($news_page->page_content);

        $metafields = [
        	'metatag_title'					=> config_item('website_name') . ' | ' . $news_page->page_title,
        	'metatag_description'			=> $page_description,
        	'metatag_keywords'				=> 'greenhills, shopping, center, tiendesitas, circulo, verde, frontera, verde, luntala, valle, verde, viridian, capitol, commons, royalton, imperium,maven',
        	'metatag_author'				=> config_item('website_name'),
        	'metatag_og_title'				=> config_item('website_name') . ' | ' . $news_page->page_title,
        	'metatag_og_image'				=> isset($data['sliders'][0]->banner_thumb) ? $data['sliders'][0]->banner_thumb : '',
        	'metatag_og_url'				=> current_url(),
        	'metatag_og_description'		=> $page_description,
        	'metatag_twitter_card'			=> 'photo',
        	'metatag_twitter_title'			=> config_item('website_name') . ' | ' . $news_page->page_title,
        	'metatag_twitter_image'			=> isset($data['sliders'][0]->banner_thumb) ? $data['sliders'][0]->banner_thumb : '',
        	'metatag_twitter_url'			=> current_url(),
        	'metatag_twitter_description'	=> $page_description,
        ];

        $metatags = $this->metatags_model->get_metatags($metafields);

		$fields = ['rand'=>true,'limit'=>4,'category_id'=>1];
		$data['residences'] = $this->properties_model->get_properties($fields);

		$fields = ['rand'=>true,'limit'=>4,'category_id'=>2];
		$data['malls'] 		= $this->properties_model->get_properties($fields);

		$fields = ['rand'=>true,'limit'=>4,'category_id'=>3];
		$data['offices'] 	= $this->properties_model->get_properties($fields);

		$data['section_id'] = 0;
		$data['section'] = 'News';

		$data['recommended_links'] = $this->related_links_model->find_all_by(array('related_link_section_id' => $data['news_page']->page_id, 'related_link_section_type' => 'pages'));
		
		$this->template->write('head', $metatags);
		$this->template->add_css(module_css('website', 'news_index'), 'embed');
		$this->template->add_js(module_js('website', 'news_index'), 'embed');
		$this->template->write_view('content', 'news_index', $data);
		$this->template->render();
	}

	public function view($params)
	{
		
		$fields = [ 'post_slug' => $params ];
		$news = $this->posts_model->get_specific_news($fields);
		$data['news'] = $news[0];

		$data['page_heading'] = $news[0]->post_title;
		$data['page_subhead'] = lang('index_subhead');
		$data['page_layout'] = 'full_width';



		$data['news_tags'] = $this->news_tags_model->find_all();

		$fields = [ 'news_tag_id' => $news[0]->news_tag_id,
					'without_this_post_id' => $news[0]->post_id
				];
		$data['suggested_news'] = $this->posts_model->get_specific_news($fields);


		$archive = $this->posts_model->get_archive_year();
		foreach ($archive as $key => $value) {
			$archive[$key]->archive_month = $this->posts_model->get_archive_month($value->archive_year);
		}

		$data['archive'] = $archive;

		$page_description = $this->metatags_model->clean_page_description($news[0]->post_content);

        $metafields = [
        	'metatag_title'					=> config_item('website_name') . ' | ' . $news[0]->post_title,
        	'metatag_description'			=> $page_description,
        	'metatag_keywords'				=> 'greenhills, shopping, center, tiendesitas, circulo, verde, frontera, verde, luntala, valle, verde, viridian, capitol, commons, royalton, imperium,maven',
        	'metatag_author'				=> config_item('website_name'),
        	'metatag_og_title'				=> config_item('website_name') . ' | ' . $news[0]->post_title,
        	'metatag_og_image'				=> isset($news[0]->post_image) ? $news[0]->post_image : '',
        	'metatag_og_url'				=> current_url(),
        	'metatag_og_description'		=> $page_description,
        	'metatag_twitter_card'			=> 'photo',
        	'metatag_twitter_title'			=> config_item('website_name') . ' | ' . $news[0]->post_title,
        	'metatag_twitter_image'			=> isset($news[0]->post_image) ? $news[0]->post_image : '',
        	'metatag_twitter_url'			=> current_url(),
        	'metatag_twitter_description'	=> $page_description,
        ];

        $metatags = $this->metatags_model->get_metatags($metafields);


		$this->template->write('head', $metatags);
		$this->template->add_css(module_css('website', 'news_view'), 'embed');
		$this->template->add_js(module_js('website', 'news_view'), 'embed');
		$this->template->write_view('content', 'news_view', $data);
		$this->template->render();
	}

}