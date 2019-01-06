<section id="roles">
	<?php if($category){ ?>
	<div id="banner_image">
		<div id="banner_logo_image"></div>
		<div class="banner_margin container"><h1><?php echo $category->category_name; ?></h1></div>
		<img src="<?php echo  getenv('UPLOAD_ROOT').$category->category_image; ?>" draggable="false" alt="<?php echo $category->category_alt_image; ?>" title="<?php echo $category->category_alt_image; ?>" />
		<?php echo $this->load->view('website/breadcrumbs_view'); ?>			
	</div>
	<?php } ?>
	<main role="main" class="container">
		<div class="content">	
		
			<div class="estate_heading">
				<?php echo parse_content($category->category_description); ?>
				<a class="inquiry_button default-button" data-anchor="inquiry_form_container"><?php if($button_text) { echo strip_tags(parse_content($button_text->partial_content)); } ?></a>
			</div>

			<div class="estate_page_select_location">
				<input type="hidden" id="csrf" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

				<?php echo form_dropdown('location_id', $select_locations, set_value('location_id', (isset($_GET['lid'])) ? $_GET['lid'] : ''), 'id="location_id" class="form-control"'); ?>
			</div>
			
			<?php
			if(isset($estates) && $estates){ $properties = $estates; $estates = 1;}  else{ $estates = 0; }
		    if(isset($properties) && $properties){
			?>
			<div class="row properties_of_estate">
				<?php
				foreach ($properties as $key => $val) { ?>
					<div class="estates properties col-sm-4">
						<?php if($estates){  ?>
							<a href="<?php echo site_url('').'estates/'.$val->estate_slug; ?>">
						<?php } else { ?>
							<a href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">
						 <?php } ?>

						<div class="image_wrapper">
							<!-- <div class="property"><p><?php //if($estates){ } else { echo $val->property_name; } ?></p></div> -->
							<div class="image_container">

									<?php if($estates){ ?>
										<img src="<?php echo getenv('UPLOAD_ROOT').$val->estate_image; ?>" width="100%" draggable="false" alt="<?php echo $val->estate_alt_image; ?>" title="<?php echo $val->estate_alt_image; ?>" />
									<?php } else { ?>
										<img src="<?php echo getenv('UPLOAD_ROOT').$val->property_image; ?>" width="100%" draggable="false" alt="<?php echo $val->property_alt_image; ?>" title="<?php echo $val->property_alt_image; ?>" />	 
									<?php } ?>
							</div>
							<!-- <div class="estate"><?php //echo $val->estate_name; ?></div> -->

						</div>
						<?php if($estates){ ?>
							<div class="estates_content_wrapper">
								<div class="estate_title"><?php echo $val->estate_name; ?></div>
								<div class="estate_content"><?php echo $val->estate_snippet_quote; ?></div>
							</div>
						<?php } else { ?>
							<div class="property_content_wrapper">
								<div class="property_title"><?php  echo $val->property_name; ?></div>
								<div class="estate_title_dup"><?php echo $val->estate_name; ?></div>
								<div class="estate_content"><?php echo $val->property_snippet_quote; ?></div>
							</div>
						<?php } ?>
						

						</a>
					</div>
				<?php	} //end foreach ?>
			</div>
			<?php }?>



			<div class="seo_content">
				<?php if($category) { echo parse_content($category->category_bottom_description); } ?>
			</div>

			<div class="inquiry_form_container">
				<?php echo $this->load->view('messages/messages_form')?>
			</div>
		</div>
	</main>
		<?php if(isset($news_result) && $news_result){ ?>
			<div class="news_related">
		
				<h2 class="related_news_title"><?php echo 'Related News'; ?></h2>
				
		
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

<script type="text/javascript">
	var site_url = "<?php echo site_url(); ?>"
	var upload_url = "<?php echo getenv('UPLOAD_ROOT'); ?>"
	var category_name = "<?php echo $category->category_name; ?>"
</script>