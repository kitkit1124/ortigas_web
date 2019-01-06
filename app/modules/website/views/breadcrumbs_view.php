<div class="breadcrumbs">
	<div class="breadcrumbs_content container">
		<?php if(isset($breadcrumbs['heading'])): ?>
		<a href="<?php echo site_url(); ?>"><?php echo $breadcrumbs['heading']; ?></a>
		&nbsp; > &nbsp;

		<?php if(isset($breadcrumbs['page_subhead'])): ?>
			<a href=""><?php echo $breadcrumbs['page_subhead']; ?></a>
			&nbsp; > &nbsp;
		<?php endif; ?>

		<?php echo $breadcrumbs['subhead']; ?>

		<?php endif; ?>
	</div>
	
</div>