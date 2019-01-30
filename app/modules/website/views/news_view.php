<section id="news">
	<?php if($news){ ?>
	<div id="banner_image">
		<div class="banner_gradient"></div>
		<img class="estate_banner_img" src="<?php echo getenv('UPLOAD_ROOT').$news->post_image; ?>" draggable="false" alt="<?php echo $news->post_alt_image; ?>" title="<?php echo $news->post_alt_image; ?>" onerror="this.onerror=null;this.src='<?php echo site_url('ui/images/placeholder.png')?>';"/>
		<?php echo $this->load->view('website/breadcrumbs_view'); ?>	
	</div>
	<?php } ?>

	<main role="main" class="container">
		<div class="content">
			<div class="row">	
				<div class="news_content col-sm-8">
					<h1><?php echo $news->post_title; ?></h1>
					<?php if($news->post_modified_on){ $dtraw = $news->post_modified_on; } else { $dtraw = $news->post_created_on; } $dtpost = date_create($dtraw); ?>
					<p><?php echo 'Date posted '. date_format($dtpost,"F j, Y");  ?></p>
					<p class="news_filter"><?php echo $news->news_tag_name; ?></p>
					<?php echo parse_content($news->post_content); ?>			
				</div>
				<div class="news_sidebar col-sm-4">
					<?php if($news_tags) : ?>
					<div class="news_filter_division">
						<h5 class="news_sidebar_heading">Tags</h5>
						<?php foreach ($news_tags as $key => $value) { ?>
							<p class="news_filter news_filter_list"><?php echo $value->news_tag_name; ?> </p>
						<?php } ?>
					</div>
					<?php endif; ?>

					<?php if($suggested_news) : ?>
					<div class="suggested_news">
						<h5 class="news_sidebar_heading">Suggested Articles</h5>
						<?php foreach ($suggested_news as $key => $value) { ?>
							<a href="<?php echo site_url().'news/'.$value->post_slug; ?>" class=" "><?php echo $value->post_title; ?> </a>
						<?php } ?>
					</div>
					<?php endif; ?>

					<?php if($news_tags) : ?>
					<div class="archive">
						<div class="row">
							<div class="col-sm-8">
								<h5 class="news_sidebar_heading archive_heading">Archive</h5>
							</div>
							<div class="col-sm-4">
								<span class="pull-right archive_button_view_all">VIEW ALL</span>
							</div>
						</div>
						<div class="border_bottom"></div>
						<?php foreach ($archive as $key => $value) { ?>
							<ul>
								<a href="#archive<?php echo $key;?>"><span><?php echo $value->archive_year; ?></span></a>
								<div class="expandable" id="archive<?php echo $key;?>">
									<?php foreach ($value->archive_month as $key => $val) { ?>
									<li><?php echo $val->archive_month; ?></li>
									<?php } ?>
								</div>
							</ul>
							
						<?php } ?>						
					</div>
					<?php endif; ?>

				</div>
			</div>
		</div><!--content-->
	</main>
</section>