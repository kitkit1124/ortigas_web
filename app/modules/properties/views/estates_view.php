<section id="roles">
	<?php if($estates){ ?>
	<div id="banner_image">

		<?php if(isset($estates->estate_logo) && $estates->estate_logo || $estates->estate_logo=='NULL'){ ?>
		<div class="estate_logo_div">
			<div class="banner_gradient"></div>
			<img class="estate_logo_img" src="<?php echo getenv('UPLOAD_ROOT').img_selector($estates->estate_logo,'small'); ?>" draggable="false" alt="<?php echo $estates->estate_alt_logo; ?>" title="<?php echo $estates->estate_alt_logo; ?>" />
			<h1 class="hide"><?php echo $estates->estate_name; ?></h1>
		</div> 
		<?php } else { ?>
		<div class="banner_margin container"><h1><?php echo $estates->estate_name; ?></h1></div> 
		<div class="banner_gradient"></div>
		<?php } ?>
		
		<img class="estate_banner_img lazy parallax-window" data-parallax="scroll" data-image-src="<?php echo getenv('UPLOAD_ROOT').$estates->estate_image; ?>" data-z-index="1" data-src="<?php echo getenv('UPLOAD_ROOT').$estates->estate_image; ?>" draggable="false" alt="<?php echo $estates->estate_alt_image; ?>" title="<?php echo $estates->estate_alt_image; ?>"/>
		<?php echo $this->load->view('website/breadcrumbs_view'); ?>					
	</div>
	<?php } ?>

	<?php 
	/*$btn_cnt = 0;
	$col_cnt = 12; 
	if(isset($residences) && $residences){ $btn_cnt += 1; }
	if(isset($malls) && $malls){ $btn_cnt += 1; }
	if(isset($offices) && $offices){ $btn_cnt += 1; }
	if($btn_cnt){
		$col_cnt = $col_cnt / $btn_cnt;
	}
	
		<div class="content">	
			<div class="row specific_estate">

				<?php if(isset($residences) && $residences){ ?>
				<div class="<?php echo "col-sm-".$col_cnt; ?> btn_est">
					<div class="estate_button" data-anchor="residences">
						<p>RESIDENCES</p>
					</div>
				</div>
				<?php } ?>

				<?php if(isset($malls) && $malls){ ?>
				<div class="<?php echo "col-sm-".$col_cnt; ?> btn_est">
					<div class="estate_button" data-anchor="malls">
						<p>MALLS</p>
					</div>
				</div>
				<?php } ?>
				<?php if(isset($offices) && $offices){ ?>
				<div class="<?php echo "col-sm-".$col_cnt; ?> btn_est">
					<div class="estate_button" data-anchor="offices">
						<p>OFFICES</p>
					</div>
				</div>
				<?php } ?>
			</div>
		</div> */
	?>
		
	<main role="main" class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="estates_description">
					<?php echo $estates->estate_text; ?>
				</div>
			</div>
			<div class="col-lg-6">
				<?php $this->template->add_js(module_js('website', 'slider_index'), 'embed'); ?>
				<?php $this->load->view('properties/specific_properties/slider_view'); ?>
			</div>
		</div>
	

		<?php if(isset($residences) && $residences){ ?>
		<?php 
			$resi_margin 	= count($residences)>1? "estates":"";
			$resi_spacing 	= count($residences)>1? "":"offset-lg-3";
			$resi_align 	= count($residences)>1? "":"text-center";
		?>	
		<div class="content_residence">
			<!--<div class="row cat_heading_res hide">
				 <div class="col-sm-4 res_title"><h2><?php echo $category_residence->category_name; ?></h2></div>
				<div class="col-sm-8 res_desc"><?php echo $category_residence->category_snippet_quote; ?></div> -->
				<!-- <div class="col-sm-2 est_link"><a href="<?php //echo site_url('').strtolower($category_residence->category_name); ?>">View All</a></div> 
			</div>-->
			<div class="cat_heading">
				<div class="cat_title"><h2><?php echo $category_residence->category_name; ?></h2></div>
				<div class="cat_desc"><?php echo strip_tags($category_residence->category_snippet_quote); ?></div>
			</div>
			<div class="row residences_div">
				<?php foreach ($residences as $key => $val) { ?>
					<div class="<?php echo $resi_margin; ?> residences <?php echo $resi_spacing; ?> col-lg-6 ">
						<div class="residences">
							<a href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">
							<div class="image_wrapper">
								<div class="image_container">
										<img class="lazy" data-src="<?php echo  getenv('UPLOAD_ROOT').img_selector($val->property_image,'large'); ?>" width="100%" draggable="false" alt="<?php echo $val->property_alt_image; ?>" title="<?php echo $val->property_alt_image; ?>" />
								</div>
							</div>
							<div class="property_desc">
								<h5 class="<?php echo $resi_align; ?>"><?php echo $val->property_name; ?></h5>
								<span class="<?php echo $resi_align; ?>"><?php echo strip_tags($val->property_snippet_quote); ?></span>
							</div>
							</a>
						</div>
					</div>
				<?php	} //end foreach ?>	
			</div>
			<div style="clear: both;"></div>
		</div>
		<?php } ?>

		<?php if(isset($malls) && $malls){ ?>
		<?php 
			$mall_margin 	= count($malls)>1? "estates":"";
			$mall_spacing 	= count($malls)>1? "":"offset-lg-3";
			$mall_align 	= count($malls)>1? "":"text-center";
		?>	
		<div class="content_residence">
			<div class="cat_heading">
				<div class="cat_title"><h2><?php echo $category_mall->category_name; ?></h2></div>
				<div class="cat_desc"><?php echo strip_tags($category_mall->category_snippet_quote); ?></div>
			</div>
			<div class="row residences_div">
				<?php foreach ($malls as $key => $val) { ?>
					<div class="<?php echo $mall_margin; ?> residences <?php echo $mall_spacing; ?> col-lg-6">
						<div class="residences">
							<a href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">
							<div class="image_wrapper">
								<div class="image_container">
										<img class="lazy" data-src="<?php echo  getenv('UPLOAD_ROOT').img_selector($val->property_image,'large'); ?>" width="100%" draggable="false" alt="<?php echo $val->property_alt_image; ?>" title="<?php echo $val->property_alt_image; ?>" />
								</div>
							</div>
							<div class="property_desc">
								<h5 class="<?php echo $mall_align; ?>"><?php echo $val->property_name; ?></h5>
								<span class="<?php echo $mall_align; ?>"><?php echo strip_tags($val->property_snippet_quote); ?></span>
							</div>
							</a>
						</div>
					</div>
				<?php	} //end foreach ?>	
			</div>
			<div style="clear: both;"></div>
		</div>
		<?php } ?>

		<?php if(isset($offices) && $offices){ ?>
		<?php 
			$offi_margin 	= count($offices)>1? "estates":"";
			$offi_spacing 	= count($offices)>1? "":"offset-lg-3";
			$offi_align 	= count($offices)>1? "":"text-center";
		?>	
		<div class="content_residence">
			<div class="cat_heading">
				<div class="cat_title"><h2><?php echo $category_office->category_name; ?></h2></div>
				<div class="cat_desc"><?php echo strip_tags($category_office->category_snippet_quote); ?></div>
			</div>
			<div class="row residences_div">
				<?php foreach ($offices as $key => $val) { ?>
					<div class="<?php echo $offi_margin; ?> residences <?php echo $offi_spacing; ?> col-lg-6">
						<div class="residences">
							<a href="<?php echo site_url('').'estates/property/'.$val->property_slug; ?>">
							<div class="image_wrapper">
								<div class="image_container">
										<img class="lazy" data-src="<?php echo  getenv('UPLOAD_ROOT').img_selector($val->property_image,'large'); ?>" width="100%" draggable="false" alt="<?php echo $val->property_alt_image; ?>" title="<?php echo $val->property_alt_image; ?>" />
								</div>
							</div>
							<div class="property_desc">
								<h5 class="<?php echo $offi_align; ?>"><?php echo $val->property_name; ?></h5>
								<span class="<?php echo $offi_align; ?>"><?php echo strip_tags($val->property_snippet_quote); ?></span>
							</div>
							</a>
						</div>
					</div>
				<?php	} //end foreach ?>	
			</div>
			<div style="clear: both;"></div>
		</div>
		<?php } ?>


			<div style="display: none">				
				<?php echo form_input(array('id'=>'estate_latitude', 'name'=>'estate_latitude', 'value'=>set_value('estate_latitude', isset($estates->estate_latitude) ? $estates->estate_latitude : ''), 'class'=>'form-control'));?>
	
				<?php echo form_input(array('id'=>'estate_longtitude', 'name'=>'estate_longtitude', 'value'=>set_value('estate_longtitude', isset($estates->estate_longtitude) ? $estates->estate_longtitude : ''), 'class'=>'form-control'));?>

				<textarea id="pac-input" style="display: none;"></textarea>
			</div>
		</div>
	</main>
			<div id="location">
				<div id="map"></div>
			<!-- 	
			<iframe 
			  width="100%" 
			  height="400" 
			  frameborder="0" 
			  scrolling="no" 
			  marginheight="0" 
			  marginwidth="0" 
			  src="<?php echo 'https://maps.google.com/maps?q='.$estates->estate_latitude.','.$estates->estate_longtitude.'&hl=es;z=14&amp;output=embed'; ?>"
			 >
			 </iframe> -->
			</div><!--map-location-->
	<main role="main" class="container">
		<div class="content">
			<!-- <div class="seo_content">
				<?php //if($estates) { echo parse_content($estates->estate_bottom_text); } ?>
			</div> -->

			<div class="inquiry_form_container">
				<?php echo $this->load->view('messages/messages_form')?>
			</div>
		
		</div>
	</main>
	<?php /*if(isset($news_result) && $news_result){ ?>
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
	<?php } */?>
	<?php //echo $this->load->view('properties/recommended_links')?>
</section>