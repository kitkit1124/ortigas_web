<section id="roles">
	<?php if($estates){ ?>
	<div id="banner_image">
		<img src="<?php echo config_item('website_url').$estates->estate_image; ?>" draggable="false" />		
		<h1><?php echo $estates->estate_name; ?></h1>			
	</div>
	<?php } ?>
	<main role="main" class="container">
		<div class="content">	
			<div class="row specific_estate">
				<div class="col-sm-4">
					<div class="estate_button" data-anchor="residences">
						<p>RESIDENCES</p>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="estate_button" data-anchor="malls">
						<p>MALLS</p>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="estate_button" data-anchor="offices">
						<p>OFFICES</p>
					</div>
				</div>
			</div>
		</div>
	</main>	
	<?php if(isset($residences) && $residences){ ?>
	<div class="row">
		<?php
		foreach ($residences as $key => $val) { ?>
			<div class="estates residences col-sm-6">
				<a href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">
				<div class="image_wrapper">
					<div class="property"><p><?php echo $val->property_name; ?></p></div>
					<div class="image_container">
							<img src="<?php echo  config_item('website_url').$val->property_image; ?>" width="100%" alt="" draggable="false"/>
					</div>
				</div>
				</a>
			</div>
		<?php	} //end foreach ?>
	</div>
	<?php } ?>
	<main role="main" class="container">
		<div class="content">	
			

			<?php if(isset($malls) && $malls){ ?>
			<div class="row">
				<?php
				foreach ($malls as $key => $val) { ?>
					<div class="estates malls col-sm-4">
						<a href="<?php echo $val->property_website; ?>" target="_blank">
						<div class="image_wrapper">
							<div class="property"><p><?php echo $val->property_name; ?></p></div>
							<div class="image_container">
									<img src="<?php echo  config_item('website_url').$val->property_image; ?>" width="100%" alt="" draggable="false"/>
							</div>
						</div>
						</a>
					</div>
				<?php	} //end foreach ?>
			</div>
			<?php } ?>


			<?php if(isset($offices) && $offices){ ?>
			<div class="row">
				<?php
				foreach ($offices as $key => $val) { ?>
					<div class="estates offices col-sm-6">
						<a href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">
						<div class="image_wrapper">
							<div class="property"><p><?php echo $val->property_name; ?></p></div>
							<div class="image_container">
									<img src="<?php echo  config_item('website_url').$val->property_image; ?>" width="100%" alt="" draggable="false"/>
							</div>
						</div>
						</a>
					</div>
				<?php	} //end foreach ?>
			</div>
			<?php } ?>
		</div>
	</main>
</section>