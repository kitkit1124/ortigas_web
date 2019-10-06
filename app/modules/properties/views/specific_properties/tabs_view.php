<?php 
	$btn_cnt = 0;
	$col_cnt = 12; 
	if(isset($floors) && $floors && count($floors) > 1 || isset($room_types) && $room_types) { $btn_cnt += 1; }
	if(isset($floors) && $floors && count($floors) > 1) { $btn_cnt += 1; }
	if(isset($construction_sliders) && $construction_sliders){ $btn_cnt += 1; }
	if($btn_cnt){
		$col_cnt = $col_cnt / $btn_cnt;
	}
	?>
	
<div class="row specific_estate">

	<?php if(isset($floors) && $floors && count($floors) > 1 || isset($room_types) && $room_types) : ?>
	<div class="<?php echo "col-sm-".$col_cnt; ?> btn_est">
		<div class="estate_button" data-anchor="properties_overview">
			<p>OVERVIEW</p>
			<span>360 Tour, Gallery & Amenities</span>
		</div>
	</div>
	<?php endif; ?>

	<?php if(isset($floors) && $floors && count($floors) > 1) : ?>
	<div class="<?php echo "col-sm-".$col_cnt; ?> btn_est">
		<div class="estate_button" data-anchor="building-floorplan">
			<p>BUILDING & UNIT FLOOR PLAN</p> 
			<span>View Floor Plans & Unit Sizes</span> 
		</div>
	</div>
	<?php endif; ?>

	<?php if(isset($construction_sliders) && $construction_sliders) : ?>
	<div class="<?php echo "col-sm-".$col_cnt; ?> btn_est">
		<a href="<?php echo site_url().'properties/construction_timeline_modal?id='.$properties->property_id; ?>" data-target="#modal-lg" data-toggle="modal">
		<div class="estate_button" data-anchor="property_view_content">
			<p>PROJECT UPDATES</p>
			<span>Construction Timeline</span>
		</div>
		</a>
	</div>
	<?php endif; ?>

</div>