<section id="roles">
	<?php echo $this->load->view('properties/specific_properties/banner_view'); ?>
	<main role="main" class="container">
		<div class="content">	
			<div class="row">	
				<div class="news_content col-sm-8">

					<?php echo $this->load->view('properties/specific_properties/tabs_view'); ?>

					<?php
					foreach($division_order as $key => $value){
						if($value->setting_division == 'Overview Description'){
							echo $this->load->view('properties/specific_properties/properties_overview');
						}
						if($value->setting_division == 'Amenities'){
							echo $this->load->view('properties/specific_properties/properties_amenities');
						}
						if($value->setting_division == 'Slider'){
							echo $this->load->view('properties/specific_properties/slider_view');
						}
						if($value->setting_division == 'Locations'){
							echo $this->load->view('properties/specific_properties/location_view');
						}
						if($value->setting_division == 'Building Floorplan'){
							echo $this->load->view('properties/specific_properties/floorplan_view');
						}
						if($value->setting_division == 'Unit Floorplan'){
							echo $this->load->view('properties/specific_properties/unit-type_view');
						}
						if($value->setting_division == 'Construction Update'){
							echo $this->load->view('properties/specific_properties/construction_update');
						}
						if($value->setting_division == 'SEO Content'){
							echo $this->load->view('properties/specific_properties/seo_content');
						}
						if($value->setting_division == 'Related News'){
							echo $this->load->view('properties/specific_properties/news_related');
						}
						if($value->setting_division == 'Related Residences'){
							echo $this->load->view('properties/specific_properties/other-residences_view');
						}
					}
					?>

				</div>

				<div class="news_sidebar col-sm-4">
					<?php echo $this->load->view('website/inquiry_form'); ?>
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
			</div>
		</div>
	</main>
</section>
<script type="text/javascript">
	var site_url = "<?php echo site_url(); ?>"
	var app_url = "<?php echo base_url(); ?>"
	var property_id = "<?php echo $properties->property_id; ?>"
</script>