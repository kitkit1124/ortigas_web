<link href="<?php echo site_url('npm/dropzone/dropzone.min.css'); ?>" rel="stylesheet" type="text/css" />
<div class="modal-header">
	<h5 class="modal-title" id="modalLabel"><?php echo lang('button_upload')?></h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<div class="modal-body">
	<div class="form">
		<?php echo form_open(site_url('files/images/upload'), array('class'=>'dropzone', 'id'=>'dropzone'));?>
			<div class="fallback">
				<input name="file" type="file"/>
			</div>
		<?php echo form_close();?> 
	</div>
</div>

<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">
		<i class="fa fa-times"></i> <?php echo lang('button_close')?>
	</button>
</div>	
<script>
var site_url = '<?php echo site_url() ?>';
</script>

