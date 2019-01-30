<section id="roles">
	<main role="main" class="container">
		<div class="content">
			<img class="not_found_img" src="<?php echo getenv('UPLOAD_ROOT');?>data/photos/error_404.png">
			<?php echo parse_content($partials->partial_content); ?>
			<a class="default-button" href="<?php echo site_url(); ?>">BACK TO HOME PAGE</a>
		</div><!--content-->
	</main>
</section>
