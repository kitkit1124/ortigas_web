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
		width: 140px;
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
		margin-left: 10px;
		font-family: Helvetica;
	}
</style>
</head>
<body>
	<h1>Career Inquiry Notification</h1>
	<table border="0">
		<tr>
			<td class="label">Position<span>:</span></td>
			<td class="eval"><?php echo $job_career_id; ?></td>
		</tr>
		<tr>
			<td class="label">Division<span>:</span></td>
			<td class="eval"><?php echo $job_division; ?></td>
		</tr>
		<tr>
			<td class="label">Department<span>:</span></td>
			<td class="eval"><?php echo $job_department; ?></td>
		</tr>
		<tr>
			<td class="label">Name<span>:</span></td>
			<td class="eval"><?php echo $job_applicant_name; ?></td>
		</tr>
		<tr>
			<td class="label">Email<span>:</span></td>
			<td class="eval"><?php echo $job_email; ?></td>
		</tr>

		<?php if(isset($job_mobile) && $job_mobile): ?>
		<tr>
			<td class="label">Mobile Number<span>:</span></td>
			<td class="eval"><?php echo $job_mobile; ?></td>
		</tr>
		<?php endif; ?>

		<?php if(isset($job_referred) && $job_referred): ?>
			<tr>
				<td class="label">Referred by<span>:</span></td>
				<td class="eval"><?php echo $job_referred; ?></td>
			</tr>
		<?php endif; ?>


	</table>
</body>
</html>