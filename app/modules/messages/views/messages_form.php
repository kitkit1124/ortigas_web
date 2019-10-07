<?php $this->template->add_css(module_css('messages', 'messages_form'), 'embed'); ?>
<?php $this->template->add_js(module_js('messages', 'messages_form'), 'embed'); ?>
<div class="inquiry_form">
	<h2>Quick Inquiry</h2>
	<div class="row">		
		<input type="hidden" id="csrf" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
		<div class="form_container col-sm-4">
			<!-- <label for="inquiry_name">Category*</label> -->
			<?php echo form_input(array('id'=>'inquiry_category', 'name'=>'inquiry_category', 'value'=>set_value('inquiry_category', isset($section) ? $section : ''), 'class'=>'form-control', 'placeholder'=>'Category*'));?>
			<div id="error-message_section" class="error_field"></div>
		</div>

		<div class="form_container col-sm-4">
			<!-- <label for="inquiry_name">Name*</label> -->
			<?php echo form_input(array('id'=>'inquiry_name', 'name'=>'inquiry_name', 'value'=>set_value('inquiry_name', isset($record->inquiry_name) ? $record->inquiry_name : ''), 'class'=>'form-control', 'placeholder'=>'Name*'));?>
			<div id="error-message_name" class="error_field"></div>
		</div>
		<div class="form_container col-sm-4">
			<!-- <label for="inquiry_email">Email*</label> -->
			<?php echo form_input(array('id'=>'inquiry_email', 'name'=>'inquiry_email', 'value'=>set_value('inquiry_email', isset($record->inquiry_email) ? $record->inquiry_email : ''), 'class'=>'form-control', 'placeholder'=>'Email*'));?>
			<div id="error-message_email" class="error_field"></div>
		</div>	
	</div>

	<div class="form_container">
		<!-- <label for="inquiry_message">Your Message*</label> -->
		<?php echo form_textarea(array('id'=>'inquiry_message', 'name'=>'inquiry_message', 'rows'=>'3', 'value'=>set_value('inquiry_message', isset($record->inquiry_message) ? $record->inquiry_message : '', false), 'class'=>'form-control','placeholder'=>'Your Message*')); ?>
		<div id="error-message_content" class="error_field"></div>
	</div>
	
	<center><a class="inquiry_submit default-button">SUBMIT</a></center>

	<?php if(isset($remove_this)){ ?>
		<div class="inquiry_border_bottom"></div>
	<?php } ?>

	<a id="message_success" class="hide" href="<?php echo site_url().'website/page/show_modal?id=5' ?>" data-target="#modal-lg" data-toggle="modal"></a>
	<a id="message_denied" class="hide" href="<?php echo site_url().'website/page/show_modal?id=8' ?>" data-target="#modal-lg" data-toggle="modal"></a>
</div>

<script type="text/javascript">
   var section = '<?php echo $section; ?>'
   var section_id = '<?php echo $section_id; ?>'
</script>