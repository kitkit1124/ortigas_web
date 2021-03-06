<section id="roles">
	<?php echo $this->load->view('properties/specific_properties/banner_view'); ?>
	<!-- <div class="tabs_view_outer">
		<?php //echo $this->load->view('properties/specific_properties/tabs_view'); ?>
	</div> -->
<!-- 	<main role="main" class="container">
		<div class="content">	
			<div class="row"> -->	
				<div id="property_view_content" class="property_view_content">
					<?php if($properties->category_id==1) : ?>
						<div class="container">
							<div class="tabs_view_inner">
								<?php echo $this->load->view('properties/specific_properties/tabs_view'); ?>
							</div>
						</div>
					<?php endif; ?>
	
					<?php if($properties->category_id!=1 && $properties->property_slug == "the-galleon") : ?>
							<div class="container">
								<div class="inquiry_form_container">
									<?php echo $this->load->view('messages/messages_form')?>
								</div>
							</div>
					<?php endif; ?>

					<?php
					foreach($division_order as $key => $value){

						if($value->setting_division == 'Overview Description' && $properties->category_id == 1){ 

					?>

						<div class="container">
							<?php echo $this->load->view('properties/specific_properties/properties_overview'); ?>
						</div>

					<?php 

						}


						if($value->setting_division == 'Slider'){	
							if($properties->category_id==1){
						?>

								<div class="container">
									<?php if(isset($amenities) && $amenities): ?>
									<div class="row">

										<div class="col-lg-6">
										<?php endif; ?>
											<?php  echo $this->load->view('properties/specific_properties/slider_view'); ?>
										<?php if(isset($amenities) && $amenities): ?>
										</div>

										<div class="col-lg-6">
										<?php endif; ?>
											<?php echo $this->load->view('properties/specific_properties/properties_amenities'); ?>

										<?php if(isset($amenities) && $amenities): ?>
										</div>
									</div>
									<?php endif; ?>
								</div>
					
						<?php
							}else{
						?>
								<div class="container">
									<div class="row cont_malls">
										<div class="col-lg-6">
											<h2><?php echo $properties->property_name; ?></h2>
											<?php echo $this->load->view('properties/specific_properties/properties_overview'); ?>

											<a class="default-button" href="<?php echo $properties->property_website; ?>">
												DISCOVER <?php echo $properties->property_name; ?>
											</a>
										</div>
										<div class="col-lg-6">
											<?php  echo $this->load->view('properties/specific_properties/slider_view'); ?>
										</div>
									</div>
								</div>
						<?php
							}
						}
						?>

						<?php
						if($value->setting_division == 'Locations'){
							echo $this->load->view('properties/specific_properties/location_view');
						}
						?>

						<?php
						if($value->setting_division == 'Building Floorplan'){
							// if($properties->category_id==1) :
						?>
							<div class="container">
								<?php echo $this->load->view('properties/specific_properties/floorplan_view'); ?>
							</div>
						<?php
							// endif;
						}
						if($value->setting_division == 'Unit Floorplan'){
							// if($properties->category_id==1) :
						?>
							<div class="container">
								<?php echo $this->load->view('properties/specific_properties/unit-type_view'); ?>
							</div>
						<?php
							// endif;
						}
						if($value->setting_division == 'Construction Update'){
							if($properties->category_id==1) :
						?>
							<div class="container">
								<?php echo $this->load->view('properties/specific_properties/construction_update'); ?>
							</div>
						<?php
							endif;
						}
						
					/*	if($value->setting_division == 'SEO Content'){
						?>
							<!-- <div class="container">
								<?php //echo $this->load->view('properties/specific_properties/seo_content'); ?>
							</div> -->
						<?php
						}
						if($value->setting_division == 'Related News'){
							// if($properties->category_id==1) :
						?>
							<!-- <div class="container"> -->
								<?php //echo $this->load->view('properties/specific_properties/news_related'); ?>
							<!-- </div> -->
						<?php
							// endif;
						}*/
						
						if($value->setting_division == 'Related Residences'){
							if($properties->category_id==1) :
							?>
							<div class="container">
								<?php echo $this->load->view('properties/specific_properties/other-residences_view'); ?>
							</div>
						<?php
							endif; 
						}
					}

					?>


					<?php if(/*$properties->category_id!=1 && */$properties->property_slug != "the-galleon") : ?>
						<div class="container">
							<div class="inquiry_form_container">
								<?php echo $this->load->view('messages/messages_form')?>
							</div>
						</div>
					<?php endif; ?>
						
				</div>

				<?php /*if($properties->category_id==1) : ?>
				<style>
					.inquiry_form .form_container{
						flex: 100%;
						max-width: 100%;
					}
				</style>

				<div class="news_sidebar col-sm-4">
					<div class="stick_side">
							<?php 
							$data = [];
							$data['remove_this'] = 1;
							echo $this->load->view('messages/messages_form',$data); ?>
					
						<div class="related_properties_result">
							<?php
								$data = [];
								$data['display'] = 'hide';
								$data['cols'] = 'col-sm-6';
								$data['image'] = 'property_thumb';

							 	echo $this->load->view('properties/properties_result', $data); 
							 ?>
						</div>
					</div>
				</div>

				<?php endif;*/ ?>
		<!-- 	</div> -->

		<!-- </div>
	</main> -->
</section>
<script type="text/javascript">
	var site_url = "<?php echo site_url(); ?>"
	var app_url = "<?php echo base_url(); ?>"
	var property_id = "<?php echo $properties->property_id; ?>"
	var map_name = "<?php echo $properties->property_map_name; ?>"
	var upload_url = "<?php echo getenv('UPLOAD_ROOT'); ?>"
</script>

<?php //echo $this->load->view('properties/recommended_links')?>
