<?php $carousel = $sliders; ?>
<?php if($carousel) { ?>
<div id="header_">
<div id="slider" class="carousel slide" data-ride="carousel">
	
	<?php if(count($carousel) != 1) { ?>
	<!-- Indicators -->
	<ul class="carousel-indicators">
	<?php foreach ($carousel as $key => $value) { ?>
	 	<li class="carousel-indicator_button" data-target="#slider" data-slide-to="<?php echo $key; ?>"> </li>
	<?php } ?>	
	</ul>
	<?php } ?>

	<div class="banner_margin container"><h3><?php  if($carousel[0]->banner_group_id == 1) { } else { echo $carousel[0]->banner_group_name; }  ?></h3></div>
	<!-- The slideshow -->
	<div class="carousel-inner">
		<?php foreach ($carousel as $key => $value) { ?>
			<div class="carousel-item">
				<div class="banner_gradient"></div>
				<div class="banner_gradient"></div>
			 	<img class="carousel-indicator_button" data-target="#slider" data-slide-to="<?php echo $key; ?>" src="<?php echo getenv('UPLOAD_ROOT').$value->banner_image; ?>" alt="<?php echo $value->banner_alt_image; ?>" title="<?php echo $value->banner_alt_image; ?>" />
			</div>
		<?php } ?>	
	</div>


	<?php if(count($carousel) != 1) { ?>
		<!-- Left and right controls -->
		<a class="carousel-control-prev" href="#slider" data-slide="prev">
			<span class="carousel-control-prev-icon"></span>
		</a>
		<a class="carousel-control-next" href="#slider" data-slide="next">
			<span class="carousel-control-next-icon"></span>
		</a>
	<?php } ?>

	<?php echo $this->load->view('website/breadcrumbs_view'); ?>
</div>

</div>

<?php } else { ?>
	<div class="no-slider">
	</div>
<?php } ?>


<?php 
if(isset($value->banner_group_id) && $value->banner_group_id){
	if($value->banner_group_id == 1) {} else { ?>
		<div class="hide"><h1><?php echo $value->banner_group_name; ?></h1></div>
	<?php }
} ?>
