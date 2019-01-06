<section id="roles">
	<main role="main" class="container">
		<div class="content">	



			<div class="search_index">

				<h5>Search Properties</h5>
				<?php echo $this->load->view('properties/search_form'); ?>
				
				<h1 class="search_result_search_label">Search Results</h1>

				<?php if(isset($residences) && $residences) {?>
				
					<?php
					foreach ($residences as $key => $val) { ?>

						<?php 
						$units = '';
						if(isset($val->unit_types) && $val->unit_types){
							foreach ($val->unit_types as $key => $unit_types) {
								$units .= $unit_types->room_type_name.', '; 
							}
						} ?>


						<div class="row search_properties_row">
							<div class="estates property_details col-sm-4">
								<a href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">
								<div class="image_wrapper">
									<div class="image_container">
										<img src="<?php echo getenv('UPLOAD_ROOT').$val->property_image; ?>" width="100%" alt="" draggable="false"/>
									</div>
								</div>
								</a>
							</div>
							<div class="estates property_details col-sm-8">
								<a href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">
								
									<h2 class="green"><?php echo $val->property_name; ?></h2>
									<!-- <p class="green"><i><?php //echo site_url().'estates/properties/'.$val->property_slug; ?></i></p> -->
									<i><?php echo $val->property_type_name; ?></i>
									<p>from <?php echo $val->price_range_label; ?></p>
									<div class="property_overview"><?php echo $val->property_overview; ?></div>
									<?php if(isset($val->unit_types) && $val->unit_types): ?>
									<p class="unit_types"><?php echo substr($units,0,-2)?></p> 
									<?php endif; ?>
									<?php echo $val->location_name; ?></p>
							
								</a>
							</div>
						</div>
					<?php	} //end foreach ?>
				
		
				<?php } else{ ?>
					<h1 class="pull-left"> No result found... </h1>
					<div class="clear"></div>
				<?php } ?>

				<div class="seo_content">
					<?php if($page_content) { echo parse_content($page_content->page_bottom_content); } ?>
				</div>
			<!-- <div class="search_result"> -->
				<?php /*if(isset($residences) && $residences) {?>
				<div class="r">
				<!-- <h1>Residences</h1> -->
				<div class="row">
					<?php
					foreach ($residences as $key => $val) { ?>
						<div class="estates residences col-sm-4">
							<a href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">
							<div class="image_wrapper">
								<div class="property"><?php echo $val->property_name; ?></div>
								<div class="image_container">
									<img src="<?php echo config_item('website_url').$val->property_image; ?>" width="100%" alt="" draggable="false"/>
								</div>
								<div class="estate"><?php echo $val->estate_name; ?></div>
							</div>
							</a>
						</div>
					<?php	} //end foreach ?>
				</div>
				</div>
				<?php }?>
				
				
				<?php if(isset($malls) && $malls) {?>
				<div class="m">
				<h1>Malls</h1>
				<div class="row">
					<?php
					foreach ($malls as $key => $val) { ?>
						<div class="estates residences col-sm-4">
							<a href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">
							<div class="image_wrapper">
								<div class="property"><?php echo $val->property_name; ?></div>
								<div class="image_container">
									<img src="<?php echo config_item('website_url').$val->property_image; ?>" width="100%" alt="" draggable="false"/>
								</div>
								<div class="estate"><?php echo $val->estate_name; ?></div>
							</div>
							</a>
						</div>
					<?php	} //end foreach ?>
				</div>
				</div>
				<?php }?>

				<?php if(isset($offices) && $offices) {?>
				<div class="o">
				<h1>Offices</h1>
				<div class="row">
					<?php
					foreach ($offices as $key => $val) { ?>
						<div class="estates residences col-sm-4">
							<a href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">
							<div class="image_wrapper">
								<div class="property"><?php echo $val->property_name; ?></div>
								<div class="image_container">
									<img src="<?php echo config_item('website_url').$val->property_image; ?>" width="100%" alt="" draggable="false"/>
								</div>
								<div class="estate"><?php echo $val->estate_name; ?></div>
							</div>
							</a>
						</div>
					<?php	} //end foreach ?>
				</div>
				</div>
				<?php } */?>

		
			</div>
		</div><!--content-->
	</main>
</section>
<script type="text/javascript">
	var post_url = '<?php echo current_url(); ?>'
	var site_url = "<?php echo site_url(); ?>"
</script>
