<section id="roles">
	<?php if($category){ ?>
	<div id="banner_image">
		<div id="banner_logo_image"></div>
		<img src="<?php echo config_item('website_url').$category->category_image; ?>" draggable="false" />		
		<h1><?php echo $category->category_name; ?></h1>			
	</div>
	<?php } ?>
	<main role="main" class="container">
		<div class="content">	
			<?php
			if(isset($estates) && $estates){ $properties = $estates; $estates = 1;}  else{ $estates = 0; }
		    if(isset($properties) && $properties){
			?>
			<div class="row">
				<?php
				foreach ($properties as $key => $val) { ?>
					<div class="estates properties col-sm-4">
						<?php if($estates){  ?>
							<a href="<?php echo site_url('').'estates/'.$val->estate_slug; ?>">
						<?php } else { 
						 		if($val->property_category_id == 3){ ?>
						 			<a href="<?php echo $val->property_website; ?>" target="_blank">		
						 		<?php } else{ ?>
						 			<a href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">
						 <?php	}
						 } ?>

						<div class="image_wrapper">
							<div class="property"><p><?php if($estates){ echo $val->estate_name; } else { echo $val->property_name; } ?></p></div>
							<div class="image_container">
									<img src="<?php if($estates){ echo config_item('website_url').$val->estate_image; } else { echo  config_item('website_url').$val->property_image; }?>" width="100%" alt="" draggable="false"/>
							</div>
						</div>

						</a>
					</div>
				<?php	} //end foreach ?>
			</div>
			<?php }?>
		</div>
	</main>
</section>