<?php include ('../includes/header.php'); ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">My Account</h1>
        <ol class="breadcrumb mb-4 mt-3">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item">My Account</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <?php
                    $userID = $_SESSION['auth_user']['user_id'];
                    $user_qry = $con->query("SELECT * FROM user WHERE user_id = $userID ");
                    $user = $user_qry->fetch_assoc();
                ?>
                <form action="myaccount_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <h4>My Account info
                                <div class="float-end">
                                    <button type="submit" name="btn_update_account" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="fname">First Name</label>
                                    <input type="text" class="form-control" id="fname" value="<?=$user['fname']?>" disabled>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="mname">Middle Name</label>
                                    <input type="text" class="form-control" id="mname" value="<?=$user['mname']?>" disabled>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="lname">Last Name</label>
                                    <input type="text" class="form-control" id="lname" value="<?=$user['lname']?>" disabled>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="suffix">Suffix</label>
                                    <input type="text" class="form-control" id="suffix" value="<?=$user['suffix']?>" disabled>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="gender">Gender</label>
                                    <input type="text" class="form-control" id="gender" value="<?=$user['gender']?>" disabled>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" placeholder="Enter Email" name="email" id="email" value="<?=$user['email']?>" required>
                                    <div id="email-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" class="form-control" placeholder="Enter Phone" name="phone" maxlength="11" id="phone" value="<?=$user['phone']?>" required>
                                    <div id="phone-error"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <br>
                <!-- Change password card-->
                <div class="card mb-4">
                    <div class="card-header"><h4>Change Password</h4></div>
                    <div class="card-body">
                        <form action="myaccount_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
                            <!-- Form Group (current password)-->
                            <div class="mb-3">
                                <label class="small mb-1 required" for="currentPassword">Current Password</label>
                                <a href="javascript:void(0)" class="password-toggle float-end text-decoration-none" onclick="togglePassword('currentPassword')">
                                    <i class="fa fa-eye"></i> Show
                                </a>
                                <input class="form-control" id="currentPassword" name="currentPassword" type="password" placeholder="Enter current password" required />
                                <i style="font-size: 0.85rem;">Leave this blank if you don't want to change the password...</i>
                            </div>

                            <!-- Form Group (new password)-->
                            <div class="mb-3">
                                <label class="small mb-1 required" for="newPassword">New Password</label>
                                <a href="javascript:void(0)" class="password-toggle float-end text-decoration-none" onclick="togglePassword('newPassword')">
                                    <i class="fa fa-eye"></i> Show
                                </a>
                                <input class="form-control" id="newPassword" name="newPassword" type="password" placeholder="Enter new password" required />
                            </div>

                            <!-- Form Group (confirm password)-->
                            <div class="mb-3">
                                <label class="small mb-1 required" for="confirmPassword">Confirm Password</label>
                                <a href="javascript:void(0)" class="password-toggle float-end text-decoration-none" onclick="togglePassword('confirmPassword')">
                                    <i class="fa fa-eye"></i> Show
                                </a>
                                <input class="form-control" id="confirmPassword" name="confirmPassword" type="password" placeholder="Confirm new password" required />
                                <div id="cpassword-error" style="margin-top: 0.5rem;"></div>
                            </div>
                            <button class="btn btn-primary float-end" type="submit" name="btn_change_password"><i class="fas fa-save"></i> Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Password validation -->
<script>
    // Get references to the password fields and label
    const passwordInput = document.getElementById('newPassword');
    const confirmPasswordInput = document.getElementById('confirmPassword');
    var cpasswordNameError = document.getElementById("cpassword-error");

    // Function to check if passwords match and update required class
    function checkPasswords() {

        if (passwordInput.value !== confirmPasswordInput.value) {
            confirmPasswordInput.setCustomValidity("Passwords do not match");
            $('#cpassword-error').text('Passwords do not match').css('color', 'red');
            $('#cpassword').addClass('is-invalid');
            $('#btn_change_password').prop('disabled', true);
        } else {
            $('#cpassword-error').empty();
            $('#cpassword-input').removeClass('is-invalid');
            $('#btn_change_password').prop('disabled', false);
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
<?php include ('../includes/bottom.php'); ?>