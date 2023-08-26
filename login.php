<?php include ('db_conn.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Rental Properties Mamangement System with SMS notifications">
        <meta name="author" content="Management System, Rental Properties, SMS, Generate Reports">
        <!-- Title Page -->
        <title>RPM System | Login</title>
        <!-- Custom fonts for this template-->
        <link href="<?php echo base_url ?>assets/login/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <!-- Custom styles for this template-->
        <link href="<?php echo base_url ?>assets/login/css/sb-admin-2.css" rel="stylesheet">
        <!-- Styles for center login -->
        <style>
            body{
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                background-color: #f8f9fc;
            }
        </style>
    </head>
    <body class="bg-gradient-primary">
        <div class="container">
            <!-- Outer Row -->
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900">Rental Properties Mamangement System</h1>
                                            <hr style="margin-top:5px !important; margin-bottom:5px !important">
                                            <h1 class="h4 text-gray-900 mb-4">LOGIN</h1>
                                        </div>
                                        <form class="user">
                                            <div class="form-group">
                                                <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                            </div>
                                            <a href="index.html" class="btn btn-primary btn-user btn-block">Login</a>
                                        </form>
                                        <label class="h6 text-gray-900 mt-3">By clicking login you agree the <a class="text-decoration-none" href="#">terms and conditions</a> and <a class="text-decoration-none" href="#">privacy policy</a>.</lab>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small text-decoration-none" href="#">Forgot Password?</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript-->
        <script src="<?php echo base_url ?>assets/login/vendor/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url ?>assets/login/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="<?php echo base_url ?>assets/login/vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="<?php echo base_url ?>assets/login/js/sb-admin-2.min.js"></script>
    </body>
</html>