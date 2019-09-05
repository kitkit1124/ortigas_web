<?php $this->template->add_css(module_css('properties', 'search_form'), 'embed'); ?>
<?php $this->template->add_js(module_js('properties', 'search_form'), 'embed'); ?>

<div class="search_tab property_search">
	<div class="search_tab_content">
		<div class="advance_search">
			<div class="row">
				<div class="col-sm-10 colselect">
					<div class="row">
						<input type="hidden" id="csrfs" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						<div class="col-sm-6">
							<label>Location</label>
							<?php echo form_dropdown('locations_id', $select_locations, set_value('locations_id', (isset($_GET['loc'])) ? $_GET['loc'] : ''), 'id="locations_id" class="form-control"'); ?>
						</div>
						<div class="col-sm-6">
							<label>Development Type</label>
							<?php echo form_dropdown('dev_id', $select_dev_types, set_value('dev_id', (isset($_GET['dev'])) ? $_GET['dev'] : ''), 'id="dev_id" class="form-control"'); ?>
						</div>
					<!-- 	<div class="col-sm-4">
							<label>Price Range</label>
							<?php //echo form_dropdown('price_range_id', $select_price_range, set_value('price_range_id', (isset($_GET['pid'])) ? $_GET['pid'] : ''), 'id="price_range_id" class="form-control"'); ?>
						</div> -->
					</div>
				</div>
				<div class="col-sm-2 colsearch">
					<label>&nbsp;</label>
					<a class="button_search default-button"><i class="fa fa-search"></i></a>
				</div>
			</div>
		</div><!--advance_search-->
	</div><!--search_tab_content-->
</div><!--search_tab-->

<script type="text/javascript">
	var post_url = '<?php echo current_url(); ?>'
	var site_url = "<?php echo site_url(); ?>"
</script>
