<section id="roles">
	<div class="no-slider">
	</div>
	<?php if($career){ ?>
	<!-- <div id="banner_image">
		<div class="banner_margin container"><h1><?php //echo $career->career_position_title; ?></h1></div>
		<div class="banner_gradient"></div>
		<img class="estate_banner_img lazy" data-src="<?php echo getenv('UPLOAD_ROOT').$career->career_image; ?>" draggable="false" alt="<?php echo $career->career_alt_image; ?>" title="<?php echo $career->career_alt_image; ?>" />
		<?php echo $this->load->view('website/breadcrumbs_view'); ?>			
	</div> -->
	<?php }  ?>
	<main role="main" class="container">
		<div class="content">	
			<?php echo $this->load->view('careers/careers_form'); ?>
			<a id="message_success" class="hide" href="<?php echo site_url().'website/page/show_modal?id=4' ?>" data-target="#modal-lg" data-toggle="modal"></a>
			<?php 
			if($career->career_modified_on){ $dtraw = $career->career_modified_on; } else { $dtraw = $career->career_created_on; }		
			$dtpost = date_create($dtraw);
			?>
			<div class="career_content_details">
				<p class="title mb-1"><?php echo $career->career_position_title; ?></p>
				<p class="dept mb-0"><?php echo $career->department_name; ?></p>
				<p class="dtpost"><?php echo 'Date Posted '. date_format($dtpost,"F j, Y"); ?></p>
				<p class="loc font-weight-bold"><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $career->career_location; ?></p>
				<p class="res_head">Responsibilities</p>
				<p class="res"><?php echo parse_content($career->career_res); ?></p>
				<p class="req_head">Requirements</p>
				<p class="req"><?php echo parse_content($career->career_req); ?></p>
				<br>
				<div class="page_overview"><a id="post_data" class="page_overview_button default-button" data-toggle="modal" data-target="#form_application">SUBMIT RESUME</a></div>

				<br>
				<span class="filesize_note">*max ﬁle size 25mb (doc, docx or PDF ﬁles only)</span>
			</div>

		

		</div><!--content-->
	</main>
</section>
<script type="text/javascript">
	var post_url = '<?php echo current_url() ?>';
	var site_url = "<?php echo site_url(); ?>"
</script>