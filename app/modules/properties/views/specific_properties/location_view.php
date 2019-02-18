<div id="location_view">
	<?php if($properties->category_id==1) : ?>
	<div class="row location_heading">
		<div class="col-sm-4 location_title">
			<h2>Location</h2>
		</div>
		<div class="col-sm-8 nearby_link hide">
			<h3>What's Nearby</h3>
	
		    <ul class="nav" role="tablist">

		    	<?php $show = 0; 
		    	if(isset($properties->property_nearby_malls) &&  $properties->property_nearby_malls) { $show +=1; } 
		    	if(isset($properties->property_nearby_markets) &&  $properties->property_nearby_markets) { $show +=1; } 
		    	if(isset($properties->property_nearby_hospitals) &&  $properties->property_nearby_hospitals) { $show +=1; } 
		    	if(isset($properties->property_nearby_schools) &&  $properties->property_nearby_schools) { $show +=1; } 
		    	?>
		    	<?php if($show > 1){ ?>
				<li class="nav-item">
			      <a class=" active" data-toggle="tab" href="#all"><?php echo lang('property_nearby_all'); ?></a>
			    </li>
			    <?php } ?>
			    <?php if(isset($properties->property_nearby_malls) &&  $properties->property_nearby_malls) : ?>
			    <li class="nav-item">
			      <a class="" data-toggle="tab" href="#menu1"><?php echo lang('property_nearby_malls'); ?></a>
			    </li>
				<?php endif; ?>
				<?php if(isset($properties->property_nearby_markets) &&  $properties->property_nearby_markets) : ?>
			    <li class="nav-item">
			      <a class="" data-toggle="tab" href="#menu2"><?php echo lang('property_nearby_market'); ?></a>
			    </li>
				<?php endif; ?>
				<?php if(isset($properties->property_nearby_hospitals) &&  $properties->property_nearby_hospitals) : ?>
			    <li class="nav-item">
			      <a class="" data-toggle="tab" href="#menu3"><?php echo lang('property_nearby_hospitals'); ?></a>
			    </li>
			    <?php endif; ?>
			    <?php if(isset($properties->property_nearby_schools) &&  $properties->property_nearby_schools) : ?>
			    <li class="nav-item">
			      <a class="" data-toggle="tab" href="#menu4"><?php echo lang('property_nearby_schools'); ?></a>
			    </li>
			    <?php endif; ?>
		    </ul>
		</div>
	</div>  
	<?php endif; ?>

			
				<div style="display: none">				
					<?php echo form_input(array('id'=>'property_longitude', 'name'=>'property_longitude', 'value'=>set_value('property_longitude', isset($properties->property_longitude) ? $properties->property_longitude : ''), 'class'=>'form-control'));?>
					<?php echo form_input(array('id'=>'property_latitude', 'name'=>'property_latitude', 'value'=>set_value('property_latitude', isset($properties->property_latitude) ? $properties->property_latitude : ''), 'class'=>'form-control'));?>
				</div>

<?php if(isset($properties->property_latitude) && isset($properties->property_longitude) && $properties->property_latitude && $properties->property_longitude) {?>
	<div id="map-location">
			<textarea id="pac-input" style="display: none;"></textarea>
			<div id="map"></div>

	<!-- <iframe 
	  width="100%" 
	  height="400" 
	  frameborder="0" 
	  scrolling="no" 
	  marginheight="0" 
	  marginwidth="0" 
	  src="<?php //echo 'https://maps.google.com/maps?q='.$properties->property_latitude.','.$properties->property_longitude.'&hl=es;z=14&amp;output=embed'; ?>"
	 >
	 </iframe> -->
	</div><!--map-location-->
<?php } ?>

		<?php if($properties->category_id==1) : ?>
		<div id="nearby" class="hide">
			<div class="tab-content">
				<div id="all" class="tab-pane active">
					<?php if(isset($properties->property_nearby_malls) &&  $properties->property_nearby_malls) : ?>
					   <div class="nearby_title"><p>Nearby Malls</p></div>
					   <div class="nearby"><?php echo $properties->property_nearby_malls; ?></div>
					<?php endif; ?>
					<?php if(isset($properties->property_nearby_markets) &&  $properties->property_nearby_markets) : ?>
					   <div class="nearby_title"><p>Nearby Markets</p></div>
					   <div class="nearby"><?php echo $properties->property_nearby_markets; ?></div>
					<?php endif; ?>
					<?php if(isset($properties->property_nearby_hospitals) &&  $properties->property_nearby_hospitals) : ?>
					   <div class="nearby_title"><p>Nearby Hospitals</p></div>
					   <div class="nearby"><?php echo $properties->property_nearby_hospitals; ?></div>
					<?php endif; ?>
					<?php if(isset($properties->property_nearby_schools) &&  $properties->property_nearby_schools) : ?>
					   <div class="nearby_title"><p>Nearby Schools</p></div>
					   <div class="nearby"><?php echo $properties->property_nearby_schools; ?></div>
					<?php endif; ?>
				   		<div class="clear"></div>
				</div>

				<?php if(isset($properties->property_nearby_malls) &&  $properties->property_nearby_malls) : ?>
				<div id="menu1" class="tab-pane fade">
					<div class="nearby_title"><p>Nearby Malls</p></div>
					<div class="nearby"><?php echo $properties->property_nearby_malls; ?></div><div class="clear"></div>
				</div>
				<?php endif; ?>
				<?php if(isset($properties->property_nearby_markets) &&  $properties->property_nearby_markets) : ?>
				<div id="menu2" class="tab-pane fade">
					<div class="nearby_title"><p>Nearby Markets</p></div>
					<div class="nearby"><?php echo $properties->property_nearby_markets; ?></div><div class="clear"></div>
				</div>
				<?php endif; ?>
				<?php if(isset($properties->property_nearby_hospitals) &&  $properties->property_nearby_hospitals) : ?>
				<div id="menu3" class="tab-pane fade">
					<div class="nearby_title"><p>Nearby Hospitals</p></div>
				 	<div class="nearby"><?php echo $properties->property_nearby_hospitals; ?></div><div class="clear"></div>
				</div>
				<?php endif; ?>
				<?php if(isset($properties->property_nearby_schools) &&  $properties->property_nearby_schools) : ?>
				<div id="menu4" class="tab-pane fade">
					<div class="nearby_title"><p>Nearby Schools</p></div>
					<div class="nearby"><?php echo $properties->property_nearby_schools; ?></div><div class="clear"></div>
				</div>
				<?php endif; ?>
			</div><!--tab-content-->
		</div><!--nearby-->
	<?php endif; ?>

</div><!--location-->