<html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('npm/bootstrap/css/bootstrap.min.css'); ?>">
<style type="text/css">

	h1,p{ font-family: Helvetica;}
	h1{ color: #07793F; }

</style>
</head>
<body>
	<h1>Subscription Notification</h1>
	<p>An email address of <?php echo $subscriber_email; ?> has subscribed to our website. To manage your subscription preferences, please click the url below.</p>
	<a href="<?php echo config_item('website_url'); ?>subscribers/subscribers"  target="_blank"><?php echo config_item('website_url'); ?>subscribers/subscribers. </a>
</body>
</html>