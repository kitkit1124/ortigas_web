<?php echo $this->load->view('website/slider_index'); ?>
<?php $this->template->add_js(module_js('website', 'slider_index'), 'embed'); ?>

<main role="main" class="container">
	<div class="content">

		<div class="row">
			<div class="col-sm-4 contact_break">

				<div class="google-maps">

					<textarea id="pac-input" placeholder="Ortigas & Company 9th Floor, Ortigas Building Ortigas Avenue, Pasig City 1600 Philippines"> <?php echo $page_content->page_map_name; ?></textarea>
					<div id="map"></div>

					<!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.206901707607!2d121.07216671505488!3d14.587283081313162!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c808abaef137%3A0xdd2ab4e5438fc1a8!2sValle+Verde+5!5e0!3m2!1sen!2sph!4v1505972548418" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe> -->
				</div>

				<div class="contact_address">
					<?php echo parse_content($contact_address->partial_content); ?>
				</div>

			</div>
			<div class="col-sm-8 contact_break">
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
								<label for="message_section">Inquiry Type *</label>
								<?php $options = create_dropdown('array', 'Please select Inquiry Type,Sales Inquiry,Leasing Inquiry,Career Inquiry'); ?>
								<?php echo form_dropdown('message_section', $options, '', 'id="message_section" class="form-control"'); ?>
								<?php echo form_error('error-message_section'); ?>
								<div id="error-message_section" class="error_field"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="message_section_id_label" for="message_section_id">Select Project *</label>
								<?php $options = create_dropdown('array','Please select Inquiry Type first'); ?>
								<?php echo form_dropdown('message_section_id', $options, '', 'id="message_section_id" class="form-control"'); ?>
								<?php echo form_error('error-message_section_id'); ?>
								<div id="error-message_section_id" class="error_field"></div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="message_name">Name *</label>
								<?php echo form_input(array('id'=>'message_name', 'name'=>'message_name', 'value'=>set_value('message_name'), 'class'=>'form-control'));?>
								<?php echo form_error('error-message_name'); ?>
								<div id="error-message_name" class="error_field"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="message_email">E-Mail Address *</label>
								<?php echo form_input(array('id'=>'message_email', 'name'=>'message_email', 'value'=>set_value('message_email'), 'class'=>'form-control', 'placeholder'=>'sample@email.com'));?>
								<?php echo form_error('error-message_email'); ?>
								<div id="error-message_email" class="error_field"></div>
							</div>
						</div>
						
					</div>

					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="message_mobile">Mobile Number</label>
								<?php echo form_input(array('id'=>'message_mobile', 'name'=>'message_mobile', 'value'=>set_value('message_mobile'), 'class'=>'form-control', 'placeholder'=>'0917-XXX-XXXX'));?>
								<?php echo form_error('error-message_mobile'); ?>
								<div id="error-message_mobile" class="error_field"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="message_location">Your Location</label>
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
						<div class="g-recaptcha" data-sitekey="6Ledg30UAAAAAHixIxThPUv1CLlvuPV1S-NvgWtX"></div>
						<?php echo form_error('g-recaptcha-response'); ?>
						<div id="error-message_captcha" class="error_field"></div>
					</div>
					
					<div class="form-group agreement">
	          		<input type="checkbox" id="message_agreement" name="message_agreement" class="pointer message_agreement">
	          		<label for="message_agreement" class="pointer message_agreement_label"><span class="color_default">* I agree to the</span><a href="<?php echo base_url();?>oclp-data-privacy-policy" target="_blank"><span class="green">OCLP</span></a> <span class="color_default">and</span><a href="<?php echo base_url();?>oclp-data-privacy-policy" target="_blank"><span class="green">CCC<span></a><span class="color_default">Data privacy.</span></label>
	          			<div id="error-message_agreement" class="error_field"></div>
	    		    </div>

					<div class="form-group">
						 <a class="btn contact_submit default-button">SUBMIT</a>
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

	<a id="message_success" class="hide" href="<?php echo site_url().'website/page/show_modal?id=5' ?>" data-target="#modal-lg" data-toggle="modal"></a>
	<a id="message_denied" class="hide" href="<?php echo site_url().'website/page/show_modal?id=8' ?>" data-target="#modal-lg" data-toggle="modal"></a>

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


<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript">
	var latitude = '<?php echo $page_content->page_latitude; ?>';
	var longitude = '<?php echo $page_content->page_longitude; ?>';
	var location_name = '<?php echo $page_content->page_map_name; ?>';
</script>