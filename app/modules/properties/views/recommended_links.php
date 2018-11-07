<?php if(isset($recommended_links) && $recommended_links): ?>
<div class="recommended_links_container">
	<div class="recommended_links_content container">
		<h1>Recommended Links</h1>
		<div class="row">
			<?php foreach ($recommended_links as $key => $value) { ?>
				<div class="col-sm-4"><?php echo $value->related_link_label; ?></div>
			<?php }?>
		</div>
	</div>
</div>
<?php endif; ?>