<?php $this->template->add_css(module_css('properties', 'search_form'), 'embed'); ?>
<div class="search_tab">
	<div class="search_tab_content">
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
				</div>
			</div>
		</div><!--advance_search-->
	</div><!--search_tab_content-->
</div><!--search_tab-->