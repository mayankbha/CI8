<footer class="py-5 bg-footer clr">
    <div class="container">
        <div class="row top-ft-mg">
            <div class="col-lg-3 col-sm-3 mb-4">
                <div class="card-block logo-mg">
                    <img src="<?php echo base_url(); ?>assets/images/logo.png" width="220">
                </div>
            </div>
            <div class="col-lg-5 col-sm-5 ft-center mb-4">
                <div class="card-block">
                    <ul class="ft-nav">
                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li><a href="<?php echo base_url('page/about'); ?>">About</a></li>
                        <li><a href="#">Products</a></li>
                        <li><a href="<?php echo base_url('page/contact'); ?>">Contact</a></li>
                    </ul>
                </div>
                <div class="ft-social">
                    <h3>Follow Us</h3>
                    <a href="#" class="ft-facebook"></a>
                    <a href="#" class="ft-twitter"></a>
                    <a href="#" class="ft-pintrest"></a>
                </div>
                <p>All Rights Reserved @ 2017</p>
            </div>
            <div class="col-lg-4 col-sm-4 mb-4 add-ft">
                <div class="card-block">
                    <h3>Address:</h3>
                    <p>Lorem ipsum dolor sit amet, ectetuer adipiscing elit,  Lorem ipsum dolor sit amet, ectetuer </p>
                    <p>Email : info@companyname.com</p>
                    <span>Mobile : +123 456 7890</span>
                </div>
            </div>
            <div class="col-lg-12">
                <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
            </div>
        </div>
    </div>
    <!-- /.container -->
</footer>

<script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
