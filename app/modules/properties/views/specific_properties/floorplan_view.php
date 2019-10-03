<?php if(isset($floors) && $floors && count($floors) > 1) { ?>
<div id="building-floorplan">
	<div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="floorplan_heading col-md-4">
				<h2>Building Floor Plan</h2>		
				<?php echo form_dropdown('select-floorplan', $floors, set_value('floorplan', (isset($record->floorplan)) ? '' : ''), 'id="select-floorplan" class="form-control"'); ?>
			</div>
			
			<div id="unit-img  col-md-6" >
				<center>
					<a class="floorplan_image_link" href="<?php echo site_url().'properties/properties/floorplan_image?img='.getenv("UPLOAD_ROOT").'data/images/building-floorplan.png' ?>" data-target="#modal-lg" data-toggle="modal">
						<img id="floorplan_image" class="lazy" data-src="<?php echo getenv('UPLOAD_ROOT'); ?>data/images/building-floorplan.png">
					</a>
				</center>
			</div>
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

