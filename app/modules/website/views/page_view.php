<?php echo $this->load->view('website/slider_index'); ?>
<?php $this->template->add_js(module_js('website', 'slider_index'), 'embed'); ?>
<main role="main" class="container">
	<div class="content">
		<p class="lead">
			<?php echo parse_content($record->page_content); ?>
		</p>

		<?php  if($record->page_uri == 'about-us'){ ?> 
			<div class="projects_about">
				<div class="row cat_heading">
					<div class="col-sm-3 est_title"><h2><?php echo $projects->page_title; ?></h2></div>
					<div class="col-sm-9 est_desc"><?php echo  $this->metatags_model->clean_page_description($projects->page_content); ?></div>
				</div>
				<div class="related_properties_result">
					<?php
						$data = [];
						$data['display'] = 'hide';
						$data['cols'] = 'col-sm-3';
						$data['image'] = 'property_thumb';

					 	echo $this->load->view('properties/properties_result', $data); 
					 ?>
				</div>
			</div>
		<?php } ?>

		
		<?php if($record->page_bottom_content) { ?>
			<div class="seo_content">
			<?php echo parse_content($record->page_bottom_content); ?>
			</div>
		<?php } ?>
		

	</div>

</main>

<?php //if($record->page_uri == 'about-us'){ ?>
	<?php if(isset($news_result) && $news_result){ ?>
		<div class="news_related">
			<h2 class="related_news_title">Related News</h2>
			<div class="news_related_content">
				<?php
					$news_data['related_news'] = 1;
					$news_data['cols_img'] = 'col-sm-5';
					$news_data['cols_data'] = 'col-sm-7';
					echo $this->load->view('website/news_result', $news_data); 
				?>
			</div>
		</div>
	<?php } ?>
<?php //} ?>

