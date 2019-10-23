<section id="roles">
	<nav class="navbar navbar-expand-lg">
<div class="container">
<a class="navbar-brand text-center" href="#"><img  class="header_logo" src="<?php echo $this->config->item('assets_url'); ?>data/images/ortigaslogo.png"></a>
</nav>
<div class="container">
  	<div class="row justify-content-md-center">
    	<div class="col-md-7">
			<div class="card" >
			  <div class="card-header "  style="background-color:#0a4233;color:#fff">
			   <i class="fa fa-window-close" aria-hidden="true"></i> Transaction Cancelled
			  </div>
			  <div>
	
			</div>
				<div class="row ">
					<div class="col-6 pr-0">
						<ul class="list-group">
				    		<li class="list-group-item">Merchant Reference No.</li>
				    		<li class="list-group-item"> Paynamics Reference No.</li>
				    		<li class="list-group-item">Transaction Amount</li>
			  			</ul>
					</div>
					<div class="col-6 pl-0">
						<ul class="list-group ">
						    <li class="list-group-item"><?php echo $details->ref_no; ?></li>
						    <li class="list-group-item"><?php echo $details->paynamics_ref_no; ?></li>
						    <li class="list-group-item"> <?php echo $details->reservation_fee; ?></li>
			  			</ul>
					</div>
				</div>
			</div>
     		
    	</div>
  	</div>
</div>
</section>
<script type="text/javascript">
	var site_url = "<?php echo site_url(); ?>";

	
</script>