<section id="roles">
	<?php if($location){ ?>
	<div id="banner_image">
		<div id="banner_logo_image"></div>
		<div class="banner_margin container"><h1><?php echo $location->location_name; ?></h1></div>
		<div class="banner_gradient"></div>
		<img class="estate_banner_img lazy" data-src="<?php echo  getenv('UPLOAD_ROOT').$location->location_image; ?>" draggable="false" />
	</div>
	<?php } ?>
	<main role="main" class="container">
		<div class="content">	
		
			<div class="estate_heading">
				<p class="estate_heading_text"><?php echo parse_content($location->location_name); ?></p>
				<?php echo parse_content($location->location_description); ?>
			</div>
			
			<div id="thumbnails" class="row text-center"></div>
			<table class="table table-striped table-bordered table-hover dt-responsive" id="dt-images">
				<thead><tr><th class="all"></th></tr></thead>
			</table>

			<div class="inquiry_form_container">
				<?php echo $this->load->view('messages/messages_form')?>
			</div>
		</div>
	</main>
	
</section>

<script type="text/javascript">
	var site_url = "<?php echo site_url(); ?>"
	var upload_url = "<?php echo getenv('UPLOAD_ROOT'); ?>"
	var category_name = "";
	var location_id = "<?php echo $location->location_id; ?>";
</script>