<div class="modal-header"> 
	<button type="button" class="close" data-dismiss="modal">
		<span aria-hidden="true">&times;</span> 
		<span class="sr-only"><?php echo lang('button_close')?></span>
	</button>
	<h4 class="modal-title" id="myModalLabel"><?php echo $page_heading?></h4>
</div>

<div class="modal-body">
	<div id="confirm-message" class="callout callout-danger callout-dismissable hide"></div>
	<span class="font-130"><?php echo $page_confirm?></span>
</div>

<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">
		<i class="fa fa-times"></i> <?php echo lang('button_close'); ?>
	</button>

	<button id="confirm-submit" class="btn btn-warning" type="submit" data-loading-text="<?php echo lang('processing')?>">
		<i class="fa fa-check"></i> <?php echo $page_button?>
	</button>
</div>

<script>
$(function(){
	$('#confirm-submit').click(function(e){

		// change the button to loading state
		var btn = $(this);
		btn.button('loading');

		e.preventDefault();

		var ajax_url = "<?php echo current_url(); ?>";
		var ajax_load = '<span class="help-block text-center">Loading...</span>';

		$(ajax_load).load(ajax_url, {
			'confirm': 1,
		}, function(data) {
			var o = jQuery.parseJSON(data);
			if (o.success === false) {
				btn.button('reset');
				alertify.error(o.message);
				$('#modal').modal('hide');
			}
			else {
				<?php if (isset($datatables_id)): ?>
					$('<?php echo $datatables_id; ?>').dataTable().fnDraw(false);
					alertify.success(o.message);
				<?php elseif (isset($redirect_url)): ?>
					window.location.replace('<?php echo $redirect_url; ?>');
				<?php else: ?>
					window.location.reload(true);
				<?php endif; ?>
				$('#modal').modal('hide');
			}

		});
	});
});
</script>