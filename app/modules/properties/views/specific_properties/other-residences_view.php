<?php if($other_residences) { ?>
<div id="other-residences">
	<h2>Other Residences in <?php echo $other_residences[0]->estate_name; ?></h2>
		<?php if(isset($other_residences) && $other_residences){ ?>
		<div class="row">
			<div class="col-sm-1"></div>
			<?php
			foreach ($other_residences as $key => $val) { ?>
				<div class="estates residences col-sm-5">
					<a href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">
					<div class="image_wrapper">
						<div class="image_container">
								<img class="lazy" data-src="<?php echo  getenv('UPLOAD_ROOT').img_selector($val->property_image,'medium'); ?>" width="100%" alt="" draggable="false" />
						</div>
						<div class="property"><?php echo $val->property_name; ?></div>
						<div class="estate"><?php echo $val->estate_name; ?></div>
					</div>
					</a>
				</div>
			<?php	} //end foreach ?>
			<div class="col-sm-1"></div>
		</div>
		<?php } ?>
</div><!--other-residences-->
<?php } ?>