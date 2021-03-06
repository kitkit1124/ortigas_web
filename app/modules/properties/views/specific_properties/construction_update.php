<?php if(isset($properties->property_construction_update) && $properties->property_construction_update) :?>
<div id="construction_update" class="construction_update">
						
	<div class="property_construction_update">
		<div class="all_stages"></div>
		<?php 
			$current_stage = $properties->property_construction_update; 
			if($current_stage == 1){ $current_stage_value = '10%'; }
			if($current_stage == 2){ $current_stage_value = '25%'; }
			if($current_stage == 3){ $current_stage_value = '50%'; }
			if($current_stage == 4){ $current_stage_value = '75%'; }
			if($current_stage == 5){ $current_stage_value = '100%'; }
		?>
		<div class="current_stage_value" style="width: <?php echo $current_stage_value; ?>"></div>
	</div>

	<h2> Construction Update</h2>
	<div class="row year">
	  	<div class="col-sm-4 ground">
	  		<div class="construction_stages">
	  		 <img class="" src="<?php echo getenv('UPLOAD_ROOT').'data/images/ground.png'; ?>"  >
	  		 <p><?php echo $properties->property_ground; ?></p>
	  		 <label>Ground Breaking</label>
	  		</div>
	  	</div>
	  	<div class="col-sm-4 presell">
	  		<div class="construction_stages">
	  		<center><img class="" src="<?php echo getenv('UPLOAD_ROOT').'data/images/presell.png'; ?>"  ></center>
	  		<center><p><?php echo $properties->property_presell; ?></p></center>
	  		<center><label>Preselling</label></center>
	  		</div>
	  	</div>
	  	<div class="col-sm-4 turnover">
	  		<div class="construction_stages">
	  		<img class="" src="<?php echo getenv('UPLOAD_ROOT').'data/images/turnover.png'; ?>"  >
	  		<p><?php echo $properties->property_turnover; ?></p>
	  		<label>Turnover</label>
	  		</div>
	  	</div>
	 
	</div>
	<div class="button_progress hide"><a href="#">VIEW PROGRESS</a></div>

</div>
<?php endif; ?>