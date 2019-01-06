<?php 
	$btn_cnt = 0;
	$col_cnt = 12; 
	if(isset($floors) && $floors && count($floors) > 1 || isset($room_types) && $room_types) { $btn_cnt += 1; }
	if(isset($floors) && $floors && count($floors) > 1) { $btn_cnt += 1; }
	if(isset($room_types) && $room_types){ $btn_cnt += 1; }
	if($btn_cnt){
		$col_cnt = $col_cnt / $btn_cnt;
	}
	?>
	
<div class="row specific_estate">

	<?php if(isset($floors) && $floors && count($floors) > 1 || isset($room_types) && $room_types) : ?>
	<div class="<?php echo "col-sm-".$col_cnt; ?> btn_est">
		<div class="estate_button" data-anchor="location">
			<p>INFORMATION</p>
			<span>Overview</span>
		</div>
	</div>
	<?php endif; ?>

	<?php if(isset($floors) && $floors && count($floors) > 1) : ?>
	<div class="<?php echo "col-sm-".$col_cnt; ?> btn_est">
		<div class="estate_button" data-anchor="building-floorplan">
			<p>BUILDING FLOOR PLAN</p> 
			<span>Floor Plan Overview</span>
		</div>
	</div>
	<?php endif; ?>

	<?php if(isset($room_types) && $room_types) : ?>
	<div class="<?php echo "col-sm-".$col_cnt; ?> btn_est">
		<div class="estate_button" data-anchor="unit-floorplan">
			<p>UNIT FLOOR PLAN</p>
			<span>Unit Type and Size</span>
		</div>
	</div>
	<?php endif; ?>

</div>