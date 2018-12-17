<?php if($properties){ ?>
<div id="banner_image">
	<div id="banner_logo_image"></div>
	<img src="<?php echo getenv('UPLOAD_ROOT').$properties->property_image; ?>" draggable="false" alt="<?php echo $properties->property_alt_image; ?>" title="<?php echo $properties->property_alt_image; ?>"/>		
	<h1><?php echo $properties->property_name; ?></h1>	
	<h5><?php echo $properties->estate_name; ?></h5>		

	<div class="social_media_properties">
		<?php if($properties->property_facebook){  ?>
		<a href="<?php echo $properties->property_facebook; ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
		<?php } ?>

		<?php if($properties->property_twitter){  ?>
		<a href="<?php echo $properties->property_twitter; ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
		<?php } ?>

		<?php if($properties->property_instagram){  ?>
		<a href="<?php echo $properties->property_instagram; ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a>
		<?php } ?>

		<?php if($properties->property_linkedin){  ?>
		<a href="<?php echo $properties->property_linkedin; ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
		<?php } ?>

		<?php if($properties->property_youtube){  ?>
		<a href="<?php echo $properties->property_youtube; ?>"><i class="fa fa-youtube" aria-hidden="true"></i></a>
		<?php } ?>
	</div>

</div>


<?php } ?>