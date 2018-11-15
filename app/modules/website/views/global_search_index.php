<div class="global_search">
<h5>Search</h5>

<div class="default_search row">
	<div class="col-sm-3 gsearch_labels">
		<input type="hidden" id="csrf" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
		<label>WHAT ARE YOU LOOKING FOR?</label>
	</div>
	<div class="col-sm-9 gsearch_inputs">
		<input class="form-control" type="text" aria-label="Search" id="keyword" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''?>">
		<i class="fa fa-search"></i>
		<div class="global_search_filters">
			<span>
			<input type="radio" id="search_properties" class="checkbox-round search_properties" name="global_search_filter" value="search_properties" />
			<label for="search_properties">Properties</label>
			</span>
			<span>
			<input type="radio" id="search_articles" class="checkbox-round search_articles" name="global_search_filter" value="search_articles" />
			<label for="search_articles">Articles</label>
			</span>
			<span>
			<input type="radio" id="search_careers" class="checkbox-round search_careers" name="global_search_filter" value="search_careers"/>
			<label for="search_careers">Careers</label>
			</span>
			<span>
			<input type="radio" id="search_any" class="checkbox-round search_any" name="global_search_filter" value="search_any" checked/>
			<label for="search_any">Any</label>
			</span>
		</div>
	</div>
</div>
</div>