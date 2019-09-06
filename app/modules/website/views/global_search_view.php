<section id="roles">
	<main role="main" class="container">
		<div class="content">	

			<div class="search_index">
				<?php echo $this->load->view('website/global_search_index'); ?>
			</div>
			<?php $true_result = 0; ?>
			<div class="search_result">
					<h1 class="hide">Search</h1>
					<h2 class="search_result_search_label">Search results</h2>
						
					<div class="properties_content">

						<?php if(isset($residences) && $residences) {  $true_result++; ?>
						<h2>Residences</h2>
							
						<div class="row ">
							<?php
							foreach ($residences as $key => $val) {
							if($val->property_modified_on){ $dtraw = $val->property_modified_on; } else { $dtraw = $val->property_created_on; }
							$dtpost = date_create($dtraw);
							?>
								<div class="search_box col-sm-6">
									<div class="row search_properties_row">
										<div class="estates col-sm-5">
											<a href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">
											<div class="image_wrapper">
												<div class="image_container">
													<img class="lazy" data-src="<?php echo getenv('UPLOAD_ROOT').img_selector($val->property_image,'medium'); ?>" width="100%" alt="" draggable="false" />
												</div>
											</div>
											</a>
										</div>
										<div class="estates property_details col-sm-7">
											<a href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">
												<h2><?php echo $val->property_name; ?></h2>
												<div class="property_overview"><?php echo $val->property_overview; ?></div>
												<a class="green search_link" href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">View Property ></a>
											</a>
										</div>
									</div>
								</div>

							<?php	} //end foreach ?>
						</div>
						<?php } ?>

						<?php if(isset($malls) && $malls) {  $true_result++; ?>
						<h2>Malls</h2>
							
						<div class="row ">
							<?php
							foreach ($malls as $key => $val) {
							if($val->property_modified_on){ $dtraw = $val->property_modified_on; } else { $dtraw = $val->property_created_on; }
							$dtpost = date_create($dtraw);
							?>
								<div class="search_box col-sm-6">
									<div class="row search_properties_row">
										<div class="estates col-sm-5">
											<a href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">
											<div class="image_wrapper">
												<div class="image_container">
													<img class="lazy" data-src="<?php echo getenv('UPLOAD_ROOT').img_selector($val->property_image,'medium'); ?>" width="100%" alt="" draggable="false"/>
												</div>
											</div>
											</a>
										</div>
										<div class="estates property_details col-sm-7">
											<a href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">
												<h2><?php echo $val->property_name; ?></h2>
												<div class="property_overview"><?php echo $val->property_overview; ?></div>
												<a class="green search_link" href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">View Property ></a>
											</a>
										</div>
									</div>	
								</div>
							<?php	} //end foreach ?>
						</div>
						<?php } ?>

						<?php if(isset($offices) && $offices) {  $true_result++; ?>
						<h2>Offices</h2>
							
						<div class="row ">
							<?php
							foreach ($offices as $key => $val) {
							if($val->property_modified_on){ $dtraw = $val->property_modified_on; } else { $dtraw = $val->property_created_on; }
							$dtpost = date_create($dtraw);
							?>
								<div class="search_box col-sm-6">
									<div class="row search_properties_row">
										<div class="estates col-sm-5">
											<a href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">
											<div class="image_wrapper">
												<div class="image_container">
													<img class="lazy" data-src="<?php echo getenv('UPLOAD_ROOT').img_selector($val->property_image,'medium'); ?>" width="100%" alt="" draggable="false"/>
												</div>
											</div>
											</a>
										</div>
										<div class="estates property_details col-sm-7">
											<a href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">
												<h2><?php echo $val->property_name; ?></h2>
												<div class="property_overview"><?php echo $val->property_overview; ?></div>
												<a class="green search_link" href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">View Property ></a>
											</a>
										</div>
									</div>	
								</div>
							<?php	} //end foreach ?>
						</div>
						<?php } ?>

					</div>

					<?php if(isset($news_result) && $news_result){ $true_result++; ?>

			 		<h2>Articles</h2>
					<div class="row ">
						<?php
						foreach ($news_result as $key => $val) {
						if($val->post_modified_on){ $dtraw = $val->post_modified_on; } else { $dtraw = $val->post_created_on; }
						$dtpost = date_create($dtraw);
						?>
							<div class="search_box col-sm-6">
									<div class="row search_properties_row">
										<div class="estates col-sm-5">
											<a href="<?php echo site_url('').'news/'.$val->post_slug; ?>">
											<div class="image_wrapper">
												<div class="image_container">
													<img class="lazy" data-src="<?php echo getenv('UPLOAD_ROOT').img_selector($val->post_image,'medium'); ?>" width="100%" alt="" draggable="false"/>
												</div>
											</div>
											</a>
										</div>
										<div class="estates property_details col-sm-7">
											<a href="<?php echo site_url('').'estates/property/'.$val->post_slug; ?>">
												<h2><?php echo $val->post_title; ?></h2>
												<p class="dtpost"><?php echo 'Date Posted '. date_format($dtpost,"F j, Y"); ?></p>
												<div class="property_overview"><?php echo $val->post_content; ?></div>
												<a class="green search_link" href="<?php echo site_url('').'news/'.$val->post_slug; ?>">Read Article ></a>
											</a>
										</div>
									</div>	
								</div>

						<?php	} //end foreach ?>
					</div>
					<?php } ?>


			 		<?php if(isset($careers) && $careers){ $true_result++; ?>

			 		<h2>Careers</h2>
					<div class="row ">
						<?php
						foreach ($careers as $key => $val) { 
						if($val->career_modified_on){ $dtraw = $val->career_modified_on; } else { $dtraw = $val->career_created_on; }		
						$dtpost = date_create($dtraw);
						?>
							<div class="search_box col-sm-6">
								<div class="row search_properties_row">
									<div class="estates col-sm-5">
										<a href="<?php echo site_url('').'careers/'.$val->career_slug; ?>">
										<div class="image_wrapper">
											<div class="image_container">
												<img class="lazy" data-src="<?php echo getenv('UPLOAD_ROOT').img_selector($val->career_image,'medium'); ?>" width="100%" alt="" draggable="false"/>
											</div>
										</div>
										</a>
									</div>
									<div class="estates property_details col-sm-7">
										<a href="<?php echo site_url('').'careers/'.$val->career_slug; ?>">
											<h2><?php echo $val->career_position_title; ?></h2>
										<!-- <p class="link green"><?php //echo site_url().'careers/'.$val->career_slug; ?></p> -->
										<!-- <p class="dept"><?php //echo $val->department_name; ?></p> -->
										<!-- <p class="dtpost"><?php //echo 'Date Posted '. date_format($dtpost,"F j, Y"); ?></p> -->
											<p><i class="fa fa-map-marker green" aria-hidden="true"></i>&nbsp;<?php echo $val->career_location; ?></p>
											<a class="green search_link" href="<?php echo site_url('').'careers/'.$val->career_slug; ?>">View Details ></a>
										</a>
									</div>
								</div>	
							</div>
						<?php	} //end foreach ?>
					</div>
					<?php } ?>
		

				<?php if(!$true_result){ ?>
					<h2 class="pull-left"> No result found... </h2>
					<div class="clear"></div>
				<?php } ?>
		
			</div>


			<div class="seo_content">
				<?php if($page_content) { echo parse_content($page_content->page_bottom_content); } ?>
			</div>
				
		</div><!--content-->
	</main>
</section>
<script type="text/javascript">
	var post_url = "<?php echo current_url(); ?>"
	var site_url = "<?php echo site_url(); ?>"
	var search_filter = "<?php echo $_GET['search_filter']; ?>"
</script>
