<html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('npm/bootstrap/css/bootstrap.min.css'); ?>">
<style type="text/css">

	body{
		font-family: Helvetica;
	}
	.label{
		color: #07793F;
		text-transform: uppercase;
		font-weight: bold;
		letter-spacing: -1px;
		width: 150px;
		vertical-align: top;
	}
	.label span{
		float: right;
		text-align: right;
	}
	td.eval {
		max-width: 600px;
	}
	td{
		margin: 5px;
		padding: 5px;
		display: inline-block;
		font-family: Helvetica;
	}
	h1{
		color: #07793F;
		margin-left: 15px;
	}
</style>
</head>
<body>
	<h1>Inquiry Notification</h1>
	<table border="0">
		<tr>
			<td class="label">Inquiry Type<span>:</span></td>
			<td class="eval"><?php echo $message_section; ?></td>
		</tr>
		<tr>
			<td class="label">Subject<span>:</span></td>
			<td class="eval"><?php echo $message_section_id; ?></td>
		</tr>
		<tr>
			<td class="label">Name<span>:</span></td>
			<td class="eval"><?php echo $message_name; ?></td>
		</tr>
		<tr>
			<td class="label">Email<span>:</span></td>
			<td class="eval"><?php echo $message_email; ?></td>
		</tr>

		<?php if(isset($message_mobile) && $message_mobile): ?>
		<tr>
			<td class="label">Mobile Number<span>:</span></td>
			<td class="eval"><?php echo $message_mobile; ?></td>
		</tr>
		<?php endif; ?>

		<?php if(isset($message_location) && $message_location): ?>
			<tr>
				<td class="label">Location<span>:</span></td>
				<td class="eval"><?php echo $message_location; ?></td>
			</tr>
		<?php endif; ?>

		<?php if(isset($message_content) && $message_content): ?>
			<tr>
				<td class="label">Message<span>:</span></td>
				<td class="eval"><?php echo $message_content; ?></td>
			</tr>
		<?php endif; ?>
	</table>
</body>
</html>