<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Scrapers Class
 *
 * @package		Codifire
 * @version		1.0
 * @author 		Gutzby Marzan <gutzby.marzan@digify.com.ph>
 * @copyright 	Copyright (c) 2018, Digify, Inc.
 * @link		http://www.digify.com.ph
 */
class Scrapers extends MX_Controller 
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

		$this->load->model('url_model');
		//set_time_limit(1000);

	}

	// --------------------------------------------------------------------

	public function index(){}

	public function get_meta(){

		$url = $this->url_model->find_all();

		echo '<table border="1">';
		echo '<th></th>';
		echo '<th>URL</th>';
		echo '<th>STATUS</th>';
		echo '<th>TITLE</th>';
		echo '<th>DESCRIPTION</th>';
		echo '<th>KEYWORDS</th>';
		echo '<th>AUTHOR</th>';
		echo '<th>OG:TITLE</th>';
		echo '<th>OG:TYPE</th>';
		echo '<th>OG:IMAGE</th>';
		echo '<th>OG:URL</th>';
		echo '<th>OG:DESCRIPTION</th>';
		echo '<th>TWIITER:CARD</th>';
		echo '<th>TWIITER:TITLE</th>';
		echo '<th>TWIITER:DESCRIPTION</th>';
		echo '<th>TWIITER:IMAGE:SRC</th>';
		echo '<th>COPYRIGHT</th>';
		echo '<th>VIEWPORT</th>';
		echo '<th>H1</th>';
		echo '<th>H2</th>';
		echo '<th>H3</th>';
		echo '<th>BODY</th>';

		foreach ($url as $key => $val) {

			list($status) = get_headers($val->url);
			if (strpos($status, '404') !== FALSE) {
				$meta_data = "Page Not Found";

			}else{
				$meta_data = $this->get_page_structure($val->url);
			}
			if($meta_data){
				echo '<tr>';

				echo '<td>'.$val->id.'</td>';
				echo '<td>'.$val->url.'</td>';
				echo '<td>'.(isset($meta_data['status']) ? $meta_data['status'] : '').'</td>';
				echo '<td>'.(isset($meta_data['title']) ? $meta_data['title'] : '').'</td>';
				echo '<td>'.(isset($meta_data['description']) ? $meta_data['description'] : '').'</td>';
				echo '<td>'.(isset($meta_data['keywords']) ? $meta_data['keywords'] : '').'</td>';
				echo '<td>'.(isset($meta_data['author']) ? $meta_data['author'] : '').'</td>';
				
				echo '<td>'.(isset($meta_data['og:title']) ? $meta_data['og:title'] : '').'</td>';
				echo '<td>'.(isset($meta_data['og:type']) ? $meta_data['og:type'] : '').'</td>';
				echo '<td>'.(isset($meta_data['og:image']) ? $meta_data['og:image'] : '').'</td>';
				echo '<td>'.(isset($meta_data['og:url']) ? $meta_data['og:url'] : '').'</td>';
				echo '<td>'.(isset($meta_data['og:description']) ? $meta_data['og:description'] : '').'</td>';

				echo '<td>'.(isset($meta_data['twitter:card']) ? $meta_data['twitter:card'] : '').'</td>';
				echo '<td>'.(isset($meta_data['twitter:title']) ? $meta_data['twitter:title'] : '').'</td>';
				echo '<td>'.(isset($meta_data['twitter:description']) ? $meta_data['twitter:description'] : '').'</td>';
				echo '<td>'.(isset($meta_data['twitter:image:src']) ? $meta_data['twitter:image:src'] : '').'</td>';

				echo '<td>'.(isset($meta_data['copyright']) ? $meta_data['copyright'] : '').'</td>';
				echo '<td>'.(isset($meta_data['viewport']) ? $meta_data['viewport'] : '').'</td>';

				echo '<td>';
				if(isset($meta_data['h1']) && $meta_data['h1']){
					foreach ($meta_data['h1'] as $key => $value) {
						if($value){
							echo '*'.$value;
						}	
					}
				}
				echo '</td>';

				echo '<td>';
				if(isset($meta_data['h2']) && $meta_data['h2']){
					foreach ($meta_data['h2'] as $key => $value) {
						if($value){
							echo '*'.$value;
						}	
					}
				}
				echo '</td>';

				echo '<td>';
				if(isset($meta_data['h3']) && $meta_data['h3']){
					foreach ($meta_data['h3'] as $key => $value) {
						if($value){
							echo '*'.$value;
						}	
					}
				}
				echo '</td>';
				
				
				echo '<td>'.(isset($meta_data['body']) ? $meta_data['body'] : '').'</td>';

				echo '</tr>';
			}
		}
		echo '</table>';
	
	}



	public function get_image(){

		$url = $this->url_model->find_all();


		
		

		echo '<table border="1">';
		echo '<th></th>';
		echo '<th>URL</th>';
		echo '<th>STATUS</th>';
		echo '<th>IMAGE CONTENTS</th>';



		foreach ($url as $key => $val) {
		
			list($status) = get_headers($val->url);
			if (strpos($status, '404') !== FALSE) {
				$image_data = "Page Not Found";

			}else{
				$image_data = $this->get_image_structure($val->url);
			}
			if($image_data){
				echo '<tr>';
				echo '<td style="vertical-align: text-top;">'.$val->id.'</td>';
				echo '<td style="vertical-align: text-top;">'.$val->url.'</td>';
				echo '<td style="vertical-align: text-top;">'.(isset($image_data['image_contents']) ? $image_data['status'] : '').'</td>';
			
				echo '<td>';

				if(isset($image_data['image_contents']) && $image_data['image_contents']){
				
					

					foreach ($image_data['image_contents'] as $key => $value) {

						echo "<table border='1' width='100%'>";
					
						if(isset($value['filename']) && $value['filename']){
							echo '<tr><td width="25%"">File Name</td>';
							echo '<td>';
							echo $value['filename'];
							echo '</td>';
							echo '</tr>';
						}	
						if(isset($value['alt']) && $value['alt']){
							echo '<tr><td>Alt</td>';
							echo '<td>';
							echo $value['alt'];
							echo '</td>';
							echo '</tr>';
						}
						
						if(isset($value['flocation']) && $value['flocation']){
							echo '<tr><td>File Location</td>';
							echo '<td>';
							echo $value['flocation'];
							echo '</td>';
							echo '</tr>';
						}
						if(isset($value['src']) && $value['src']){
							echo '<tr><td>Original Source</td>';
							echo '<td>';
							echo $value['src'];
							echo '</td>';
							echo '</tr>';
						}	
						if(isset($value['src']) && $value['src']){
							echo '<tr>';
							echo '<td colspan="2">';
							//echo '<img src="' . $value['src'] .'" width="100px">';
							echo '</td>';
							echo '</tr>';
						}
						
						echo "</table><br>";
						
					}

					
				}
				echo '</td>';
				echo '</tr>';
			}
		}
		echo '</table>';
	
	}


	public function get_page_structure($url = null){

		$html = $this->file_get_contents_curl($url);

		//parsing begins here:
		$doc = new DOMDocument();
		@$doc->loadHTML($html);

		if(isset($doc->encoding) && $doc->encoding) {
			$nodes = $doc->getElementsByTagName('title');

			$title = ['title' => $nodes->item(0)->nodeValue ];

			$metas = $doc->getElementsByTagName('meta');


			// get heading text content
			$h1 = $this->get_text_content($doc->getElementsByTagName('h1'));
			$h2 = $this->get_text_content($doc->getElementsByTagName('h2'));
			$h3 = $this->get_text_content($doc->getElementsByTagName('h3'));

			// get body content
			$body = $doc->getElementsByTagName('body');
			$mock = new DOMDocument;
			$body = $doc->getElementsByTagName('body')->item(0);
			foreach ($body->childNodes as $child){
			    $mock->appendChild($mock->importNode($child, true));
			}
			$body = htmlentities($mock->saveHTML());

			// get title content
			

			$meta_data = []; 
			foreach ($metas as $key => $meta) {
				
				if($meta->getAttribute('name') == 'description'){
	            	$meta_data['description'] = $meta->getAttribute('content'); }

	            if($meta->getAttribute('name') == 'keywords'){
	            	$meta_data['keywords'] = $meta->getAttribute('content'); }

	            if($meta->getAttribute('name') == 'author'){
	            	$meta_data['author'] = $meta->getAttribute('content'); }

	            if($meta->getAttribute('name') == 'twitter:card'){
	            	$meta_data['twitter:card'] = $meta->getAttribute('content'); }

	            if($meta->getAttribute('name') == 'twitter:title'){
	            	$meta_data['twitter:title'] = $meta->getAttribute('content'); }

	            if($meta->getAttribute('name') == 'twitter:description'){
	            	$meta_data['twitter:description'] = $meta->getAttribute('content'); }

	            if($meta->getAttribute('name') == 'twitter:image:src'){
	            	$meta_data['twitter:image:src'] = $meta->getAttribute('content'); }

	            if($meta->getAttribute('name') == 'copyright'){
	            	$meta_data['copyright'] = $meta->getAttribute('content'); }

	            if($meta->getAttribute('name') == 'viewport'){
	            	$meta_data['viewport'] = $meta->getAttribute('content'); }

	            if($meta->getAttribute('property') == 'og:title'){
	            	$meta_data['og:title'] = $meta->getAttribute('content'); }

	            if($meta->getAttribute('property') == 'og:type'){
	               $meta_data['og:type'] = $meta->getAttribute('content');}

	            if($meta->getAttribute('property') == 'og:image'){
	            	$meta_data['og:image'] = $meta->getAttribute('content');}

	            if($meta->getAttribute('property') == 'og:url'){
	            	$meta_data['og:url'] = $meta->getAttribute('content');}

	            if($meta->getAttribute('property') == 'og:description'){
	            	$meta_data['og:description'] = $meta->getAttribute('content');}

			}

			$return = [];
			

			$array = array_merge($title,$meta_data);

			$array['h1'] = $h1;
			$array['h2'] = $h2;
			$array['h3'] = $h3;

			$array['body'] = $body;

			$array['status'] = 'HTTP 200';
			

			return $array;
		}
		else{
			$status['status'] = 'HTTP 404: Page Not Found';
			return $status;
		}
	}	

	public function get_image_structure($url = null){

		$html = $this->file_get_contents_curl($url);

		//parsing begins here:
		$doc = new DOMDocument();
		@$doc->loadHTML($html);

		if(isset($doc->encoding) && $doc->encoding) {
			$nodes = $doc->getElementsByTagName('title');

			$title = ['title' => $nodes->item(0)->nodeValue ];

			$images = $doc->getElementsByTagName('img');

			$image_data = [];
			foreach ($images as $key => $img) {
				if($img->getAttribute('src')){      
	            	if( preg_match('/\.(jpg|jpeg|png|gif)(?:[\?\#].*)?$/i', $img->getAttribute('src'), $matches) ) {
	            		$image_data[$key]['src'] = $img->getAttribute('src');

	            		$path_parts = pathinfo($img->getAttribute('src'));
						$image_data[$key]['filename'] = $path_parts['basename'];

						

						$flocation_raw = str_replace('http://',"",$url);

						$flocation = 'scraped_images/'.$flocation_raw;

						$image_data[$key]['flocation'] = $flocation;

						// $this->file_download($flocation, $image_data[$key]['filename'], $image_data[$key]['src']);

	            		if($img->getAttribute('alt')){
			            	$image_data[$key]['alt'] = $img->getAttribute('alt');
			            }

					}
	            }  
			}

			$images_div = $doc->getElementsByTagName('div');

			$image_data_div = [];
			foreach ($images_div as $key => $div) {
					if( preg_match('/background-image/i', $div->getAttribute('style') , $matches) ) {
						
						$str1 = $div->getAttribute('style');
						$str2 = str_replace("background-image:url(","",$str1);
						$str3 = str_replace(")","",$str2);
						$str4 = str_replace(";","",$str3);
						$image_data_div[$key]['src'] = $str4;

						$path_parts = pathinfo($str4);
						$image_data_div[$key]['filename'] = $path_parts['basename'];

						$flocation_raw = str_replace('http://',"",$url);
						$flocation = 'scraped_images/'.$flocation_raw;

						$image_data_div[$key]['flocation'] = $flocation;

						// $this->file_download($flocation, $image_data_div[$key]['filename'], $image_data_div[$key]['src']);
					}
			}


			$array['image_contents'] = array_merge($image_data,$image_data_div);
			$array['status'] = 'HTTP 200';

			return $array;

		}
		else{
			$status['status'] = 'HTTP 404: Page Not Found';
			return $status;
		}
	}

	function file_download($floc = null, $fname = null, $furl = null){

		// $floc = 'scraped_images/ortigas.com.ph/about-ortigas';
		// $furl = 'http://ortigas.com.ph/includes/img/ocLogo.png';
		// $fname = 'image.png';
		if(filter_var($furl, FILTER_VALIDATE_URL)){

			list($status) = get_headers($furl);
			if (strpos($status, '404') !== FALSE) {

			}else{
				if(!file_exists($floc)){ mkdir($floc,0777,true);}
				$url = file_get_contents($furl);
				file_put_contents($floc.'/'.$fname, $url); //Where to save the image on your server
			}
		}
		
	}


	function file_get_contents_curl($url)
	{
	    $ch = curl_init();

	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

	    $data = curl_exec($ch);
	    curl_close($ch);

	    return $data;
	}

	function get_text_content($elem){
		$result = [];

		foreach($elem as $item){
	       $result[]  = $item->textContent;
	    }

	    return $result;

	}



}