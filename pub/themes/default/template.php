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
	<link rel="stylesheet" href="<?php echo site_url('npm/bootstrap/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo site_url('npm/font-awesome/css/font-awesome.min.css'); ?>">
	
	<link rel="stylesheet" href="<?php echo site_url('npm/alertify/themes/alertify.core.css'); ?>" />
	<link rel="stylesheet" href="<?php echo site_url('npm/alertify/themes/alertify.bootstrap.css'); ?>" />
	
	
	<link rel="stylesheet" href="<?php echo site_url('themes/default/css/styles.min.css'); ?>">
	<link rel="shortcut icon" href="<?php echo site_url('themes/default/img/favicon.png'); ?>">

	<link rel="stylesheet" href="<?php echo site_url('themes/default/css/custom/nav_styles.css'); ?>">

	<?php echo $_styles; // loads additional css files ?>
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
		<div class="oclogo">
			<a class="" href="<?php echo site_url(''); ?>"><img src="<?php echo base_url(); ?>data/images/ortigaslogo.png" width="260px"></a>
		</div>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="main_menu collapse navbar-collapse" id="navbarsExampleDefault">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="<?php echo site_url('estates'); ?>">Estates</a>
					<div class = "sub_menu_estates">
						<ul>
								<?php
								$this->load->model('properties/estates_model');
						
								$estates = $this->estates_model->find_all();

								$this->load->model('properties/properties_model');
								
								if($estates){
									foreach ($estates as $key => $estate) { 
								?>
										<li class="nav-item">
											<a class="nav-link" href="<?php echo site_url('').'estates/'.$estate->estate_slug; ?>"><?php echo $estate->estate_name; ?></a>
												<div class = "sub_menu_categ">
												<ul>
												<?php
													$fields = [ 'estate_id' => $estate->estate_id, 'group_by' => 'category_name' ];
													$categories = $this->properties_model->get_properties($fields);
													if($categories){
														foreach ($categories as $key => $category) {
												?>
														<li>
															
															<a class="nav-link" href="<?php echo site_url('').'estates/category/'.strtolower($category->category_name); ?>"><?php echo $category->category_name; ?></a>
															<div class="sub_menu_properties">
																<ul>
																	<?php
																		$fields = [ 'estate_id' => $estate->estate_id, 'category_id' => $category->category_id ];
																		$properties = $this->properties_model->get_properties($fields);
																		if($properties){
																			foreach ($properties as $key => $property) {
																				if ($property->property_category_id == 3){
																					$link = $property->property_website;
																					$target = '_blank';
																				}
																				else{
																					$link = site_url('').'estates/property/'.$property->property_slug;
																					$target = null;
																				}
																			
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
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo site_url(''); ?>">Established Communities</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo site_url(''); ?>">Careers</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo site_url('contact-us'); ?>">Contact Us</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo site_url('search?r&m&o&n&c'); ?>">Search</a>
				</li>
			</ul>
<!-- 			<ul class="navbar-nav ml-auto">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Account</a>
					<div class="dropdown-menu" aria-labelledby="dropdown01">
						<a class="dropdown-item" href="<?php echo site_url('account/profile'); ?>">Profile</a>
						<a class="dropdown-item" href="<?php echo site_url('account/login'); ?>">Login</a>
					</div>
				</li>
			</ul> -->
			<form class="form-inline my-2 my-lg-0 d-none">
				<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
			</form>
		</div>
	</nav>
	<?php echo $content; ?>

	<script>var site_url = '<?php echo site_url(); ?>';</script>

		<!-- JavaScript files-->
	<script src="<?php echo site_url('npm/jquery/jquery.min.js'); ?>"></script>
	<script src="<?php echo site_url('npm/popper.js/umd/popper.min.js'); ?>"> </script>
	<script src="<?php echo site_url('npm/bootstrap/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo site_url('npm/jquery.cookie/jquery.cookie.js'); ?>"></script>
	<script src="<?php echo site_url('npm/alertify/lib/alertify.min.js'); ?>"></script>
	
	<script src="<?php echo site_url('themes/default/js/scripts.min.js'); ?>"></script>
	<?php echo $_scripts; // loads additional js files from the module ?>
</body>
</html>