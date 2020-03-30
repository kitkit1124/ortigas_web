<?php // Adds X-Frame-Options to HTTP header, so that page can only be shown in an iframe of the same site.
header('X-Frame-Options: SAMEORIGIN'); // FF 3.6.9+ Chrome 4.1+ IE 8+ Safari 4+ Opera 

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php echo $head; ?>

	<title><?php echo $page_heading; ?> | <?php echo config_item('website_name'); ?></title>


	<!-- Start of oclp Zendesk Widget script -->
	<!-- <script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=fd0f7982-b94d-4c07-8176-69dbf81d7a0b"> </script> -->

	<!-- BEGIN JIVOSITE CODE {literal} -->
	<!-- <script type='text/javascript'>
	(function(){ var widget_id = 'C9krjKl6x0';
	var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);})();</script> -->
	<!-- {/literal} END JIVOSITE CODE -->


	<!-- End of oclp Zendesk Widget script -->

	<!-- bootstrap & fontawesome -->
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('npm/font-awesome/css/font-awesome.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('npm/alertify/themes/alertify.core.css'); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('npm/alertify/themes/alertify.bootstrap.css'); ?>" />
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo site_url('npm/bootstrap/css/bootstrap.min.css'); ?>">
	
	
	 -->
	
	


	<link rel="shortcut icon" type="text/css" href="<?php echo site_url('themes/default/img/favicon.ico'); ?>">


		<!-- <link rel="stylesheet" type="text/css" href="<?php //echo site_url('data/fonts/fontface.css'); ?>"> -->
<style type="text/css">
@font-face {
    font-family: Gotham-Book;
    src: url("<?php echo site_url('themes/default/fonts/Gotham-Book.otf'); ?>")  format("opentype");
}
</style>
	<?php echo $_styles; // loads additional css files ?>

</head>

<body> 

	

	<?php echo $content; ?>

<div id="modal-sm" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      ...
    </div>
  </div>
</div>
 

<div class="modal" id="modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">
							<span aria-hidden="true">&times;</span>
							<span class="sr-only"><?php echo lang('close')?></span>
						</button>
						<h4 class="modal-title" id="myModalLabel"><?php echo lang('loading')?></h4>
					</div>
					<div class="modal-body">
						<div class="text-center">
							<img src="<?php echo site_url('ui/images/loading3.gif')?>" alt="<?php echo lang('loading')?>" />
							<p><?php echo lang('loading')?></p>
						</div>
					</div>

				</div>
			</div>
		</div>


	<script>
		var site_url = '<?php echo site_url(); ?>';
		var uri_string = '<?php echo uri_string(); ?>';
		var upload_url = '<?php echo getenv('UPLOAD_ROOT'); ?>';
		var csrf_name = '<?php echo $this->security->get_csrf_token_name() ?>';

	</script>

		<!-- JavaScript files-->
	<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="<?php echo site_url('npm/popper.js/umd/popper.min.js'); ?>"> </script>

	<script src="<?php echo site_url('npm/jquery.cookie/jquery.cookie.js'); ?>"></script>
	<script src="<?php echo site_url('npm/alertify/lib/alertify.min.js'); ?>"></script> -->

	<script src="<?php echo site_url('npm/jquery/jquery.min.js'); ?>"></script>
	<script src="<?php echo site_url('npm/popper.js/umd/popper.min.js'); ?>"> </script>
	<script src="<?php echo site_url('npm/bootstrap/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo site_url('npm/jquery.cookie/jquery.cookie.js'); ?>"></script>
	<script src="<?php echo site_url('npm/alertify/lib/alertify.min.js'); ?>"></script>
	
	<script src="<?php echo site_url('themes/default/js/scripts.js'); ?>"></script>
	<script src="<?php echo site_url('themes/default/js/scripts.min.js'); ?>"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/jquery.validate.min.js" crossorigin="anonymous"></script>

	<?php echo $_scripts; // loads additional js files from the module ?>



</body>
</html>