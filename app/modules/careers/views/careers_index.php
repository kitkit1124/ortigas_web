<section id="roles">
		<?php echo $this->load->view('website/slider_index'); ?>
		<?php $this->template->add_js(module_js('website', 'slider_index'), 'embed'); ?>

	<main role="main" class="container">
		<div class="content">	
			 <?php echo $this->load->view('careers/careers_landing'); ?>
			 <?php echo $this->load->view('careers/careers_form'); ?>
			<div class="page_overview">
				<?php if($careers_page) {	echo parse_content($careers_page->page_content); } ?>
				<label><a class="page_overview_button green_button" data-toggle="modal" data-target="#form_application">Submit Resume</a></label>			
			</div>
			 <div class="search_tab">
				<div class="search_tab_content">
					<form>
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						<div class="default_search">
								<label>Keyword</label>
								<input class="form-control" type="text" aria-label="Search" placeholder= "Type keyword here" value="" id="keyword" name="keyword">
						</div>
						<div class="advance_search">
							<div class="row">
								<div class="col-sm-10">
									<div class="row">
										<div class="col-sm-4">
											<label>Select Job Title</label>
											<?php echo form_dropdown('career_id', $select_careers, '', 'id="career_id" class="form-control"'); ?>
										</div>
										<div class="col-sm-4">
											<label>Location</label>
											<?php echo form_dropdown('career_location', $select_locations, '', 'id="career_location" class="form-control"'); ?>
										</div>
										<div class="col-sm-4">
											<label>Departments</label>
											<?php echo form_dropdown('department_id', $select_departments, '', 'id="department_id" class="form-control"'); ?>
										</div>
									</div>
								</div>
								<div class="col-sm-2">
									<label>&nbsp;</label>
									<button class="button_search" type="button"><i class="fa fa-search"></i></button>
								</div>
							</div>
						</div><!--advance_search-->
					</form>
				</div><!--search_tab_content-->
			</div><!--search_tab-->

			 <div id="careers_content">
			 		<?php if(isset($careers) && $careers){ ?>
					<div class="row ">
						<?php
						foreach ($careers as $key => $val) { 
						if($val->career_modified_on){ $dtraw = $val->career_modified_on; } else { $dtraw = $val->career_created_on; }		
						$dtpost = date_create($dtraw);
						?>
							<div class="career_box col-sm-4">
								<div class="image_wrapper">
									<div class="details">
										<p class="title"><?php echo $val->career_position_title; ?></p>
										<p class="dept"><?php echo $val->department_name; ?></p>
										<p class="dtpost"><?php echo 'Date Posted '. date_format($dtpost,"F j, Y"); ?></p>
										<p class="loc"><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $val->career_location; ?></p>
										<a href="<?php echo site_url('').'careers/post/'.$val->career_slug; ?>">View Details</a>
									</div>
									<div class="image_container">
											<!-- <img src="<?php //echo  site_url().$val->career_image; ?>" width="100%" alt="" draggable="false"/> -->
									</div>
								</div>
							</div>
						<?php	} //end foreach ?>
					</div>
					<?php } ?>
			 </div>

			 <div class="seo_content">
				<?php if($careers_page) { echo parse_content($careers_page->page_bottom_content); } ?>
			</div>
			
		</div><!--content-->
	</main>
	<?php echo $this->load->view('properties/recommended_links')?>
</section>
<script type="text/javascript">
	var post_url = '<?php echo current_url() ?>';
	var site_url = "<?php echo site_url(); ?>"
</script>