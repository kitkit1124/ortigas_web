<section id="roles">
	<?php if($estates){ ?>
	<div id="banner_image">
		<img src="<?php echo config_item('website_url').$estates->estate_image; ?>" draggable="false" alt="<?php echo $estates->estate_alt_image; ?>" title="<?php echo $estates->estate_alt_image; ?>" />		
		<div class="banner_margin"><h1><?php echo $estates->estate_name; ?></h1></div>			
	</div>
	<?php } ?>

	<?php 
	$btn_cnt = 0;
	$col_cnt = 12; 
	if(isset($residences) && $residences){ $btn_cnt += 1; }
	if(isset($malls) && $malls){ $btn_cnt += 1; }
	if(isset($offices) && $offices){ $btn_cnt += 1; }
	if($btn_cnt){
		$col_cnt = $col_cnt / $btn_cnt;
	}
	?>
	

		<div class="content">	
			<div class="row specific_estate">

				<?php if(isset($residences) && $residences){ ?>
				<div class="<?php echo "col-sm-".$col_cnt; ?> btn_est">
					<div class="estate_button" data-anchor="residences">
						<p>RESIDENCES</p>
						<span>Lorem Ipsum</span>
					</div>
				</div>
				<?php } ?>

				<?php if(isset($malls) && $malls){ ?>
				<div class="<?php echo "col-sm-".$col_cnt; ?> btn_est">
					<div class="estate_button" data-anchor="malls">
						<p>MALLS</p>
						<span>Shop 'till you drop</span>
					</div>
				</div>
				<?php } ?>
				<?php if(isset($offices) && $offices){ ?>
				<div class="<?php echo "col-sm-".$col_cnt; ?> btn_est">
					<div class="estate_button" data-anchor="offices">
						<p>OFFICES</p>
						<span>Spaces for lease</span>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>

		
	<main role="main" class="container">
	

		<div class="estates_description">
			<?php echo $estates->estate_text; ?>
		</div>

		<?php $this->template->add_js(module_js('website', 'slider_index'), 'embed'); ?>
		<?php $this->load->view('properties/specific_properties/slider_view'); ?>
	</main>	

	<?php if(isset($residences) && $residences){ ?>
	<div class="content_residence">
		<div class="row cat_heading_res">
			<div class="col-sm-4 res_title"><h1><?php echo $category_residence->category_name; ?></h1></div>
			<div class="col-sm-8 res_desc"><?php echo $category_residence->category_description; ?></div>
			<!-- <div class="col-sm-2 est_link"><a href="<?php echo site_url('').strtolower($category_residence->category_name); ?>">View All</a></div> -->
		</div>
		<?php
			foreach ($residences as $key => $val) { ?>

				<div class="residences">
					<a href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">
	
						<div class="image_container">
								<img src="<?php echo  config_item('website_url').$val->property_image; ?>" width="100%" draggable="false" alt="<?php echo $val->property_alt_image; ?>" title="<?php echo $val->property_alt_image; ?>" />
						</div>
						<div class="property"><label><?php echo $val->property_name; ?></label></div>
					</div>
					</a>
				
			<?php	} //end foreach ?>
	<div style="clear: both;"></div>
	</div>
	<?php } ?>

	<main role="main" class="container mo_result">
		<div class="content">	
			<?php if(isset($malls) && $malls){ ?>
			<div class="cat_heading">
				<div class="cat_title"><h1><?php echo $category_mall->category_name; ?></h1></div>
				<div class="cat_desc"><?php echo $category_mall->category_description; ?></div>
			</div>

			
			<div class="row">
				<?php
				foreach ($malls as $key => $val) { ?>
					<div class="estates malls col-sm-4">
						<a href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">
						<div class="image_wrapper">
							<div class="property"><p><?php echo $val->property_name; ?></p></div>
							<div class="image_container">
									<img src="<?php echo  config_item('website_url').$val->property_image; ?>" width="100%" width="100%" alt="" draggable="false" alt="<?php echo $val->property_alt_image; ?>" title="<?php echo $val->property_alt_image; ?>" />
							</div>
						</div>
						</a>
					</div>
				<?php	} //end foreach ?>
			</div>
			<?php } ?>

			<?php if(isset($offices) && $offices){ ?>
			<div class="cat_heading">
				<div class="cat_title"><h1><?php echo $category_office->category_name; ?></h1></div>
				<div class="cat_desc"><?php echo $category_office->category_description; ?></div>
			</div>
			
			<div class="office_custom_width">
				<div class="row">
					<?php
					foreach ($offices as $key => $val) { ?>
						<div class="estates offices col-sm-6">
							<a href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">
							<div class="image_wrapper">
								<div class="property"><p><?php echo $val->property_name; ?></p></div>
								<div class="image_container">
										<img src="<?php echo  config_item('website_url').$val->property_image; ?>" width="100%" alt="" draggable="false" alt="<?php echo $val->property_alt_image; ?>" title="<?php echo $val->property_alt_image; ?>" />
								</div>
							</div>
							</a>
						</div>
					<?php	} //end foreach ?>
				</div>
			</div>
			<?php }?>


			<div id="location">
			<iframe 
			  width="100%" 
			  height="400" 
			  frameborder="0" 
			  scrolling="no" 
			  marginheight="0" 
			  marginwidth="0" 
			  src="<?php echo 'https://maps.google.com/maps?q='.$estates->estate_latitude.','.$estates->estate_longtitude.'&hl=es;z=14&amp;output=embed'; ?>"
			 >
			 </iframe>
			</div><!--map-location-->

			<div class="seo_content">
				<?php if($estates) { echo parse_content($estates->estate_bottom_text); } ?>
			</div>

			<div class="inquiry_form_container">
				<?php echo $this->load->view('messages/messages_form')?>
			</div>
		
		</div>
	</main>
	<?php if(isset($news_result) && $news_result){ ?>
	<div class="news_related">

		<h2 class="related_news_title">Related News</h2>
		

		<div class="news_related_content">
			<?php
				$news_data['related_news'] = 1;
				$news_data['cols_img'] = 'col-sm-5';
				$news_data['cols_data'] = 'col-sm-7';
				echo $this->load->view('website/news_result', $news_data); 
			?>
		</div>
	</div>
	<?php } ?>
	<?php echo $this->load->view('properties/recommended_links')?>
</section>