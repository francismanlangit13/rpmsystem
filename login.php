<?php
    include ('db_conn.php');
    if(isset($_SESSION['auth'])){
        if ($_SESSION['auth_role'] == "Admin"){
            if(!isset($_SESSION['status'])){
            $_SESSION['status'] = "You are already logged in";
            $_SESSION['status_code'] = "error";
            }
            header("Location: " . base_url . "admin");
            exit(0);
        }
        elseif ($_SESSION['auth_role'] == "Staff"){
            if(!isset($_SESSION['status'])){
            $_SESSION['status'] = "You are already logged in";
            $_SESSION['status_code'] = "error";
            }
            header("Location: " . base_url . "staff");
            exit(0);
        }
        elseif ($_SESSION['auth_role'] == "Renter"){
            if(!isset($_SESSION['status'])){
            $_SESSION['status'] = "You are already logged in";
            $_SESSION['status_code'] = "error";
            }
            header("Location: " . base_url . "renter");
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
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login | Rental Properties Management System</title>
        <!-- Favicons -->
        <link rel="shortcut icon" href="<?php echo base_url ?>assets/files/system/system_logo.jpg" type="image/x-icon">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url ?>assets/files/system/system_logo.jpg">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url ?>assets/files/system/system_logo.jpg">
        <link href="<?php echo base_url ?>assets/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <!-- Include Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row d-flex align-items-center justify-content-center" style="min-height: 100vh;">
                            <div class="col-lg-6">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                        <h5 class="text-center my-4">Rental Properties Management System</h5>
                                        <h4 class="text-center my-4">Login</h4>
                                    </div>
                                    <div style="text-align: center;">
                                        <img class="zoom img-fluid img-bordered-sm" src="<?php echo base_url ?>assets/files/system/system_logo.jpg" alt="image" style="max-width: 160px; object-fit: cover;">
                                    </div>
                                    <div class="card-body">
                                        <form action="logincode.php" method="POST">
                                            <div class="form-floating mb-3">
                                                <input type="email" class="form-control" id="email" name="email" autocomplete="on">
                                                <label for="email">Email address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" id="password" name="password">
                                                <label for="password">Password</label>
                                                <a href="javascript:void(0)"  style="position: relative; top: -2.5rem; left: -3%; cursor: pointer; color: black;">
                                                    <span class="password-toggle float-end"><i class="fa fa-eye"></i> Show</span>
                                                </a>
                                            </div>
                                            <small>By clicking login, you agree to the <a class="text-decoration-none" href="javascript:void(0);" data-toggle="modal" data-target="#System_Terms">terms</a> and <a class="text-decoration-none" href="javascript:void(0);" data-toggle="modal" data-target="#System_Privacy">privacy policy</a>.</small>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="forgot.php">Forgot Password?</a>
                                                <button type="submit" name="btn_login" class="btn btn-primary">Login</button>
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
        <!-- Modal System Privacy Policy -->
        <div class="modal fade" id="System_Privacy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Rental Properties Management System - Privacy Policy</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="text-align: justify;">
                        <b>1. Introduction</b><br>
                        Welcome to Rental Properties Management System ("we," "us," or "our"). We are committed to protecting your privacy and providing a secure experience when using our system. This Privacy Policy outlines how we collect, use, disclose, and safeguard your personal information.
                        <br>
                        <b>2. Information We Collect</b><br>
                        2.1 Personal Information:<br>
                        We may collect personal information such as names, contact details, and payment information when you register for an account or use our system.<br>
                        2.2 Usage Information:<br>
                        We gather information about your interactions with our system, including pages visited, features used, and other user activities.<br>
                        2.3 Device Information:<br>
                        We may collect information about the device you use to access our system, including device type, operating system, and browser type.
                        <br>
                        <b>3. How We Use Your Information</b><br>
                        We use the collected information for the following purposes:<br>
                        To provide and improve our services.<br>
                        To personalize your experience.<br>
                        To process transactions and payments.<br>
                        To communicate with you regarding your account and system updates.<br>
                        To comply with legal obligations.<br>
                        <b>4. How We Share Your Information</b><br>
                        We do not sell, trade, or rent your personal information to third parties. We may share your information in the following circumstances:<br>
                        With your consent.<br>
                        To comply with legal requirements.<br>
                        To provide services on our behalf, such as payment processing.<br>
                        <b>5. Security</b><br>
                        We take reasonable measures to protect your information from unauthorized access, use, or disclosure. However, no method of transmission over the internet or electronic storage is entirely secure, and we cannot guarantee absolute security.
                        <br>
                        <b>6. Cookies and Similar Technologies</b><br>
                        Our system may use cookies and similar technologies to enhance your experience. You can manage your preferences for these technologies through your browser settings.
                        <br>
                        <b>7. Third-Party Links</b><br>
                        Our system may contain links to third-party websites or services. We are not responsible for the privacy practices of these third parties, and we encourage you to review their privacy policies.
                        <br>
                        <b>8. Changes to This Privacy Policy</b><br>
                        We may update this Privacy Policy from time to time. Any changes will be posted on this page, and the effective date will be updated accordingly.
                        <br>
                        <b>9. Contact Us</b><br>
                        If you have any questions or concerns about this Privacy Policy, please contact us at <a href="mailto:jbenzlomo@gmail.com" target="_blank">jbenzlomo@gmail.com</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal System Terms And Conditions -->
        <div class="modal fade" id="System_Terms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Rental Properties Management System - Terms and Conditions</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="text-align: justify;">
                        <b>1. Acceptance of Terms</b><br>
                        By accessing or using the Rental Properties Management System (the "System"), you agree to comply with and be bound by the following terms and conditions. If you do not agree to these terms, please do not use the System.<br><br>
                        <b>2. System Description</b><br>
                        The System is designed to facilitate the management of rental properties, including but not limited to property listings, tenant information, lease agreements, and financial transactions.<br><br>
                        <b>3. User Accounts</b><br>
                        3.1 You must create an account to use certain features of the System. You are responsible for maintaining the confidentiality of your account information.<br>
                        3.2 You agree to provide accurate and complete information when creating your account and to update your information to keep it accurate and current.<br><br>
                        <b>4. Use of the System</b><br>
                        4.1 You agree to use the System only for lawful purposes and in compliance with all applicable laws and regulations.<br>
                        4.2 You may not use the System in any manner that could damage, disable, overburden, or impair the System or interfere with any other party's use and enjoyment of it.<br><br>
                        <b>5. Data Privacy</b><br>
                        5.1 We respect your privacy and handle your personal information in accordance with our Privacy Policy.<br>
                        5.2 You grant us the right to use, store, and process your data in accordance with the terms of our Privacy Policy.<br><br>
                        <b>6. Payment and Fees</b><br>
                        6.1 Certain features of the System may require payment of fees. You agree to pay all fees and charges incurred in connection with your account.<br>
                        6.2 Fees are non-refundable unless otherwise stated.<br><br>
                        <b>7. Intellectual Property</b><br>
                        7.1 The System and its original content, features, and functionality are owned by us and are protected by international copyright, trademark, patent, trade secret, and other intellectual property or proprietary rights laws.<br>
                        7.2 You may not reproduce, distribute, modify, create derivative works of, publicly display, publicly perform, republish, download, store, or transmit any of the material on our System.<br><br>
                        <b>8. Lease Term</b><br>
                        The lease term shall commence on Start Date and terminate on End Date, unless otherwise terminated in accordance with the terms of this Agreement.<br><br>
                        <b>9. Rent Payment</b><br>
                        9.1 The Tenant agrees to pay rent in the amount of Rent Amount on or before the Due Date of each month.<br>
                        9.2 Late payments may incur a late fee of Late Fee Amount if received after Grace Period.<br><br>
                        <b>10. Security Deposit</b><br>
                        10.1 The Tenant shall provide a security deposit in the amount of Security Deposit Amount upon signing this Agreement.<br>
                        10.2 The security deposit will be returned within Number of Days days after the termination of this Agreement, less any deductions for damages or unpaid rent.<br><br>
                        <b>11. Maintenance and Repairs</b><br>
                        11.1 The Tenant is responsible for maintaining the Property in good condition and promptly reporting any damages to the Landlord.<br>
                        11.2 The Landlord will be responsible for necessary repairs not caused by the Tenant's negligence.<br><br>
                        <b>12. Utilities</b><br>
                        The Tenant agrees to pay for all utilities, including but not limited to electricity, water, gas, and internet, unless otherwise specified in writing by the Landlord.<br><br>
                        <b>13. Occupancy</b><br>
                        13.1 The Tenant agrees that the Property will be occupied only by the individuals listed in this Agreement.<br>
                        13.2 Subleasing is not permitted without written consent from the Landlord.<br><br>
                        <b>14. Termination</b><br>
                        14.1 Either party may terminate this Agreement with written notice of at least Number of Days days prior to the intended termination date.<br>
                        14.2 Termination by the Tenant without proper notice may result in forfeiture of the security deposit.<br><br>
                        <b>15. Rules and Regulations</b><br>
                        The Tenant agrees to comply with all rules and regulations outlined by the Landlord, including those related to noise, pets, and use of common areas.<br><br>
                        <b>16. Changes to Terms</b><br>
                        We reserve the right to modify or revise these Terms at any time. Your continued use of the System constitutes acceptance of such modifications.<br><br>
                        <b>17. Governing Law</b><br>
                        These Terms shall be governed by and construed in accordance with the laws of the Philippines.
                    </div>
                </div>
            </div>
        </div>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url ?>assets/js/scripts.js"></script>
        <script src="<?php echo base_url ?>assets/js/sweetalert.js"></script>
        <!-- Show password login JavaScript -->
        <script src="<?php echo base_url ?>assets/js/show-password-login.js"></script>
        <?php include ('message.php'); ?>
    </body>
</html>
