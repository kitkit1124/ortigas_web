<section id="roles">
	<div id="banner_image">
		<img src="<?php echo site_url().$career->career_image; ?>" draggable="false" width="100%" />		
		<h1><?php echo "Careers"; ?></h1>		
	</div>
	<main role="main" class="container">
		<div class="content">	
			<?php echo $this->load->view('careers/careers_landing'); ?>
			<?php echo $this->load->view('careers/careers_form'); ?>
			<?php 
			if($career->career_modified_on){ $dtraw = $career->career_modified_on; } else { $dtraw = $career->career_created_on; }		
			$dtpost = date_create($dtraw);
			?>
			<div class="career_content_details">
				<p class="title"><?php echo $career->career_position_title; ?></p>
				<p class="dept"><?php echo $career->department_name; ?></p>
				<p class="dtpost"><?php echo 'Date Posted '. date_format($dtpost,"F j, Y"); ?></p>
				<p class="loc"><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $career->career_location; ?></p>
				<p class="res_head">Resposiblities</p>
				<p class="res"><?php echo parse_content($career->career_res); ?></p>
				<p class="req_head">Requirements</p>
				<p class="req"><?php echo parse_content($career->career_req); ?></p>
				<div class="page_overview"><a id="post_data" class="page_overview_button green_button" data-toggle="modal" data-target="#form_application">SUBMIT RESUME</a></div>

				<br><span class="filesize_note">*max ﬁle size 25mb (doc, docx or PDF ﬁles only)</span>
			</div>

		

		</div><!--content-->
	</main>
</section>
<script type="text/javascript">
	var post_url = '<?php echo current_url() ?>';
	var site_url = "<?php echo site_url(); ?>"
</script>