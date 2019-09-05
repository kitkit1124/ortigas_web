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
			$categories = $this->_get_data_from('categories_model','category',NULL);
			$estates 	= $this->_get_data_from('estates_model','estate','estates/');
			$residence	= $this->_get_data_from('properties_model','property','residences/');
			$malls		= $this->_get_data_from('properties_model','property','malls/');
			$offices	= $this->_get_data_from('properties_model','property','offices/');
			$careers	= $this->_get_data_from('careers_model','career','careers/');
			
			$data['site'] 		= array_merge($pages,$posts,$categories,$estates,$residence,$malls,$offices,$careers);	

			header("Content-type: text/xml");
			$this->load->view('sitemap/sitemap_view', $data);
	}

	function _get_data_from($model,$singular,$segment){


		if($singular=='page' || $singular=='post'){ 
			$status = 'Posted';
		} 
		else{ 
			$status = 'Active';
		}


		if($singular=='category'){ 
			$field = $singular.'_name'; 
		}
		else{ 
			$field = $singular.'_slug'; 
		}

		$lastmod = $singular.'_modified_on';

		

		if($singular=='property'){
			$data =	$this->$model
			->where('property_categories.category_name',substr($segment,0,-1))
			->join('property_categories', 'property_categories.category_id = property_category_id', 'LEFT')
			->where($singular.'_status', $status)
			->where($singular.'_deleted', 0)
			->find_all();
		}
		else{

			$data =	$this->$model
			->where($singular.'_status', $status)
			->where($singular.'_deleted', 0)
			->find_all();
		}
				
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