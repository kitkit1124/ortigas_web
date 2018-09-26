<main role="main" class="container">
	<div class="content">
		<h1><?php echo $page_heading; ?></h1>
		<p class="lead">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...</p>
	</div>
	<div class="card-columns">
		<?php if ($posts): ?>
			<?php echo $this->pagination->create_links(); ?>
			<?php foreach ($posts as $post): ?>
				<div class="card">
					<!-- <img class="card-img-top" src=".../100px160/" alt="Card image cap"> -->
					<div class="card-body">
						<h5 class="card-title"><?php echo $post->post_title; ?></h5>
						<p class="card-text"><?php echo word_limiter(strip_tags($post->post_content), 100); ?> <a href="<?php echo site_url('post/' . $post->post_slug); ?>">More</a></p>
						<p class="card-text"><small class="text-muted"><em>Posted by <strong><?php echo $post->first_name; ?> <?php echo $post->last_name; ?></strong>
					on <strong><?php echo $post->post_posted_on; ?></strong></em></small></p>
					</div>
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<div class="alert alert-warning">Posts not found within this category</div>
		<?php endif; ?>
	</div>
</main>