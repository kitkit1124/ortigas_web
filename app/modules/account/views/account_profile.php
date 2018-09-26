<div class="content row">
	<div class="col-sm-3 col-md-2">
		<div class="list-group">
			<a href="<?php echo site_url('account'); ?>" class="list-group-item">
				<i class="fa fa-fw fa-dashboard"></i> Dashboard
			</a>

			<a href="<?php echo site_url('account/profile'); ?>" class="list-group-item active">
				<i class="fa fa-fw fa-user"></i> Profile
			</a>
			<a href="<?php echo site_url('account/logout'); ?>" class="list-group-item">
				<i class="fa fa-fw fa-sign-out"></i> Logout
			</a>
		</div>
	</div>
	<div class="col-sm-9 col-md-10">

		<h2>
			<?php echo $page_heading; ?>
			<?php if ($this->acl->restrict('users.users.profile', 'return')): ?>
				<a href="<?php echo site_url('account/edit')?>" data-toggle="modal" data-target="#modal" class="btn btn-sm btn-success pull-right"><span class="fa fa-pencil"></span> <?php echo lang('button_update')?></a>
			<?php endif; ?>
		</h2>
		<p>Please setup your account information.  </p>

		<div class="row top-margin4">
			<div class="col-sm-2">
				<img src="<?php echo site_url($record->photo); ?>" class="img-responsive img-circle" />
			</div>
			<div class="col-sm-6">
				<table class="table table-striped table-hover">
					<tr>
						<td class="col-sm-4">Account Name:</td>
						<td><?php echo $record->company; ?></td>
					</tr>
					<tr>
						<td>Contact Person:</td>
						<td><?php echo $record->first_name; ?> <?php echo $record->last_name; ?></td>
					</tr>
					<tr>
						<td>Phone/Mobile:</td>
						<td><?php echo $record->phone; ?></td>
					</tr>
					<tr>
						<td>Email Address:</td>
						<td><?php echo $record->email; ?></td>
					</tr>
				</table>
			</div>
		</div>

	</div>
</div>

