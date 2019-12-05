<?php // Adds X-Frame-Options to HTTP header, so that page can only be shown in an iframe of the same site.
header('X-Frame-Options: SAMEORIGIN'); // FF 3.6.9+ Chrome 4.1+ IE 8+ Safari 4+ Opera 10.5+
// $user = $this->ion_auth->user()->row();
$this->load->model('website/navigation_settings_model');
$this->load->model('website/navigations_model'); 
$this->load->model('website/partials_model'); 
$this->load->model('website/pages_model'); 
$this->load->model('website/seo_model'); 
$this->load->model('properties/estates_model');
$this->load->model('properties/properties_model');
$this->load->model('properties/locations_model');
$nav = $this->navigation_settings_model->find(1);
$nav_color_theme = $nav->nav_setting_color_theme;
?><!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php echo $head; ?>

	<title><?php echo $page_heading; ?> | <?php echo config_item('website_name'); ?></title>

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
		<!-- <link rel="stylesheet" type="text/css" href="<?php //echo site_url('data/fonts/fontface.css'); ?>"> -->
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('themes/default/css/custom/custom_general_styles.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('themes/default/css/custom/footer_styles.css'); ?>">

	<?php echo $_styles; // loads additional css files ?>
</head>

<body> 

	<?php $seo = $this->seo_model->find(2); echo parse_content(html_entity_decode(strip_tags($seo->seo_content)));  ?>
	
	<?php echo $this->load->view('website/navigation_index');?>
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
						<a class="" href="<?php echo site_url(''); ?>"><img src="<?php echo getenv('UPLOAD_ROOT'); ?>data/images/ortigasland.svg"></a>

						<?php $footer = $this->partials_model->find(1); if($footer) { echo parse_content($footer->partial_content); } ?>
					</div>
					<div class="footer_border"></div>
					<div class="col-sm-4 link mt-2">
						<h2 id="explore_title">Explore</h2>
						<ul class="mt-4">
							<?php echo $this->navigations_model->get_footer_navigation(2); ?>
						</ul>
					</div>
					<div class="footer_border"></div>
					<div class="col-sm-4 subscribe mt-3 text-left">
						<?php $subscribe = $this->partials_model->find(2); 
							if($subscribe) {
								$content = $subscribe->partial_content;
								// $input = '<input type="email" id="subscription_email" placeholder="your@email.com"><a class="subscribe_button">Subscribe</a>';
								$input = '<a class="subscribe_button text-center my-5" href="'.site_url().'website/page/show_modal?id=14" data-target="#modal-lg" data-toggle="modal">Subscribe</a>';
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
		<?php //$seo = $this->seo_model->find(4); echo parse_content(html_entity_decode(strip_tags($seo->seo_content)));  ?>
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
						<img src="<?php echo site_url('ui/images/loading3.gif')?>" alt="<?php echo lang('loading')?>"/>
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
						<img src="<?php echo site_url('ui/images/loading3.gif')?>" alt="<?php echo lang('loading')?>" />
						<p><?php echo lang('loading')?></p>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
		
	<?php /*if($nav_color_theme == 'White'){ ?>
		<style type="text/css">
		.oclogo img { filter: brightness(0) invert(1); }
		a.nav-link.base_nav.nav_estates, .nav_search_button i{color: #FFF; }
		</style>
	<?php } ?>
	<?php /*if($is_home){*/ ?>
		<style type="text/css">
		body {  padding-top: 0px; } 
		.navi-bar { background-color: transparent; border-bottom: 1px solid transparent; }
		</style>
	<?php/* }*/*/ ?>

	<script>
		var site_url = '<?php echo site_url(); ?>';
		var uri_string = '<?php echo uri_string(); ?>';
		var upload_url = '<?php echo getenv('UPLOAD_ROOT'); ?>';
		var csrf_name = '<?php echo $this->security->get_csrf_token_name() ?>';
		var is_sGlobal =  "<?php echo isset($is_sGlobal) ? TRUE : FALSE ; ?>";
		var nav_color_theme = "<?php echo $nav_color_theme ?>";
	</script>

		<!-- JavaScript files-->
	<script src="<?php echo site_url('npm/jquery/jquery.min.js'); ?>"></script>
	<script src="<?php echo site_url('npm/popper.js/umd/popper.min.js'); ?>"> </script>
	<script src="<?php echo site_url('npm/bootstrap/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo site_url('npm/jquery.cookie/jquery.cookie.js'); ?>"></script>
	<script src="<?php echo site_url('npm/alertify/lib/alertify.min.js'); ?>"></script>
	
	<script src="<?php echo site_url('themes/default/js/scripts.js'); ?>"></script>
	<script src="<?php echo site_url('themes/default/js/scripts.min.js'); ?>"></script>

	<script src="<?php echo site_url('themes/default/js/parallax.min.js'); ?>"></script>

	<script src="<?php echo site_url('themes/default/js/template_custom.js'); ?>"></script>

	<?php echo $_scripts; // loads additional js files from the module ?>

	<?php if(isset($enable_map) && $enable_map) : ?>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDN6cUNcHO88eddYIc5mo4nW4t-sOPILCE&libraries=places&callback=initMap" type="text/javascript"></script>
	<?php endif;?>
</body>
</html>