<div class="modal-header"><h5>Contruction Timeline</h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
<div class="modal-body">
	<div class="form">	
		    <?php if(count($sliders) > 1 ) { ?>
		          <div class="contruction">
		        <?php foreach ($sliders as $key => $value) {  ?>
		          <img class="carousel-indicator_button" src="<?php echo getenv('UPLOAD_ROOT').$value->image_slider_image; ?>"  width="100" height="100" alt="<?php echo $value->image_slider_alt_image; ?>" title="<?php echo $value->image_slider_alt_image; ?>" >
		        <?php } ?>  
		          </div>
		  
		    <?php } ?>  
	</div>
</div>
