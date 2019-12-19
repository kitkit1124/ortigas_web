<section id="roles">
	<nav class="navbar navbar-expand-lg ">
<div class="container text-center">
<span class="navbar-brand " href="#"><img  style="width:100%" src="<?php echo $this->config->item('assets_url'); ?>data/images/ortigasland.svg"></span>

</nav>

<div class="container">
	<form id="reservation-form" method="post" action="<?php base_url('/reservations/index') ?>" >
	<div class="card text-center">
  		<div class="card-header text-center" style="background-color:#0a4233;color:#fff">
    		<h4 class="font-weight-bold font-29px">RESERVATION PAYMENT FORM</h4>
			<div class="row justify-content-md-center">
    			<div class="col-md-9">
					<p class="justify-content-md-center">Please ensure that the Reservation Agreement Form has been acknowledged to Ortigas Land before proceeding to fill out the items below</p>
				</div>
			</div>
			
		
  		</div>
  		<div class="card-body" style="margin:1%">
			<p class="card-text text-center"> 
			<?php print_r($reservations->firstname);?>

			Information in the reservation Agreement Form sent to Ortigas & Company should be reflected when filling out the fields.<br>	
			Should there be any inconsistencies, reservation will not be accepted.</p>

  		</div>
  		<div class="card-body" style="margin:6%;margin-top: 0%;">
    
    <div class="row">
    	<div class="col-sm text-left">
				 <div class="form-row mb-4">
				    <div class="col-8 col-md-8">
						<h5 class="card-title font-18-9px" style="color:#0a4233;font-weight:900">PERSONAL INFORMATION</h5>
				    </div>
				    <div class="col-4 col-md-4 text-right">
				        <p><small>*Required fields</small></p>
				    </div>
				</div>
				
      		
				<div class="form-row">
				    <div class="form-group col-6 col-md-6">
						
				       <label for="firstname" class="font-11px">FIRST NAME*</label>
				    	<input type="text" class="form-control" id="firstname" name="firstname" value ="<?php echo (isset($reservations->firstname) ? $reservations->firstname : ''); ?>" >
						<?php echo form_error('firstname'); ?>
				    </div>
				    <div class="form-group col-6 col-md-6">
				       <label for="lastname" class="font-11px">LAST NAME*</label>
				    	<input type="text" class="form-control" id="lastname" name="lastname" placeholder="" value ="<?php echo (isset($reservations->lastname) ? $reservations->lastname : ''); ?>" >
						<?php echo form_error('lastname'); ?>
				    </div>
				</div>
				<div class="form-group">
				    <label for="phonenumber" class="font-11px">TELEPHONE NUMBER*</label>
				    <input type="text" class="form-control" id="phonenumber"  name="phonenumber" placeholder="" value ="<?php echo (isset($reservations->phonenumber) ? $reservations->phonenumber : ''); ?>" >
					<?php echo form_error('phonenumber'); ?>
				</div>
				<div class="form-group">
				    <label for="mobilenumber" class="font-11px">MOBILE NUMBER*</label>
				    <input type="text" class="form-control" id="mobilenumber"  name="mobilenumber" placeholder="" value ="<?php echo (isset($reservations->mobilenumber) ? $reservations->mobilenumber : ''); ?>" >
					<?php echo form_error('mobilenumber'); ?>
				</div>
				<div class="form-group">
				    <label for="email" class="font-11px">EMAIL ADDRESS*</label>
				    <input type="text" class="form-control" id="email" name="email" placeholder="" value ="<?php echo (isset($reservations->email) ? $reservations->email : ''); ?>" >
					<?php echo form_error('email'); ?>
				</div>
				  <label for="idtype" class="font-11px">ID TYPE AND DETAILS</label>
				  <div class="input-group">
			        <div class="input-group-prepend">
        				<?php $options = create_dropdown('array', ',TIN,SSS,Postal ID'); ?>					
						<?php echo form_dropdown('idtype', $options,set_value('idtype', (isset($reservations->idtype)) ? $reservations->idtype : '') ,'id="idtype" class="form-control input-group-text selectwidth" '); ?>
			        </div>
					
			        <input type="text" class="form-control" id="idnumber" placeholder="ENTER YOUR ID NUMBER" aria-describedby="idnumber" name="idnumber" value ="<?php echo (isset($reservations->idnumber) ? $reservations->idnumber : ''); ?>" >
					
			      </div>
					<?php echo form_error('idtype'); ?> 
					<?php echo form_error('idnumber'); ?>
				
			
    	</div>
    	<div class="col-sm border-left-line text-left">
      	<!-- 	<div class="form-group">
				<label for="country">COUNTRY</label>
					<select name="country" class="form-control property">
						<option value="PHILIPPINES">PHILIPPINES</option>
						<option value="THAILAND">THAILAND</option>
						<option value="SINGAPORE">SINGAPORE</option>
						<option value="TAIWAN">TAIWAN</option>
					</select>
        		<i class="fa fa-angle-down"></i>
				<?php echo form_error('country'); ?>
      		</div> -->
			<div class="form-row mb-4 m-t-15pc">
				    <div class="col-8 col-md-8">
						<h5 class="card-title font-18-9px" style="color:#0a4233;font-weight:900">MAILING ADDRESS</h5>
				    </div>
				    <div class="col-4 col-md-4 text-right">
				        <p><small>*Required fields</small></p>
				    </div>
				</div>

			<div class="form-group">
				<label for="country" class="font-11px">COUNTRY*</label>
				<?php  echo form_dropdown('country', $countries, set_value('country', isset($reservations->country) ? $reservations->country : ''), 'id="country" class="form-control property" '); ?>
					<i class="fa fa-angle-down"></i>
				<?php echo form_error('country'); ?>
			</div>
			<div class="form-group">
				<label for="house_no" class="font-11px">HOUSE/UNIT NUMBER*</label>
				<input type="text" class="form-control" id="house_no" name="house_no" placeholder=""  value ="<?php echo (isset($reservations->house_no) ? $reservations->house_no : ''); ?>" >
				<?php echo form_error('house_no'); ?>
			</div>
			<div class="form-group">
				<label for="street" class="font-11px">STREET*</label>
				<input type="text" class="form-control" id="street" name="street" placeholder="" value ="<?php echo (isset($reservations->street) ? $reservations->street : ''); ?>" >
				<?php echo form_error('street'); ?>
			</div>
			<div class="form-group">
				<label for="city" class="font-11px">CITY*</label>
				<input type="text" class="form-control" id="city" name="city" placeholder="" value ="<?php echo (isset($reservations->city) ? $reservations->city : ''); ?>" >
				<?php echo form_error('city'); ?>
			</div>
			<div class="form-row">
				    <div class="form-group col-6 col-md-6">
				       <label for="barangay" class="font-11px">BARANGAY*</label>
				    	<input type="text" class="form-control" id="barangay" name="barangay" placeholder="" value ="<?php echo (isset($reservations->barangay) ? $reservations->barangay : ''); ?>" >
						<?php echo form_error('barangay'); ?>
				    </div>
				    <div class="form-group col-6 col-md-6">
				       <label for="postal_zip" class="font-11px">ZIP POSTAL CODE*</label>
				    		<input type="text" class="form-control" id="postal_zip" name="postal_zip" placeholder="" value ="<?php echo (isset($reservations->postal_zip) ? $reservations->postal_zip : ''); ?>" >
						<?php echo form_error('postal_zip'); ?>
				    </div>
			</div>
    	</div>
  	</div>
	
  </div>
   <div class="card-body secondrow" style="background-color:#ccc;margin:5%;padding:3%">
		<div class="form-row mb-4">
				    <div class=" col-md-12">
						<h5 class="card-title text-left font-18-9px" style="color:#0a4233;font-weight:900">PROPERTY RESERVATION DETAILS</h5>
				    </div>
  
		</div>
  
     	<div class="row">
		<div class="col-sm text-left">
			<div class="form-group">
				<label for="project" class="font-11px">PROJECT*</label>
					
				<input type="text" class="form-control" id="project" name="project" placeholder="" value ="<?php echo (isset($reservations->project) ? $reservations->project : ''); ?>" >
				<?php echo form_error('project'); ?>
      		</div>
			<div class="form-group">
				<label for="sellers_group" class="font-11px">SELLERS GROUP*</label>	
				<input type="text" class="form-control" id="sellers_group" name="sellers_group" placeholder="" value ="<?php echo (isset($reservations->sellers_group) ? $reservations->sellers_group : ''); ?>" >
				<?php echo form_error('sellers_group'); ?>
      		</div>
			<div class="form-group">
			 	<label for="allocation" class="font-11px">ALLOCATION*</label>
				<input type="text" class="form-control" id="allocation" name="allocation" placeholder="" value ="<?php echo (isset($reservations->allocation) ? $reservations->allocation : ''); ?>" >
				<?php echo form_error('allocation'); ?>
      		</div>
	 	</div>
	  	<div class="col-sm text-left">
			<div class="form-group">
				<label for="property_specialist" class="font-11px">PROPERTY SPECIALIST*</label>
				<input type="text" class="form-control" id="property_specialist" name="property_specialist" placeholder="" value ="<?php echo (isset($reservations->property_specialist) ? $reservations->property_specialist : ''); ?>" >
				<?php echo form_error('property_specialist'); ?>
			</div>
			<div class="form-group">
				<label for="unit_details" class="font-11px">COMPLETE UNIT DETAILS*</label>
				<input type="text" class="form-control" id="unit_details" name="unit_details" placeholder="" value ="<?php echo (isset($reservations->unit_details) ? $reservations->unit_details : ''); ?>" ><?php echo form_error('unit_details'); ?>
			</div>
			<div class="form-group">
				<label for="reservation_fee" class="font-11px">RESERVATION FEE*</label>
				<input type="text" class="form-control" id="reservation_fee" name="reservation_fee" placeholder="" value ="<?php echo (isset($reservations->reservation_fee) ? $reservations->reservation_fee : ''); ?>" >
				<?php echo form_error('reservation_fee'); ?>
			</div>
		</div>
		</div>
		<div class="form-group text-left">
			<label for="notes" class="font-11px">NOTES</label>
			<textarea  style="white-space: unset;" class="form-control test-left" id="notes" name="notes" placeholder="" rows='10' value ="<?php echo (isset($reservations->notes) ? $reservations->notes : ''); ?>" >	
			<?php echo (isset($reservations->notes) ? $reservations->notes : ''); ?>
			</textarea><?php echo form_error('notes'); ?>
		</div>
  </div>
