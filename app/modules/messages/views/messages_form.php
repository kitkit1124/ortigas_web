<?php $this->template->add_css(module_css('messages', 'messages_form'), 'embed'); ?>
<?php $this->template->add_js(module_js('messages', 'messages_form'), 'embed'); ?>
<div class="inquiry_form">
	<h1>Quick Inquiry</h1>
	<div class="row">		
		<input type="hidden" id="csrf" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
		<div class="form_container col-sm-4">
			<label for="inquiry_category">Category*</label>
			<?php echo form_input(array('id'=>'inquiry_category', 'name'=>'inquiry_category', 'value'=>set_value('inquiry_category', isset($section) ? $section : ''), 'class'=>'form-control'));?>
			<div id="error-message_section" class="error_field"></div>
		</div>

		<div class="form_container col-sm-4">
			<label for="inquiry_name">Name*</label>
			<?php echo form_input(array('id'=>'inquiry_name', 'name'=>'inquiry_name', 'value'=>set_value('inquiry_name', isset($record->inquiry_name) ? $record->inquiry_name : ''), 'class'=>'form-control'));?>
			<div id="error-message_name" class="error_field"></div>
		</div>
		<div class="form_container col-sm-4">
			<label for="inquiry_email">Email*</label>
			<?php echo form_input(array('id'=>'inquiry_email', 'name'=>'inquiry_email', 'value'=>set_value('inquiry_email', isset($record->inquiry_email) ? $record->inquiry_email : ''), 'class'=>'form-control'));?>
			<div id="error-message_email" class="error_field"></div>
		</div>	
	</div>

	<div class="form_container">
		<label for="inquiry_message">Your Message*</label>
		<?php echo form_textarea(array('id'=>'inquiry_message', 'name'=>'inquiry_message', 'rows'=>'4', 'value'=>set_value('inquiry_message', isset($record->inquiry_message) ? $record->inquiry_message : '', false), 'class'=>'form-control')); ?>
		<div id="error-message_content" class="error_field"></div>
	</div>
	
	<a class="inquiry_submit default-button">SUBMIT</a>

	<?php if(isset($remove_this)){ ?>
		<div class="inquiry_border_bottom"></div>
	<?php } ?>
</div>


<a id="form_landing_button" class="hide" data-toggle="modal" data-target="#form_landing">&nbsp;</a>
<!-- Modal -->
<div class="modal fade" id="form_landing" tabindex="-1" role="dialog" aria-labelledby="Form" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="times_button">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php $form_landing = $this->partials_model->find(5);  echo parse_content($form_landing->partial_content); ?>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
   var section = '<?php echo $section; ?>'
   var section_id = '<?php echo $section_id; ?>'
</script>