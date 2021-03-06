<?php $this->template->add_css(module_css('website', 'news_result'), 'embed'); ?>
<?php if(isset($related_news) && $related_news) { ?> 
	<div class="row">
<?php } ?>
<?php
if(isset($news_result) && $news_result){
foreach ($news_result as $key => $value) { 

		$dtpost = date_create($value->post_posted_on); 

		$news_tags = '';
		if(isset($value->post_tags) && $value->post_tags){
			foreach ($value->post_tags as $key => $tag_result ){
				$news_tags .= $tag_result->news_tag_name.'&nbsp; & ';
			}
		}
	?>
	<?php if(isset($related_news) && $related_news) { ?>
		<div class="col-sm-6 news_result_container">
	<?php } ?>
	<div class="news_result">
		<div class="row">
			<div class="news_image <?php echo (isset($cols_img) && $cols_img) ? $cols_img : ''; ?>">
				<a href="<?php echo site_url().'news/'.$value->post_slug;?>">
					<img class="lazy" data-src="<?php echo getenv('UPLOAD_ROOT').img_selector($value->post_image,'medium'); ?>" alt="<?php echo $value->post_alt_image; ?>" title="<?php echo $value->post_alt_image; ?>">
				</a>
			</div>
			<div class="news_details <?php echo (isset($cols_data) && $cols_data) ? $cols_data : ''; ?>">
				<?php if(isset($value->post_tags) && $value->post_tags){ ?>
					<i class="fa fa-tag"></i>
					<span class="news_tags"><?php echo substr($news_tags,0,-2)?></span>
				<?php } ?>
				<a href="<?php echo site_url().'news/'.$value->post_slug;?>"><h2><?php echo $value->post_title; ?></h2></a>
				<label>
					<span class="dtpost">
						<i><?php echo 'Date Posted '. date_format($dtpost,"F j, Y"); ?></i>
					</span>
					
				</label>
				<div class="news_text"><?php echo strip_tags($value->post_content); ?></div>
				<a href="<?php echo site_url().'news/'.$value->post_slug;?>" class="default-button">Read More</a>
			</div>
		</div>
	</div>
	<?php if(isset($related_news) && $related_news) { ?>
	</div>
	<?php } ?>
<?php
}
} ?>
<?php if(isset($related_news) && $related_news) { ?>
</div>
<?php } ?>