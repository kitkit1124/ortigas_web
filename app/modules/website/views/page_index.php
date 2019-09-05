<?php if(isset($video) && $video){ ?>
	<div class="video_division">
		<video id="video_player" height="100%" controls autoplay loop muted>
		  <source src="<?php echo getenv('UPLOAD_ROOT').$video->video_location ?>" type="video/mp4">
		</video>
	</div>
	<div id="video_label" class="noselect">
		<div class="<?php echo $video->video_text_pos; ?>">
			<h2><?php echo $video->video_title; ?></h2>
			<p><?php echo $video->video_caption; ?></p>
			<a href="<?php echo $video->video_link; ?>" class="default-button"><?php echo $video->video_button_text; ?></a>
		</div>
	</div>
<?php } else{ ?>

			<?php $this->template->add_js(module_js('website', 'slider_index'), 'embed'); ?>
			<?php echo $this->load->view('website/slider_index'); ?>

			<div id="video_label" class="noselect">
				<div class="<?php echo $video_details->video_text_pos; ?>">
					<h2><?php echo $video_details->video_title; ?></h2>
					<p><?php echo $video_details->video_caption; ?></p>
					<a href="<?php echo $video_details->video_link; ?>" class="default-button"><?php echo $video_details->video_button_text; ?></a>
				</div>
			</div>

<?php } ?>

