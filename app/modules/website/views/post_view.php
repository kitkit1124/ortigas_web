<main role="main" class="container">
	<div class="content">
		<h1><?php echo $page_heading; ?></h1>
		<div class="post-info">
			<small class="text-muted"><em>Posted by <strong><?php echo $post->first_name; ?> <?php echo $post->last_name; ?></strong>
			on <strong><?php echo $post->post_posted_on; ?></strong></em></small>
		</div>				
		<div class="post-content mt-4 lead">
			<?php echo parse_content($post->post_content); ?>
		</div>
	</div>
</main>