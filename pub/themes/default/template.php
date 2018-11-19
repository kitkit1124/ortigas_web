<?php // Adds X-Frame-Options to HTTP header, so that page can only be shown in an iframe of the same site.
header('X-Frame-Options: SAMEORIGIN'); // FF 3.6.9+ Chrome 4.1+ IE 8+ Safari 4+ Opera 10.5+
// $user = $this->ion_auth->user()->row();
?><!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title><?php echo config_item('website_name'); ?> | <?php echo $page_heading; ?></title>

	<?php echo $head; ?>

	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('npm/bootstrap/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('npm/font-awesome/css/font-awesome.min.css'); ?>">
	
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('npm/alertify/themes/alertify.core.css'); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('npm/alertify/themes/alertify.bootstrap.css'); ?>" />
	
	
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('themes/default/css/styles.min.css'); ?>">
	<link rel="shortcut icon" type="text/css" href="<?php echo site_url('themes/default/img/favicon.png'); ?>">

	<link rel="stylesheet" type="text/css" href="<?php echo site_url('themes/default/css/custom/navigation_styles.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('themes/default/css/custom/custom_general_styles.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('themes/default/css/custom/footer_styles.css'); ?>">


	<?php echo $_styles; // loads additional css files ?>
</head>

<body>

	<nav class="navbar navbar-expand-lg navbar-light fixed-top">
		
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_navbar" aria-controls="main_navbar" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="oclogo_mobile">
			<a class="" href="<?php echo site_url(''); ?>"><img src="<?php echo base_url(); ?>data/images/ortigaslogo.png"></a>
		</div>


		<?php $request = str_replace(base_url(),'',current_url()); preg_match("/".substr(preg_quote($request,'/'),0,6)."/", $request, $url_current);  ?>
		<!-- 	<a class="nav-link base_nav <?php //echo ($url_current[0]=='search') ? 'base_nav_active' : ''; ?>" href="<?php echo site_url('search'); ?>">Inquire</a>  -->
				
		<div class="main_menu collapse navbar-collapse" id="main_navbar">
			<div class="oclogo">
				<a class="" href="<?php echo site_url(''); ?>"><img src="<?php echo base_url(); ?>data/images/ortigaslogo.png"></a>
			</div>
			<ul class="navbar-nav mr-auto">

				<?php 
					$this->load->model('website/navigations_model'); 
					$this->load->model('website/partials_model'); 
					$navigations = $this->navigations_model->get_frontend_navigations(1); 
					
					foreach ($navigations as $key => $value) {?>

						<li class="nav-item">
							<a class="nav-link base_nav nav_estates <?php echo ($url_current[0] == substr($value->navigation_link,0,6)) ? 'base_nav_active' : ''; ?>" href="<?php echo site_url($value->navigation_link); ?>"><?php echo $value->navigation_name; ?></a>
							<?php if($value->navigation_link == "estates"){?>
								<div class = "sub_menu_estates">
									<ul class = "ul_sub_menu_estates">
											<?php
											$this->load->model('properties/estates_model');
									
											$estates = $this->estates_model->find_all();

											$this->load->model('properties/properties_model');
											
											if($estates){
												foreach ($estates as $key => $estate) { 
											?>		

													<li class="nav-item li_nav_estates_active<?php echo ($key==0) ? '' : '_list'; ?>">
														<a class="nav-link a_sub_menu_estates" href="<?php echo site_url('').'estates/'.$estate->estate_slug; ?>"><?php echo $estate->estate_name; ?></a>
															<div class = "sub_menu_categ sub_nav_estates_active<?php echo $key; ?>">
																
															<ul class="ul_sub_menu_categ">
																<img src="<?php echo config_item('website_url').$estate->estate_thumb; ?>">
															<?php
																$fields = [ 'estate_id' => $estate->estate_id, 'group_by' => 'category_name' ];
																$categories = $this->properties_model->get_properties($fields);
																if($categories){
																	foreach ($categories as $key => $category) {
															?>
																	<li class="li_sub_menu_categ">
																		
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
																							<li class="nav-item">

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
				<?php if($url_current[0] != "search"){ echo $this->load->view('website/global_search_index'); } ?>
		</div>

	</nav>

		<div class="nav_search_button_mobile">
			<i class="fa fa-search " aria-hidden="true"></i>
		</div>

	<?php echo $content; ?>
	<?php $this->load->model('website/pages_model'); ?>
	<div id="footer">
		<div class="footer_content container">
			<div class="row">
				<div class="col-sm-4 address">
					<a class="" href="<?php echo site_url(''); ?>"><img src="<?php echo base_url(); ?>data/photos/ortigaslogo_white.png"></a>

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
				</div>
			</div>
		</div>
	</div>
	

	<script>
		var site_url = '<?php echo site_url(); ?>';
		var csrf_name = '<?php echo $this->security->get_csrf_token_name() ?>';
	</script>

		<!-- JavaScript files-->
	<script src="<?php echo site_url('npm/jquery/jquery.min.js'); ?>"></script>
	<script src="<?php echo site_url('npm/popper.js/umd/popper.min.js'); ?>"> </script>
	<script src="<?php echo site_url('npm/bootstrap/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo site_url('npm/jquery.cookie/jquery.cookie.js'); ?>"></script>
	<script src="<?php echo site_url('npm/alertify/lib/alertify.min.js'); ?>"></script>
	
	<script src="<?php echo site_url('themes/default/js/scripts.min.js'); ?>"></script>
	<script src="<?php echo site_url('themes/default/js/template_custom.js'); ?>"></script>

	<?php echo $_scripts; // loads additional js files from the module ?>
</body>
</html>