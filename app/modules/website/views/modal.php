<?php if(strpos($content, "{{subscribe}}") === false){ ?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		<div class="form">	
				<center><?php echo $content; ?></center>
		</div>
	</div>	
<?php } else { ?>
	<div class="modal-body">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<div id="modal_subs" class="form mt-3">
				<center>
				<?php 
					$input = '<input type="hidden" id="csrf" name="'.$this->security->get_csrf_token_name().'" value="'.$this->security->get_csrf_hash().'" /><input type="email" id="subscription_email" placeholder="Enter your E-mail Address">';
					$button = '<a id="subscribe_modal" class="subscribe_button_modal">Subscribe</a>';
					$content = preg_replace("{{{subscribe}}}", $input, $content);
					$content = preg_replace("{{{subscribe_button}}}", $button, $content);
					echo parse_content($content);
				?>
				</center>
		</div>
	</div>	
	<script>
		$("#subscribe_modal").click(function(){
			// console.log("bakit ganito?");
			var app_url = "<?php echo base_url(); ?>";
			$.ajax({method: "POST",url: site_url + 'subscribers/subscribers/form',
				data: { 
					subscriber_email     : $('#subscription_email').val(),
					[csrf_name]: $('#csrf').val()
				} 
			})
			.done(function(data) {
				// console.log('pasok');
				var o = jQuery.parseJSON(data);
				if (o.success === false) {
					// console.log('bigo');
					// shows the error message
					// alertify.error(o.message);
					$('#subscribe_denied').trigger('click');
					// displays individual error messages
					if (o.errors) {
					for (var form_name in o.errors) {

						$('#error-' + form_name).html(o.errors[form_name]);

						$('#error-' + form_name + ' .text-danger').append('<i class="fa fa-exclamation-circle" aria-hidden="true"></i>');
					}
					}
				} else {
					// console.log('tagumpay');
					$('#subscribe_success').trigger('click');

					$.ajax({method: "GET",url: site_url + 'subscribers/subscribers/form',
						data: { 
							subscriber_email     : $('#subscription_email').val(),
							[csrf_name]: $('#csrf').val()
						} 
					})
				}
			});
		});	
	</script>
<?php } ?>

	
	