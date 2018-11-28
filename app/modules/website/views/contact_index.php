<?php echo $this->load->view('website/slider_index'); ?>
<?php $this->template->add_js(module_js('website', 'slider_index'), 'embed'); ?>
<main role="main" class="container">
	<div class="content">

		<div class="row">
			<div class="col-sm-4">

				<div class="google-maps">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.206901707607!2d121.07216671505488!3d14.587283081313162!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c808abaef137%3A0xdd2ab4e5438fc1a8!2sValle+Verde+5!5e0!3m2!1sen!2sph!4v1505972548418" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>

				<div class="contact_address">
					<?php echo parse_content($contact_address->partial_content); ?>
				</div>

			</div>
			<div class="col-sm-8">
				<div class="page_content">
					<?php echo parse_content($page_content->page_content); ?>
				</div>

				<div class="contact_form">

					<?php $return = ($this->input->get('return')) ? '?return=' . urlencode($this->input->get('return')) : ''; ?>
					<?php echo form_open(current_url() . $return);?>

					<input type="hidden" id="csrf" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="message_section">Inquiry Type</label>

								<?php $options = create_dropdown('array', 'Project'); ?>
								<?php echo form_dropdown('message_section', $options, '', 'id="message_section" class="form-control"'); ?>
								<?php echo form_error('error-message_section'); ?>
								<div id="error-message_section" class="error_field"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="message_section_id">Select Project*</label>
								<?php echo form_dropdown('message_section_id', $properties, '', 'id="message_section_id" class="form-control"'); ?>
								<?php echo form_error('error-message_section_id'); ?>
								<div id="error-message_section_id" class="error_field"></div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="message_name">Name</label>
								<?php echo form_input(array('id'=>'message_name', 'name'=>'message_name', 'value'=>set_value('message_name'), 'class'=>'form-control'));?>
								<?php echo form_error('error-message_name'); ?>
								<div id="error-message_name" class="error_field"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="message_email">E-Mail</label>
								<?php echo form_input(array('id'=>'message_email', 'name'=>'message_email', 'value'=>set_value('message_email'), 'class'=>'form-control'));?>
								<?php echo form_error('error-message_email'); ?>
								<div id="error-message_email" class="error_field"></div>
							</div>
						</div>
						
					</div>

					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="message_mobile">Mobile Number</label>
								<?php echo form_input(array('id'=>'message_mobile', 'name'=>'message_mobile', 'value'=>set_value('message_mobile'), 'class'=>'form-control'));?>
								<?php echo form_error('error-message_mobile'); ?>
								<div id="error-message_mobile" class="error_field"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="message_location">Location</label>
								<?php echo form_input(array('id'=>'message_location', 'name'=>'message_location', 'value'=>set_value('message_location'), 'class'=>'form-control'));?>
								<?php echo form_error('error-message_location'); ?>
								<div id="error-message_location" class="error_field"></div>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label for="message_content">Message <span>(optional)</span></label>
						<?php echo form_textarea(array('id'=>'message_content', 'name'=>'message_content', 'rows'=>'3', 'value'=>set_value('message_content'), 'class'=>'form-control')); ?>
						<?php echo form_error('error-message_content'); ?>
						<div id="error-message_content" class="error_field"></div>
					</div>

					<br>

					<div class="form-group">
						<div class="g-recaptcha" data-sitekey="6Ld1hH0UAAAAAMEkhVLwf9p4KPwQvkZWsgMzYeZK"></div>
						<?php echo form_error('g-recaptcha-response'); ?>
					</div>
					
					<div class="form-group agreement">
	          		<input type="checkbox" id="message_agreement" name="message_agreement" class="pointer message_agreement">
	          		<label for="message_agreement" class="pointer"><span class="color_default">* I accept the Website</span><span class="green">OCLP</span> <span class="color_default">and</span><span class="green">CCC<span> data privacy.</label>
	          			<div id="error-message_agreement" class="error_field"></div>
	    		    </div>
			
					<div class="form-group">
						 <button type="button" class="btn contact_submit green_button">SUBMIT</button>
					</div>

					<?php echo form_hidden('submit', 1); ?>
					<?php echo form_hidden('return', ($this->input->get('return') ? $this->input->get('return') : '')); ?>
					
				</div>
			</div>
		</div>


		<?php if($page_content->page_bottom_content) { ?>
			<div class="seo_content">
			<?php echo parse_content($page_content->page_bottom_content); ?>
			</div>
		<?php } ?>

	</div>

	<a id="form_landing_button" data-toggle="modal" data-target="#form_landing">&nbsp;</a>
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

</main>


<?php //if($record->page_uri == 'about-us'){ ?>
	<?php if(isset($news_result) && $news_result){ ?>
		<div class="news_related">
			<h2 class="related_news_title">Related News</h2>
			<div class="news_related_content">
				<?php
					$news_data['related_news'] = 1;
					$news_data['cols_img'] = 'col-sm-5';
					$news_data['cols_data'] = 'col-sm-7';
					echo $this->load->view('website/news_result', $news_data); 
				?>
			</div>
		</div>
	<?php } ?>
<?php //} ?>


<script src='https://www.google.com/recaptcha/api.js?render=6Ld1hH0UAAAAAMEkhVLwf9p4KPwQvkZWsgMzYeZK'></script>