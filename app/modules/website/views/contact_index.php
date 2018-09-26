<main role="main" class="container">
	<div class="content">
		<h1><?php echo $page_heading; ?></h1>
		<p class="lead">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...</p>
	</div>
	<?php $return = ($this->input->get('return')) ? '?return=' . urlencode($this->input->get('return')) : ''; ?>
	<?php echo form_open(current_url() . $return);?>
		<div class="row">
			<div class="col-sm">

				<div class="form-group">
					<?php echo form_input(array('id'=>'name', 'name'=>'name', 'value'=>set_value('name'), 'class'=>'form-control', 'placeholder'=>lang('name')));?>
					<?php echo form_error('name'); ?>
				</div>

				<div class="form-group">
					<?php echo form_input(array('id'=>'email', 'name'=>'email', 'value'=>set_value('email'), 'class'=>'form-control', 'placeholder'=>lang('email')));?>
					<?php echo form_error('email'); ?>
				</div>
		
				<div class="form-group">
					<?php echo form_input(array('id'=>'phone', 'name'=>'phone', 'value'=>set_value('phone'), 'class'=>'form-control', 'placeholder'=>lang('phone')));?>
					<?php echo form_error('phone'); ?>
				</div>

				<div class="form-group">
					<?php echo form_input(array('id'=>'subject', 'name'=>'subject', 'value'=>set_value('subject'), 'class'=>'form-control', 'placeholder'=>lang('subject')));?>
					<?php echo form_error('subject'); ?>
				</div>

				<div class="form-group">
					<?php echo form_textarea(array('id'=>'content', 'name'=>'content', 'rows'=>'3', 'value'=>set_value('content'), 'class'=>'form-control', 'placeholder'=>lang('content'))); ?>
					<?php echo form_error('content'); ?>
				</div>

				<div class="form-group">
					<div class="g-recaptcha" data-sitekey="6LesgDEUAAAAACnHdg78NXeQ--Iy1Fp7C4b32RF9"></div>
					<?php echo form_error('g-recaptcha-response'); ?>
				</div>

				<div class="form-group">
					<button id="submit" type="submit" class="btn btn-lg btn-success">
						<span class="fa fa-send"></span> SEND
					</button>
				</div>

			</div>

			<div class="col-sm">
				<div class="google-maps">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.206901707607!2d121.07216671505488!3d14.587283081313162!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c808abaef137%3A0xdd2ab4e5438fc1a8!2sValle+Verde+5!5e0!3m2!1sen!2sph!4v1505972548418" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
			</div>
		</div>

		<?php echo form_hidden('submit', 1); ?>
		<?php echo form_hidden('return', ($this->input->get('return') ? $this->input->get('return') : '')); ?>
	</form>
</main>
<script src='https://www.google.com/recaptcha/api.js'></script>