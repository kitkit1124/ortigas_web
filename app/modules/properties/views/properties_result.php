<div class="residences">
<?php if(isset($residences) && $residences) {?>
<div class="residences">
	<div class="category_title">
		<div class="row">
			<div class="col-sm-10"><h1>Residences</h1></div>
			<div class="col-sm-2 <?php echo $display; ?>"><a href="<?php echo site_url('').'estates/category/residences'; ?>">View All</a></div>
		</div>
	</div>
</div>
<div class="row">
	<?php
	foreach ($residences as $key => $val) { ?>
		<div class="estates residences <?php echo $cols; ?>">
			<a href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">
			<div class="image_wrapper">
				<div class="property <?php echo $display; ?>"><?php echo $val->property_name; ?></div>
				<div class="image_container">
					<img src="<?php echo config_item('website_url').$val->$image; ?>" width="100%" alt="" draggable="false"/>
				</div>
				<div class="estate <?php echo $display; ?>"><?php echo $val->estate_name; ?></div>
			</div>
			</a>
		</div>
	<?php	} //end foreach ?>
</div>
</div>
<?php }?>


<?php if(isset($malls) && $malls) {?>
<div class="malls">
	<div class="category_title">
		<div class="row">
			<div class="col-sm-10"><h1>Malls</h1></div>
			<div class="col-sm-2 <?php echo $display; ?>"><a href="<?php echo site_url('').'estates/category/malls'; ?>">View All</a></div>
		</div>
	</div>
<div class="row">
	<?php
	foreach ($malls as $key => $val) { ?>
		<div class="estates residences <?php echo $cols; ?>">
			<a href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">
			<div class="image_wrapper">
				<div class="property <?php echo $display; ?>"><?php echo $val->property_name; ?></div>
				<div class="image_container">
					<img src="<?php echo config_item('website_url').$val->$image; ?>" width="100%" alt="" draggable="false"/>
				</div>
				<div class="estate <?php echo $display; ?>"><?php echo $val->estate_name; ?></div>
			</div>
			</a>
		</div>
	<?php	} //end foreach ?>
</div>
</div>
<?php }?>

<?php if(isset($offices) && $offices) {?>
<div class="offices">
	<div class="category_title">
		<div class="row">
			<div class="col-sm-10"><h1>Offices</h1></div>
			<div class="col-sm-2 <?php echo $display; ?>"><a href="<?php echo site_url('').'estates/category/offices'; ?>">View All</a></div>
		</div>
	</div>
<div class="row">
	<?php
	foreach ($offices as $key => $val) { ?>
		<div class="estates residences <?php echo $cols; ?>">
			<a href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">
			<div class="image_wrapper">
				<div class="property <?php echo $display; ?>"><?php echo $val->property_name; ?></div>
				<div class="image_container">
					<img src="<?php echo config_item('website_url').$val->$image; ?>" width="100%" alt="" draggable="false"/>
				</div>
				<div class="estate <?php echo $display; ?>"><?php echo $val->estate_name; ?></div>
			</div>
			</a>
		</div>
	<?php	} //end foreach ?>
</div>
</div>
<?php }?>
