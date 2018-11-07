<?php if($floors) { ?>
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
			<center><img id="floorplan_image" data-toggle="modal" data-target="#enlarge_image" src="<?php echo base_url(); ?>data/images/building-floorplan.png"></center>
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

	<!-- The Modal -->
	<div class="modal fade" id="enlarge_image">
	<div class="modal-dialog modal-dialog-centered">
	  <div class="modal-content">
	  		<img id="floorplan_image" src="<?php echo base_url(); ?>data/images/building-floorplan.png" draggable="false"/>
	  </div>
	</div>
</div>
<?php } ?>	

