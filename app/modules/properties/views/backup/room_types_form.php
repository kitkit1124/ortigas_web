<div class="modal-header">
	<h5 class="modal-title" id="modalLabel"><?php echo $page_heading?></h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<div class="modal-body">

	<div class="form">

		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
		
		<div class="form-group">
			<label for="room_type_property_id"><?php echo lang('room_type_property_id')?>:</label>
			<?php echo form_dropdown('room_type_property_id', $properties, set_value('room_type_property_id', (isset($record->room_type_property_id)) ? $record->room_type_property_id : ''), 'id="room_type_property_id" class="form-control"'); ?>
			<div id="error-room_type_property_id"></div>
		</div>

		<div class="form-group">
			<label for="room_type_name"><?php echo lang('room_type_name')?>:</label>			
			<?php echo form_input(array('id'=>'room_type_name', 'name'=>'room_type_name', 'value'=>set_value('room_type_name', isset($record->room_type_name) ? $record->room_type_name : ''), 'class'=>'form-control'));?>
			<div id="error-room_type_name"></div>			
		</div>

		<div class="form-group">
			<?php if(isset($record->room_type_image)) { ?> <style type="text/css"> #dropzone{ display: none; } </style> <?php } 
			else {  ?> <style type="text/css"> #image_container{ display: none; } </style> <?php } ?>
			
			<div class="form image_upload">
				<?php echo form_open(site_url('files/images/upload'), array('class'=>'dropzone', 'id'=>'dropzone'));?>
					<div class="fallback">
						<input name="file" type="file"/>
					</div>
				<?php echo form_close();?> 
			</div>
			<div id="image_container">
				<!-- <button id="clear_photo_button" class="fa fa-window-close"></button> -->
				<center>
					<img id="room_type_active_image" src="<?php echo site_url(isset($record->room_type_image) ? $record->room_type_image : 'ui/images/placeholder.png'); ?>" class="img-responsive" width="100%" alt=""/>
				</center>

			</div>
			<div id="error-room_type_image"></div>

			<div style="display: none">
			<?php echo form_input(array('id'=>'room_type_image', 'name'=>'room_type_image', 'value'=>set_value('room_type_image', isset($record->room_type_image) ? $record->room_type_image : ''), 'class'=>'form-control'));?>
			</div>				
		</div>

		<div class="form-group">
			<label for="room_type_status"><?php echo lang('room_type_status')?>:</label>
			<?php $options = create_dropdown('array', 'Active,Disabled'); ?>
			<?php echo form_dropdown('room_type_status', $options, set_value('room_type_status', (isset($record->room_type_status)) ? $record->room_type_status : ''), 'id="room_type_status" class="form-control"'); ?>
			<div id="error-room_type_status"></div>
		</div>



	</div>

</div>

<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">
		<i class="fa fa-times"></i> <?php echo lang('button_close')?>
	</button>
	<?php if ($action == 'add'): ?>
		<button id="submit" class="btn btn-success" type="submit" data-loading-text="<?php echo lang('processing')?>">
			<i class="fa fa-save"></i> <?php echo lang('button_add')?>
		</button>
	<?php elseif ($action == 'edit'): ?>
		<button id="submit" class="btn btn-success" type="submit" data-loading-text="<?php echo lang('processing')?>">
			<i class="fa fa-save"></i> <?php echo lang('button_update')?>
		</button>
	<?php else: ?>
		<script>$(".modal-body :input").attr("disabled", true);</script>
	<?php endif; ?>
</div>	