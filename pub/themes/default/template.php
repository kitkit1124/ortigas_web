<?php // Adds X-Frame-Options to HTTP header, so that page can only be shown in an iframe of the same site.
header('X-Frame-Options: SAMEORIGIN'); // FF 3.6.9+ Chrome 4.1+ IE 8+ Safari 4+ Opera 10.5+
// $user = $this->ion_auth->user()->row();
$this->load->model('website/navigations_model'); 
$this->load->model('website/partials_model'); 
$this->load->model('website/pages_model'); 
$this->load->model('website/seo_model'); 
$this->load->model('properties/estates_model');
$this->load->model('properties/properties_model');
?><!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php echo $head; ?>

	<title><?php echo $page_heading; ?> | <?php echo config_item('website_name'); ?></title>

	<script src="<?php echo site_url('npm/pace/pace.min.js'); ?>"></script>
	<link href="<?php echo site_url('npm/pace/pace.css'); ?>" rel="stylesheet" />


	<?php $seo = $this->seo_model->find(1); echo parse_content(html_entity_decode(strip_tags($seo->seo_content)));  ?>

	<!-- Start of oclp Zendesk Widget script -->
	<!-- <script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=fd0f7982-b94d-4c07-8176-69dbf81d7a0b"> </script> -->

	<!-- BEGIN JIVOSITE CODE {literal} -->
	<script type='text/javascript'>
	(function(){ var widget_id = 'C9krjKl6x0';
	var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);})();</script>
	<!-- {/literal} END JIVOSITE CODE -->


	<!-- End of oclp Zendesk Widget script -->

	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('npm/bootstrap/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('npm/font-awesome/css/font-awesome.min.css'); ?>">
	
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('npm/alertify/themes/alertify.core.css'); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('npm/alertify/themes/alertify.bootstrap.css'); ?>" />
	
	
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('themes/default/css/styles.min.css'); ?>">
	<link rel="shortcut icon" type="text/css" href="<?php echo site_url('themes/default/img/favicon.ico'); ?>">

	<link rel="stylesheet" type="text/css" href="<?php echo site_url('themes/default/css/custom/navigation_styles.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('data/fonts/fontface.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('themes/default/css/custom/custom_general_styles.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('themes/default/css/custom/footer_styles.css'); ?>">

	<?php echo $_styles; // loads additional css files ?>
</head>

<body> 
	<?php $seo = $this->seo_model->find(2); echo parse_content(html_entity_decode(strip_tags($seo->seo_content)));  ?>
	<nav class="navbar navbar-expand-lg navbar-light fixed-top">
		
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_navbar" aria-controls="main_navbar" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="oclogo_mobile">
			<a class="" href="<?php echo site_url(''); ?>"><img src="<?php echo getenv('UPLOAD_ROOT'); ?>data/photos/ortigaslogo.png ?>"></a>
		</div>


		<?php $request = str_replace(base_url(),'',current_url()); preg_match("/".substr(preg_quote($request,'/'),0,3)."/", $request, $url_current);  ?>

		<!-- 	<a class="nav-link base_nav <?php //echo ($url_current[0]=='search') ? 'base_nav_active' : ''; ?>" href="<?php //echo site_url('search'); ?>">Inquire</a>  -->
				
		<div class="main_menu collapse navbar-collapse" id="main_navbar">
			<div class="oclogo">
				<a class="" href="<?php echo site_url(''); ?>"><img src="<?php echo getenv('UPLOAD_ROOT'); ?>data/photos/ortigaslogo.png?>"></a>
			</div>
			<ul class="navbar-nav mr-auto">

				<?php 
					$navigations = $this->navigations_model->get_frontend_navigations(1); 
					foreach ($navigations as $key => $value) {?>

						<li class="nav-item base_nav_li">		<!-- 	/** base_nav_actives remove 's' to show highlights **/ -->
							<a class="nav-link base_nav nav_estates <?php echo (substr($request,0,3) == substr($value->navigation_link,0,4)) ? 'base_nav_actives' : ''; ?>" href="<?php echo site_url($value->navigation_link); ?>"><?php echo $value->navigation_name; ?></a>
							<?php if($value->navigation_link == "estates"){?>
								<div class = "sub_menu_estates">
									<ul class = "ul_sub_menu_estates">
											<?php
											$estates = $this->estates_model
													->where('estate_deleted',0)
													->where('estate_status','Active')
													->order_by('estate_order', 'ASC')
													->find_all();

											if($estates){
												foreach ($estates as $key => $estate) { 
											?>		
												<li class="nav-item li_nav_estates_active<?php echo ($key==0) ? '' : '_list'; ?> img_link" data-img='<?php echo isset($estate->estate_thumb) ? $estate->estate_thumb : "ui/images/placeholder.png" ?>'>
														<a class="nav-link a_sub_menu_estates" href="<?php echo site_url('').'estates/'.$estate->estate_slug; ?>"><?php echo $estate->estate_name; ?></a>
															<div class = "sub_menu_categ sub_nav_estates_active<?php echo $key; ?>">
																
															<ul class="ul_sub_menu_categ">
																<div class="img_holder">
																	<img src="<?php echo getenv('UPLOAD_ROOT').$estate->estate_thumb; ?>" onerror="this.onerror=null;this.src='<?php echo site_url('ui/images/placeholder.png')?>';">
																</div>
															<?php
																$fields = [ 'estate_id' => $estate->estate_id, 'group_by' => 'category_name' ];
																$categories = $this->properties_model->get_properties($fields);
																if($categories){
																	foreach ($categories as $key => $category) {
															?>
																	<li class="li_sub_menu_categ" >
																		
																		<a class="nav-link a_sub_menu_categ" href="<?php echo site_url('').'estates/category/'.strtolower($category->category_name); ?>"><?php echo $category->category_name; ?></a>
																		<div class="sub_menu_properties">

																			<ul>
																				<?php
																					$fields = [ 'estate_id' => $estate->estate_id, 'category_id' => $category->category_id ];
																					$properties = $this->properties_model->get_properties($fields);
																					if($properties){
																						foreach ($properties as $key => $property) {
																							// if ($property->property_category_id == 3){
																							// 	$link = $property->property_website;
																							// 	$target = '_blank';
																							// }
																							// else{
																								$link = site_url('').'estates/property/'.$property->property_slug;
																								$target = null;
																							// }
																						
																				?>
																							<li class="nav-item img_link" data-img='<?php echo isset($property->property_thumb) ? $property->property_thumb : "ui/images/placeholder.png" ?>'>
																								<a class="nav-link" target="<?php echo $target; ?>" href="<?php echo $link; ?>"><?php echo $property->property_name; ?></a>
																							</li>
																				<?php	
																						}//endforeach
																					}//ifproperties
																				?>
																			</ul>
																		</div>
																	</li>
															<?php	
																	}//endforeach
																}//ifcategories
															?>
															</ul> 
															</div>
													</li>
													
											<?php	
												} //endforeach
											}//ifestates
										?>
									</ul>
								</div>
							<?php }?>

							<?php if($value->navigation_link == "residences" || $value->navigation_link == "malls" || $value->navigation_link == "offices"){?>
								<div class = "sub_menu_estates sub_menu_estates_categs">

									<ul class="ul_sub_menu_categ">
									<?php
										if($value->navigation_link == "residences"){ $category_id = 1; }
										if($value->navigation_link == "malls"){ $category_id = 2; }
										if($value->navigation_link == "offices"){ $category_id = 3; }

										$estates = $this->estates_model
										->where('estate_deleted',0)
										->where('estate_status','Active')
										->where('property_deleted',0)
										->where('property_status','Active')
										->where('property_category_id',$category_id)
										->join('properties', 'properties.property_estate_id = estates.estate_id')
										->order_by('estate_order','asc')
										->group_by('estate_id')
										->find_all(); 


										if($estates){
											foreach ($estates as $key => $estates) {
									?>
											<li class="li_sub_menu_categ" >
												
												<a class="nav-link a_sub_menu_categ" href="<?php echo site_url('').'estates/'.strtolower($estates->estate_slug); ?>"><?php echo $estates->estate_name; ?></a>
												<div class="sub_menu_properties">

													<ul>
														<?php
															$fields = [ 'estate_id' => $estates->estate_id, 'category_id' => $category_id ];
															$properties = $this->properties_model->get_properties($fields);
															if($properties){
																foreach ($properties as $key => $property) {
																	// if ($property->property_category_id == 3){
																	// 	$link = $property->property_website;
																	// 	$target = '_blank';
																	// }
																	// else{
																		$link = site_url('').'estates/property/'.$property->property_slug;
																		$target = null;
																	// }
																
														?>
																	<li class="nav-item img_link" data-img='<?php echo isset($property->property_thumb) ? $property->property_thumb : "ui/images/placeholder.png" ?>'>
																		<a class="nav-link" target="<?php echo $target; ?>" href="<?php echo $link; ?>"><?php echo $property->property_name; ?></a>
																	</li>
														<?php	
																}//endforeach
															}//ifproperties
														?>
													</ul>
												</div>
											</li>
									<?php	
											}//endforeach
										}//ifcategories
									?>
									</ul> 
															
								</div>
							<?php }?>
						</li>
				<?php
					}
				?>								
			</ul>

			<div class="nav_search_button">
				<i class="fa fa-search " aria-hidden="true"></i>
			</div>
		
			<!-- <form class="form-inline my-2 my-lg-0 d-none">
				<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
			</form> -->
		</div>

		<div id="global_search_container">
				<?php if( substr($request,0,3) != "sea"){ echo $this->load->view('website/global_search_index'); } ?>
		</div>

	</nav>

		<div class="nav_search_button_mobile">
			<i class="fa fa-search " aria-hidden="true"></i>
		</div>

	<?php echo $content; ?>
	<?php $seo = $this->seo_model->find(3); echo parse_content(html_entity_decode(strip_tags($seo->seo_content)));  ?>

 	<footer>
		<div id="footer">
			<div class="footer_content container">
				<div class="row">
					<div class="col-sm-4 address">
						<a class="" href="<?php echo site_url(''); ?>"><img src="<?php echo getenv('UPLOAD_ROOT'); ?>data/photos/ortigaslogo.png" onerror="this.onerror=null;this.src='<?php echo site_url('ui/images/placeholder.png')?>';"></a>

						<?php $footer = $this->partials_model->find(1); if($footer) { echo parse_content($footer->partial_content); } ?>
					</div>
					<div class="footer_border"></div>
					<div class="col-sm-4 link">
						<ul>
							<?php echo $this->navigations_model->get_footer_navigation(2); ?>
						</ul>
					</div>
					<div class="footer_border"></div>
					<div class="col-sm-4 subscribe">
						<?php $subscribe = $this->partials_model->find(2); 
							if($subscribe) {
								$content = $subscribe->partial_content;
								$input = '<input type="email" id="subscription_email" placeholder="your@email.com"><a class="subscribe_button">Subscribe</a>';
								$content = preg_replace("{{{subscribe}}}", $input, $subscribe->partial_content);
								echo parse_content($content); 
							}
						?>
						<a id="subscribe_success" class="hide" href="<?php echo site_url().'website/page/show_modal?id=6' ?>" data-target="#modal-lg" data-toggle="modal"></a>
						<a id="subscribe_denied" class="hide" href="<?php echo site_url().'website/page/show_modal?id=9' ?>" data-target="#modal-lg" data-toggle="modal"></a>
					</div>
				</div>
			</div>
		</div>
		<?php $seo = $this->seo_model->find(4); echo parse_content(html_entity_decode(strip_tags($seo->seo_content)));  ?>
	</footer>	

		<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
		<div class="modal-dialog modal" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalLabel"><?php echo lang('loading')?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="text-center">
						<img src="<?php echo site_url('ui/images/loading3.gif')?>" alt="<?php echo lang('loading')?>" onerror="this.onerror=null;this.src='<?php echo site_url('ui/images/placeholder.png')?>';"/>
						<p><?php echo lang('loading')?></p>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade bd-example-modal-lg" id="modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><?php echo lang('loading')?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="text-center">
						<img src="<?php echo site_url('ui/images/loading3.gif')?>" alt="<?php echo lang('loading')?>" onerror="this.onerror=null;this.src='<?php echo site_url('ui/images/placeholder.png')?>';"/>
						<p><?php echo lang('loading')?></p>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	
	<script>
		var site_url = '<?php echo site_url(); ?>';
		var upload_url = '<?php echo getenv('UPLOAD_ROOT'); ?>';
		var csrf_name = '<?php echo $this->security->get_csrf_token_name() ?>';
		var is_sGlobal =  "<?php echo isset($is_sGlobal) ? TRUE : FALSE ; ?>";
	</script>

		<!-- JavaScript files-->
	<script src="<?php echo site_url('npm/jquery/jquery.min.js'); ?>"></script>
	<script src="<?php echo site_url('npm/popper.js/umd/popper.min.js'); ?>"> </script>
	<script src="<?php echo site_url('npm/bootstrap/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo site_url('npm/jquery.cookie/jquery.cookie.js'); ?>"></script>
	<script src="<?php echo site_url('npm/alertify/lib/alertify.min.js'); ?>"></script>
	
	<script src="<?php echo site_url('themes/default/js/scripts.js'); ?>"></script>
	<script src="<?php echo site_url('themes/default/js/scripts.min.js'); ?>"></script>
	<script src="<?php echo site_url('themes/default/js/template_custom.js'); ?>"></script>

	<?php echo $_scripts; // loads additional js files from the module ?>

	<?php if(isset($enable_map) && $enable_map) : ?>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDN6cUNcHO88eddYIc5mo4nW4t-sOPILCE&libraries=places&callback=initMap" type="text/javascript"></script>
	<?php endif;?>
</body>
</html>