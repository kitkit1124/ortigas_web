<section id="roles">
		<?php echo $this->load->view('website/slider_index'); ?>
		<?php $this->template->add_js(module_js('website', 'slider_index'), 'embed'); ?>
	<main role="main" class="container">
		<div class="content">
			<div class="row">	
				<div class="news_content col-sm-8">
					<h1 class="news_title">What's New in Ortigas and Company</h1>
					<p class="news_filter_label">Filter by Category:</p>
					<a class="news_filter" data-id="0">ALL</a>
					<?php
					if($news_tags){
						foreach ($news_tags as $key => $value) { ?>
							<a class="news_filter" data-id = "<?php echo $value->news_tag_id; ?>"><?php echo $value->news_tag_name; ?></a>
					<?php 
						} 
					} ?>

					<?php
						$news_data['cols_img'] = 'col-sm-4';
						$news_data['cols_data'] = 'col-sm-8';
						echo $this->load->view('news_result', $news_data); 
					?>
	
				</div>
				<div class="news_sidebar col-sm-4">
					<?php echo $this->load->view('messages/messages_form')?>
					
					<div class="related_properties_result">
						<?php
							$data = [];
							$data['display'] = 'hide';
							$data['cols'] = 'col-sm-6';
							$data['image'] = 'property_logo';

						 	echo $this->load->view('properties/properties_result', $data); 
						 ?>
					</div>
				</div>
			</div>

			 <div class="seo_content">
				<?php if($news_page) { echo parse_content($news_page->page_bottom_content); } ?>
			</div>

		</div><!--content-->
	</main>
	<?php echo $this->load->view('properties/recommended_links')?>
</section>