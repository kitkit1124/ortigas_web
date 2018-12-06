<?php if($sliders) { ?>

<div id="slider" class="carousel slide" data-ride="carousel">
<!-- Indicators -->
<ul class="carousel-indicators">
<?php foreach ($sliders as $key => $value) { ?>
 	<li class="carousel-indicator_button" data-target="#slider" data-slide-to="<?php echo $key; ?>"> </li>
<?php } ?>	
</ul>
<!-- The slideshow -->
<div class="carousel-inner">
<?php foreach ($sliders as $key => $value) { ?>
<div class="carousel-item">
  <img src="<?php echo site_url().$value->banner_image; ?>" width="100%" alt="<?php echo $value->banner_alt_image; ?>" title="<?php echo $value->banner_alt_image; ?>" />
</div>
<?php } ?>	
</div>

<!-- Left and right controls -->
<a class="carousel-control-prev" href="#slider" data-slide="prev">
<span class="carousel-control-prev-icon"></span>
</a>
<a class="carousel-control-next" href="#slider" data-slide="next">
<span class="carousel-control-next-icon"></span>
</a>
<h1><?php echo $value->banner_group_name; ?></h1>
</div>
<?php } ?>	