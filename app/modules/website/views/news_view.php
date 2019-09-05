<section id="news">
	<?php if($news){ ?>
	<div id="banner_image">
		<div class="banner_gradient"></div>
		<img class="estate_banner_img lazy" data-src="<?php echo getenv('UPLOAD_ROOT').$news->post_image; ?>" draggable="false" alt="<?php echo $news->post_alt_image; ?>" title="<?php echo $news->post_alt_image; ?>" />
		<?php echo $this->load->view('website/breadcrumbs_view'); ?>	
	</div>
	<?php } ?>

	<main role="main" class="container">
		<div class="content">
			<div class="row">	
				<div class="news_content col-sm-8">
					<h1><?php echo $news->post_title; ?></h1>
					<?php $dtpost = date_create($news->post_posted_on); ?>
					
					<p><?php echo 'Posted by '. config_item('website_name');  ?></p>
					<p><?php echo 'Date posted '. date_format($dtpost,"F j, Y");  ?></p>

					<div class="social_media">
						<?php if($news->post_facebook){  ?>
						<a target="_blank" href="<?php echo $news->post_facebook; ?>" class="social_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
						<?php } ?>

						<?php if($news->post_twitter){  ?>
						<a target="_blank" href="<?php echo $news->post_twitter; ?>" class="social_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
						<?php } ?>

						<?php if($news->post_instagram){  ?>
						<a target="_blank" href="<?php echo $news->post_instagram; ?>" class="social_facebook"><i class="fa fa-instagram" aria-hidden="true"></i></a>
						<?php } ?>

						<?php if($news->post_linkedin){  ?>
						<a target="_blank" href="<?php echo $news->post_linkedin; ?>" class="social_facebook"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
						<?php } ?>

						<?php if($news->post_youtube){  ?>
						<a target="_blank" href="<?php echo $news->post_youtube; ?>" class="social_facebook"><i class="fa fa-youtube" aria-hidden="true"></i></a>
						<?php } ?>
					</div>

					<a href="/news/tags/<?php echo $news->news_tag_slug; ?>" class="news_filter"><?php echo $news->news_tag_name; ?></a>
					<?php echo parse_content($news->post_content); ?>	

					<a href="<?php echo getenv('UPLOAD_ROOT'); echo isset($news->post_document) ? $news->post_document : '' ?>" download target="_blank">
						<div class="upload_document_holder">
	          				<?php if(isset($news->post_document) && $news->post_document && $news->post_document != null): ?>

	          				<i class="fa fa-download" aria-hidden="true"></i>

							<?php $path = site_url().isset($news->post_document) ? $news->post_document : '';
								$ext = pathinfo($path, PATHINFO_EXTENSION);
								switch ($ext)
								{
									case "docx":
									case "doc":
									case "dotx":
									case "dot":
									case "docm":
										$thumb = 'fa fa-file-word-o fa-3x color_doc';
										break;
									case "xlsx":
									case "xlsb":
									case "xls":
									case "xltx":
									case "xla":
									case "xlt":
										$thumb = 'fa fa-file-excel-o fa-3x';
										break;
									case "pptx":
									case "ppt":
									case "pptm":
									case "ppsm":
									case "ppsx":
									case "psw":
										$thumb = 'fa fa-file-powerpoint-o fa-3x';
										break;
									case "pdf":
										$thumb = 'fa fa-file-pdf-o fa-3x color_pdf';
										break;
								}
							?>
								<i class="<?php echo isset($news->post_document) ? $thumb : ''; ?>" aria-hidden="true"></i>
	          				<?php endif; ?>
	          			</div>
          			</a>
				</div>
				<div class="news_sidebar col-sm-4">
					<?php if($news_tags) : ?>
					<div class="news_filter_division">
						<h5 class="news_sidebar_heading">Tags</h5>
						<?php foreach ($news_tags as $key => $value) { ?>
							<a href="/news/tags/<?php echo $value->news_tag_slug; ?>" class="news_filter news_filter_list"><?php echo $value->news_tag_name; ?></a>
						<?php } ?>
					</div>
					<?php endif; ?>

					<?php if($suggested_news) : ?>
					<div class="suggested_news">
						<h5 class="news_sidebar_heading">Suggested Articles</h5>
						<?php foreach ($suggested_news as $key => $value) { ?>
							<a href="<?php echo site_url().'news/'.$value->post_slug; ?>" class="news_filter"><?php echo $value->post_title; ?> </a>
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
								<a href="/news"><span class="pull-right archive_button_view_all">VIEW ALL</span></a>
							</div>
						</div>
						<div class="border_bottom"></div>
						<?php foreach ($archive as $key => $value) { ?>
							<ul>
								<a href="#archive<?php echo $key;?>"><span><?php echo $value->archive_year; ?></span></a>
								<div class="expandable" id="archive<?php echo $key;?>">
									<?php foreach ($value->archive_month as $key => $val) { ?>
									<li><a href="/news?q=<?php echo $val->archive_month.'-'.$value->archive_year; ?>" ><?php echo $val->archive_month; ?></a></li>
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