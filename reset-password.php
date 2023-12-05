<?php include ('db_conn.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Reset Password | Rental Properties Management System</title>
        <!-- Favicons -->
        <link rel="shortcut icon" href="<?php echo base_url ?>assets/files/system/system_logo.jpg" type="image/x-icon">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url ?>assets/files/system/system_logo.jpg">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url ?>assets/files/system/system_logo.jpg">
        <link href="<?php echo base_url ?>assets/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <?php
        if(isset($_SESSION['auth'])){
            if ($_SESSION['auth_role'] == "1"){
                if(!isset($_SESSION['status'])){
                $_SESSION['status'] = "You are already logged in";
                $_SESSION['status_code'] = "error";
                }
                header("Location: " . base_url . "admin");
                exit(0);
            }
            elseif ($_SESSION['auth_role'] == "2"){
                if(!isset($_SESSION['status'])){
                $_SESSION['status'] = "You are already logged in";
                $_SESSION['status_code'] = "error";
                }
                header("Location: " . base_url . "staff");
                exit(0);
            }
            else{
                if(!isset($_SESSION['status'])){
                    $_SESSION['status'] = "Login first to access dashboard";
                    $_SESSION['status_code'] = "error";
                }
                header("Location: " . base_url . "login");
                exit(0);
            }
        }
        if (isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"]) && ($_GET["action"]=="reset") && !isset($_POST["action"])){
        $key = $_GET["key"];
        $email = $_GET["email"];
        $curDate = date("Y-m-d H:i:s");
        $query = mysqli_query($con,"SELECT * FROM `password_reset_temp` WHERE `key`='".$key."' and `email`='".$email."';");
        $row = mysqli_num_rows($query);
        if ($row==""){
            $_SESSION['status'] = "The link is invalid or expired.";
            $_SESSION['status_code'] = "warning";
            header("Location: " . base_url . "forgot");
            exit(0);
        }
        else{
            $row = mysqli_fetch_assoc($query);
	        $expDate = $row['expDate'];
	        if ($expDate >= $curDate){
    ?>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row d-flex align-items-center justify-content-center" style="min-height: 100vh;">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                        <h5 class="text-center font-weight-light my-4">Rental Properties Management System</h5>
                                        <h4 class="text-center font-weight-light my-4">Reset Password</h4>
                                    </div>
                                    <div style="text-align: center;">
                                        <img class="zoom img-fluid img-bordered-sm" src="<?php echo base_url ?>assets/files/system/system_logo.jpg" alt="image" style="max-width: 160px; object-fit: cover;">
                                    </div>
                                    <div class="card-body">
                                        <form action="forgotcode.php" method="POST">
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" id="password" name="password" required>
                                                <label for="password">New Password</label>
                                                <a href="javascript:void(0)"  style="position: relative; top: -2.5rem; left: -3%; cursor: pointer; color: black;" onclick="togglePassword('password')">
                                                    <span class="password-toggle float-end"><i class="fa fa-eye"></i> Show</span>
                                                </a>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" id="cpassword" name="cpassword" required>
                                                <label for="cpassword">Confirm Password</label>
                                                <a href="javascript:void(0)"  style="position: relative; top: -2.5rem; left: -3%; cursor: pointer; color: black;" onclick="togglePassword('cpassword')">
                                                    <span class="password-toggle float-end"><i class="fa fa-eye"></i> Show</span>
                                                </a>
                                                <div class="invalid-feedback ml-3" id="cpassword-error"></div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="index"></a>
                                                <input type="hidden" name="email" value = "<?= $email; ?>"/>
                                                <button type="submit" name="changepass_btn" class="btn btn-primary">Update password</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url ?>assets/js/scripts.js"></script>
        <script src="<?php echo base_url ?>assets/js/sweetalert.js"></script>
        <?php include ('message.php'); ?>
        <!-- Password validation -->
        <script>
            // Get references to the password fields and label
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('cpassword');
            var cpasswordNameError = document.getElementById("cpassword-error");

            // Function to check if passwords match and update required class
            function checkPasswords() {

                if (passwordInput.value !== confirmPasswordInput.value) {
                    confirmPasswordInput.setCustomValidity("Passwords do not match");
                } else {
                    confirmPasswordInput.setCustomValidity("");
                }
            }

            // Add event listeners to the password fields
            passwordInput.addEventListener('input', checkPasswords);
            confirmPasswordInput.addEventListener('input', checkPasswords);
        </script>

        <script type="text/javascript">
            function togglePassword(inputId) {
                const passwordInput = document.getElementById(inputId);

                if (passwordInput) {
                    const passwordToggle = passwordInput.parentElement.querySelector('.password-toggle');

                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        if (passwordToggle) {
                            passwordToggle.innerHTML = '<i class="fa fa-eye-slash"></i> Hide';
                        }
                    } else {
                        passwordInput.type = 'password';
                        if (passwordToggle) {
                            passwordToggle.innerHTML = '<i class="fa fa-eye"></i> Show';
                        }
                    }
                }
            }
        </script>
    </body>
    <?php } } } else {
        $_SESSION['status'] = "Method Not Allowed";
        $_SESSION['status_code'] = "error";
        header("Location: " . base_url . "index");
        exit(0);
    } ?>
</html>
