<?php include ('../includes/header.php'); ?>
<style type="text/css">
    #datatablesSimple th:nth-child(7) {
        width: 15% !important;
    }
</style>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Add User</h1>
        <ol class="breadcrumb mb-4 mt-3">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="./user" class="text-decoration-none">Users</a></li>
            <li class="breadcrumb-item">Add User</li>
        </ol>
        <form action="user_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>User form
                                <div class="float-end">
                                    <button type="button" id="submit-btn" data-toggle="modal" data-target="#Modal_Confirm_Terms" class="btn btn-primary"><i class="fas fa-plus"></i> Add</button>
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="fname" class="required">First Name</label>
                                    <input type="text" class="form-control" placeholder="Enter First Name" name="fname" id="fname" required>
                                    <div id="fname-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="mname">Middle Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Middle Name" name="mname" id="mname">
                                    <div id="mname-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="lname" class="required">Last Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Last Name" name="lname" id="lname" required>
                                    <div id="lname-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="suffix">Suffix</label>
                                        <select class="form-control" name="suffix" id="suffix" required>
                                            <option value="" selected>Select Suffix</option>
                                            <option value=" ">None</option>
                                            <option value="Jr">Jr</option>
                                            <option value="Sr">Sr</option>
                                            <option value="I">I</option>
                                            <option value="II">II</option>
                                            <option value="III">III</option>
                                            <option value="IV">IV</option>
                                            <option value="V">V</option>
                                            <option value="VI">VI</option>
                                        </select>
                                        <div id="suffix-error"></div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="gender" class="required">Gender</label>
                                        <select class="form-control" name="gender" id="gender" required>
                                            <option value="" selected disabled>Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        <div id="gender-error"></div>
                                    </div>
                                </div>
    
                                <div class="col-md-4 mb-3">
                                    <label for="email" class="required">Email</label>
                                    <input type="email" class="form-control" placeholder="Enter Email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" id="email" autocomplete="off" required>
                                    <div id="email-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="phone" class="required">Phone Number</label>
                                    <input type="text" class="form-control" placeholder="Enter Phone" name="phone" pattern="09[0-9]{9}" maxlength="11" minlength="11" id="phone" autocomplete="off" required>
                                    <div id="phone-error"></div>
                                </div>

                                <!-- Form Group (password)-->
                                <div class="col-md-4 mb-3">
                                    <label for="password">New Password</label>
                                    <input type="password" name="password" class="form-control" minlength="8" placeholder="New Password" id="password">
                                    <a href="javascript:void(0)" style="position: relative; top: -2rem; left: -8%; cursor: pointer; color: black;" onclick="togglePassword('password')">
                                        <span class="password-toggle float-end"><i class="fa fa-eye"></i> Show</span>
                                    </a>
                                    <div style="position: absolute" id="password-error"></div>
                                </div>

                                <!-- Form Group (confirm password)-->
                                <div class="col-md-4 mb-3">
                                    <label for="cpassword" class="required">Password</label>
                                    <!-- <a href="javascript:void(0)" class="password-toggle float-end text-decoration-none" onclick="togglePassword('password')">
                                        <i class="fa fa-eye"></i> Show
                                    </a> -->
                                    <input type="password" class="form-control" placeholder="Enter Confirm Password" name="cpassword" id="cpassword" required>
									<a href="javascript:void(0)" style="position: relative; top: -2rem; left: -8%; cursor: pointer; color: black;" onclick="togglePassword('cpassword')">
                                        <span class="password-toggle float-end"><i class="fa fa-eye"></i> Show</span>
                                    </a>
                                    <div style="position: absolute" id="cpassword-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="role" class="required">Role</label>
                                        <select class="form-control" name="role" id="role" required>
                                            <option value="" selected>Select Role</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Staff">Staff</option>
                                            <option value="Renter">Rentee</option>
                                        </select>
                                        <div id="role-error"></div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3 d-none" id="Container">
                                    <label for="address" class="required">Address</label>
                                    <textarea type="text" class="form-control" placeholder="Enter Address" rows="3" name="address" id="address" autocomplete="off"></textarea>
                                    <div id="address-error"></div>
                                </div>

                                <div class="col-md-4 mb-3 d-none" id="Container1">
                                    <label for="civil_status" class="required">Civil Status</label>
                                    <select class="form-control" name="civil_status" id="civil_status">
                                        <option value="" selected>Select Civil Status</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Widowed">Widowed</option>
                                        <option value="Separated">Separated</option>
                                    </select>
                                    <div id="civil_status-error"></div>
                                </div>

                                <div class="col-md-4 mb-3 d-none" id="Container2">
                                    <label for="occupation" class="required">Occupation</label>
                                    <input type="text" class="form-control" placeholder="Enter Occupation" name="occupation" id="occupation" autocomplete="off">
                                    <div id="occupation-error"></div>
                                </div>

                                <div class="col-md-4 mb-3 d-none" id="Container3">
                                    <label for="company" class="required">Company</label>
                                    <input type="text" class="form-control" placeholder="Enter Company" name="company" id="company" autocomplete="off">
                                    <div id="company-error"></div>
                                </div>

                                <div class="col-md-4">
                                    <label for="image1" class="required">Valid ID Attachment</label>
                                    <input required type="file" name="image1" class="form-control btn btn-secondary" style="padding-bottom:2.2rem;" id="image1" accept=".jpg, .jpeg, .png" onchange="previewImage('frame1', 'image1')">
                                </div>

                                <div class="col-md-8">
                                </div>

                                <div class="col-md-4 text-center">
                                    <br>
                                    <h6>JPG or PNG no larger than 5 MB</h6> 
                                    <img class="mt-2" id="frame1" src ="<?php echo base_url ?>assets/files/system/no-image.png" alt="Valid ID" width="240px" height="180px"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal User Terms And Conditions -->
            <div class="modal fade" id="Modal_Confirm_Terms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Rental Properties Management System - Terms and Conditions</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <b>1. Acceptance of Terms</b>
                            <br>
                            By accessing or using the Rental Properties Management System (the "System"), you agree to comply with and be bound by the following terms and conditions. If you do not agree to these terms, please do not use the System.
                            <br>
                            <b>2. System Description</b>
                            <br>
                            The System is designed to facilitate the management of rental properties, including but not limited to property listings, tenant information, lease agreements, and financial transactions.
                            <br>
                            <b>3. User Accounts</b>
                            <br>
                            3.1 You must create an account to use certain features of the System. You are responsible for maintaining the confidentiality of your account information.
                            <br>
                            3.2 You agree to provide accurate and complete information when creating your account and to update your information to keep it accurate and current.
                            <br>
                            <b>4. Use of the System</b>
                            <br>
                            4.1 You agree to use the System only for lawful purposes and in compliance with all applicable laws and regulations.
                            <br>
                            4.2 You may not use the System in any manner that could damage, disable, overburden, or impair the System or interfere with any other party's use and enjoyment of it.
                            <br>
                            <b>5. Data Privacy</b>
                            <br>
                            5.1 We respect your privacy and handle your personal information in accordance with our Privacy Policy.
                            <br>
                            5.2 You grant us the right to use, store, and process your data in accordance with the terms of our Privacy Policy.
                            <br>
                            <b>6. Payment and Fees</b>
                            <br>
                            6.1 Certain features of the System may require payment of fees. You agree to pay all fees and charges incurred in connection with your account.
                            <br>
                            6.2 Fees are non-refundable unless otherwise stated.
                            <br>
                            <b>7. Intellectual Property</b>
                            <br>
                            7.1 The System and its original content, features, and functionality are owned by us and are protected by international copyright, trademark, patent, trade secret, and other intellectual property or proprietary rights laws.
                            <br>
                            7.2 You may not reproduce, distribute, modify, create derivative works of, publicly display, publicly perform, republish, download, store, or transmit any of the material on our System.
                            <br>
                            <b>8. Termination</b>
                            <br>
                            We reserve the right to terminate or suspend your account and access to the System at our sole discretion, without notice, for conduct that we believe violates these Terms or is harmful to other users of the System or third parties.
                            <br>
                            <b>9. Changes to Terms</b>
                            <br>
                            We reserve the right to modify or revise these Terms at any time. Your continued use of the System constitutes acceptance of such modifications.
                            <br>
                            <b>10. Governing Law</b>
                            <br>
                            These Terms shall be governed by and construed in accordance with the laws of the Philippines.
                            <br><br>
                            <input type="checkbox" id="terms_checkbox" value="1" onchange="toggleAddButton()">
                            <label for="terms_checkbox" style="display: contents;">By using the Rental Properties Management System, you acknowledge that you have read, understood, and agree to be bound by these Terms and Conditions. If you do not agree to these terms, please refrain from using the System.</label><br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="add_user" id="addButton" class="btn btn-primary" disabled>Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>

