<?php if(isset($amenities) && $amenities): ?>
<div class="ammenities_container">
	<div class="amenities">
		<h2>Amenities</h2>
		<div class="row">
			<?php foreach ($amenities as $key => $value) { ?>
				<div class="col-sm-4"><i class="fa fa-circle" aria-hidden="true"></i><?php echo $value->amenity_name; ?></div>
			<?php }?>
		</div>
	</div>
</div>
<?php endif; ?>