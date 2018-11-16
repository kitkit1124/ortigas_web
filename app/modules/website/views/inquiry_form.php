<?php $this->template->add_css(module_css('inquiry_form'), 'embed'); ?>
<?php $this->template->add_js(module_js('inquiry_form'), 'embed'); ?>
<div class="inquiry_form">
	<h1>Quick Inquiry</h1>
	<div class="row">		
		<input type="hidden" id="csrf" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
		<div class="form_container col-sm-4">
			<label for="inquiry_category">Category*</label>
			<?php echo form_input(array('id'=>'inquiry_category', 'name'=>'inquiry_category', 'value'=>set_value('inquiry_category', isset($record->inquiry_category) ? $record->inquiry_category : ''), 'class'=>'form-control'));?>
		</div>
		<div class="form_container col-sm-4">
			<label for="inquiry_name">Name*</label>
			<?php echo form_input(array('id'=>'inquiry_name', 'name'=>'inquiry_name', 'value'=>set_value('inquiry_name', isset($record->inquiry_name) ? $record->inquiry_name : ''), 'class'=>'form-control'));?>
		</div>
		<div class="form_container col-sm-4">
			<label for="inquiry_email">Email*</label>
			<?php echo form_input(array('id'=>'inquiry_email', 'name'=>'inquiry_email', 'value'=>set_value('inquiry_email', isset($record->inquiry_email) ? $record->inquiry_email : ''), 'class'=>'form-control'));?>
		</div>	
	</div>

	<div class="form_container">
		<label for="inquiry_message">Your Message*</label>
		<?php echo form_textarea(array('id'=>'inquiry_message', 'name'=>'inquiry_message', 'rows'=>'5', 'value'=>set_value('inquiry_message', isset($record->inquiry_message) ? $record->inquiry_message : '', false), 'class'=>'form-control')); ?>
	</div>
	
	<a class="inquiry_submit green_button">SUBMIT</a>

	<div class="inquiry_border_bottom"></div>
</div>