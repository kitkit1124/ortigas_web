<?php echo $this->load->view('website/slider_index'); ?>
<?php $this->template->add_js(module_js('website', 'slider_index'), 'embed'); ?>

<main role="main" class="container">
	<div class="content">

		<div class="row">
			<!-- <div class="col-sm-4 contact_break">

				<div class="google-maps">

					<textarea id="pac-input" placeholder="Ortigas & Company 9th Floor, Ortigas Building Ortigas Avenue, Pasig City 1600 Philippines"> <?php echo $page_content->page_map_name; ?></textarea>
					<div id="map"></div> -->

					<!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.206901707607!2d121.07216671505488!3d14.587283081313162!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c808abaef137%3A0xdd2ab4e5438fc1a8!2sValle+Verde+5!5e0!3m2!1sen!2sph!4v1505972548418" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe> -->
				<!-- </div>

				<div class="contact_address">
					<?php echo parse_content($contact_address->partial_content); ?>
				</div>

			</div> -->
			<div class="col-md-6 text-left">
				<div class="google-maps">
					<div id="map"></div>
				</div>
				<p><br/>
					Corporate Office<br/>
					9th Floor, Ortigas Building,<br/>
					Ortigas Avenue,<br/>
					Pasig City 1600 Philippines<br/>
				</p>
			</div>
			<div class="col-sm-6 contact_break mb-4">
				<div class="page_content">
					<?php echo parse_content($page_content->page_content); ?>
				</div>

				<div class="contact_form">

					<?php $return = ($this->input->get('return')) ? '?return=' . urlencode($this->input->get('return')) : ''; ?>
					<?php echo form_open('https://s1319205889.t.eloqua.com/e/f2' . $return,array('name' => 'contact_us'));?>
					<?php //echo form_open(current_url() . $return,array('name' => 'contact_us'));?>
					<input type="hidden" name="elqCustomerGUID" value="">
					<input type="hidden" name="elqCookieWrite" value="0">

					<input type="hidden" id="csrf" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<!-- <label for="message_section">Inquiry Type *</label> -->
								<?php $options = create_dropdown('array', 'INQUIRY TYPE *,Sales Inquiry,Leasing Inquiry,Career Inquiry'); ?>
								<?php echo form_dropdown('message_section', $options, '', 'id="message_section" class="form-control"'); ?>
								<?php echo form_error('error-message_section'); ?>
								<div id="error-message_section" class="error_field"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<!-- <label class="message_section_id_label" for="message_section_id">Select Project *</label> -->
								<?php $options = create_dropdown('array','SELECT PROJECT *'); ?>
								<?php echo form_dropdown('message_section_id', $options, '', 'id="message_section_id" class="form-control"'); ?>
								<?php echo form_error('error-message_section_id'); ?>
								<div id="error-message_section_id" class="error_field"></div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<!-- <label for="message_name">Name *</label> -->
								<?php echo form_input(array('id'=>'message_name', 'name'=>'message_name', 'value'=>set_value('message_name'), 'class'=>'form-control', 'placeholder'=>' Name *'));?>
								<?php echo form_error('error-message_name'); ?>
								<div id="error-message_name" class="error_field"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<!-- <label for="message_email">E-Mail Address *</label> -->
								<?php echo form_input(array('id'=>'message_email', 'name'=>'message_email', 'value'=>set_value('message_email'), 'class'=>'form-control', 'placeholder'=>' E-Mail Address *'));?>
								<?php echo form_error('error-message_email'); ?>
								<div id="error-message_email" class="error_field"></div>
							</div>
						</div>
						
					</div>

					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<!-- <label for="message_mobile">Mobile Number</label> -->
								<?php echo form_input(array('id'=>'message_mobile', 'name'=>'message_mobile', 'value'=>set_value('message_mobile'), 'class'=>'form-control', 'placeholder'=>' Mobile Number'));?>
								<?php echo form_error('error-message_mobile'); ?>
								<div id="error-message_mobile" class="error_field"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<!-- <label for="message_location">Your Location</label> -->
								<?php echo form_input(array('id'=>'message_location', 'name'=>'message_location', 'value'=>set_value('message_location'), 'class'=>'form-control', 'placeholder'=>' Your Location'));?>
								<?php echo form_error('error-message_location'); ?>
								<div id="error-message_location" class="error_field"></div>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label for="message_content">&emsp; Message <span>(optional)</span></label>
						<?php echo form_textarea(array('id'=>'message_content', 'name'=>'message_content', 'rows'=>'5', 'value'=>set_value('message_content'), 'class'=>'form-control mt-1')); ?>
						<?php echo form_error('error-message_content'); ?>
						<div id="error-message_content" class="error_field"></div>
					</div>

					<div class="form-group text-center">
						<div class="g-recaptcha" data-sitekey="6Ledg30UAAAAAHixIxThPUv1CLlvuPV1S-NvgWtX"></div>
						<?php echo form_error('g-recaptcha-response'); ?>
						<div id="error-message_captcha" class="error_field"></div>
					</div>
					
					<div class="form-group row agreement text-justify">
	          			<input type="checkbox" id="message_agreement" name="message_agreement" class="pointer message_agreement col-1">
	          		
					  <label for="message_agreement" class="pointer message_agreement_label col-11">
							  <span class="color_default">By clicking on the button above, I give my consent to all divisions and organizations in Ortigas&Company, and their service provides and agents to collect, use and disclose the personal data as contained in this form, or as otherwise provided by me for the purpose of providing information on their products and services to me via email, including but not limited to offers, promotions, and new goods and services.</span>
							  <!-- <span class="color_default">* I Agree to the</span><a href="<?php echo base_url();?>oclp-data-privacy-policy" target="_blank"><span class="green">OCLP</span></a> <span class="color_default">and</span><a href="<?php echo base_url();?>oclp-data-privacy-policy" target="_blank"><span class="green">CCC<span></a><span class="color_default ml-0">Data Privacy.</span> -->
							<!-- <br><br> -->
							<!-- <span class="color_default nomargin">By filling in my personal particulars above, I give my consent to all divisions and organizations in ORTIGAS & COMPANY, LIMITED PARTNERSHIP, and their service providers and agents, to collect, use and disclose the personal data as contained in this form, or as otherwise provided by me, for the purposes of providing information on their products and services to me via email, including but not limited to offers, promotions, and new goods and services.</span></label> -->
	          		
	          			<div id="error-message_agreement" class="error_field"></div>
	    		    </div>

					<div class="form-group text-center">
						 <a type="submit" class="btn contact_submit default-button">SUBMIT</a>
					</div>

					<?php echo form_hidden('submit', 1); ?>
					<?php echo form_hidden('return', ($this->input->get('return') ? $this->input->get('return') : '')); ?>
					<?php echo form_close(); ?>
				</div>
			</div>
			<div id="special_contacts" class="container-fluid text-left">
				<?php echo parse_content($page_content->page_rear_content); ?>
			</div>
			<!-- <div class="col-md-6 text-left">
				<div>
					<img class="lazy w-100" data-src="<?php echo getenv('UPLOAD_ROOT'); ?>data/images/corporate_contact.PNG" draggable="false" alt="Corporate Contact" title="Corporate Contact"/>
				</div>
				<p><br/>
					Corporate Sales<br/>
					(+632) 477-1393<br/>
				</p>
			</div>
			<div class="col-md-6 text-left">
				<div>
					<img class="lazy w-100" data-src="<?php echo getenv('UPLOAD_ROOT'); ?>data/images/international_contact.PNG" draggable="false" alt="Corporate Contact" title="Corporate Contact"/>
				</div>
				<p><br/>
					International Sales USA Toll-free Number<br/>
					1-800-459-2137<br/>
				</p>
			</div> -->
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

<!-- <div>
	<div class="google-maps"> -->
	<!-- <textarea id="pac-input" placeholder="Ortigas & Company 9th Floor, Ortigas Building Ortigas Avenue, Pasig City 1600 Philippines"> <?php echo $page_content->page_map_name; ?></textarea> -->
	<!-- <div id="map"></div> -->
	<!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.206901707607!2d121.07216671505488!3d14.587283081313162!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c808abaef137%3A0xdd2ab4e5438fc1a8!2sValle+Verde+5!5e0!3m2!1sen!2sph!4v1505972548418" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe> -->
	<!-- </div>
</div> -->

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
	var map_icon = '<?php echo $map_marker; ?>';
	var location_name = '<?php echo $page_content->page_map_name; ?>';
	var app_url = "<?php echo site_url() ?>";
</script>