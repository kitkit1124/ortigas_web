<div class="modal-header"> 
	<button type="button" class="close" data-dismiss="modal">
		<span aria-hidden="true">&times;</span> 
		<span class="sr-only"><?php echo lang('button_close')?></span>
	</button>
</div>

<div class="modal-body">
	<iframe style= "width: 100%;height: 650px;" name="myiframe" id="myiframe" src="<?php echo base_url('/data/pdf/Reservation-Agreement-Form-2019-v1.pdf') ?>"></iframe>
</div>

<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">
		<i class="fa fa-times"></i> <?php echo lang('button_close'); ?>
	</button>
	
</div>
<script type="text/javascript">
 var app_url = "<?php echo base_url(); ?>";
</script>