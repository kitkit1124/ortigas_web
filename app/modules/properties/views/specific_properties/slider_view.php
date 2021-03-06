 <div class="carousels">
 <?php if($sliders) { ?>
 <div id="slider" class="carousel slide" data-ride="carousel" data-interval="false">

    <!-- The slideshow -->
    <div class="carousel-inner">
      <?php foreach ($sliders as $key => $value) { ?>
      <div class="carousel-item">
<!--         <img class="lazy" data-src="<?php echo getenv('UPLOAD_ROOT').img_selector($value->image_slider_image,'large'); ?>" width="100%" height="400" alt="<?php echo $value->image_slider_alt_image; ?>" title="<?php echo $value->image_slider_alt_image; ?>"> -->
        <?php 
        $url = getenv('UPLOAD_ROOT').img_selector($value->image_slider_image,'large');
        $handle = curl_init($url);
        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

        /* Get the HTML or whatever is linked in $url. */
        $response = curl_exec($handle);

        /* Check for 404 (file not found). */
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        if($httpCode == 404) {
          $imagesrc = getenv('UPLOAD_ROOT').$value->image_slider_image;
        }
        else{
          $imagesrc = getenv('UPLOAD_ROOT').img_selector($value->image_slider_image,'large');
        }
        curl_close($handle);
        ?>
        <img class="lazy" data-src="<?php echo $imagesrc; ?>" width="100%" height="400" alt="<?php echo $value->image_slider_alt_image; ?>" title="<?php echo $value->image_slider_alt_image; ?>">
        
      </div>
      <?php } ?>	

       <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#slider" data-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#slider" data-slide="next">
          <span class="carousel-control-next-icon"></span>
        </a>
    </div>

    <!-- Indicators -->
    <?php if(count($sliders) > 1 ) { ?>
      <ul class="carousel-indicators">
          <div class="regular slider item">
        <?php foreach ($sliders as $key => $value) {  ?>
          <img class="carousel-indicator_button lazy" data-target="#slider" data-slide-to="<?php echo $key; ?>" data-src="<?php echo getenv('UPLOAD_ROOT').img_selector($value->image_slider_image,'thumb'); ?>"  width="100" height="100" alt="<?php echo $value->image_slider_alt_image; ?>" title="<?php echo $value->image_slider_alt_image; ?>" >
        <?php } ?>  
          </div>
      </ul>
    <?php } ?>  
  
  </div>
 <?php } ?> 
</div>