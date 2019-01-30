<?php if(isset($room_types) && $room_types)  { ?>
<div id="unit-floorplan">
	<h2>Unit Floor Plan</h2>
    <ul class="nav" role="tablist">
		<?php foreach ($room_types as $key => $value) { ?>
			<li class="nav-item">
				<a class="" data-toggle="tab" data-id="<?php echo $value->room_type_id; ?>" href="#room-menu<?php echo $key; ?>">
					<img class="unit_floorplan_thumb" src="<?php echo getenv('UPLOAD_ROOT').$value->room_type_image; ?>" alt="<?php echo $value->room_type_alt_image; ?>" title="<?php echo $value->room_type_alt_image; ?>" data-title="<?php echo $value->room_type_name; ?>" onerror="this.onerror=null;this.src='<?php echo site_url('ui/images/placeholder.png')?>';"/>	
				</a>
			</li>
    	<?php } ?>
    </ul>

    <center class="unit-floorplan_title"></center>

	<div class="tab-content">
		<?php foreach ($room_types as $key => $value) { ?>
		<div id="room-menu<?php echo $key; ?>" class="tab-pane fade">
			<a href="<?php echo site_url().'properties/properties/floorplan_image?img='.getenv("UPLOAD_ROOT").$value->room_type_image ?>" data-target="#modal-lg" data-toggle="modal">
				<img src="<?php echo getenv('UPLOAD_ROOT').$value->room_type_image; ?>" alt="<?php echo $value->room_type_alt_image; ?>" title="<?php echo $value->room_type_alt_image; ?>" onerror="this.onerror=null;this.src='<?php echo site_url('ui/images/placeholder.png')?>';"/>
			</a>
    	</div>
    	
    	<?php } ?>
    	<p id="range_size">&nbsp;</p>
    	<a id="check_available_button" class="hide" data-action="check"><?php echo lang('button_check_available'); ?></a>
	</div>
</div><!--unit-floorplan-->
 <?php } ?>	

 <div class="unit-reservation-heading hide">
	 <div class="row">
	 	<div class="col-sm-7">
			<p>Unit Availability</p>
			<p>*Reservation fee PHP 10,000 must be paid via PayPal or PayMaya</p>
			
		</div>
		<div class="col-sm-5 button">
			<?php echo form_dropdown('select-floorplan2', $floors, set_value('floorplan2', (isset($record->floorplan)) ? '' : ''), 'id="select-floorplan2" class="form-control"'); ?>
		</div>
	</div>
</div>