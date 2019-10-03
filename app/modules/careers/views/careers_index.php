<section id="roles">
		<?php echo $this->load->view('website/slider_index'); ?>
		<?php $this->template->add_js(module_js('website', 'slider_index'), 'embed'); ?>

	<main role="main" class="container">
		<div class="content">	

		
			<?php echo $this->load->view('careers/careers_form'); ?>
			 	<a id="message_success" class="hide" href="<?php echo site_url().'website/page/show_modal?id=4' ?>" data-target="#modal-lg" data-toggle="modal"></a>
			<div class="page_overview">
				<?php if($careers_page) {	echo parse_content($careers_page->page_content); } ?>
			</div>

			<?php if(isset($careers) && $careers){ ?>
			 <div class="search_tab">
				<div class="search_tab_content">
					<form>
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						<div class="default_search mb-0">
								<!-- <label>Keyword</label> -->
								<input class="form-control" type="text" aria-label="Search" placeholder= " Keyword" value="" id="keyword" name="keyword">
						</div>
						<div class="advance_search">
							<div class="row">
								<div class="col-md-10">
									<div class="row">
										<div class="col-md-4 mt-3">
											<!-- <label>Select Job Title</label> -->
											<?php echo form_dropdown('career_id', $select_careers, '', 'id="career_id" class="form-control"'); ?>
										</div>
										<div class="col-md-4 mt-3">
											<!-- <label>Location</label> -->
											<?php echo form_dropdown('career_location', $select_locations, '', 'id="career_location" class="form-control"'); ?>
										</div>
										<div class="col-md-4 mt-3">
											<!-- <label>Departments</label> -->
											<?php echo form_dropdown('department_id', $select_departments, '', 'id="department_id" class="form-control"'); ?>
										</div>
									</div>
								</div>
								<div class="col-md-2 mt-3">
									<!-- <label>&nbsp;</label> -->
									<a class="button_search default-button" ><i class="fa fa-search"></i></a>
								</div>
							</div>
						</div><!--advance_search-->
					</form>
					<div id="clear_search" class="mt-2">
						<span class="ml-3"><label>Clear Search</label></span>
					</div>
				</div><!--search_tab_content-->
			</div><!--search_tab-->

			<div class="page_overview">
				<?php if(isset($careers) && $careers){ ?>
				<label><a class="page_overview_button default-button" data-toggle="modal" data-target="#form_application">Submit Resume</a></label>		
				<?php } ?>	
			</div>

			 <div id="careers_content">

			 <?php if(isset($careers) && $careers){ ?>
					<div class='col-md-12 text-left mb-3'>
						<span class="jobs_found">All Available Jobs (<?php echo count($careers);?> Found)</span>
					</div>
					<div id="alldiv" class="row text-center">
					</div>
					<table class="table table-striped table-bordered table-hover dt-responsive" id="allTable">
						<thead><tr><th class="all"></th></tr></thead>
					</table>
			 		<!-- <div id="wide" class="row text-center">
					</div>
					<table class="table table-striped table-bordered table-hover dt-responsive" id="widetable">
						<thead><tr><th class="all"></th></tr></thead>
					</table>
			 
			 		<div id="narrow" class="row text-center"> 
					</div>
					<table class="table table-striped table-bordered table-hover dt-responsive" id="narrowtable">
						<thead><tr><th class="all"></th></tr></thead>
					</table> -->
					
					<!-- <div id="wide" class="row"> -->
						
						<!-- <span class="col-md-12 jobs_found mb-3">All Available Jobs (<?php echo count($careers);?> Found)</span> -->
						<?php
						foreach ($careers as $key => $val) { 
						if($val->career_modified_on){ $dtraw = $val->career_modified_on; } else { $dtraw = $val->career_created_on; }		
						$dtpost = date_create($dtraw);
						?>
							<!-- <div class="col-md-4">
								<div class="card p-0 border-0 shadow rounded-0">
									<div class="card-header border-0 text-center font-weight-bold">
										<span class="title text-uppercase"><?php echo $val->career_position_title; ?></span>
									</div>
									<div class="card-body details">
										<p class="dept"><?php echo $val->department_name; ?></p>
										<p class="dtpost"><?php echo 'Date Posted '. date_format($dtpost,"F j, Y"); ?></p>
										<p class="loc"><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $val->career_location; ?></p>
										<a href="<?php echo site_url('').'careers/'.$val->division_slug.'/'.$val->career_slug; ?>" class="default-button">View Details</a>
									</div>
								</div>								
							</div> -->
							

							<!-- <div class="career_box col-sm-4">
								<div class="image_wrapper">
									<div class="card-header">
										<p class="title"><?php echo $val->career_position_title; ?></p>
									</div>
									<div class="details">
										<p class="dept"><?php echo $val->department_name; ?></p>
										<p class="divi"><?php echo $val->division_name; ?></p> 
										<p class="dtpost"><?php echo 'Date Posted '. date_format($dtpost,"F j, Y"); ?></p>
										<p class="loc"><i class="fa fa-map-marker" aria-hidden="true"></i><?php //echo $val->career_location; ?></p>
										<a href="<?php echo site_url('').'careers/'.$val->division_slug.'/'.$val->career_slug; ?>" class="default-button">View Details</a>
									</div>
									<div class="image_container">
											<img src="<?php //echo  site_url().$val->career_image; ?>" width="100%" alt="" draggable="false"/>
									 </div>
								</div>
							</div> -->
							
							<!-- <div class="container row col-md-12 <?php echo $key%2? 'flex-row':'flex-row-reverse'; ?>">
								<div class="career_box col-md-6">
									<div class="image_wrapper">
										<div class="details">
											<p class="title"><?php echo $val->career_position_title; ?></p>
											<p class="dept"><?php echo $val->department_name; ?></p>
											<p class="divi"><?php echo $val->division_name; ?></p>
											<p class="dtpost"><?php echo 'Date Posted '. date_format($dtpost,"F j, Y"); ?></p>
											<p class="loc"><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $val->career_location; ?></p>
											<a href="<?php echo site_url('').'careers/'.$val->division_slug.'/'.$val->career_slug; ?>" class="default-button">View Details</a>
										</div>
									</div>
								</div>
								<div class="career_box col-md-6">
									<div class="image_wrapper">
										<img class="estate_banner_img lazy mh-100 mw-100" data-src="<?php echo getenv('UPLOAD_ROOT').$val->career_image; ?>" draggable="false" alt="<?php echo $val->career_alt_image; ?>" title="<?php echo $val->career_alt_image; ?>" />
									</div>
								</div>	
							</div>					 -->
						
						<?php } //end foreach ?>
					<!-- </div> -->

					<!-- <div id="narrow" class="row">
						<span class="col-md-12 jobs_found">All Available Jobs (<?php echo count($careers);?> Found)</span>
						<?php
							foreach ($careers as $key => $val) { 
							if($val->career_modified_on){ $dtraw = $val->career_modified_on; } else { $dtraw = $val->career_created_on; }		
							$dtpost = date_create($dtraw);
						?>
						<div class="card col-sm-12 career_box border-0">
							<img class="estate_banner_img lazy mh-100 mw-100" data-src="<?php echo getenv('UPLOAD_ROOT').$val->career_image; ?>" draggable="false" alt="<?php echo $val->career_alt_image; ?>" title="<?php echo $val->career_alt_image; ?>" />
							<div class="card-body details px-0">
								<p class="title"><?php echo $val->career_position_title; ?></p>
								<p class="dept"><?php echo $val->department_name; ?></p>
								<p class="divi"><?php echo $val->division_name; ?></p>
								<p class="dtpost"><?php echo 'Date Posted '. date_format($dtpost,"F j, Y"); ?></p>
								<p class="loc">
									<i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $val->career_location; ?>
									<a href="<?php echo site_url('').'careers/'.$val->division_slug.'/'.$val->career_slug; ?>" class="button default-button-2 pull pull-right mt-0">View Details</a>
								</p>
							</div>
						</div> 
						<?php } //end foreach ?>
					</div> -->

					<?php } ?>
					<div class="found_no_career">
						<?php if($found_no_career) { echo parse_content($found_no_career->partial_content); } ?>
					</div>
			 </div>

		<?php } else{ ?>
			<div class="no_career_div">
				<?php if($found_no_career) { echo parse_content($found_no_career->partial_content); } ?>
			</div>
		<?php } ?>
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