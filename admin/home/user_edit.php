<?php include ('../includes/header.php'); ?>
<head>
    <!-- Select2 CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
</head>
<style type="text/css">
    #datatablesSimple th:nth-child(7) {
        width: 15% !important;
    }
</style>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Edit User</h1>
        <ol class="breadcrumb mb-4 mt-3">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="./user" class="text-decoration-none">Users</a></li>
            <li class="breadcrumb-item">Edit User</li>
        </ol>
        <?php
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM `user` WHERE `user_id` = '$id' AND `status` != 'Archive'";
                $sql_run = mysqli_query($con, $sql);

                if(mysqli_num_rows($sql_run) > 0) {
                    foreach($sql_run as $row){
        ?>
        <form id="myForm" action="user_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>User form
                                <div class="float-end btn-disabled">
                                    <button type="submit" class="btn btn-success" id="submit-btn" onclick="return validateForm()"><i class="fas fa-save"></i> Save</button>
                                    <input type="hidden" name="user_id" value="<?=$row['user_id']?>">
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="fname" class="required">First Name</label>
                                    <input type="text" class="form-control" placeholder="Enter First Name" name="fname" id="fname" value="<?=$row['fname']?>" required>
                                    <div id="fname-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="mname">Middle Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Middle Name" name="mname" id="mname" value="<?=$row['mname']?>">
                                    <div id="mname-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="lname" class="required">Last Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Last Name" name="lname" id="lname" value="<?=$row['lname']?>" required>
                                    <div id="lname-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="suffix" class="required">Suffix</label>
                                        <select class="form-control" id="suffix" name="suffix" required>
                                            <option value="" selected>Select Suffix</option>
                                            <option value=" " <?= isset($row['suffix']) && $row['suffix'] == ' ' ? 'selected' : '' ?>>None</option>
                                            <option value="Jr" <?= isset($row['suffix']) && $row['suffix'] == 'Jr' ? 'selected' : '' ?>>Jr</option>
                                            <option value="Sr" <?= isset($row['suffix']) && $row['suffix'] == 'Sr' ? 'selected' : '' ?>>Sr</option>
                                            <option value="I" <?= isset($row['suffix']) && $row['suffix'] == 'I' ? 'selected' : '' ?>>I</option>
                                            <option value="II" <?= isset($row['suffix']) && $row['suffix'] == 'II' ? 'selected' : '' ?>>II</option>
                                            <option value="III" <?= isset($row['suffix']) && $row['suffix'] == 'III' ? 'selected' : '' ?>>III</option>
                                            <option value="IV" <?= isset($row['suffix']) && $row['suffix'] == 'IV' ? 'selected' : '' ?>>IV</option>
                                            <option value="V" <?= isset($row['suffix']) && $row['suffix'] == 'V' ? 'selected' : '' ?>>V</option>
                                            <option value="VI" <?= isset($row['suffix']) && $row['suffix'] == 'VI' ? 'selected' : '' ?>>VI</option>
                                        </select>
                                        <div id="suffix-error"></div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="gender" class="required">Gender</label>
                                        <select class="form-control" name="gender" id="gender" required>
                                            <option value="" selected>Select Gender</option>
                                            <option value="Male" <?= isset($row['gender']) && $row['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                                            <option value="Female" <?= isset($row['gender']) && $row['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                                        </select>
                                        <div id="gender-error"></div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="civil_status" class="required">Civil Status</label>
                                    <select class="form-control" name="civil_status" id="civil_status" <?php if($row['type'] == 'Renter'){ echo "required";} ?>>
                                        <option value="" selected>Select Civil Status</option>
                                        <option value="Single" <?= isset($row['civil_status']) && $row['civil_status'] == 'Single' ? 'selected' : '' ?>>Single</option>
                                        <option value="Married" <?= isset($row['civil_status']) && $row['civil_status'] == 'Married' ? 'selected' : '' ?>>Married</option>
                                        <option value="Widowed" <?= isset($row['civil_status']) && $row['civil_status'] == 'Widowed' ? 'selected' : '' ?>>Widowed</option>
                                        <option value="Separated" <?= isset($row['civil_status']) && $row['civil_status'] == 'Separated' ? 'selected' : '' ?>>Separated</option>
                                    </select>
                                    <div id="civil_status-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="birthday" class="required">Birthday</label>
                                    <input type="date" class="form-control" name="birthday" id="birthday" value="<?=$row['birthday']?>" required>
                                    <div id="birthday-error"></div>
                                </div>
    
                                <div class="col-md-3 mb-3">
                                    <label for="email" class="required">Email</label>
                                    <input type="email" class="form-control" placeholder="Enter Email" name="email" id="email" value="<?=$row['email']?>" required>
                                    <div id="email-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="phone" class="required">Phone Number</label>
                                    <input type="text" class="form-control" placeholder="Enter Phone" name="phone" maxlength="11" id="phone" value="<?=$row['phone']?>" required>
                                    <div id="phone-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="role" class="required">Role</label>
                                        <select class="form-control" name="role" id="role" required>
                                            <option value="" selected>Select Role</option>
                                            <option value="Admin" <?= isset($row['type']) && $row['type'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
                                            <option value="Staff" <?= isset($row['type']) && $row['type'] == 'Staff' ? 'selected' : '' ?>>Staff</option>
                                            <option value="Renter" <?= isset($row['type']) && $row['type'] == 'Renter' ? 'selected' : '' ?>>Rentee</option>
                                        </select>
                                        <div id="role-error"></div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="status" class="required">Status</label>
                                        <select class="form-control" name="status" id="status" required>
                                            <option value="" selected>Select Status</option>
                                            <option value="Active" <?= isset($row['status']) && $row['status'] == 'Active' ? 'selected' : '' ?>>Active</option>
                                            <option value="Inactive" <?= isset($row['status']) && $row['status'] == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                                        </select>
                                        <div id="status-error"></div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="address" class="required">Address</label>
                                    <textarea type="text" class="form-control" placeholder="Enter Address" rows="3" name="address" id="address" autocomplete="off" required><?=$row['address']?></textarea>
                                    <div id="address-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="image1" class="required">Valid ID Attachment</label>
                                    <input type="file" name="image1" class="form-control btn btn-secondary" style="padding-bottom:2.2rem;" id="image1" accept=".jpg, .jpeg, .png" onchange="previewImage('frame1', 'image1')">
                                    <div id="image1-error"></div>
                                </div>

                                <div class="col-md-4 mb-3 <?php if($row['type'] != 'Renter'){ echo "d-none";} ?>" id="Container">
                                    <label for="occupation">Occupation</label>
                                    <input type="text" class="form-control" placeholder="Enter Occupation" name="occupation" id="occupation" autocomplete="off" value="<?=$row['occupation']?>">
                                    <div id="occupation-error"></div>
                                </div>

                                <div class="col-md-4 mb-3 <?php if($row['type'] != 'Renter'){ echo "d-none";} ?>" id="Container1">
                                    <label for="company">Company</label>
                                    <input type="text" class="form-control" placeholder="Enter Company" name="company" id="company" autocomplete="off" value="<?=$row['company']?>">
                                    <div id="company-error"></div>
                                </div>

                                <div class="col-md-8 <?php if($row['type'] == 'Renter'){ echo "d-none";} ?>" id="Container2"></div>

                                <div class="col-md-4 text-center">
                                    <h6>JPG or PNG no larger than 5 MB</h6> 
                                    <a href="
                                        <?php
                                            if(!empty($row['valid_id'])){ 
                                                echo base_url . 'assets/files/attachment/' . $row['valid_id'];
                                            } else { echo base_url . 'assets/files/system/no-image.png'; }
                                        ?>" class="glightbox d-block" data-gallery="QRCode">
                                        <img class="zoom img-fluid img-bordered-sm" id="frame1"
                                        src="
                                            <?php
                                                if(!empty($row['valid_id'])) {
                                                    echo base_url . 'assets/files/attachment/' . $row['valid_id'];
                                                } else { echo base_url . 'assets/files/system/no-image.png'; } 
                                            ?>
                                        " alt="image" style="height: 180px; max-width: 240px; object-fit: cover;">
                                    </a>
                                </div>

                                <!-- Select2 Example -->
                                <div class="col-md-4 mb-3 <?php if($row['type'] != 'Renter'){ echo "d-none";} ?>" id="Container3">
                                    <?php
                                        $used_property = $row['property_id'];
                                        $property = "SELECT * FROM `property` INNER JOIN `property_type` ON `property`.`property_type_id` = `property_type`.`property_type_id`  WHERE (`property`.`property_status` = 'Available') OR `property`.`property_id` = '$used_property';";
                                        $property_result = $con->query($property);
                                    ?>
                                    <label for="property" class="required">Property</label>
                                    <select class="form-control select2" id="property" name="property" style="width: 100%;" <?php if($row['type'] == 'Renter'){ echo "required";} ?>>
                                        <option value="">Select Property</option>
                                        <?php 
                                            if ($property_result->num_rows > 0) {
                                            while($propertyrow = $property_result->fetch_assoc()) {
                                            $selected = ($propertyrow['property_id'] == $row['property_id']) ? 'selected' : '';
                                        ?>
                                        <option value="<?=$propertyrow['property_id'];?>" <?=$selected;?>><?=$propertyrow['property_unit_code'];?> (Purok <?=$propertyrow['property_purok'];?>, <?=$propertyrow['property_barangay'];?>, <?=$propertyrow['property_city'];?> <?=$propertyrow['property_zipcode'];?>) <?=$propertyrow['property_type_name'];?> </option>
                                        <?php } } ?>
                                    </select>
                                    <div id="property-error"></div>
                                </div>
                                <!-- Initialize Select2 -->
                                <script>
                                    $(document).ready(function () {
                                        // Initialize Select2 Elements
                                        $('.select2').select2();
                                    });
                                </script>

                                <div class="col-md-2 mb-3 <?php if($row['type'] != 'Renter'){ echo "d-none";} ?>" id="Container4">
                                    <label for="startrent" class="required">Start Rent</label>
                                    <input type="date" class="form-control" name="startrent" id="startrent" value="<?=$row['startrent']?>" <?php if($row['type'] == 'Renter'){ echo "required";} ?>>
                                    <div id="startrent-error"></div>
                                </div>

                                <div class="col-md-2 mb-3 <?php if($row['type'] != 'Renter'){ echo "d-none";} ?>" id="Container5">
                                    <label for="endrent" class="required">End Rent</label>
                                    <input type="date" class="form-control" name="endrent" id="endrent" value="<?=$row['endrent']?>" <?php if($row['type'] == 'Renter'){ echo "required";} ?>>
                                    <div id="endrent-error"></div>
                                </div>
                            </div>
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
                            <input type="hidden" name="oldfileimage" value="<?=$row['valid_id']?>" />
                            <button type="submit" name="edit_user" id="editButton" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php } } else{ ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>User info</h4>
                        </div>
                        <div class="card-body">
                            <h4>No records found.</h4>
                        </div>
                    </div>
                </div>
            </div>
        <?php } } ?>
    </div>
</main>

<!-- Script for Role if Renter show hidden forms -->
<script>
    document.getElementById('role').addEventListener('change', function () {
        var Container = document.getElementById('Container');
        var Container1 = document.getElementById('Container1');
        var Container2 = document.getElementById('Container2');
        var Container3 = document.getElementById('Container3');
        var Container4 = document.getElementById('Container4');
        var Container5 = document.getElementById('Container5');
        var property1 = document.getElementById('property');
        var startrent1 = document.getElementById('startrent');
        var endrent1 = document.getElementById('endrent');

        if (this.value === 'Renter') {
            Container.classList.remove('d-none');
            Container1.classList.remove('d-none');
            Container2.classList.add('d-none');
            Container3.classList.remove('d-none');
            Container4.classList.remove('d-none');
            Container5.classList.remove('d-none');
            property1.required = true;
            startrent1.required = true;
            endrent1.required = true;
        } else {
            Container.classList.add('d-none');
            Container1.classList.add('d-none');
            Container2.classList.remove('d-none');
            Container3.classList.add('d-none');
            Container4.classList.add('d-none');
            Container5.classList.add('d-none');
            property1.required = false;
            startrent1.required = false;
            endrent1.required = false;
        }
    });
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
        var debouncedCheckBirthday = _.debounce(checkBirthday, 500);
        var debouncedCheckEmail = _.debounce(checkEmail, 500);
        var debouncedCheckPhone = _.debounce(checkPhone, 500);
        var debouncedCheckRole = _.debounce(checkRole, 500);
        var debouncedCheckStatus = _.debounce(checkStatus, 500);
        var debouncedCheckAddress = _.debounce(checkAddress, 500);
        var debouncedCheckProperty = _.debounce(checkProperty, 500);
        var debouncedCheckStartrent = _.debounce(checkStartrent, 500);
        var debouncedCheckEndrent = _.debounce(checkEndrent, 500);

        // attach event listeners for each input field
        $('#fname').on('input', debouncedCheckFname);
        $('#lname').on('input', debouncedCheckLname);
        $('#suffix').on('change', debouncedCheckSuffix);
        $('#gender').on('change', debouncedCheckGender);
        $('#civil_status').on('input', debouncedCheckCivilstatus);
        $('#birthday').on('input', debouncedCheckBirthday);
        $('#email').on('input', debouncedCheckEmail); 
        $('#phone').on('input', debouncedCheckPhone);
        $('#role').on('change', debouncedCheckRole);
        $('#status').on('change', debouncedCheckStatus);
        $('#address').on('input', debouncedCheckAddress);
        $('#property').on('input', debouncedCheckProperty);
        $('#startrent').on('input', debouncedCheckStartrent);
        $('#endrent').on('input', debouncedCheckEndrent);

        $('#fname').on('blur', debouncedCheckFname);
        $('#lname').on('blur', debouncedCheckLname);
        $('#suffix').on('blur', debouncedCheckSuffix);
        $('#gender').on('blur', debouncedCheckGender);
        $('#civil_status').on('blur', debouncedCheckCivilstatus);
        $('#birthday').on('blur', debouncedCheckBirthday);
        $('#email').on('blur', debouncedCheckEmail);
        $('#phone').on('blur', debouncedCheckPhone);
        $('#role').on('blur', debouncedCheckRole);
        $('#status').on('blur', debouncedCheckStatus);
        $('#address').on('blur', debouncedCheckAddress);
        $('#property').on('blur', debouncedCheckProperty);
        $('#startrent').on('blur', debouncedCheckStartrent);
        $('#endrent').on('blur', debouncedCheckEndrent);

        // handle Select2 change event for property
        $('#property').on('change', function () {
            debouncedCheckProperty();
        });

        // handle Select2 opening and closing events for property
        $('#property').on('select2:open', function (event) {
            // Set a flag to track if the dropdown was opened
            $(this).data('dropdownOpened', true);
        }).on('select2:close', function (event) {
            // Check if the dropdown was opened and no option was selected
            if ($(this).data('dropdownOpened') && $(this).val() === '') {
                $('#property-error').text('Please select property').css('color', 'red');
                $('.select2-selection').css('border-color', '#dc3545');
                $('#property').addClass('is-invalid');
                checkIfAllFieldsValid();
            }
            // Reset the flag
            $(this).data('dropdownOpened', false);
        });

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
                 $('#role-error').is(':empty') &&
                 $('#status-error').is(':empty') &&
                 $('#address-error').is(':empty') &&
                 $('#property-error').is(':empty') &&
                 $('#startrent-error').is(':empty') &&
                 $('#endrent-error').is(':empty')
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
            var initialEmail = "<?php echo $row['email']; ?>"; // Display current user email
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
            var initialPhone = "<?php echo $row['phone']; ?>"; // Display current user email
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

        function checkStatus() {
            var status = $('#status').val()
            
            // show error if status is empty
            if (!status || status.trim() === '') {
                $('#status-error').text('Please select status').css('color', 'red');
                $('#status').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for status if needed
            
            $('#status-error').empty();
            $('#status').removeClass('is-invalid');
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

        function checkProperty() {
            var property = $('#property').val().trim();
            
            // show error if property is empty
            if (property === '') {
                $('#property-error').text('Please select property').css('color', 'red');
                $('.select2-selection').css('border-color', '#dc3545'); // Apply border color when is-invalid class is added
                $('#property').addClass('is-invalid');

                checkIfAllFieldsValid();
                return;
            }

            $('#property-error').empty();
            $('#property').removeClass('is-invalid');

            // Remove border color when is-invalid class is removed
            $('.select2-selection').css('border-color', '');

            checkIfAllFieldsValid();
        }

        function checkStartrent() {
            var startrent = $('#startrent').val().trim();
            
            // show error if startrent is empty
            if (startrent === '') {
                $('#startrent-error').text('Please input start rent').css('color', 'red');
                $('#startrent').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for startrent if needed
            
            $('#startrent-error').empty();
            $('#startrent').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkEndrent() {
            var endrent = $('#endrent').val().trim();
            
            // show error if endrent is empty
            if (endrent === '') {
                $('#endrent-error').text('Please input end rent').css('color', 'red');
                $('#endrent').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for endrent if needed
            
            $('#endrent-error').empty();
            $('#endrent').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }
    });
</script>
<?php include ('../includes/bottom.php'); ?>