<?php if(isset($main_video) && $main_video){ ?>
	<div class="video_division">
		<video width="100%"  controls autoplay loop>
		  <source src="<?php echo site_url().$main_video->video_location ?>" type="video/mp4">
		</video>
	</div>
	<div id="video_label" class="noselect">
	<h1>We Build Great Places for Life</h1>
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
	<a class="default-button">Inquire Now</a>
	</div>
<?php } else{ ?>
			<?php $this->template->add_js(module_js('website', 'slider_index'), 'embed'); ?>
			<?php echo $this->load->view('website/slider_index'); ?>
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
		
		<?php if($estates) { ?>
		<div class="main_page">
			<div class="row cat_heading">
				<div class="col-sm-2 est_title"><h2><?php echo $page_estates->page_title; ?></h2></div>
				<div class="col-sm-8 est_desc"><?php echo $page_estates->page_content; ?></div>
				<div class="col-sm-2 est_link"><a href="<?php echo site_url('').strtolower($page_estates->page_slug); ?>" class="default-button">View All</a></div>
			</div>
			<div class="row">
			<?php
				foreach ($estates as $key => $val) { ?>
					<div class="estates properties col-sm-4">
						<a href="<?php echo site_url('').'estates/'.$val->estate_slug; ?>">
						<div class="image_wrapper">
							<div class="image_container">
								<img src="<?php echo site_url().$val->estate_image; ?>" width="100%" alt="" draggable="false"/>
							</div>
							<div class="estate"><center><?php echo $val->estate_name; ?></center></div>
						</div>
						</a>
					</div>
				<?php	} //end foreach ?>
			</div>
			<div class="est_link2"><a href="<?php echo site_url('').strtolower($page_estates->page_slug); ?>" class="default-button">View All</a></div>
		</div>
		

		<?php }?>
		<?php if(isset($carousel) && $carousel) {?>
		<div class="main_page">
			<div class="row">
				<div class="estates residences col-sm-4">
					<div class="res_title"><h2><?php echo $category_residence->category_name; ?></h2></div>
					<div class="res_desc"><?php echo $category_residence->category_description; ?></div>
					<div class="res_link"><a href="<?php echo site_url('').'estates/category/'.strtolower($category_residence->category_name); ?>" class="default-button">View All</a></div>
				</div>			
				<div class="estates residences col-sm-8">
					<?php if($carousel) { ?>
					<div id="carousel" class="carousel slide" data-ride="carousel">
					<!-- Indicators -->
					<ul class="carousel-indicators">
					<?php foreach ($carousel as $key => $value) { ?>
					 	<li class="carousel-indicator_button" data-target="#carousel" data-slide-to="<?php echo $key; ?>"> </li>
					<?php } ?>	
					</ul>
					<!-- The slideshow -->
					<div class="carousel-inner">
					<?php foreach ($carousel as $key => $value) { ?>
					<div class="carousel-item">
					  <img class="carousel-indicator_button" data-target="#carousel" data-slide-to="<?php echo $key; ?>" src="<?php echo site_url().$value->image_slider_image; ?>"  width="100" height="100">
					</div>
					<?php } ?>	
					</div>

					<!-- Left and right controls -->
					<a class="carousel-control-prev" href="#carousel" data-slide="prev">
					<span class="carousel-control-prev-icon"></span>
					</a>
					<a class="carousel-control-next" href="#carousel" data-slide="next">
					<span class="carousel-control-next-icon"></span>
					</a>
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
						<div class="col-sm-6 mo_link"><a href="<?php echo site_url('').'estates/category/'.strtolower($category_mall->category_name); ?>">View All</a></div>
					</div>
					<a href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">
					<!-- <a href="<?php //echo $val->property_website; ?>" target="_blank"> -->
					<div class="image_wrapper">
						<div class="property"><?php echo $val->property_name; ?></div>
						<div class="image_container">
							<img src="<?php echo site_url().$val->property_image; ?>" width="100%" alt="" draggable="false"/>
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
						<div class="col-sm-6 mo_link"><a href="<?php echo site_url('').'estates/category/'.strtolower($category_office->category_name); ?>">View All</a></div>
					</div>
					<a href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">
					<div class="image_wrapper">
						<div class="property"><?php echo $val->property_name; ?></div>
						<div class="image_container">
							<img src="<?php echo site_url().$val->property_image; ?>" width="100%" alt="" draggable="false"/>
						</div>
						<div class="estate"><?php echo $val->estate_name; ?></div>
					</div>
					</a>
				</div>
			<?php	} //end foreach ?>
		</div>
		<?php }?>

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

		<div class="seo_content">
			<?php if($page_content) { echo parse_content($page_content->page_bottom_content); } ?>
		</div>

	</div>
</main>