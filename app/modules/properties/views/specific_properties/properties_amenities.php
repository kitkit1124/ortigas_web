<?php if(isset($amenities) && $amenities): ?>
<div class="ammenities_container">
	<div class="amenities">
		<h2>Amenities</h2>
		<p class="amenities_description">
			<?php echo $properties->property_amenities_description; ?>
		</p>
		<div class="row">
			<?php foreach ($amenities as $key => $value) { ?>
				<div class="col-lg-6"><i class="fa fa-circle" aria-hidden="true"></i><?php echo $value->amenity_name; ?></div>
			<?php }?>
		</div>
	</div>
</div>
<?php endif; ?>