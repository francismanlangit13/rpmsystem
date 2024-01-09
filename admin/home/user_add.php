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
        <form id="myForm" action="user_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>User form
                                <div class="float-end btn-disabled">
                                    <button type="submit" id="submit-btn" class="btn btn-primary" onclick="return validateForm()"><i class="fas fa-plus"></i> Add</button>
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
                                        <label for="suffix" class="required">Suffix</label>
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

                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="gender" class="required">Gender</label>
                                        <select class="form-control" name="gender" id="gender" required>
                                            <option value="" selected>Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        <div id="gender-error"></div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="civil_status" class="required">Civil Status</label>
                                    <select class="form-control" name="civil_status" id="civil_status" required>
                                        <option value="" selected>Select Civil Status</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Widowed">Widowed</option>
                                        <option value="Separated">Separated</option>
                                    </select>
                                    <div id="civil_status-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="birthday" class="required">Birthday</label>
                                    <input type="date" class="form-control" name="birthday" id="birthday" required>
                                    <div id="birthday-error"></div>
                                </div>
    
                                <div class="col-md-3 mb-3">
                                    <label for="email" class="required">Email</label>
                                    <input type="email" class="form-control" placeholder="Enter Email" name="email" id="email" autocomplete="off" required>
                                    <div id="email-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="phone" class="required">Phone Number</label>
                                    <input type="text" class="form-control" placeholder="Enter Phone" name="phone" maxlength="11" minlength="11" id="phone" autocomplete="off" required>
                                    <div id="phone-error"></div>
                                </div>

                                <!-- Form Group (password)-->
                                <div class="col-md-3 mb-3">
                                    <label for="password" class="required">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password" id="password" required>
                                    <a href="javascript:void(0)" style="position: relative; top: -2rem; left: -8%; cursor: pointer; color: black;" onclick="togglePassword('password')">
                                        <span class="password-toggle float-end"><i class="fa fa-eye"></i> Show</span>
                                    </a>
                                    <div style="position: absolute" id="password-error"></div>
                                </div>

                                <!-- Form Group (confirm password)-->
                                <div class="col-md-3 mb-3">
                                    <label for="cpassword" class="required">Confirm Password</label>
                                    <!-- <a href="javascript:void(0)" class="password-toggle float-end text-decoration-none" onclick="togglePassword('password')">
                                        <i class="fa fa-eye"></i> Show
                                    </a> -->
                                    <input type="password" class="form-control" placeholder="Enter Confirm Password" name="cpassword" id="cpassword" required>
									<a href="javascript:void(0)" style="position: relative; top: -2rem; left: -8%; cursor: pointer; color: black;" onclick="togglePassword('cpassword')">
                                        <span class="password-toggle float-end"><i class="fa fa-eye"></i> Show</span>
                                    </a>
                                    <div style="position: absolute" id="cpassword-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
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

                                <div class="col-md-12 mb-3">
                                    <label for="address" class="required">Address</label>
                                    <textarea type="text" class="form-control" placeholder="Enter Address" rows="3" name="address" id="address" autocomplete="off" required></textarea>
                                    <div id="address-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="image1" class="required">Valid ID Attachment</label>
                                    <input type="file" name="image1" class="form-control btn btn-secondary" style="padding-bottom:2.2rem;" id="image1" accept=".jpg, .jpeg, .png" onchange="previewImage('frame1', 'image1')" required>
                                    <div id="image1-error"></div>
                                </div>

                                <div class="col-md-4 mb-3 d-none" id="Container">
                                    <label for="occupation">Occupation</label>
                                    <input type="text" class="form-control" placeholder="Enter Occupation" name="occupation" id="occupation" autocomplete="off">
                                    <div id="occupation-error"></div>
                                </div>

                                <div class="col-md-4 mb-3 d-none" id="Container1">
                                    <label for="company">Company</label>
                                    <input type="text" class="form-control" placeholder="Enter Company" name="company" id="company" autocomplete="off">
                                    <div id="company-error"></div>
                                </div>

                                
                                <div class="col-md-8" id="Container2"></div>

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
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
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
                            <br><br><br>
                            <input type="checkbox" id="terms_checkbox" value="1" onchange="toggleAddButton()">
                            <label for="terms_checkbox" style="display: contents;">By using the Rental Properties Management System, you acknowledge that you have read, understood, and agree to be bound by these Terms and Conditions. If you do not agree to these terms, please refrain from using the System.</label><br>
                        </div>
                        <div class="modal-footer">
                            <div class="float-end btn-disabled">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" name="add_user" id="addButton" class="btn btn-primary" disabled>Add</button>
                            </div>
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

<!-- Script for Role if Renter show hidden forms -->
<script>
    document.getElementById('role').addEventListener('change', function () {
        var Container = document.getElementById('Container');
        var Container1 = document.getElementById('Container1');
        var Container2 = document.getElementById('Container2');

        if (this.value === 'Renter') {
            Container.classList.remove('d-none');
            Container1.classList.remove('d-none');
            Container2.classList.add('d-none');
        } else {
            Container.classList.add('d-none');
            Container1.classList.add('d-none');
            Container2.classList.remove('d-none');
        }
    });
</script>

