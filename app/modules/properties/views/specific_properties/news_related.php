<div class="news_related">
	<h2 class="related_news_title">Related News</h2>
	<div class="news_related_content">
		<?php
			$news_data['cols_img'] = 'col-sm-4';
			$news_data['cols_data'] = 'col-sm-8';
			echo $this->load->view('website/news_result', $news_data); 
		?>
	</div>
</div>