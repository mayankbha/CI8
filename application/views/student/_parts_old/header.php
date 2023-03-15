
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?php echo !empty($page_title) ? $page_title : 'Keen Kids'; ?></title>
        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom fonts for this template -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- Custom styles for this template -->
        <link href="<?php echo base_url(); ?>assets/css/modern-business.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/style.css" type="text/css" rel="stylesheet"/>

        <!-- Bootstrap core JavaScript -->
        <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
    </head>
    <body>
        <!-- Navigation -->
        <header>
            <div class="container-fluid p-0">
                <div class="top-head inner-head">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 text-right">
                                <ul class="nav justify-content-end">
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo base_url('student/account'); ?>">My Account</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo base_url('student/account/logout'); ?>">Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="container top-hd-in">
                        <div class="row logo-mn"> <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/logo.png"></a> </div>
                        <div class="">
                            <nav class="navbar navbar-toggleable-lg navbar-inverse">
                                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarExample" aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>

                                    <div class="collapse navbar-collapse justify-content-md-center" id="navbarExample">
                                        <ul class="navbar-nav mr-auto">
                                            <li class="nav-item"> <a class="nav-link" href="<?php echo base_url(); ?>">Home</a> </li>
                                            <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('page/about'); ?>">About</a> </li>
                                            <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Products </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog"> <a class="dropdown-item" href="#">Product 01</a> <a class="dropdown-item" href="#">Product 01</a> <a class="dropdown-item" href="#">Product 01</a> </div>
                                        </li>
                                        <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('page/contact'); ?>">Contact</a> </li>
                                    </ul>
                                </div>

                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
