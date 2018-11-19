<?php if($properties){ ?>
<div id="banner_image">
	<div id="banner_logo_image"></div>
	<img src="<?php echo site_url().$properties->property_image; ?>" draggable="false" />		
	<h1><?php echo $properties->property_name; ?></h1>	
	<h5><?php echo $properties->estate_name; ?></h5>		
</div>
<?php } ?>