<div class="card-body" >
		<div class="row">	
			<div class="col-sm text-left" style="margin:5%;padding:3%">
				<div class="form-row mb-4">
				    <div class="col-8 col-md-8">
						<h5 class="card-title font-18-9px" style="color:#0a4233;font-weight:900">BILLING ADDRESS</h5>
				    </div>
				    <div class="col-4 col-md-4 text-right">
				        <p><small>*Required fields</small></p>
				    </div>
				</div>

				
				<div class="form-group">
					<label for="billing_country" class="font-11px">COUNTRY</label>
								
					<?php  echo form_dropdown('billing_country', $countries, set_value('billing_country', isset($reservations->billing_country) ? $reservations->billing_country : ''), 'id="billing_country" class="form-control property" '); ?>
					<i class="fa fa-angle-down"></i>
					<?php echo form_error('billing_country'); ?>

      			</div>
				<div class="form-group">
					<label for="billing_house_no" class="font-11px">HOUSE/UNIT NUMBER*</label>
					<input type="text" class="form-control" id="billing_house_no" name="billing_house_no" placeholder=""  value ="<?php echo (isset($reservations->billing_house_no) ? $reservations->billing_house_no : ''); ?>" >
					<?php echo form_error('billing_house_no'); ?>
				</div>
				<div class="form-group">
					<label for="billing_street" class="font-11px">STREET*</label>
					<input type="text" class="form-control" id="billing_street" name="billing_street" placeholder="" value ="<?php echo (isset($reservations->billing_street) ? $reservations->billing_street : ''); ?>" >
					<?php echo form_error('billing_street'); ?>
				</div>
				<div class="form-group">
					<label for="billing_city" class="font-11px">CITY*</label>
					<input type="text" class="form-control" id="billing_city"  name="billing_city" placeholder="" value ="<?php echo (isset($reservations->billing_city) ? $reservations->billing_city : ''); ?>">
					<?php echo form_error('billing_city'); ?>
				</div>
				<div class="form-row">
					    <div class="form-group col-6 col-md-6">
					       <label for="billing_barangay" class="font-11px">BARANGAY*</label>
					    	<input type="text" class="form-control" id="billing_barangay" name="billing_barangay" placeholder=""  value ="<?php echo (isset($reservations->billing_barangay) ? $reservations->billing_barangay : ''); ?>">
							<?php echo form_error('billing_barangay'); ?>
					    </div>
						
					    <div class="form-group col-6 col-md-6">
					       <label for="billing_postal_zip" class="font-11px">ZIP POSTAL CODE*</label>
					    		<input type="text" class="form-control" id="billing_postal_zip" name="billing_postal_zip" placeholder="" value ="<?php echo (isset($reservations->billing_postal_zip) ? $reservations->billing_postal_zip : ''); ?>">
							<?php echo form_error('billing_postal_zip'); ?>
					    </div>
				</div>
				<!-- <div class="custom-control form-control-lg custom-checkbox">
    				<input type="checkbox" class="custom-control-input" id="same_mailing_address">
    				<label class="custom-control-label" for="same_mailing_address"> Same as Mailing Address</label>
				</div> -->
				
				 <input type="checkbox" id="same-email" name="same-email" value="1" checked>
 				 <label for="same-email">Same as Mailing Address</label>
				
				<div class="form-group">
				<input class="form-control" type="hidden" name="biller_email" id="biller-email" placeholder="ENTER YOUR BILLING EMAIL" required>
				</div>
				<span id="error-same-email" style="display: none">The Email Address field must contain a valid email address.</span>
				
			</div>
			<div class="col-sm text-left border-line disclaimer-box" style="">
				<div style="margin-top:12%;">	
					<h5 class="card-title font-18-9px">DISCLAIMER</h5>
					<p class="font-14px">	1. You are now at a secure page powered by ortigas.com.ph</p>
					<p class="font-14px">2. Before transaction of payment, please ensure that all information has been filled out and submitted </p>
					<p class="font-14px">3. For inquiries pertaining to products, delivery, order status and other related concerns, you may contact Ortigas & Company.</p>
					<p class="font-14px">4. All information submitted will be used solely for this transaction and will be kept confidential using 128-bit SSL(secure socket layer) encryption.</p>
					<p class="font-14px">5. Fraud and illegal activities will be prosecuted to the fullest extent of the of the law</p>
							<p>	
								<b>Note: Only transaction with reference number will be honored by the law as a proof that the units were paid successfully.</b>
							</p>
						</ol>
					</p>
				</div>
			</div>
		</div>
	</div>
  	<div class="card-footer text-center" style="background-color:#0a4233;color:#fff;padding: 5%;">
		<div class="row justify-content-md-center ">	
		<div class="form-group"> 
			<div class="chiller_cb">
		    <input id="agreement" type="checkbox"  name="agreement" class="agreement" >
		    <label for="agreement" class="font-17px ml-4"> I agree with Ortigas & Company's <a href="https://www.ortigas.com.ph/oclp-data-privacy-policy" target="_blank">Data Policy</a> and <a href="https://www.ortigas.com.ph/oclp-data-privacy-policy" target="_blank">Terms & Conditions </a>.</label>
		    <span></span>
		 </div>
    		
		</div>
  		</div>
		
  			
	
		<div class="form-group">
			<a type="submit"  class="btn btn-success btn-lg submit_button font-12px" id="form-submit"> PROCEED TO PAYMENT </a>
			
		</div>
		<div class="form-group">
			<div class="row justify-content-center ">	
				<div class="col-9">
					<p class="font-9px">	
				By clicking on the button below, I give my consent to Ortigas & Company, and to its subsidiaries, affiliates, partners, successors and assigns, and to their service providers and agents, to collect, possess, use, store and disclose any and all information and personal data furnished herein, or as may otherwise be provided by me, for the purpose of providing me information on their products and services, including but not limited to, offers, promotions, and new goods and services.

					</p>
				</div>
				</div>
		</div>
		<div class="form-group">
			<p class="font-13px">	For Credit Card payments, you will be credited to a website owned and operated by a third party. <br> Ortigas & Company disclaims responsibility on any information you shall provided to the 3rd party system.</p>
		</div>
		
		<div class="container">
			<div class="row justify-content-center ">	
				<div class="col-6">
				<p>	ACCEPTED HERE:</p>
			</div>
			</div>
		  <div class="row justify-content-center ">	
			
			<div class="col col-lg-1">
		      <img class=" fit-image " src="<?php echo $this->config->item('assets_url'); ?>data/images/payanamicslogo.jpg">
		    </div>
		    <div class="col col-lg-1">
				<img class=" fit-image" src="<?php echo $this->config->item('assets_url'); ?>data/images/mastercard.jpg">
			</div>
			<div class="col col-lg-1">
				<img class=" fit-image" src="<?php echo $this->config->item('assets_url'); ?>data/images/visa logo.jpg">
			</div>
			<div class="col col-lg-1">
				<img class=" fit-image" src="<?php echo $this->config->item('assets_url'); ?>data/images/verisign logo.jpg">
			</div>

		    
		  </div>
		</div>
	</div>
		
		
  	</div>
</div>
	</form>
</div>
</section>
<script type="text/javascript">
	var post_url = '<?php echo current_url() ?>';
	var site_url = "<?php echo site_url(); ?>";
	
	
</script>