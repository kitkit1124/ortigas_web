<?php if($other_residences) { ?>
<div id="other-residences">
	<h2>Other Residences in <?php echo $other_residences[0]->estate_name; ?></h2>
		<?php if(isset($other_residences) && $other_residences){ ?>
		<div class="row">
			
			<?php
			foreach ($other_residences as $key => $val) { ?>
				<?php if(count($other_residences) > 1): ?>
				<div class="col-md-6">
				<?php endif; ?>
					<div class="estates residences">
						<a href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">
						<div class="image_wrapper">
							<div class="image_container">
									<img class="lazy" data-src="<?php echo  getenv('UPLOAD_ROOT').img_selector($val->property_image,'medium'); ?>" width="100%" alt="" draggable="false" />
							</div>
						<!-- 	<div class="property"><?php //echo $val->property_name; ?></div>
							<div class="estate"><?php //echo $val->estate_name; ?></div> -->
						</div>
						<div class="property_desc">
							<h5><?php echo $val->property_name; ?></h5>
							<span><?php echo $val->property_snippet_quote; ?></span>
						</div>
						</a>
					</div>
				<?php if(count($other_residences) > 1): ?>
				</div>
				<?php endif; ?>
			<?php	} //end foreach ?>
			
		</div>
		<?php } ?>
</div><!--other-residences-->
<?php } ?>