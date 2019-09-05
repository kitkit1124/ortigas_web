<section id="roles">
		<?php echo $this->load->view('website/slider_index'); ?>
		<?php $this->template->add_js(module_js('website', 'slider_index'), 'embed'); ?>
	<main role="main" class="container">
		<div class="content">	

			<div class="page_overview">
				<?php if($projects) {	echo parse_content($projects->page_content); } ?>
				<a class="inquiry_button default-button" data-anchor="inquiry_form_container"><?php if($button_text) { echo strip_tags(parse_content($button_text->partial_content)); } ?></a>
			</div>

			<?php echo $this->load->view('properties/search_form'); ?>
			<?php
				$data = [];
				$data['display'] = '';
				$data['cols'] = 'col-sm-4';
				$data['image'] = 'property_image';

			 	echo $this->load->view('properties/properties_result', $data); 
			 ?>

			<div class="seo_content">
				<?php if($projects) {	echo parse_content($projects->page_bottom_content); } ?>
			</div>

			<div class="inquiry_form_container">
				<?php echo $this->load->view('messages/messages_form')?>
			</div>
		</div><!--content-->

	</main>

	<?php if(isset($news_result) && $news_result){ ?>
		<div class="news_related">
	
			<h2 class="related_news_title"><?php echo 'Related News'; ?></h2>
			
	
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

	<?php echo $this->load->view('properties/recommended_links')?>
</section>