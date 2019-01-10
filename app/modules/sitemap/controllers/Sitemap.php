<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sitemap Class
 *
 * @package		Codifire
 * @version		1.0
 * @author 		Gutzby Marzan <gutzby.marzan@digify.com.ph>
 * @copyright 	Copyright (c) 2018, Digify, Inc.
 * @link		http://www.digify.com.ph
 */
class Sitemap extends MX_Controller 
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

		$this->load->model('website/pages_model');
		$this->load->model('website/posts_model');
		$this->load->model('properties/categories_model');
		$this->load->model('properties/estates_model');
		$this->load->model('properties/properties_model');
		$this->load->model('careers/careers_model');
	}

	// --------------------------------------------------------------------

	public function index(){

			
			$pages 		= $this->_get_data_from('pages_model','page',NULL); 
			$posts 		= $this->_get_data_from('posts_model','post','news/');
			$categories = $this->_get_data_from('categories_model','category','estates/category/');
			$estates 	= $this->_get_data_from('estates_model','estate','estates/');
			$properties	= $this->_get_data_from('properties_model','property','estates/property/');
			$careers	= $this->_get_data_from('careers_model','career','careers/post/');
			
			$data['site'] 		= array_merge($pages,$posts,$categories,$estates,$properties,$careers);	

			header("Content-type: text/xml");
			$this->load->view('sitemap/sitemap_view', $data);
	}

	function _get_data_from($model,$singular,$segment){


		if($singular=='page' || $singular=='post'){ $status = 'Posted';} else{ $status = 'Active'; }
		if($singular=='category'){ $field = $singular.'_name'; }else{ $field = $singular.'_slug'; }

		$lastmod = $singular.'_modified_on';

		$data =	$this->$model
					->where($singular.'_status', $status)
					->where($singular.'_deleted', 0)
					->find_all();

		$array = [];

		foreach ($data as $key => $value) {
			$array[$key]['loc'] = strtolower(base_url().$segment.$value->$field);
			$array[$key]['lastmod'] = $value->$lastmod;

			if($singular=='page'){ 
				$array[$key]['changefreq'] = 'monthly';
				$array[$key]['priority'] = '0.5';
			}

			if($singular=='post'){ 
				$array[$key]['changefreq'] = 'monthly';
				$array[$key]['priority'] = '0.7';
			}

			if($singular=='category'){ 
				$array[$key]['changefreq'] = 'monthly';
				$array[$key]['priority'] = '0.6';
			}

			if($singular=='estate'){ 
				$array[$key]['changefreq'] = 'monthly';
				$array[$key]['priority'] = '0.8';
			}

			if($singular=='property'){ 
				$array[$key]['changefreq'] = 'monthly';
				$array[$key]['priority'] = '0.9';
			}

			if($singular=='career'){ 
				$array[$key]['changefreq'] = 'monthly';
				$array[$key]['priority'] = '0.4';
			}
		}

		return $array;
	}

}