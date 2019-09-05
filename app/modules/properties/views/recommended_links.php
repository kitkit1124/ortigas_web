<?php if(isset($recommended_links) && $recommended_links): ?>
<div class="recommended_links_container">
	<div class="recommended_links_content container">
		<h2>Recommended Links</h2>
		<div class="row">
			<?php foreach ($recommended_links as $key => $value) { ?>
				<div class="col-sm-4"><a href="<?php echo $value->related_link_link; ?>" target="_blank"><?php echo $value->related_link_label; ?></a></div>
			<?php }?>
		</div>
	</div>
</div>
<?php endif; ?>