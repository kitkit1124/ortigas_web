<?php if(isset($floors) && $floors && count($floors) > 1) { ?>
<div id="building-floorplan">
	<div>
		<!-- <div class="row">
			<div class="col-sm-7">
				<h1>Building Floor Plan</h1>
			</div>
			<div class="col-sm-5">
				<?php echo form_dropdown('select-floorplan', $floors, set_value('floorplan', (isset($record->floorplan)) ? '' : ''), 'id="select-floorplan" class="form-control"'); ?>
			</div>
		</div> -->
		<div class="floorplan_heading">
			<h1>Building Floor Plan</h1>		
			<?php echo form_dropdown('select-floorplan', $floors, set_value('floorplan', (isset($record->floorplan)) ? '' : ''), 'id="select-floorplan" class="form-control"'); ?>
		</div>
		
		<div id="unit-img" >
			<center>
				<a class="floorplan_image_link" href="<?php echo site_url().'properties/properties/floorplan_image?img='.getenv("UPLOAD_ROOT").'data/photos/building-floorplan.png' ?>" data-target="#modal-lg" data-toggle="modal">
					<img id="floorplan_image" src="<?php echo getenv('UPLOAD_ROOT'); ?>data/photos/building-floorplan.png">
				</a>
			</center>
		</div>
		<div id="unit-reserve">
			<table>
				<th>Unit</th>
				<th>SQM</th>
				<th></th>
			</table>
		</div><!--unit-reserve-->
		<div style="clear: both;"></div>
	</div>
</div><!--building-floorplan-->
<?php } ?>	

