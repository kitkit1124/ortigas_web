 <div class="carousels">
 <?php if($sliders) { ?>
 <div id="slider" class="carousel slide" data-ride="carousel">

  <!-- The slideshow -->
  <div class="carousel-inner">
    <?php foreach ($sliders as $key => $value) { ?>
    <div class="carousel-item">
      <img src="<?php echo site_url().$value->image_slider_image; ?>" width="100%" height="400">
    </div>
    <?php } ?>	
  </div>

    <!-- Indicators -->
  <ul class="carousel-indicators">
    <?php foreach ($sliders as $key => $value) { ?>
      <img class="carousel-indicator_button" data-target="#slider" data-slide-to="<?php echo $key; ?>" src="<?php echo site_url().$value->image_slider_image; ?>"  width="100" height="100">
    <?php } ?>  
  </ul>
  
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#slider" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#slider" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
 </div>
 <?php } ?>	
</div>