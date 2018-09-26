<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">
		<span aria-hidden="true">&times;</span>
		<span class="sr-only"><?php echo lang('button_close')?></span>
	</button>
	<h4 class="modal-title" id="myModalLabel"><?php echo $page_heading?></h4>
</div>

<div class="modal-body">

	<div class="form-horizontal">

		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

		<div class="form-group">
			<label class="col-sm-3 control-label" for="company"><?php echo lang('company')?>:</label>
			<div class="col-sm-9">
				<?php echo form_input(array('id'=>'company', 'name'=>'company', 'value'=>set_value('company', isset($record->company) ? $record->company : ''), 'class'=>'form-control'));?>
				<div id="error-company"></div>
				<div class="help-text text-muted"><em>Company name or your full name</em></div>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="first_name"><?php echo lang('first_name')?>:</label>
			<div class="col-sm-9">
				<?php echo form_input(array('id'=>'first_name', 'name'=>'first_name', 'value'=>set_value('first_name', isset($record->first_name) ? $record->first_name : ''), 'class'=>'form-control'));?>
				<div id="error-first_name"></div>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="last_name"><?php echo lang('last_name')?>:</label>
			<div class="col-sm-9">
				<?php echo form_input(array('id'=>'last_name', 'name'=>'last_name', 'value'=>set_value('last_name', isset($record->last_name) ? $record->last_name : ''), 'class'=>'form-control'));?>
				<div id="error-last_name"></div>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="phone"><?php echo lang('phone')?>:</label>
			<div class="col-sm-9">
				<?php echo form_input(array('id'=>'phone', 'name'=>'phone', 'value'=>set_value('phone', isset($record->phone) ? $record->phone : ''), 'class'=>'form-control'));?>
				<div id="error-phone"></div>
			</div>
		</div>

	</div>

</div>

<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">
		<i class="fa fa-times"></i> <?php echo lang('button_close')?>
	</button>
	<button id="submit" class="btn btn-success" type="submit" data-loading-text="<?php echo lang('processing')?>">
		<i class="fa fa-save"></i> <?php echo lang('button_update')?>
	</button>
</div>