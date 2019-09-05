<div class="breadcrumbs">
	<div class="breadcrumbs_content container">
		<?php if(isset($breadcrumbs['heading'])): ?>
		<a href="<?php echo site_url(); ?>"><?php echo $breadcrumbs['heading']; ?></a>
		&nbsp; > &nbsp;

		<?php if(isset($breadcrumbs['page_subhead'])): ?>
			<a href="<?php echo base_url().$breadcrumbs['page_subhead_link']; ?>"><?php echo $breadcrumbs['page_subhead']; ?></a>
			&nbsp; > &nbsp;
		<?php endif; ?>

		<?php if(isset($breadcrumbs['page_subhead_inner'])): ?>
			<a href="<?php echo base_url().$breadcrumbs['page_subhead_inner_link']; ?>"><?php echo $breadcrumbs['page_subhead_inner']; ?></a>
			&nbsp; > &nbsp;
		<?php endif; ?>

		<a href="<?php echo current_url(); ?>"><?php echo $breadcrumbs['subhead']; ?></a>

		<?php endif; ?>
	</div>
	
</div>