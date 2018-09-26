<section id="roles">
	<main role="main" class="container">
		<div class="content">	
			<div class="search_tab">
				<div class="search_tab_content">
					<div class="default_search row">
						<div class="col-sm-3">
							<label>WHAT ARE YOU LOOKING FOR?</label>
						</div>
						<div class="col-sm-9">
							<input class="form-control" type=" " aria-label="Search" value="<?php echo isset($_GET['filter']) ? $_GET['filter'] : ''?>">
							<i class="fa fa-search"></i>
							<p class="prop_search_link">property search</p>
						</div>
					</div>
					<div class="advance_search">
						<div class="row">
							<div class="col-sm-10">
								<div class="row">
									<div class="col-sm-4">
										<label>Location</label>
										<input name="location" class="form-control" type="text" paria-label="Search">
									</div>
									<div class="col-sm-4">
										<label>Development Type</label>
										<input name="devtype" class="form-control" type="text" aria-label="Search">
									</div>
									<div class="col-sm-4">
										<label>Price Range</label>
										<input name="price" class="form-control" type="text" aria-label="Search">
									</div>
								</div>
							</div>
							<div class="col-sm-2">
								<button class="button_search" type="submit"><i class="fa fa-search"></i></button>
								<p class="adv_prop_search_link">keyword search</p>
							</div>
						</div>
					</div><!--advance_search-->
				</div><!--search_tab_content-->
			</div><!--search_tab-->
			<div class="filter">
				<div class="row">
					<div>
						<label>Filter by:</label>
					</div>
					<form action="<?php echo site_url();?>properties/search/view">
						<?php foreach ($categories as $key => $value) {
							$field_name = substr(strtolower($value->category_name),0,1);
						?>
							<div class="filter_cointainer">
								<label class="<?php echo isset($_GET[$field_name]) ? 'filter_true' : ''; ?>" for="<?php echo $field_name; ?>"><?php echo $value->category_name; ?></label><i class="fa fa-times <?php echo isset($_GET[$field_name]) ? 'i_true' : ''; ?>" aria-hidden="true"></i>
								<input type="checkbox" class="filterby" name="<?php echo $field_name; ?>" id="<?php echo $field_name; ?>" value="1">
							</div>
						<?php } 
						?>
						<div class="filter_cointainer">
							<label class="<?php echo isset($_GET['n']) ? 'filter_true' : ''; ?>" for="n">News</label><i class="fa fa-times <?php echo isset($_GET['n']) ? 'i_true' : ''; ?>" aria-hidden="true"></i>
							<input type="checkbox" class="filterby" name="n" id="n" value="1">
						</div>
						<div class="filter_cointainer">
							<label class="<?php echo isset($_GET['c']) ? 'filter_true' : ''; ?>" for="c">Careers</label><i class="fa fa-times <?php echo isset($_GET['c']) ? 'i_true' : ''; ?>" aria-hidden="true"></i>
							<input type="checkbox" class="filterby" name="c" id="c" value="1">
						</div>
					</form>
				</div>
			</div>
			<div class="search_result">
				<?php if(isset($residences) && $residences) {?>
				<h1>Residences</h1>
				<div class="row">
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

				<?php if(isset($malls) && $malls) {?>
				<h1>Malls</h1>
				<div class="row">
					<?php
					foreach ($malls as $key => $val) { ?>
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

				<?php if(isset($offices) && $offices) {?>
				<h1>Offices</h1>
				<div class="row">
					<?php
					foreach ($offices as $key => $val) { ?>
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

		
			</div>
		</div><!--content-->
	</main>
</section>
<script type="text/javascript">
	var post_url = '<?php echo current_url() ?>';
	var site_url = "<?php echo site_url(); ?>"
	var cms_url = "<?php echo config_item('website_url'); ?>"
	
	var c =   "<?php echo isset($_GET['c']) ? 1 : ''; ?>";
	var r =   "<?php echo isset($_GET['r']) ? 1 : ''; ?>";
	var o =   "<?php echo isset($_GET['o']) ? 1 : ''; ?>";
	var m =   "<?php echo isset($_GET['m']) ? 1 : ''; ?>";
	var n =   "<?php echo isset($_GET['n']) ? 1 : ''; ?>";

</script>