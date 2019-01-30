<div id= "properties_overview" class="properties_overview"><?php echo $properties->property_overview; ?></div>

<div id= "properties_overview" class="properties_overview">
	<?php if(isset($properties->property_website) && $properties->property_website && isset($properties->property_link_label) && $properties->property_link_label) :?>
	<a href="<?php echo $properties->property_website; ?>" class="default-button"><i class="fa fa-external-link"> </i> <?php echo $properties->property_link_label; ?></a>
	<?php endif; ?>
</div>