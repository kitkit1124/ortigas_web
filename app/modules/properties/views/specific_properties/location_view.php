<div id="location_view">
	<?php if($properties->category_id==2) : ?>
	<div class="row location_heading">
		<div class="col-sm-4 location_title">
			<h1>Location</h1>
		</div>
		<div class="col-sm-8">
			<h3>What's Nearby</h3>
	
		    <ul class="nav" role="tablist">
				<li class="nav-item">
			      <a class=" active" data-toggle="tab" href="#all"><?php echo lang('property_nearby_all'); ?></a>
			    </li>
			    <li class="nav-item">
			      <a class="" data-toggle="tab" href="#menu1"><?php echo lang('property_nearby_malls'); ?></a>
			    </li>
			    <li class="nav-item">
			      <a class="" data-toggle="tab" href="#menu2"><?php echo lang('property_nearby_market'); ?></a>
			    </li>
			    <li class="nav-item">
			      <a class="" data-toggle="tab" href="#menu3"><?php echo lang('property_nearby_hospitals'); ?></a>
			    </li>
			    <li class="nav-item">
			      <a class="" data-toggle="tab" href="#menu4"><?php echo lang('property_nearby_schools'); ?></a>
			    </li>
		    </ul>
		</div>
	</div>  
	<?php endif; ?>

<?php if(isset($properties->property_latitude) && isset($properties->property_longitude) && $properties->property_latitude && $properties->property_longitude) {?>
	<div id="map-location">
	<iframe 
	  width="100%" 
	  height="400" 
	  frameborder="0" 
	  scrolling="no" 
	  marginheight="0" 
	  marginwidth="0" 
	  src="<?php echo 'https://maps.google.com/maps?q='.$properties->property_latitude.','.$properties->property_longitude.'&hl=es;z=14&amp;output=embed'; ?>"
	 >
	 </iframe>
	</div><!--map-location-->
<?php } ?>

		<?php if($properties->category_id==2) : ?>
		<div id="nearby">
			<div class="tab-content">
				<div id="all" class="tab-pane active">
				   <div class="nearby"><?php echo $properties->property_nearby_malls; ?></div>
				   <div class="nearby"><?php echo $properties->property_nearby_markets; ?></div>
				   <div class="nearby"><?php echo $properties->property_nearby_hospitals; ?></div>
				   <div class="nearby"><?php echo $properties->property_nearby_schools; ?></div>
				   <div class="clear"></div>
				</div>
				<div id="menu1" class="tab-pane fade">
					<div class="nearby"><?php echo $properties->property_nearby_malls; ?></div><div class="clear"></div>
				</div>
				<div id="menu2" class="tab-pane fade">
					<div class="nearby"><?php echo $properties->property_nearby_markets; ?></div><div class="clear"></div>
				</div>
				<div id="menu3" class="tab-pane fade">
				 	<div class="nearby"><?php echo $properties->property_nearby_hospitals; ?></div><div class="clear"></div>
				</div>
				<div id="menu4" class="tab-pane fade">
					<div class="nearby"><?php echo $properties->property_nearby_schools; ?></div><div class="clear"></div>
				</div>

			</div><!--tab-content-->
		</div><!--nearby-->
	<?php endif; ?>

</div><!--location-->