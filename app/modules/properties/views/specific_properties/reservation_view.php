<div id="reservation_form">
				
	<p>Reservation > Payment > Payment Confirmation</p>
	<p>Thank you for your interest. Kindly fill out the form so we can assist you further.</p><br>
	<p>RESERVATION CODE</p>
	<br>
	<form id="reservation">
		<div class="row row1">
			<input type="hidden" id="csrf" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			<div class="col-sm-4">
				<label for="reservation_inquiry_type"><?php echo 'INQUIRY TYPE'?></label>			
				<?php echo form_input(array('id'=>'reservation_inquiry_type', 'name'=>'reservation_inquiry_type', 'value' => 'Unit Reservation', 'class'=>'form-control'));?>
			</div>
			<div class="col-sm-4">
				<label for="reservation_property_id"><?php echo 'SELECT PROJECT'?></label>			
				<?php echo form_input(array('id'=>'reservation_property_text', 'name'=>'reservation_property_text', 'value' => $properties->property_name , 'class'=>'form-control'));?>
				<?php echo form_input(array('id'=>'reservation_property_id', 'style'=>'display:none', 'value' => $properties->property_id));?>
			</div>
			<div class="col-sm-4">
				<label for="reservation_unit_id"><?php echo 'UNIT'?></label>		
				<?php echo form_input(array('id'=>'reservation_unit_text', 'name'=>'reservation_unit_text', 'class'=>'form-control'));?>	
				<?php echo form_input(array('id'=>'reservation_unit_id', 'style'=>'display:none;'));?>
			</div>
		</div>
		
		<div class="row row2">
			<div class="col-sm-4">
				<label for="reservation_name"><?php echo 'NAME*'?></label>			
				<?php echo form_input(array('id'=>'reservation_name', 'name'=>'reservation_name', 'class'=>'form-control'));?>
				<div id="error-reservation_name"></div>
			</div>
			<div class="col-sm-4">
				<label for="reservation_email"><?php echo 'E-MAIL ADDRESS*'?></label>			
				<?php echo form_input(array('id'=>'reservation_email', 'name'=>'reservation_email', 'class'=>'form-control'));?>
				<div id="error-reservation_email"></div>
			</div>
			<div class="col-sm-4">
				<label for="reservation_mobile"><?php echo 'MOBILE NUMBER'?></label>			
				<?php echo form_input(array('id'=>'reservation_mobile', 'name'=>'reservation_mobile', 'class'=>'form-control'));?>
				<div id="error-reservation_mobile"></div>
			</div>
		</div>

		<div class="form-group">
			<label for="estate_text"><?php echo 'YOUR COMPLETE ADDRESS'?></label>			
			<?php echo form_textarea(array('id'=>'reservation_address', 'name'=>'reservation_address', 'rows'=>'3', 'class'=>'form-control')); ?>		
		</div>

		<div class="form-group">
			<input type="checkbox" id="dataprivacy" name="dataprivacy" class="pointer">
			<label for="dataprivacy" class="pointer">I Agree to the OCLP and CCC Data Privacy.</label>
		</div>

		<button type="button" disabled="disabled">NEXT</button>
	</form>
</div>
