<section id="roles">
	<?php if($properties){ ?>
	<div id="banner_image">
		<div id="banner_logo_image"></div>
		<img src="<?php echo config_item('website_url').$properties->property_image; ?>" draggable="false" />		
		<h1><?php echo $properties->property_name; ?></h1>			
	</div>
	<?php } ?>
	<main role="main" class="container">


		<div class="content">	
			<div class="row specific_estate_tabs">
				<div class="col-sm-4">
					<div class="estate_button" data-anchor="location">
						<p>LOCATION</p>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="estate_button" data-anchor="unit-floorplan">
						<p>UNIT FLOOR PLAN</p>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="estate_button" data-anchor="building-floorplan">
						<p>BUILDING FLOOR PLAN</p> 
					</div>
				</div>
			</div>


			 <?php if($sliders) { ?>
			 <div id="slider" class="carousel slide" data-ride="carousel">
			  <!-- Indicators -->
			  <ul class="carousel-indicators">
			    <?php foreach ($sliders as $key => $value) { ?>
			     	<img class="carousel-indicator_button" data-target="#slider" data-slide-to="<?php echo $key; ?>" src="<?php echo config_item('website_url').$value->property_slider_image; ?>"  width="100" height="100">
			    <?php } ?>	
			  </ul>
			  <!-- The slideshow -->
			  <div class="carousel-inner">
			    <?php foreach ($sliders as $key => $value) { ?>
			    <div class="carousel-item">
			      <img src="<?php echo config_item('website_url').$value->property_slider_image; ?>" alt="New York" width="100%" height="400">
			    </div>
			    <?php } ?>	
			  </div>
			  
			  <!-- Left and right controls -->
			  <a class="carousel-control-prev" href="#slider" data-slide="prev">
			    <span class="carousel-control-prev-icon"></span>
			  </a>
			  <a class="carousel-control-next" href="#slider" data-slide="next">
			    <span class="carousel-control-next-icon"></span>
			  </a>
			 </div>
			 <?php } ?>	


			<div id="location">
				<h1>Location</h1>
				<div class="row">

					<div id="map-location" class="col-sm-8">
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

					<div id="nearby" class="col-sm-4">
						<h1>What's Nearby</h1>
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

						<div class="tab-content">
							<div id="all" class="tab-pane active">
							   <?php echo $properties->property_nearby_malls; ?>
							   <?php echo $properties->property_nearby_markets; ?>
							   <?php echo $properties->property_nearby_hospitals; ?>
							   <?php echo $properties->property_nearby_schools; ?>
							</div>
							<div id="menu1" class="tab-pane fade">
							  <?php echo $properties->property_nearby_malls; ?>
							</div>
							<div id="menu2" class="tab-pane fade">
							  <?php echo $properties->property_nearby_markets; ?>
							</div>
							<div id="menu3" class="tab-pane fade">
							  <?php echo $properties->property_nearby_hospitals; ?>
							</div>
							<div id="menu4" class="tab-pane fade">
							   <?php echo $properties->property_nearby_schools; ?>
							</div>

						</div><!--tab-content-->
					</div><!--nearby-->
				</div><!--row-->
			</div><!--location-->

					
			<?php if($room_types) { ?>
			<div id="unit-floorplan">
				<h1>Unit Floor Plan</h1>
			    <ul class="nav" role="tablist">
					<?php foreach ($room_types as $key => $value) { ?>
						<li class="nav-item">
							<a class="" data-toggle="tab" data-id="<?php echo $value->room_type_id; ?>" href="#room-menu<?php echo $key; ?>"><?php echo $value->room_type_name; ?></a>
						</li>
			    	<?php } ?>
			    </ul>

				<div class="tab-content">
					<?php foreach ($room_types as $key => $value) { ?>
					<div id="room-menu<?php echo $key; ?>" class="tab-pane fade">
						<img src="<?php echo config_item('website_url').$value->room_type_image; ?>" >
			    	</div>
			    	
			    	<?php } ?>
			    	<p id="range_size">&nbsp;</p>
			    	<a href="" id="check_available_button"><?php echo lang('button_check_available'); ?></a>
				</div>
			</div><!--unit-floorplan-->
			 <?php } ?>	


			<?php if($floors) { ?>
			<div id="building-floorplan">
				<div class="row">
					<div class="col-sm-7">
						<h1>Building Floor Plan</h1>
					</div>
					<div class="col-sm-5">
						<?php echo form_dropdown('select-floorplan', $floors, set_value('floorplan', (isset($record->floorplan)) ? $record->floorplan : ''), 'id="select-floorplan" class="form-control"'); ?>
					</div>
				</div>
				<img id="floorplan_image" data-toggle="modal" data-target="#enlarge_image" src="<?php echo base_url(); ?>data/images/building-floorplan.png">

			</div><!--building-floorplan-->
			<?php } ?>	


			 <!-- The Modal -->
			  <div class="modal fade" id="enlarge_image">
			    <div class="modal-dialog modal-dialog-centered">
			      <div class="modal-content">
			      		<img id="floorplan_image" src="<?php echo base_url(); ?>data/images/building-floorplan.png">
			      </div>
			    </div>
			  </div>




			<?php if($residences) { ?>
			<div id="other-residences">
				<h1>Other Residences in Greenhills Shopping Center</h1>
					<?php if(isset($residences) && $residences){ ?>
					<div class="row">
						<?php
						foreach ($residences as $key => $val) { ?>
							<div class="estates residences col-sm-6">
								<a href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">
								<div class="image_wrapper">
									<div class="image_container">
											<img src="<?php echo  config_item('website_url').$val->property_image; ?>" width="100%" alt="" draggable="false"/>
									</div>
									<div class="property"><p><?php echo $val->property_name; ?></p><p><?php echo $val->estate_name; ?></p></div>
								</div>
								</a>
							</div>
						<?php	} //end foreach ?>
					</div>
					<?php } ?>
			</div><!--other-residences-->
			<?php } ?>	


		</div>
	</main>
</section>
<script type="text/javascript">
	var site_url = "<?php echo site_url(); ?>"
	var app_url = "<?php echo base_url(); ?>"
	var cms_url = "<?php echo config_item('website_url'); ?>"
</script>