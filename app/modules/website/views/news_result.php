<?php $this->template->add_css(module_css('website', 'news_result'), 'embed'); ?>
<?php if(isset($related_news) && $related_news) { ?> 
	<div class="row">
<?php } ?>
<?php
if(isset($news_result) && $news_result){
foreach ($news_result as $key => $value) { 

	if($value->post_modified_on){ $dtraw = $value->post_modified_on; } else { $dtraw = $value->post_created_on; }		
		$dtpost = date_create($dtraw); 

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
				<img src="<?php echo site_url().$value->post_image; ?>">
			</div>
			<div class="news_details <?php echo (isset($cols_data) && $cols_data) ? $cols_data : ''; ?>">
				<h2><?php echo $value->post_title; ?></h2>
				<label>
					<span class="dtpost">
						<i><?php echo 'Date Posted '. date_format($dtpost,"F j, Y"); ?></i>
					</span>
					<?php if(isset($value->post_tags) && $value->post_tags){ ?>
						<i class="fa fa-tag"></i>
						<span class="news_tags"><?php echo substr($news_tags,0,-2)?></span>
					<?php } ?>
				</label>
				<span class="news_text"> <?php echo $value->post_content; ?></span>
				<a href="<?php echo site_url().'news/'.$value->post_slug;?>" class="green_button">Read More</a>
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