<!-- Checkbox Agreement -->
<script>
    // JavaScript code
    function toggleAddButton() {
      var checkbox = document.getElementById("terms_checkbox");
      var addButton = document.getElementById("addButton");

      // If the checkbox is checked, enable the button; otherwise, disable it
      addButton.disabled = !checkbox.checked;
    }
</script>

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
            $('#cpassword-error').text('Passwords do not match').css('color', 'red');
            $('#password').addClass('is-invalid');
            $('#cpassword').addClass('is-invalid');
            $('#submit-btn').prop('disabled', true);
        } else {
            $('#cpassword-error').empty();
            $('#password').removeClass('is-invalid');
            $('#cpassword').removeClass('is-invalid');
            $('#submit-btn').prop('disabled', false);
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

<script>
    document.getElementById('role').addEventListener('change', function () {
        var Container = document.getElementById('Container');
        var Container1 = document.getElementById('Container1');
        var Container2 = document.getElementById('Container2');
        var Container3 = document.getElementById('Container3');
        var address = document.getElementById('address');
        var address1 = document.getElementById('address');
        var civil_status = document.getElementById('civilstatus');
        var civil_status1 = document.getElementById('civilstatus');

        if (this.value === 'Renter') {
            Container.classList.remove('d-none');
            Container1.classList.remove('d-none');
            Container2.classList.remove('d-none');
            Container3.classList.remove('d-none');
            address.required = true;
            address1.disabled = false;
            civil_status.required = true;
            civil_status1.disabled = false;
        } else if (this.value === 'Staff'){
            Container.classList.remove('d-none');
            Container1.classList.add('d-none');
            Container2.classList.add('d-none');
            Container3.classList.add('d-none');
            address.required = true;
            address1.disabled = false;
            civil_status.required = false;
            civil_status1.disabled = true;
        } else {
            Container.classList.add('d-none');
            Container1.classList.add('d-none');
            Container2.classList.add('d-none');
            Container3.classList.add('d-none');
            address.required = false;
            address1.disabled = true;
            civil_status.required = false;
            civil_status1.disabled = true;
        }
    });
</script>
<?php include ('../includes/bottom.php'); ?>