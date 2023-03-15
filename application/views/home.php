<!-- Page Content -->
<div class="container-fluid p-0 bg-green">
      <div class="container row-first">
    <div class="row">
          <div class="col-lg-7 border-spl">
        <div class="bg-wight">
              <h1>Welcome</h1>
              <h2>Lorem ipsum dolor sit amet, consectetuer adipiscing elit,</h2>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat,  </p>
            </div>
      </div>
          <div class="col-lg-5 login-bg"> 
			<div class="login-form home-lg">
				<h2>New User Registration</h2>
				<a  style="display:none;" href="<?php echo base_url('register?as=parent'); ?>" class="green-but border-dsh">Parents</a> <span></span><a href="<?php echo base_url('register?as=student'); ?>" class="green-but border-dsh">Student</a> <strong>Or</strong> <br/>
				<a href="<?php echo base_url('login'); ?>" class="blue-but border-dsh  ">Login</a>
			</div>
           </div>
        </div>
    
    <!-- Marketing Icons Section -->
    <div class="row four-part">
          <div class="col-lg-3 mb-4">
        <div class="card-block">
              <p class="card-text"><a href="#">Online<br/>Tutions</a></p>
            </div>
      </div>
          <div class="col-lg-3 mb-4">
        <div class="card-block">
              <p class="card-text"><a href="#">Self Assessments</a></p>
            </div>
      </div>
          <div class="col-lg-3 mb-4">
        <div class="card-block">
              <p class="card-text"><a href="#">Practise Sessions</a></p>
            </div>
      </div>
          <div class="col-lg-3 mb-4 cet-n">
        <div class="card-block">
              <p class="card-text"><a href="#">Certification</a></p>
            </div>
      </div>
        </div>
    <!-- /.row --> 
    
    <!-- Call to Action Section --> 
    
  </div>
    </div>
<div class="container-fluid p-0 bg-green half-circle">
      <div class="bg-wt-last">
    <div class="container">
          <div class="row">
        <div class="col-lg-3 col-sm-3 recom-dt ">
              <h2><a href="#">Good Read Recommendations</a></h2>
              <img src="<?php echo base_url(); ?>assets/images/knowledge-icon.png"> </div>
        <div class="col-lg-3 col-sm-3 social-mg ">
              <h2>Share Your Certification</h2>
              <a href="#" class="fb-book"></a> <a href="#" class="twi-book"></a> <a href="#" class="pint-book"></a> </div>
        <div class="col-lg-6 col-sm-6 news-sld ">
        <h3>News & Updates</h3>
              <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
            <div class="carousel-inner">
                  <?php if($all_news){
						$k=1;
						foreach ($all_news as $news){
							$class= ($k==1) ? "active" : ''; ?>
							<div class="carousel-item  <?php echo $class ?>"> 
								<p><?php echo $news['description']; ?> </p>
								<a href="#">More...</a>
							</div>
			<?php 		$k++;
						} 
					}	?>
                 
                </div>
             </div>
            </div>
      </div>
        </div>
  </div>
    </div>
    <div class="container clr">
    	<div class="testimonial">
        	<h2>Testimonials</h2>
            <div class="section-t">
            	<div id="carouselExampleIndicators-2" class="carousel slide" data-ride="carousel">
             
            <div class="carousel-inner">
			<?php if($testimonials){
						$i=1;
						foreach ($testimonials as $row){
							$class= ($i==1) ? "active" : ''; ?>
						  <div class="carousel-item  <?php echo $class ?>"> 
							<p><?php echo $row['description']; ?> </p>
						  </div>
			<?php 		$i++;
					} 
						}	?>
                </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators-2" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="carousel-control-next" href="#carouselExampleIndicators-2" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
            </div>
        </div>
    </div>
<!-- /.container --> 