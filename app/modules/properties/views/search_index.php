<?php if(isset($_GET['adv']) && $_GET['adv']){ ?>
<style type="text/css">
	.default_search{ display: none; }
	.advance_search{ display: block; }
</style>
<?php } ?>

<section id="roles">
	<main role="main" class="container">
		<div class="content">	
			<div class="search_tab">
				<div class="search_tab_content">
					<div class="default_search row">
						<div class="col-sm-3">
							<input type="hidden" id="csrf" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
							<label>WHAT ARE YOU LOOKING FOR?</label>
						</div>
						<div class="col-sm-9">
							<input class="form-control" type="text" aria-label="Search" id="keyword" value="<?php echo isset($_GET['q']) ? $_GET['q'] : ''?>">
							<i class="fa fa-search"></i>
							
						</div>
					</div>
					<div class="advance_search">
						<div class="row">
							<div class="col-sm-10">
								<div class="row">
									<div class="col-sm-4">
										<label>Location</label>
										<?php echo form_dropdown('locations_id', $select_locations, set_value('locations_id', (isset($_GET['lid'])) ? $_GET['lid'] : ''), 'id="locations_id" class="form-control"'); ?>
									</div>
									<div class="col-sm-4">
										<label>Development Type</label>
										<?php echo form_dropdown('categories_id', $select_categories, set_value('categories_id', (isset($_GET['cid'])) ? $_GET['cid'] : ''), 'id="categories_id" class="form-control"'); ?>
									</div>
									<div class="col-sm-4">
										<label>Price Range</label>


										<?php echo form_dropdown('price_range_id', $select_price_range, set_value('price_range_id', (isset($_GET['pid'])) ? $_GET['pid'] : ''), 'id="price_range_id" class="form-control"'); ?>
									</div>
								</div>
							</div>
							<div class="col-sm-2">
								<label>&nbsp;</label>
								<button class="button_search" type="submit"><i class="fa fa-search"></i></button>
								<p class="search_option">SEARCH OPTION</p>
							</div>
						</div>
					</div><!--advance_search-->
				</div><!--search_tab_content-->
			</div><!--search_tab-->
			
			<div class="search_result">
				<?php if(isset($residences) && $residences) {?>
				<div class="r">
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
				</div>
				<?php }?>
				
				
				<?php if(isset($malls) && $malls) {?>
				<div class="m">
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
				</div>
				<?php }?>

				<?php if(isset($offices) && $offices) {?>
				<div class="o">
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
				</div>
				<?php }?>

		
			</div>
		</div><!--content-->
	</main>
</section>
<script type="text/javascript">
	var post_url = '<?php echo current_url() ?>';
	var site_url = "<?php echo site_url(); ?>"
</script>