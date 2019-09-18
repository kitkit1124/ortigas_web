<?php $this->template->add_css(module_css('properties', 'search_form'), 'embed'); ?>
<?php $this->template->add_js(module_js('properties', 'search_form'), 'embed'); ?>

<div class="search_tab property_search">
	<div class="search_tab_content">
		<div class="advance_search">
			<label>SEARCH PROPERTIES</label>
			<div class="row">
				<div class="col-sm-10 colselect">
					<div class="row">
						<input type="hidden" id="csrfs" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						<div class="col-sm-6">
							
							<select id="locations_id" class="form-control">
							<?php foreach ($select_locations as $key => $value) { ?>
								<?php if($value == ''){ ?>
									<option selected="selected" disabled=""><label>Location</label></option>
								<?php } else { ?>
								<option><?php echo $value; ?></option>
								<?php }  ?>
							<?php } ?>
							</select>
						
						</div>
						<div class="col-sm-6">

							<select id="dev_id" class="form-control">
							<?php foreach ($select_dev_types as $key => $value) { ?>
								<?php if($value == ''){ ?>
									<option selected="selected" disabled=""><label>Development Type</label></option>
								<?php } else { ?>
								<option><?php echo $value; ?></option>
								<?php }  ?>
							<?php } ?>
							</select>
						</div>
					<!-- 	<div class="col-sm-4">
							<label>Price Range</label>
							<?php //echo form_dropdown('price_range_id', $select_price_range, set_value('price_range_id', (isset($_GET['pid'])) ? $_GET['pid'] : ''), 'id="price_range_id" class="form-control"'); ?>
						</div> -->
					</div>
				</div>
				<div class="col-sm-2 colsearch">
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