<script>
    $(document).ready(function() {
        // Add an event listener to the modal's submit button
        $(document).on('click', '#addButton', function() {
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
            $('#Modal_Confirm_Terms').modal('show');
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
        var debouncedCheckBirthday = _.debounce(checkBirthday, 500);
        var debouncedCheckEmail = _.debounce(checkEmail, 500);
        var debouncedCheckPhone = _.debounce(checkPhone, 500);
        var debouncedCheckPassword = _.debounce(checkPassword, 500);
        var debouncedCheckCpassword = _.debounce(checkCpassword, 500);
        var debouncedCheckRole = _.debounce(checkRole, 500);
        var debouncedCheckAddress = _.debounce(checkAddress, 500);
        var debouncedCheckID = _.debounce(checkID, 500);

        // attach event listeners for each input field
        $('#fname').on('input', debouncedCheckFname);
        $('#lname').on('input', debouncedCheckLname);
        $('#suffix').on('change', debouncedCheckSuffix);
        $('#gender').on('change', debouncedCheckGender);
        $('#civil_status').on('input', debouncedCheckCivilstatus);
        $('#birthday').on('input', debouncedCheckBirthday);
        $('#email').on('input', debouncedCheckEmail); 
        $('#phone').on('input', debouncedCheckPhone);
        $('#password').on('input', debouncedCheckPassword);
        $('#cpassword').on('input', debouncedCheckCpassword);
        $('#role').on('change', debouncedCheckRole);
        $('#address').on('input', debouncedCheckAddress);
        $('#image1').on('input', debouncedCheckID);

        $('#fname').on('blur', debouncedCheckFname);
        $('#lname').on('blur', debouncedCheckLname);
        $('#suffix').on('blur', debouncedCheckSuffix);
        $('#gender').on('blur', debouncedCheckGender);
        $('#civil_status').on('blur', debouncedCheckCivilstatus);
        $('#birthday').on('blur', debouncedCheckBirthday);
        $('#email').on('blur', debouncedCheckEmail);
        $('#phone').on('blur', debouncedCheckPhone);
        $('#password').on('blur', debouncedCheckPassword);
        $('#cpassword').on('blur', debouncedCheckCpassword);
        $('#role').on('blur', debouncedCheckRole);
        $('#address').on('blur', debouncedCheckAddress);
        $('#image1').on('blur', debouncedCheckID);

        function checkIfAllFieldsValid() {
            // check if all input fields are valid and enable submit button if so
            if ( $('#fname-error').is(':empty') &&
                 $('#lname-error').is(':empty') &&
                 $('#suffix-error').is(':empty') &&
                 $('#gender-error').is(':empty') &&
                 $('#civil_status-error').is(':empty') &&
                 $('#birthday-error').is(':empty') &&
                 $('#email-error').is(':empty') &&
                 $('#phone-error').is(':empty') &&
                 $('#email-error').is(':empty') &&
                 $('#phone-error').is(':empty') &&
                 $('#password-error').is(':empty') &&
                 $('#cpassword-error').is(':empty') &&
                 $('#role-error').is(':empty') &&
                 $('#address-error').is(':empty') &&
                 $('#image1-error').is(':empty')
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
        
        function checkBirthday() {
            var birthday = $('#birthday').val().trim();
            
            // show error if birthday is empty
            if (birthday === '') {
                $('#birthday-error').text('Please input birthday').css('color', 'red');
                $('#birthday').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for birthday if needed
            
            $('#birthday-error').empty();
            $('#birthday').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkEmail() {
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
        }

        function checkPhone() {
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
        }

        function checkPassword() {
            var password = $('#password').val().trim();
            
            // show error if password is empty
            if (password === '') {
                $('#password-error').text('Please input password').css('color', 'red');
                $('#password').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for password if needed
            
            $('#password-error').empty();
            $('#password').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkCpassword() {
            var cpassword = $('#cpassword').val().trim();
            var password = $('#password').val().trim();

            // show error if confirm password is empty
            if (cpassword === '') {
                $('#cpassword-error').text('Please input confirm password').css('color', 'red');
                $('#cpassword').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }

            // show error if confirm password does not match password
            if (cpassword !== password) {
                $('#cpassword-error').text('Passwords do not match').css('color', 'red');
                $('#password').addClass('is-invalid');
                $('#cpassword').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }

            // Perform additional validation for confirm password if needed

            $('#cpassword-error').empty();
            $('#password').removeClass('is-invalid');
            $('#cpassword').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkRole() {
            var role = $('#role').val()
            
            // show error if role is empty
            if (!role || role.trim() === '') {
                $('#role-error').text('Please select role').css('color', 'red');
                $('#role').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for role if needed
            
            $('#role-error').empty();
            $('#role').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkAddress() {
            var address = $('#address').val().trim();
            
            // show error if address is empty
            if (address === '') {
                $('#address-error').text('Please input address').css('color', 'red');
                $('#address').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for address if needed
            
            $('#address-error').empty();
            $('#address').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkID() {
            var image1 = $('#image1').val().trim();
            
            // show error if attach ID is empty
            if (image1 === '') {
                $('#image1-error').text('Please attach valid ID').css('color', 'red');
                $('#image1').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for attach ID if needed
            
            $('#image1-error').empty();
            $('#image1').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }
    });
</script>
<?php include ('../includes/bottom.php'); ?>