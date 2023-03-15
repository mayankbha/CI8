<!-- Page Content -->
<div class="container-fluid p-0 bg-green">
  <div class="container row-first">
    <div class="inner-main">
      <div class="inner-sec">
        <div class="row" style="min-height:350px;">
           
           <section id="section-pricing" class="section-pricing">
     <h2>Packages</h2>
			<div class="pricing-table">
			<div class="row">

			<?php if(!empty($packages)){ ?>
			<?php foreach($packages as $pack){ 
			$price = number_format($pack['package_price']) * 100 ;	?>
			<!-- First package -->
			<div class="col-md-4">
				<div class="package">
					<div class="header-package-1 text-center">
					<h3><?php echo $pack['package_title']; ?></h3>
					<h3><?php echo $pack['package_duration']; ?> Months</h3>
					<div class="price"><h4><?php echo $pack['package_price']; ?></h4></div>
					</div>

					<!-- details -->
					<div class="package-features text-center">
						<form action="<?php echo base_url('/Package/pay') ?>" method="post" >
							<input type="hidden" name="package_id" value="<?php echo $pack['package_id']; ?>" />
							<ul>
							<?php
								$courses = get_package_courses($pack['package_id']);
								if($courses){
									foreach ($courses as $cor){ ?>
										<li><?php echo $cor['course_title'] ?></li>
								<?php
									}
								}
							?>
							</ul>
							<?php if ( !$this->session->userdata('loggedin') ){ ?>
								<div class="wrp-button text-center"> <a href="<?php echo base_url('/Login/buy') ?>" class="btn standard-button  ">Login To Pay</a></div>
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
							</div>
						</form>
					</div>
				</div>
			<?php } ?>
			<?php } ?>

			</div> 
			</div>

			</section>
			</div>
      </div>
    </div>
  </div>
</div>