<?php if($nav_color_theme == 'White'){ ?>
	<style type="text/css">
	.oclogo img { filter: brightness(0) invert(1); }
	a.nav-link.base_nav.nav_estates, .nav_search_button i{color: #FFF; }
	</style>
<?php } ?>
<?php if($is_home){ ?>
	<style type="text/css">
	body {  padding-top: 0px; } 
	.navbar { background-color: transparent; border-bottom: 1px solid transparent; }
	</style>
<?php } ?>
<main role="main" class="container">
	<div class="content">	
		<div class="page_content">
			<?php if($page_content) { echo parse_content($page_content->page_content); } ?>
			<br>
			<?php if($page_content) { echo '<h1>'.parse_content($page_content->page_heading_text).'</h1>'; } ?>
		</div>

		<div class="page_index">
			<?php echo $this->load->view('properties/search_form'); ?>
		</div>
		
		<?php if($estates) { 

			if(count($estates) == 1){
				$cols_estate = "12";
			}
			elseif (count($estates) == 2) {
				$cols_estate = "6";
			}
			else{
				$cols_estate = "4";
			}
		?>
		<div class="main_page">
			<div class="row cat_heading">
				<div class="col-sm-3 est_title"><h2><?php echo $page_estates->page_title; ?></h2></div>
				<div class="col-sm-7 est_desc"><?php echo strip_tags($page_estates->page_content); ?></div>
				<div class="col-sm-2 est_link"><a href="<?php echo site_url('').strtolower($page_estates->page_slug); ?>" class="default-button">VIEW ALL</a></div>
			</div>
			<div class="row">
			<?php
				foreach ($estates as $key => $val) { ?>
					<div class="estates properties col-sm-<?php echo $cols_estate; ?>">
						<a href="<?php echo site_url('').'estates/'.$val->estate_slug; ?>">
						<div class="image_wrapper">
							<div class="image_container">
								<img class="lazy" data-src="<?php echo getenv('UPLOAD_ROOT').img_selector($val->estate_image,'large'); ?>" width="100%" alt="" draggable="false" alt="<?php echo $val->estate_alt_image; ?>" title="<?php echo $val->estate_alt_image; ?>" />
							</div>
							<div class="estate bgestate"><center><?php echo $val->estate_name; ?></center></div>
						</div>
						</a>
					</div>
				<?php	} //end foreach ?>
			</div>
			<div class="est_link2"><a href="<?php echo site_url('').strtolower($page_estates->page_slug); ?>" class="default-button">VIEW ALL</a></div>
		</div>
		

		<?php }?>
		<?php if(isset($carousel) && $carousel) { ?>
		<div class="main_page">
			<div class="row">
				<div class="estates residences col-sm-4">
					<div class="res_title"><h2><?php echo $category_residence->category_name; ?></h2></div>
					<div class="res_desc"><?php echo $category_residence->category_snippet_quote; ?></div>
					<div class="res_link"><a href="<?php echo site_url('').strtolower($category_residence->category_name); ?>" class="default-button">VIEW ALL</a></div>
				</div>			
				<div class="estates residences col-sm-8">
					<?php if($carousel) { ?>
					<div id="carousel" class="carousel slide" data-ride="carousel">
						<?php if(count($carousel) != 1) { ?>
						<!-- Indicators -->
						<ul class="carousel-indicators">
						<?php foreach ($carousel as $key => $value) { ?>
						 	<li class="carousel-indicator_button" data-target="#carousel" data-slide-to="<?php echo $key; ?>"> </li>
						<?php } ?>	
						</ul>
						<?php } ?>
						
						<!-- The slideshow -->
						<div class="carousel-inner" data-link="<?php echo site_url('').'residences/'.$residence->property_slug; ?>">
							<?php foreach ($carousel as $key => $value) { ?>
							<div class="carousel-item">
							 	 <img class="carousel-indicator_button lazy" data-target="#carousel" data-slide-to="<?php echo $key; ?>" data-src="<?php echo getenv('UPLOAD_ROOT').img_selector($value->image_slider_image,'medium'); ?>"  width="100" height="100" alt="<?php echo $value->image_slider_alt_image; ?>" title="<?php echo $value->image_slider_alt_image; ?>"/>
							</div>
							<?php } ?>	

							<img class="residence_logo" src="<?php echo getenv('UPLOAD_ROOT').$residence->property_logo; ?>" draggable="false" alt="<?php echo $residence->property_alt_logo; ?>" title="<?php echo $residence->property_alt_logo; ?>" />

						</div>
						<?php if(count($carousel) != 1) { ?>
						
						<!-- Left and right controls -->
						<a class="carousel-control-prev" href="#carousel" data-slide="prev">
						<span class="carousel-control-prev-icon"></span>
						</a>
						<a class="carousel-control-next" href="#carousel" data-slide="next">
						<span class="carousel-control-next-icon"></span>
						</a>
						<?php } ?>
					</div>
					<?php } ?>			
				</div>
			</div>
		</div>
		<?php }?>


		<?php if($malls && $offices) {?>

		<div class="row">

			<?php
			foreach ($malls as $key => $val) { ?>
				<div class="estates malls col-sm-6">
					<div class="row">
						<div class="col-sm-6 mo_title"><h2><?php echo $category_mall->category_name; ?></h2></div>
						<div class="col-sm-6 mo_link"><a href="<?php echo site_url('').strtolower($category_mall->category_name); ?>">View All</a></div>
					</div>
					<a href="<?php echo site_url('').'malls/'.$val->property_slug; ?>">
					<!-- <a href="<?php //echo $val->property_website; ?>" target="_blank"> -->
					<div class="image_wrapper">
						<div class="property"><?php echo $val->property_name; ?></div>
						<div class="image_container">
							<img class="lazy" data-src="<?php echo getenv('UPLOAD_ROOT').img_selector($val->property_image,'large'); ?>" width="100%" alt="" draggable="false" alt="<?php echo $val->property_alt_image; ?>" title="<?php echo $val->property_alt_image; ?>"/>
						</div>
						<div class="estate"><?php echo $val->estate_name; ?></div>
					</div>
					</a>
				</div>
			<?php	} //end foreach 

			foreach ($offices as $key => $val) { ?>
				<div class="estates offices col-sm-6">
					<div class="row">
						<div class="col-sm-6 mo_title"><h2><?php echo $category_office->category_name; ?></h2></div>
						<div class="col-sm-6 mo_link"><a href="<?php echo site_url('').strtolower($category_office->category_name); ?>">View All</a></div>
					</div>
					<a href="<?php echo site_url('').'offices/'.$val->property_slug; ?>">
					<div class="image_wrapper">
						<div class="property"><?php echo $val->property_name; ?></div>
						<div class="image_container">
							<img class="lazy" data-src="<?php echo getenv('UPLOAD_ROOT').img_selector($val->property_image,'large'); ?>" width="100%" alt="" draggable="false" alt="<?php echo $val->property_alt_image; ?>" title="<?php echo $val->property_alt_image; ?>"/>
						</div>
						<div class="estate"><?php echo $val->estate_name; ?></div>
					</div>
					</a>
				</div>
			<?php	} //end foreach ?>
		</div>
		<?php }?>

	</div>
</main>
		<div class="news_related">
			<div class="row">
				<div class="col-sm-6 mo_title"><h2><?php echo 'News'; ?></h2></div>
				<div class="col-sm-6 mo_link"><a href="<?php echo site_url('').'news/'; ?>">View All</a></div>
			</div>
			<div class="news_related_content">
				<?php
					//$news_data['related_news'] = 0;
					$news_data['cols_img'] = 'col-sm-4';
					$news_data['cols_data'] = 'col-sm-8';
					echo $this->load->view('news_result', $news_data); 
				?>
			</div>
		</div>

		<div class="footer_border"></div>

		<!-- <div class="seo_content">
			<?php //if($page_content) { echo parse_content($page_content->page_bottom_content); } ?>
		</div> -->

		<script type="text/javascript">
			var nav_color_theme = "<?php echo $nav_color_theme ?>";
		</script>