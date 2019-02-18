<?php if($properties){ ?>
<div id="banner_image">
	<div id="banner_logo_image"></div>

	<?php if(isset($properties->property_logo) && $properties->property_logo){ ?>
		<div class="estate_logo_div">
			<div class="banner_gradient"></div>
			<img class="estate_logo_img lazy" data-src="<?php echo getenv('UPLOAD_ROOT').$properties->property_logo; ?>" draggable="false" alt="<?php echo $properties->property_alt_logo; ?>" title="<?php echo $properties->property_alt_logo; ?>" />
			<h1 class="hide"><?php echo $properties->property_name; ?></h1>
	</div> 
	<?php } else { ?>
	<div class="banner_margin container"><h1><?php echo $properties->property_name; ?></h1></div> 
	<div class="banner_gradient"></div>
	<?php } ?>

	<img class="estate_banner_img lazy" data-src="<?php echo getenv('UPLOAD_ROOT').$properties->property_image; ?>" draggable="false" alt="<?php echo $properties->property_alt_image; ?>" title="<?php echo $properties->property_alt_image; ?>"/>		
	
	<?php echo $this->load->view('website/breadcrumbs_view'); ?>

	<div class="social_media_properties_wrapper">
			<div class="social_media_properties">
				
				<?php if($properties->property_facebook){  ?>
				<a target="_blank" href="<?php echo $properties->property_facebook; ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
				<?php } ?>

				<?php if($properties->property_twitter){  ?>
				<a target="_blank" href="<?php echo $properties->property_twitter; ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
				<?php } ?>

				<?php if($properties->property_instagram){  ?>
				<a target="_blank" href="<?php echo $properties->property_instagram; ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a>
				<?php } ?>

				<?php if($properties->property_linkedin){  ?>
				<a target="_blank" href="<?php echo $properties->property_linkedin; ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
				<?php } ?>

				<?php if($properties->property_youtube){  ?>
				<a target="_blank" href="<?php echo $properties->property_youtube; ?>"><i class="fa fa-youtube" aria-hidden="true"></i></a>
				<?php } ?>
			</div>
	</div>

</div>


<?php } ?>