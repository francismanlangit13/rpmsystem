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
                <form id="myForm" action="myaccount_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <h4>My Account info
                                <div class="float-end btn-disabled">
                                    <button type="submit" class="btn btn-success" id="submit-btn" onclick="return validateForm()"><i class="fas fa-save"></i> Save</button>
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="fname" class="required">First Name</label>
                                    <input type="text" class="form-control" placeholder="Enter First Name" name="fname" id="fname" value="<?=$user['fname']?>" required>
                                    <div id="fname-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="mname">Middle Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Middle Name" name="mname" id="mname" value="<?=$user['mname']?>">
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="lname" class="required">Last Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Last Name" name="lname" id="lname" value="<?=$user['lname']?>" required>
                                    <div id="lname-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="suffix" class="required">Suffix</label>
                                        <select class="form-control" id="suffix" name="suffix" required>
                                            <option value="" selected>Select Suffix</option>
                                            <option value=" " <?= isset($user['suffix']) && $user['suffix'] == ' ' ? 'selected' : '' ?>>None</option>
                                            <option value="Jr" <?= isset($user['suffix']) && $user['suffix'] == 'Jr' ? 'selected' : '' ?>>Jr</option>
                                            <option value="Sr" <?= isset($user['suffix']) && $user['suffix'] == 'Sr' ? 'selected' : '' ?>>Sr</option>
                                            <option value="I" <?= isset($user['suffix']) && $user['suffix'] == 'I' ? 'selected' : '' ?>>I</option>
                                            <option value="II" <?= isset($user['suffix']) && $user['suffix'] == 'II' ? 'selected' : '' ?>>II</option>
                                            <option value="III" <?= isset($user['suffix']) && $user['suffix'] == 'III' ? 'selected' : '' ?>>III</option>
                                            <option value="IV" <?= isset($user['suffix']) && $user['suffix'] == 'IV' ? 'selected' : '' ?>>IV</option>
                                            <option value="V" <?= isset($user['suffix']) && $user['suffix'] == 'V' ? 'selected' : '' ?>>V</option>
                                            <option value="VI" <?= isset($user['suffix']) && $user['suffix'] == 'VI' ? 'selected' : '' ?>>VI</option>
                                        </select>
                                        <div id="suffix-error"></div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="gender" class="required">Gender</label>
                                        <select class="form-control" name="gender" id="gender" required>
                                            <option value="" selected>Select Gender</option>
                                            <option value="Male" <?= isset($user['gender']) && $user['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                                            <option value="Female" <?= isset($user['gender']) && $user['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                                        </select>
                                        <div id="gender-error"></div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="civil_status" class="required">Civil Status</label>
                                    <select class="form-control" name="civil_status" id="civil_status" <?php if($user['type'] == 'Renter'){ echo "required";} ?>>
                                        <option value="" selected>Select Civil Status</option>
                                        <option value="Single" <?= isset($user['civil_status']) && $user['civil_status'] == 'Single' ? 'selected' : '' ?>>Single</option>
                                        <option value="Married" <?= isset($user['civil_status']) && $user['civil_status'] == 'Married' ? 'selected' : '' ?>>Married</option>
                                        <option value="Widowed" <?= isset($user['civil_status']) && $user['civil_status'] == 'Widowed' ? 'selected' : '' ?>>Widowed</option>
                                        <option value="Separated" <?= isset($user['civil_status']) && $user['civil_status'] == 'Separated' ? 'selected' : '' ?>>Separated</option>
                                    </select>
                                    <div id="civil_status-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="email" class="required">Email</label>
                                    <input type="email" class="form-control" placeholder="Enter Email" name="email" id="email" value="<?=$user['email']?>" required>
                                    <div id="email-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="phone" class="required">Phone Number</label>
                                    <input type="text" class="form-control" placeholder="Enter Phone" name="phone" maxlength="11" id="phone" value="<?=$user['phone']?>" required>
                                    <div id="phone-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="image1">Upload a photo</label>
                                    <input type="file" name="image1" class="form-control btn btn-secondary" style="padding-bottom:2.2rem;" id="image1" accept=".jpg, .jpeg, .png" onchange="previewImage('frame1', 'image1')">
                                    <div id="image1-error"></div>
                                </div>

                                <div class="col-md-8"></div>

                                <div class="col-md-4 text-center">
                                    <h6>JPG or PNG no larger than 5 MB</h6> 
                                    <a href="
                                        <?php
                                            if(!empty($user['profile'])){ 
                                                echo base_url . 'assets/files/user/' . $user['profile'];
                                            } else { if($user['gender'] == 'Male'){ echo base_url . 'assets/files/system/profile-male.png'; } else { echo base_url . 'assets/files/system/profile-female.png'; } }
                                        ?>" class="glightbox d-block" data-gallery="Profile">
                                        <img class="zoom img-fluid img-bordered-sm" id="frame1"
                                        src="
                                            <?php
                                                if(!empty($user['profile'])) {
                                                    echo base_url . 'assets/files/user/' . $user['profile'];
                                                } else { if($user['gender'] == 'Male'){ echo base_url . 'assets/files/system/profile-male.png'; } else { echo base_url . 'assets/files/system/profile-female.png'; } } 
                                            ?>
                                        " alt="image" style="height: 180px; max-width: 240px; object-fit: cover;">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Edit -->
                    <div class="modal fade" id="Modal_save" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Save changes</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want save?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <input type="hidden" name="oldfileimage" value="<?=$user['profile']?>" />
                                    <button type="submit" name="btn_update_account" id="editButton" class="btn btn-success">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <br>
                <!-- Change password card-->
                <div class="card mb-4">
                    <form id="myFormpass" action="myaccount_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
                        <div class="card-header">
                            <h4>Change Password
                                <div class="float-end btn-disabled">
                                    <button class="btn btn-primary float-end" type="submit" id="submit-btn-pass" onclick="return validateFormpass()"><i class="fas fa-save"></i> Save</button>
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <!-- Form Group (current password)-->
                            <div class="mb-3">
                                <label class="small mb-1 required" for="currentPassword">Current Password</label>
                                <a href="javascript:void(0)" class="password-toggle float-end text-decoration-none" onclick="togglePassword('currentPassword')">
                                    <i class="fa fa-eye"></i> Show
                                </a>
                                <input class="form-control" id="currentPassword" name="currentPassword" type="password" placeholder="Enter current password" required />
                                <i style="font-size: 0.85rem;">Leave this blank if you don't want to change the password...</i>
                                <div id="currentPassword-error"></div>
                            </div>

                            <!-- Form Group (new password)-->
                            <div class="mb-3">
                                <label class="small mb-1 required" for="newPassword">New Password</label>
                                <a href="javascript:void(0)" class="password-toggle float-end text-decoration-none" onclick="togglePassword('newPassword')">
                                    <i class="fa fa-eye"></i> Show
                                </a>
                                <input class="form-control" id="newPassword" name="newPassword" type="password" placeholder="Enter new password" required />
                                <div id="newPassword-error"></div>
                            </div>

                            <!-- Form Group (confirm password)-->
                            <div class="mb-3">
                                <label class="small mb-1 required" for="confirmPassword">Confirm Password</label>
                                <a href="javascript:void(0)" class="password-toggle float-end text-decoration-none" onclick="togglePassword('confirmPassword')">
                                    <i class="fa fa-eye"></i> Show
                                </a>
                                <input class="form-control" id="confirmPassword" name="confirmPassword" type="password" placeholder="Confirm new password" required />
                                <div id="confirmPassword-error"></div>
                            </div>
                        </div>
                        <!-- Modal Edit -->
                        <div class="modal fade" id="Modal_save_pass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Save changes</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want update password?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" name="btn_change_password" id="editButtonpass" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    $(document).ready(function() {
        // Add an event listener to the modal's submit button
        $(document).on('click', '#editButtonpass', function() {
            // Set the form's checkValidity to true
            document.getElementById("myFormpass").checkValidity = function() {
                return true;
            };

            // Submit the form
            $('#myFormpass').submit();
        });
    });

    function validateFormpass() {
        var form = document.getElementById("myFormpass");
        if (form.checkValidity()) {
            // If the form is valid, show the modal
            $('#Modal_save_pass').modal('show');
            return false; // Prevent the form from being submitted immediately
        } else {
            return true; // Allow the form to be submitted and display the browser's error messages
        }
    }
</script>

<!-- Password validation -->
<script>
    $(document).ready(function() {

        // debounce functions for each input field
        var debouncedCheckCurrentpassword = _.debounce(checkCurrentpassword, 500);
        var debouncedCheckPassword = _.debounce(checkPassword, 500);
        var debouncedCheckCpassword = _.debounce(checkCpassword, 500);

        // attach event listeners for each input field
        $('#currentPassword').on('input', debouncedCheckCurrentpassword);
        $('#newPassword').on('input', debouncedCheckPassword);
        $('#confirmPassword').on('input', debouncedCheckCpassword);

        $('#currentPassword').on('blur', debouncedCheckCurrentpassword);
        $('#newPassword').on('blur', debouncedCheckPassword);
        $('#confirmPassword').on('blur', debouncedCheckCpassword);

        function checkIfAllFieldsValid() {
            // check if all input fields are valid and enable submit button if so
            if ( $('#currentPassword-error').is(':empty') && $('#newPassword-error').is(':empty') && $('#confirmPassword-error').is(':empty') ) {
                $('#submit-btn-pass').prop('disabled', false);
            } else {
                $('#submit-btn-pass').prop('disabled', true);
            }
        }

        function checkCurrentpassword() {
            var currentPassword = $('#currentPassword').val().trim();
            
            // show error if currentPassword is empty
            if (currentPassword === '') {
                $('#currentPassword-error').text('Please input current password').css('color', 'red');
                $('#currentPassword').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for currentPassword if needed
            
            $('#currentPassword-error').empty();
            $('#currentPassword').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkPassword() {
            var newPassword = $('#newPassword').val().trim();
            
            // show error if newPassword is empty
            if (newPassword === '') {
                $('#newPassword-error').text('Please input new password').css('color', 'red');
                $('#newPassword').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for newPassword if needed
            
            $('#newPassword-error').empty();
            $('#newPassword').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkCpassword() {
            var confirmPassword = $('#confirmPassword').val().trim();
            var newPassword = $('#newPassword').val().trim();

            // show error if confirm password is empty
            if (confirmPassword === '') {
                $('#confirmPassword-error').text('Please input confirm password').css('color', 'red');
                $('#confirmPassword').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }

            // show error if confirm password does not match newPassword
            if (confirmPassword !== newPassword) {
                $('#confirmPassword-error').text('Passwords do not match').css('color', 'red');
                $('#newPassword').addClass('is-invalid');
                $('#confirmPassword').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }

            // Perform additional validation for confirm password if needed

            $('#confirmPassword-error').empty();
            $('#newPassword').removeClass('is-invalid');
            $('#confirmPassword').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }
    });
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
    $(document).ready(function() {
        // Add an event listener to the modal's submit button
        $(document).on('click', '#editButton', function() {
            // Set the form's checkValidity to true
            document.getElementById("myForm").checkValidity = function() {
                return true;
            };

            // Submit the form
            $('#myForm').submit();
        });
    });

    function validateForm() {
        var form = document.getElementById("myForm");
        if (form.checkValidity()) {
            // If the form is valid, show the modal
            $('#Modal_save').modal('show');
            return false; // Prevent the form from being submitted immediately
        } else {
            return true; // Allow the form to be submitted and display the browser's error messages
        }
    }
</script>

<!-- Form Validations -->
<script>
    $(document).ready(function() {

        // debounce functions for each input field
        var debouncedCheckFname = _.debounce(checkFname, 500);;
        var debouncedCheckLname = _.debounce(checkLname, 500);
        var debouncedCheckSuffix = _.debounce(checkSuffix, 500);
        var debouncedCheckGender = _.debounce(checkGender, 500);
        var debouncedCheckCivilstatus = _.debounce(checkCivilstatus, 500);
        var debouncedCheckEmail = _.debounce(checkEmail, 500);
        var debouncedCheckPhone = _.debounce(checkPhone, 500);

        // attach event listeners for each input field
        $('#fname').on('input', debouncedCheckFname);
        $('#lname').on('input', debouncedCheckLname);
        $('#suffix').on('change', debouncedCheckSuffix);
        $('#gender').on('change', debouncedCheckGender);
        $('#civil_status').on('input', debouncedCheckCivilstatus);
        $('#email').on('input', debouncedCheckEmail); 
        $('#phone').on('input', debouncedCheckPhone);

        $('#fname').on('blur', debouncedCheckFname);
        $('#lname').on('blur', debouncedCheckLname);
        $('#suffix').on('blur', debouncedCheckSuffix);
        $('#gender').on('blur', debouncedCheckGender);
        $('#civil_status').on('blur', debouncedCheckCivilstatus);
        $('#email').on('blur', debouncedCheckEmail);
        $('#phone').on('blur', debouncedCheckPhone);

        function checkIfAllFieldsValid() {
            // check if all input fields are valid and enable submit button if so
            if ( $('#fname-error').is(':empty') &&
                 $('#lname-error').is(':empty') &&
                 $('#suffix-error').is(':empty') &&
                 $('#gender-error').is(':empty') &&
                 $('#civil_status-error').is(':empty') &&
                 $('#email-error').is(':empty') &&
                 $('#email-error').is(':empty') &&
                 $('#phone-error').is(':empty')
                ) {
                $('#submit-btn').prop('disabled', false);
            } else {
                $('#submit-btn').prop('disabled', true);
            }
        }
        
        function checkFname() {
            var fname = $('#fname').val().trim();
            
            // show error if first name is empty
            if (fname === '') {
                $('#fname-error').text('Please input first name').css('color', 'red');
                $('#fname').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for first name if needed
            
            $('#fname-error').empty();
            $('#fname').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }
        
        function checkLname() {
            var lname = $('#lname').val().trim();
            
            // show error if last name is empty
            if (lname === '') {
                $('#lname-error').text('Please input last name').css('color', 'red');
                $('#lname').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for last name if needed
            
            $('#lname-error').empty();
            $('#lname').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkSuffix() {
            var suffixSelect = document.getElementById('suffix');
            var suffix = suffixSelect.value;
            
            // show error if the default option is selected
            if (suffix === '' && suffixSelect.selectedIndex !== 1) {
                $('#suffix-error').text('Please select a suffix').css('color', 'red');
                $('#suffix').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for suffix if needed
            
            $('#suffix-error').empty();
            $('#suffix').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkGender() {
            var gender = $('#gender').val().trim();
            
            // show error if gender is empty
            if (gender === '') {
                $('#gender-error').text('Please select gender').css('color', 'red');
                $('#gender').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for gender if needed
            
            $('#gender-error').empty();
            $('#gender').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }
        
        function checkCivilstatus() {
            var civil_status = $('#civil_status').val()
            
            // show error if civilstatus is empty
            if (!civil_status || civil_status.trim() === '') {
                $('#civil_status-error').text('Please select civil status').css('color', 'red');
                $('#civil_status').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for civilstatus if needed
            
            $('#civil_status-error').empty();
            $('#civil_status').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkEmail() {
            var initialEmail = "<?php echo $user['email']; ?>"; // Display current user email
            var email = $('#email').val().trim();
            
            // show error if email is empty
            if (email === '') {
                $('#email-error').text('Please input email').css('color', 'red');
                $('#email').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }

            // check if email format is valid
            var emailPattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i;
            if (!emailPattern.test(email)) {
                $('#email-error').text('Invalid email format').css('color', 'red');
                $('#email').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            if (email !== initialEmail) {
                // make AJAX call to check if email exists
                $.ajax({
                    url: 'ajax.php', // replace with the actual URL to check email
                    method: 'POST', // use the appropriate HTTP method
                    data: { email: email },
                    success: function(response) {
                        if (response.exists) {
                            // disable submit button if email is taken
                            $('#submit-btn').prop('disabled', true);
                            $('#email-error').text('Email already taken').css('color', 'red');
                            $('#email').addClass('is-invalid');
                        } else {
                            $('#email-error').empty();
                            $('#email').removeClass('is-invalid');
                            // enable submit button if email is valid
                            checkIfAllFieldsValid();
                        }
                    },
                    error: function() {
                        $('#email-error').text('Error checking email');
                    }
                });
            } else {
                $('#email-error').empty();
                $('#email').removeClass('is-invalid');
                checkIfAllFieldsValid();
            }
        }

        function checkPhone() {
            var initialPhone = "<?php echo $user['phone']; ?>"; // Display current user email
            var phone = $('#phone').val().trim();

            // show error if phone number is empty
            if (phone === '') {
                $('#phone-error').text('Please input phone number').css('color', 'red');
                $('#phone').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }

            // check if phone number format is valid
            var phoneNumberPattern = /^09[0-9]{9}$/;
            if (!phoneNumberPattern.test(phone)) {
                $('#phone-error').text('Invalid phone number format').css('color', 'red');
                $('#phone').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }

            if (phone !== initialPhone) {
                // make AJAX call to check if phone number exists
                $.ajax({
                    url: 'ajax.php', // replace with the actual URL to check phone
                    method: 'POST', // use the appropriate HTTP method
                    data: { phone: phone },
                    success: function(response) {
                        if (response.exists) {
                            $('#phone-error').text('Phone number already taken').css('color', 'red');
                            $('#phone').addClass('is-invalid');
                            // disable submit button if phone number is taken
                            $('#submit-btn').prop('disabled', true);
                        } else {
                            $('#phone-error').empty();
                            $('#phone').removeClass('is-invalid');
                            // enable submit button if phone number is valid
                            checkIfAllFieldsValid();
                        }
                    },
                    error: function() {
                        $('#phone-error').text('Error checking phone number');
                    }
                });
            } else {
                $('#phone-error').empty();
                $('#phone').removeClass('is-invalid');
                checkIfAllFieldsValid();
            }
        }
    });
</script>
<?php include ('../includes/bottom.php'); ?>