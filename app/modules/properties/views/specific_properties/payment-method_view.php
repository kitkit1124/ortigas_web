<div id="unit_payment_method">
	Reservation Details > Payment > Payment Confirmation

	<p>Reservation > Payment > Payment Confirmation</p>
	<p>Select your mode of payment.</p><br>
	<p>Reservation Payment: PHP 10,000</p>
	<br>
	<input type="radio" name="reservation_payment_method" id="payment_paypal" value="paypal">
	<label for="payment_paypal" class="paypal pointer">
		<img id="paypal" src="<?php echo base_url(); ?>data/images/paypal.png" draggable="false"/>
	</label>
	<input type="radio" name="reservation_payment_method" id="payment_paymaya" value="paymaya">
	<label for="payment_paymaya" class="paymaya pointer">
		<img id="paymaya" src="<?php echo base_url(); ?>data/images/paymaya.png" draggable="false"/>
	</label>
	<div><button type="button" id="reservation_button">PROCEED</button></div>
</div>