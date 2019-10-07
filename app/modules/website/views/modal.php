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
					$input = '<input type="email" id="subscription_email" placeholder="Enter your E-mail Address">';
					$button = '<a id="subscribe_modal" class="subscribe_button_modal">Subscribe</a>';
					$content = preg_replace("{{{subscribe}}}", $input, $content);
					$content = preg_replace("{{{subscribe_button}}}", $button, $content);
					echo parse_content($content);
				?>
				</center>
		</div>
	</div>	
<?php } ?>

	
	