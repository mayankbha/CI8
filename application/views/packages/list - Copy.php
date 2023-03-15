<!-- Page Content -->
<div class="container-fluid p-0 bg-green">
  <div class="container row-first">
    <div class="inner-main">
      <div class="inner-sec">
        <div class="row" style="min-height:350px;">
			<?php if(!empty($packages)){ ?>
				<?php foreach($packages as $pack){ 
						$price = number_format($pack['package_price']) * 100 ;	?>
						<div style="width:127px">
							<form action="<?php echo base_url('/Package/pay') ?>" method="post" >
							<input type="hidden" name="package_id" value="<?php echo $pack['package_id']; ?>" />
							<h2><?php echo $pack['package_title']; ?></h2><br>
							<?php echo $pack['package_duration']; ?><br><br>
							<?php echo $pack['package_price']; ?><br><br>
							<?php if ( !$this->session->userdata('loggedin') ){ ?>
									<a href="<?php echo base_url('/Login/buy') ?>" class="blue-but border-dsh  ">Login To Pay</a>
							<?php
							}else{ ?>
								<script
								src="https://checkout.stripe.com/checkout.js" class="stripe-button"
								data-key="pk_test_jsURXZYH7czp5rJNf1kU6nyw"
								data-amount="<?php echo $price ; ?>"
								data-name="Stripe.com"
								data-description="<?php echo $pack['package_duration']; ?>"
								data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
								data-locale="auto"
								data-zip-code="true">
								</script>
							<?php
							} ?>
							
							</form>
						</div>
				<?php } ?>
			<?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container --> 