<main role="main" class="container">
	<div class="content">	
		<?php if($properties) {?>
		<div class="row main_page">
			<h1>Estates</h1>
			<?php
			foreach ($properties as $key => $val) { ?>
				<div class="estates properties col-sm-4">
					<a href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">
					<div class="image_wrapper">
						<div class="property"><?php echo $val->property_name; ?></div>
						<div class="image_container">
							<img src="<?php echo config_item('website_url').$val->property_image; ?>" width="100%" alt="" draggable="false"/>
						</div>
						<div class="estate"><?php echo $val->estate_name; ?></div>
					</div>
					</a>
				</div>
			<?php	} //end foreach ?>
		</div>
		<?php }?>

		<?php if($residences) {?>
		<div class="row main_page">
			<div class="estates residences col-sm-4">
				<h1>Residences</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis scelerisque felis quis libero vehicula vehicula. Quisque justo mi, dictum semper magna in, fringilla imperdiet felis. In vel lacinia eros. Nam vehicula at libero id bibendum.</p>
			</div>
			<?php
			foreach ($residences as $key => $val) { ?>
				
					<div class="estates residences col-sm-4">
						<a href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">
						<div class="image_wrapper">
							<div class="property"><?php echo $val->property_name; ?></div>
							<div class="image_container">
								<img src="<?php echo config_item('website_url').$val->property_image; ?>" width="100%" alt="" draggable="false"/>
							</div>
							<div class="estate"><?php echo $val->estate_name; ?></div>
						</div>
						</a>
					</div>
				
			<?php	} //end foreach ?>
		</div>
		<?php }?>
		<?php if($malls && $offices) {?>
		<div class="row">
			<h1>
				<h1 style="width: 50%">Malls</h1>
				<h1 style="width: 50%">Offices</h1>
			</h1>
			<?php
			foreach ($malls as $key => $val) { ?>
				<div class="estates malls col-sm-6">
					<a href="<?php echo $val->property_website; ?>" target="_blank">
					<div class="image_wrapper">
						<div class="property"><?php echo $val->property_name; ?></div>
						<div class="image_container">
							<img src="<?php echo config_item('website_url').$val->property_image; ?>" width="100%" alt="" draggable="false"/>
						</div>
						<div class="estate"><?php echo $val->estate_name; ?></div>
					</div>
					</a>
				</div>
			<?php	} //end foreach 

			foreach ($offices as $key => $val) { ?>
				<div class="estates offices col-sm-6">
					<a href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">
					<div class="image_wrapper">
						<div class="property"><?php echo $val->property_name; ?></div>
						<div class="image_container">
							<img src="<?php echo config_item('website_url').$val->property_image; ?>" width="100%" alt="" draggable="false"/>
						</div>
						<div class="estate"><?php echo $val->estate_name; ?></div>
					</div>
					</a>
				</div>
			<?php	} //end foreach ?>
		</div>
		<?php }?>
	</div>
</main>