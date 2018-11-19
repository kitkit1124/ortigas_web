<section id="roles">
	<?php echo $this->load->view('properties/specific_properties/banner_view'); ?>
	<div class="tabs_view_outer">
		<?php echo $this->load->view('properties/specific_properties/tabs_view'); ?>
	</div>
	<main role="main" class="container">
		<div class="content">	
			<div class="row">	
				<?php if (isset($properties->category_id) && $properties->category_id == 2){ $cols='8'; } else { $cols = '12'; } ?>
				<div class="property_view_content col-sm-<?php echo $cols; ?>">
					<?php if($properties->category_id==2) : ?>
						<div class="tabs_view_inner">
							<?php echo $this->load->view('properties/specific_properties/tabs_view'); ?>
						</div>
					<?php endif; ?>
					<?php
					foreach($division_order as $key => $value){
						if($value->setting_division == 'Overview Description'){
							echo $this->load->view('properties/specific_properties/properties_overview');
						}
					
						if($value->setting_division == 'Amenities'){
							if($properties->category_id==2) :
								echo $this->load->view('properties/specific_properties/properties_amenities');
							endif;
						}				

						if($value->setting_division == 'Slider'){
							echo $this->load->view('properties/specific_properties/slider_view');
						}
						if($value->setting_division == 'Locations'){
							echo $this->load->view('properties/specific_properties/location_view');
						}
						if($value->setting_division == 'Building Floorplan'){
							if($properties->category_id==2) :
								echo $this->load->view('properties/specific_properties/floorplan_view');
							endif;
						}
						if($value->setting_division == 'Unit Floorplan'){
							if($properties->category_id==2) :
								echo $this->load->view('properties/specific_properties/unit-type_view');
							endif;
						}
						if($value->setting_division == 'Construction Update'){
							if($properties->category_id==2) :
								echo $this->load->view('properties/specific_properties/construction_update');
							endif;
						}
						if($value->setting_division == 'SEO Content'){
							echo $this->load->view('properties/specific_properties/seo_content');
						}
						if($value->setting_division == 'Related News'){
							if($properties->category_id==2) :
								echo $this->load->view('properties/specific_properties/news_related');
							endif;
						}
						if($value->setting_division == 'Related Residences'){
							if($properties->category_id==2) :
								echo $this->load->view('properties/specific_properties/other-residences_view');
							endif;
						}
					}

					?>
					<?php if($properties->category_id!=2) : ?>
						<div class="inquiry_form_container">
							<?php echo $this->load->view('messages/messages_form')?>
						</div>
					
						

					<?php endif; ?>
						
				</div>

				<?php if($properties->category_id==2) : ?>
					<style>
						.inquiry_form .form_container{
							flex: 100%;
							max-width: 100%;
						}
					</style>

				<div class="news_sidebar col-sm-4">

						<?php 
						$data = [];
						$data['remove_this'] = 1;
						echo $this->load->view('messages/messages_form',$data); ?>
				
					<div class="related_properties_result">
						<?php
							$data = [];
							$data['display'] = 'hide';
							$data['cols'] = 'col-sm-6';
							$data['image'] = 'property_logo';

						 	echo $this->load->view('properties/properties_result', $data); 
						 ?>
					</div>
				</div>

				<?php endif; ?>

			</div>
		</div>
	</main>
</section>
<script type="text/javascript">
	var site_url = "<?php echo site_url(); ?>"
	var app_url = "<?php echo base_url(); ?>"
	var property_id = "<?php echo $properties->property_id; ?>"
</script>

<?php if($properties->category_id!=2) : ?>
<?php echo $this->load->view('properties/specific_properties/news_related'); ?>
<?php echo $this->load->view('properties/recommended_links')?>
<?php endif; ?>