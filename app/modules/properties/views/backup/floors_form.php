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
			<label for="floor_property_id"><?php echo lang('floor_property_id')?>:</label>
			<?php $options = create_dropdown('array', ',5'); ?>
			<?php echo form_dropdown('floor_property_id', $properties, set_value('floor_property_id', (isset($record->floor_property_id)) ? $record->floor_property_id : ''), 'id="floor_property_id" class="form-control"'); ?>
			<div id="error-floor_property_id"></div>
		</div>

		<div class="form-group">
			<label for="floor_level"><?php echo lang('floor_level')?>:</label>			
			<?php echo form_input(array('id'=>'floor_level', 'name'=>'floor_level', 'value'=>set_value('floor_level', isset($record->floor_level) ? $record->floor_level : ''), 'class'=>'form-control'));?>
			<div id="error-floor_level"></div>			
		</div>
		<div class="form-group">
			<?php if(isset($record->floor_image)) { ?> <style type="text/css"> #dropzone{ display: none; } </style> <?php } 
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
					<img id="floor_active_image" src="<?php echo site_url(isset($record->floor_image) ? $record->floor_image : 'ui/images/placeholder.png'); ?>" class="img-responsive" width="100%" alt=""/>
				</center>

			</div>
			<div id="error-floor_image"></div>

			<div style="display: none">
			<?php echo form_input(array('id'=>'floor_image', 'name'=>'floor_image', 'value'=>set_value('floor_image', isset($record->floor_image) ? $record->floor_image : ''), 'class'=>'form-control'));?>
			</div>				
		</div>
		<div class="form-group">
			<label for="floor_status"><?php echo lang('floor_status')?>:</label>
			<?php $options = create_dropdown('array', 'Active,Disabled'); ?>
			<?php echo form_dropdown('floor_status', $options, set_value('floor_status', (isset($record->floor_status)) ? $record->floor_status : ''), 'id="floor_status" class="form-control"'); ?>
			<div id="error-floor_status"></div>
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