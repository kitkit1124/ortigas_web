<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Metatags_model Class
 *
 * @package		Codifire
 * @version		1.0
 * @author 		Randy Nivales <randy.nivales@digify.com.ph>
 * @copyright 	Copyright (c) 2016, Digify, Inc.
 * @link		http://www.digify.com.ph
 */
class Metatags_model extends BF_Model 
{

	protected $table_name			= 'metatags';
	protected $key					= 'metatag_id';
	protected $date_format			= 'datetime';
	protected $log_user				= TRUE;

	protected $set_created			= TRUE;
	protected $created_field		= 'metatag_created_on';
	protected $created_by_field		= 'metatag_created_by';

	protected $set_modified			= TRUE;
	protected $modified_field		= 'metatag_modified_on';
	protected $modified_by_field	= 'metatag_modified_by';

	protected $soft_deletes			= TRUE;
	protected $deleted_field		= 'metatag_deleted';
	protected $deleted_by_field		= 'metatag_deleted_by';

	// --------------------------------------------------------------------

	/**
	 * get_metatags
	 *
	 * @access	public
	 * @param 	integer $id
	 * @author 	Randy Nivales <randy.nivales@digify.com.ph>
	 */
	
	public function get_metatags($id)
	{
		$metatags = $this->find($id);

		$output = '';
		if ($metatags)
		{
		
			$robots = '<meta name="robots" content="INDEX, FOLLOW"/>'. "\r\n\t";
			if($metatags->metatag_robots=="No Index"){ $robots = '<meta name="robots" content="NO INDEX, NO FOLLOW"/>'. "\r\n\t"; }

		$output .= $robots
				.'<meta name="title" content="' . $metatags->metatag_title . '" />' . "\r\n\t"
				. '<meta name="keywords" content="' . (($metatags->metatag_keywords) ? $metatags->metatag_keywords : '') . '" />' . "\r\n\t"
				. '<meta name="description" content="' . (($metatags->metatag_description) ? $metatags->metatag_description : '') . '" />' . "\r\n\t"
				. '<meta name="author" content="' .config_item('website_name'). '" />' . "\r\n\t"
				. '<meta property="og:title" content="' . (($metatags->metatag_og_title) ? $metatags->metatag_og_title : '') . '"/>' . "\r\n\t"
				. '<meta property="og:image" content="' . (($metatags->metatag_og_image) ? getenv('UPLOAD_ROOT').$metatags->metatag_og_image : '') . '"/>' . "\r\n\t"
				. '<meta property="og:description" content="' . (($metatags->metatag_og_description) ? $metatags->metatag_og_description : '') . '" />' . "\r\n\t"  
				. '<meta property="og:url" content="' . current_url() .'"/>' . "\r\n\t"
				. '<meta name="twitter:card" content="photo"/>' . "\r\n\t"
				. '<meta name="twitter:title" content="' . (($metatags->metatag_twitter_title) ? $metatags->metatag_twitter_title : '') . '"/>' . "\r\n\t"
				. '<meta name="twitter:url" content="' . current_url() . '"/>' . "\r\n\t"
				. '<meta name="twitter:description" content="' . (($metatags->metatag_twitter_description) ? $metatags->metatag_twitter_description : '') . '"/>' . "\r\n\t"
				. '<meta name="twitter:image" content="' . (($metatags->metatag_twitter_image) ? getenv('UPLOAD_ROOT').$metatags->metatag_twitter_image : '') . '"/>'. "\r\n\t"
				.  $metatags->metatag_code;
               
		}

		return $output;
	}
	

	// --------------------------------------------------------------------

	/**
	* get_metatags
	*
	* @access	public
	* @param 	varchar @data
	* @author 	Gutz Marzan <gutzby.marzan@digify.com.ph>
	*/
	
	// public function get_metatags($metatags)
	// {

	// 	$output = '';
	// 	if ($metatags)
	// 	{
 //                 . '<meta name="author" content="' . ($metatags['metatag_author'] ? $metatags['metatag_author'] : '') . '" />' . "\r\n\t"
 //                 . '<meta property="og:title" content="' . ($metatags['metatag_og_title'] ? $metatags['metatag_og_title'] : '') . '"/>' . "\r\n\t"
 //                 . '<meta property="og:image" content="' . ($metatags['metatag_og_image'] ? site_url($metatags['metatag_og_image']) : '') . '"/>' . "\r\n\t"
 //                 . '<meta property="og:url" content="' . ($metatags['metatag_og_url'] ? $metatags['metatag_og_url'] : '') . '" />' . "\r\n\t"
 //                 . '<meta property="og:description" content="' . ($metatags['metatag_og_description'] ? $metatags['metatag_og_description'] : '') . '" />' . "\r\n\t"
 //                 . '<meta name="twitter:card" content="' . ($metatags['metatag_twitter_card'] ? $metatags['metatag_twitter_card'] : '') . '"/>' . "\r\n\t"
 //                 . '<meta name="twitter:title" content="' . ($metatags['metatag_twitter_title'] ? $metatags['metatag_twitter_title'] : '') . '"/>' . "\r\n\t"
 //                 . '<meta name="twitter:image:src" content="' . ($metatags['metatag_twitter_image'] ? site_url($metatags['metatag_twitter_image']) : '') . '"/>' . "\r\n\t"
 //                 . '<meta name="twitter:url" content="' . ($metatags['metatag_twitter_url'] ? $metatags['metatag_twitter_url'] : '') . '" />' . "\r\n\t"
 //                 . '<meta name="twitter:description" content="' . ($metatags['metatag_twitter_description'] ? $metatags['metatag_twitter_description'] : '') . '"/>';
	// 	}

	// 	return $output;
	// }

	public function clean_page_description($content)
	{
	    $content = substr($content, 0, strpos($content, "</p>")+4);

		$doc = new DOMDocument();
   		$doc->loadHTML($content);

   		foreach($doc->getElementsByTagName('p') as $paragraph) {
	    	$page_description = strip_tags($paragraph->nodeValue);
	    } 

	    return $page_description;
	}





}