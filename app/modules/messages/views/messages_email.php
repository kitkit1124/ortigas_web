<html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('npm/bootstrap/css/bootstrap.min.css'); ?>">
<?php $this->template->add_css(module_css('message', 'email_message'), 'embed'); ?>
</head>
<body>
<div class="content">
	<div class="row">
		<div class="col-sm-3">Inquirty Type:</div>
		<div class="col-sm-6"><?php echo $message_section; ?></div>
	</div>
	<div class="row">
		<div class="col-sm-3">Subject</div>
		<div class="col-sm-6"><?php echo $message_section_id; ?></div>
	</div>
	<div class="row">
		<div class="col-sm-3">Name:</div>
		<div class="col-sm-6"><?php echo $message_name; ?></div>
	</div>
	<div class="row">
		<div class="col-sm-3">Email:</div>
		<div class="col-sm-6"><?php echo $message_email; ?></div>
	</div>

	<?php if(isset($message_mobile) && $message_mobile): ?>
	<div class="row">
		<div class="col-sm-3">Mobile Number:</div>
		<div class="col-sm-6"><?php echo $message_mobile; ?></div>
	</div>
	<?php endif; ?>

	<?php if(isset($message_location) && $message_location): ?>
		<div class="row">
			<div class="col-sm-3">Location:</div>
			<div class="col-sm-6"><?php echo $message_location; ?></div>
		</div>
	<?php endif; ?>

	<?php if(isset($message_content) && $message_content): ?>
		<div class="row">
			<div class="col-sm-3">Message:</div>
			<div class="col-sm-6"><?php echo $message_content; ?></div>
		</div>
	<?php endif; ?>
</div>
</body>
</html>