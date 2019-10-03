<?php 
$this->template->add_css(module_css('careers', 'careers_form'), 'embed');
$this->template->add_js(module_js('careers', 'careers_form'), 'embed');
?>
<!-- Modal -->
<div class="modal fade" id="form_application" tabindex="-1" role="dialog" aria-labelledby="Form" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header border-0 pb-0">
		<h5 class="modal-title" id="Form"></h5>
		<center>
			<span class="title text-uppercase">Online Application Form</span>
			<br>
			<span class="title_info color_default">*All fields are required.</span>
		</center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="times_button">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pb-0">
      
          	<input type="hidden" id="csrf" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
          	<div class="row">
          		<div class="col-12">
					  <!-- <label for="job_career_title">Position applying for*</label> -->
          			<span id="label_position" class="font-weight-bold"><label for="job_career_title">Position applying for*</label></span>
               
      				  <?php if(isset($career->career_position_title) && $career->career_position_title){ $select_careers = [$career->career_id =>  $career->career_position_title ]; } ?>
                <?php echo form_dropdown('job_career_title', $select_careers, set_value('job_career_title', (isset($career->career_position_title)) ? $career->career_position_title : ''), 'id="job_career_title" class="form-control"'); ?>
          			<?php //echo form_input('job_career_id',$career->career_id, 'id="job_career_id" class="form-control" disabled="disabled" style="display:none"'); ?>
                <div id="error-job_career_id" class="error_field"></div>
          		</div>
          	</div>
          	<div class="row">
          		<div class="col-sm-6">
          			<!-- <label for="job_applicant_name">Name*</label> -->
          			<?php echo form_input('job_applicant_name', '', 'id="job_applicant_name" class="form-control" placeholder=" Name*"'); ?>
                <div id="error-job_applicant_name" class="error_field"></div>
          		</div>
          		<div class="col-sm-6">
          			<!-- <label for="job_email">E-mail Address*</label> -->
          			<input type="email" id="job_email" class="form-control" name="job_email" placeholder=" E-mail Address*">
                <div id="error-job_email" class="error_field"></div>
				  </div>
          	</div>
          	<div class="row mb-4">				  
          		<div class="col-sm-6">
          			<!-- <label for="job_mobile">Mobile Number*</label> -->
          			<?php echo form_input('job_mobile', '', 'id="job_mobile" class="form-control" placeholder=" Mobile Number*"'); ?>
                <div id="error-job_mobile" class="error_field"></div>
          		</div>
          		<div class="col-sm-6">
          			<!-- <label for="job_referred">Referred by</label> -->
          			<?php echo form_input('job_referred', '', 'id="job_referred" class="form-control" placeholder=" Referred by"'); ?>
          		</div>
			  </div>
			<div class="row">
          		<div class="offset-lg-3 col-lg-6">
          			<div class="file_upload">
        					<?php echo form_open(site_url('files/documents/upload'), array('class'=>'dropzone', 'id'=>'dropzone'));?>
        						<div class="dz-default dz-message">
        							<i class="fa fa-upload color_default" aria-hidden="true"></i> <span class="upload">Upload Your Resume</span><br>
        							<span class="upload_info color_default">*max ﬁle size 25mb (doc, docx or PDF ﬁles only)</span>
        						</div>
        					<div class="fallback">
        						<input name="file" type="file"  />
        					</div>
        					<?php echo form_close();?>
        				</div>
                <div id="error-job_document" class="error_field"></div>
        				<div class="file_thumbnail">
        				</div>
        				<?php echo form_input('job_document','', 'id="job_document" style="display:none"'); ?>
        		</div>
			  </div>
			  
			<div class="row mt-4 mb-0">
				<div class="col-md-12 px-md-5">
					<div class="form-group job_agreement px-md-5">
						<input type="checkbox" id="job_agreement" name="job_agreement" class="pointer">
						<label for="job_agreement" class="pointer"><span class="color_default">By clicking on the button above, I give my consent to all divisions and organizations in Ortigas&Company, and their service provides and agents to collect, use and disclose the personal data as contained in this form, or as otherwise provided by me for the purpose of providing information on their products and services to me via email, including but not limited to offers, promotions, and new goods and services.</span></a></label>
						<div id="error-job_agreement" class="error_field"></div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<div class="g-recaptcha" data-sitekey="6Ledg30UAAAAAHixIxThPUv1CLlvuPV1S-NvgWtX"></div>
						<?php echo form_error('g-recaptcha-response'); ?>
						<div id="error-job_captcha" class="error_field"></div>
					</div>
				</div>
			</div>
          	
     
      </div>
      <div class="modal-footer border-0 pb-4 pt-0">
        <a class="default-button" id="form_submit">SUBMIT</a>
      </div>
    </div>
  </div>
</div>
<script src='https://www.google.com/recaptcha/api.js'></script>