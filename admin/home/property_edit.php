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
        <h1 class="mt-4">Edit Property</h1>
        <ol class="breadcrumb mb-4 mt-3">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="./property" class="text-decoration-none">Property</a></li>
            <li class="breadcrumb-item">Edit Property</li>
        </ol>
        <?php
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT *, CONCAT(`fname`, ' ', `mname`, ' ', `lname`, ' ', `suffix`) AS `staff_fullname` FROM `property` INNER JOIN `user` ON `user`.`user_id` = `property`.`user_id` WHERE `property_id` = '$id' AND `property_status` != 'Archive'";
                $sql_run = mysqli_query($con, $sql);

                if(mysqli_num_rows($sql_run) > 0) {
                    foreach($sql_run as $row){
        ?>
        <form id="myForm" action="property_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Property form
                                <div class="float-end btn-disabled">
                                    <button type="submit" class="btn btn-primary" id="submit-btn" onclick="return validateForm()"><i class="fas fa-save"></i> Save</button>
                                    <input type="hidden" name="id" value="<?=$row['property_id']?>">
                                    <input type="hidden" name="temp_renter" value="<?=$row['rented_by']?>">
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="property_unit_code" class="required">Property Unit Code</label>
                                    <input type="text" class="form-control" placeholder="Enter Property Unit Code" name="property_unit_code" id="property_unit_code" value="<?=$row['property_unit_code']?>" required>
                                    <div id="property_unit_code-error"></div>
                                </div>
                                <!-- Select2 Example -->
                                <div class="col-md-4 mb-3">
                                    <?php
                                        $client = "SELECT user_id, CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS fullname FROM `user` WHERE `type` = 'Staff'";
                                        $client_result = $con->query($client);
                                    ?>
                                    <label for="staff" class="required">Landlady / Landlord</label>
                                    <select class="form-control select2" id="staff" name="staff" style="width: 100%;" required>
                                        <option value="">Select Landlady / Landlord</option>
                                        <?php 
                                        if ($client_result->num_rows > 0) {
                                            while ($clientrow = $client_result->fetch_assoc()) {
                                                $selected = ($clientrow['user_id'] == $row['user_id']) ? 'selected' : '';
                                        ?>
                                        <option value="<?=$clientrow['user_id'];?>" <?=$selected;?>><?=$clientrow['fullname'];?></option>
                                        <?php } } ?>
                                    </select>
                                    <div id="staff-error"></div>
                                </div>
                                <!-- Initialize Select2 -->
                                <script>
                                    $(document).ready(function () {
                                        // Initialize Select2 Elements
                                        $('.select2').select2();
                                    });
                                </script>

                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="property_status" class="required">Property Status</label>
                                        <select class="form-control" name="property_status" id="property_status" required>
                                            <option value="" selected>Select Status</option>
                                            <option value="Rented" <?= isset($row['property_status']) && $row['property_status'] == 'Rented' ? 'selected' : '' ?>>Rented</option>
                                            <option value="Available" <?= isset($row['property_status']) && $row['property_status'] == 'Available' ? 'selected' : '' ?>>Available</option>
                                            <option value="Renovating" <?= isset($row['property_status']) && $row['property_status'] == 'Renovating' ? 'selected' : '' ?>>Renovating</option>
                                            <option value="Reserve" <?= isset($row['property_status']) && $row['property_status'] == 'Reserve' ? 'selected' : '' ?>>Reserve</option>
                                        </select>
                                        <div id="property_status-error"></div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <?php
                                        $stmt = "SELECT * FROM `property_type` WHERE property_type_status != 'Archive'";
                                        $stmt_run = mysqli_query($con,$stmt);
                                    ?>
                                    <label for="property_type_id" class="required">Property Type</label>
                                    <select class="form-control" id="property_type_id" name="property_type_id" required>
                                        <option value="">Select Property Type</option>
                                        <?php
                                            // use a while loop to fetch data
                                            while ($property_type = mysqli_fetch_array($stmt_run,MYSQLI_ASSOC)):;
                                            $selected = ($property_type['property_type_id'] == $row['property_type_id']) ? 'selected' : '';
                                        ?>
                                            <option value="<?= $property_type["property_type_id"]; ?>" <?=$selected;?>><?= $property_type["property_type_name"]; ?></option>
                                        <?php
                                            endwhile; // While loop must be terminated
                                        ?>
                                    </select>
                                    <div id="property_type_id-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="property_purok" class="required">Purok</label>
                                    <input type="number" class="form-control" placeholder="Enter Purok" name="property_purok" id="property_purok" value="<?=$row['property_purok']?>" required>
                                    <div id="property_purok-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="property_barangay" class="required">Barangay</label>
                                    <input type="text" class="form-control" placeholder="Enter Barangay" name="property_barangay" id="property_barangay" value="<?=$row['property_barangay']?>" required>
                                    <div id="property_barangay-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="property_city" class="required">City</label>
                                    <input type="text" class="form-control" placeholder="Enter City" name="property_city" id="property_city" value="<?=$row['property_city']?>" required>
                                    <div id="property_city-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="property_zipcode" class="required">Zipcode</label>
                                    <input type="number" class="form-control" placeholder="Enter Zipcode" name="property_zipcode" id="property_zipcode" value="<?=$row['property_zipcode']?>" required>
                                    <div id="property_zipcode-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="property_amount" class="required">Unit Cost</label>
                                    <input type="text" class="form-control" placeholder="Enter Unit Cost" name="property_amount" id="property_amount" value="<?=$row['property_amount']?>" required>
                                    <div id="property_amount-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="status" class="required">Status</label>
                                        <select class="form-control" name="status" id="status" required>
                                            <option value="" selected>Select Status</option>
                                            <option value="Active" <?= isset($row['p_status']) && $row['p_status'] == 'Active' ? 'selected' : '' ?>>Active</option>
                                            <option value="Inactive" <?= isset($row['p_status']) && $row['p_status'] == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                                        </select>
                                        <div id="status-error"></div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="electrical_meter_Yes" class="required">Does unit have it own electrical meter?</label>
                                    <br>
                                    <input required class="ml-2" type="radio" id="electrical_meter_Yes" name="has_electrical_meter" value="Yes" <?php if($row['has_electrical_meter']=="Yes") {?> <?php echo "checked";?> <?php }?>> Yes
                                    <input required class="ml-2"  type="radio" id="electrical_meter_No" name="has_electrical_meter" value="No" <?php if($row['has_electrical_meter']=="No") {?> <?php echo "checked";?> <?php }?>> No
                                    <div id="has_electrical_meter-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="water_meter_Yes" class="required">Does unit have it own water meter?</label>
                                    <br>
                                    <input required class="ml-2" type="radio" id="water_meter_Yes" name="has_water_meter" value="Yes" <?php if($row['has_water_meter']=="Yes") {?> <?php echo "checked";?> <?php }?>> Yes
                                    <input required class="ml-2"  type="radio" id="water_meter_No" name="has_water_meter" value="No" <?php if($row['has_water_meter']=="No") {?> <?php echo "checked";?> <?php }?>> No
                                    <div id="has_water_meter-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="parking_space_Yes" class="required">Does unit has a parking space?</label>
                                    <br>
                                    <input required class="ml-2" type="radio" id="parking_space_Yes" name="has_parking_space" value="Yes" <?php if($row['has_parking_space']=="Yes") {?> <?php echo "checked";?> <?php }?>> Yes
                                    <input required class="ml-2"  type="radio" id="parking_space_No" name="has_parking_space" value="No" <?php if($row['has_parking_space']=="No") {?> <?php echo "checked";?> <?php }?>> No
                                    <div id="has_parking_space-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="conectivity_Yes" class="required">Does unit has a conectivity?</label>
                                    <br>
                                    <input required class="ml-2" type="radio" id="conectivity_Yes" name="has_conectivity" value="Yes" <?php if($row['has_conectivity']=="Yes") {?> <?php echo "checked";?> <?php }?>> Yes
                                    <input required class="ml-2"  type="radio" id="conectivity_No" name="has_conectivity" value="No" <?php if($row['has_conectivity']=="No") {?> <?php echo "checked";?> <?php }?>> No
                                    <div id="has_conectivity-error"></div>
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
                            <button type="submit" name="edit_property" id="editButton" class="btn btn-success">Save</button>
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
                            <h4>Property form</h4>
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
        var debouncedCheckPropertyunitcode = _.debounce(checkPropertyunitcode, 500);
        var debouncedCheckStaff = _.debounce(checkStaff, 500);
        var debouncedCheckPropertystatus = _.debounce(checkPropertystatus, 500);
        var debouncedCheckPropertytype = _.debounce(checkPropertytype, 500);
        var debouncedCheckPropertypurok = _.debounce(checkPropertypurok, 500);
        var debouncedCheckPropertybarangay = _.debounce(checkPropertybarangay, 500);
        var debouncedCheckPropertycity = _.debounce(checkPropertycity, 500);
        var debouncedCheckPropertyzipcode = _.debounce(checkPropertyzipcode, 500);
        var debouncedCheckPropertyamount = _.debounce(checkPropertyamount, 500);
        var debouncedCheckStatus = _.debounce(checkStatus, 500);
        var debouncedCheckHaselectricalmeter = _.debounce(checkHaselectricalmeter, 500);
        var debouncedCheckHaswatermeter = _.debounce(checkHaswatermeter, 500);
        var debouncedCheckHasparkingspace = _.debounce(checkHasparkingspace, 500);
        var debouncedCheckHasconectivity = _.debounce(checkHasconectivity, 500);

        // attach event listeners for each input field
        $('#property_unit_code').on('input', debouncedCheckPropertyunitcode);
        $('#staff').on('change', debouncedCheckStaff);
        $('#property_status').on('input', debouncedCheckPropertystatus);
        $('#property_type_id').on('input', debouncedCheckPropertytype);
        $('#property_purok').on('input', debouncedCheckPropertypurok);
        $('#property_barangay').on('input', debouncedCheckPropertybarangay);
        $('#property_city').on('input', debouncedCheckPropertycity);
        $('#property_zipcode').on('input', debouncedCheckPropertyzipcode);
        $('#property_amount').on('input', debouncedCheckPropertyamount);
        $('#status').on('input', debouncedCheckStatus);
        $('#electrical_meter_Yes').on('input', debouncedCheckHaselectricalmeter);
        $('#electrical_meter_No').on('input', debouncedCheckHaselectricalmeter);
        $('#water_meter_Yes').on('input', debouncedCheckHaswatermeter);
        $('#water_meter_No').on('input', debouncedCheckHaswatermeter);
        $('#parking_space_Yes').on('input', debouncedCheckHasparkingspace);
        $('#parking_space_No').on('input', debouncedCheckHasparkingspace);
        $('#conectivity_Yes').on('input', debouncedCheckHasconectivity);
        $('#conectivity_No').on('input', debouncedCheckHasconectivity);

        $('#property_unit_code').on('blur', debouncedCheckPropertyunitcode);
        $('#staff').on('blur', debouncedCheckStaff);
        $('#property_status').on('blur', debouncedCheckPropertystatus);
        $('#property_type_id').on('blur', debouncedCheckPropertytype);
        $('#property_purok').on('blur', debouncedCheckPropertypurok);
        $('#property_barangay').on('blur', debouncedCheckPropertybarangay);
        $('#property_city').on('blur', debouncedCheckPropertycity);
        $('#property_zipcode').on('blur', debouncedCheckPropertyzipcode);
        $('#property_amount').on('blur', debouncedCheckPropertyamount);
        $('#status').on('blur', debouncedCheckStatus);
        $('#electrical_meter_Yes').on('blur', debouncedCheckHaselectricalmeter);
        $('#electrical_meter_No').on('blur', debouncedCheckHaselectricalmeter);
        $('#water_meter_Yes').on('blur', debouncedCheckHaswatermeter);
        $('#water_meter_No').on('blur', debouncedCheckHaswatermeter);
        $('#parking_space_Yes').on('blur', debouncedCheckHasparkingspace);
        $('#parking_space_No').on('blur', debouncedCheckHasparkingspace);
        $('#conectivity_Yes').on('blur', debouncedCheckHasconectivity);
        $('#conectivity_No').on('blur', debouncedCheckHasconectivity);

        // Initialize Select2 Elements
        $('.select2').select2();

        // handle Select2 change event for staff
        $('#staff').on('change', function () {
            debouncedCheckStaff();
        });

        // handle Select2 opening and closing events for staff
        $('#staff').on('select2:open', function (event) {
            // Set a flag to track if the dropdown was opened
            $(this).data('dropdownOpened', true);
        }).on('select2:close', function (event) {
            // Check if the dropdown was opened and no option was selected
            if ($(this).data('dropdownOpened') && $(this).val() === '') {
                $('#staff-error').text('Please select Landlady / Landlord').css('color', 'red');
                $('.select2-selection').css('border-color', '#dc3545');
                $('#staff').addClass('is-invalid');
                checkIfAllFieldsValid();
            }
            // Reset the flag
            $(this).data('dropdownOpened', false);
        });

        function checkIfAllFieldsValid() {
            // check if all input fields are valid and enable submit button if so
            if ( $('#property_unit_code-error').is(':empty') &&
                 $('#staff-error').is(':empty') &&
                 $('#property_status-error').is(':empty') &&
                 $('#property_type_id-error').is(':empty') &&
                 $('#property_purok-error').is(':empty') &&
                 $('#property_barangay-error').is(':empty') &&
                 $('#property_city-error').is(':empty') &&
                 $('#property_zipcode-error').is(':empty') &&
                 $('#property_amount-error').is(':empty') &&
                 $('#status-error').is(':empty') &&
                 $('#has_electrical_meter-error').is(':empty') &&
                 $('#has_water_meter-error').is(':empty') &&
                 $('#has_parking_space-error').is(':empty') &&
                 $('#has_conectivity-error').is(':empty') ) {
                $('#submit-btn').prop('disabled', false);
            } else {
                $('#submit-btn').prop('disabled', true);
            }
        }

        function checkPropertyunitcode() {
            var property_unit_code = $('#property_unit_code').val().trim();
            
            // show error if property unit code is empty
            if (property_unit_code === '') {
                $('#property_unit_code-error').text('Please input property unit code').css('color', 'red');
                $('#property_unit_code').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for property unit code if needed
            
            $('#property_unit_code-error').empty();
            $('#property_unit_code').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkStaff() {
            var staff = $('#staff').val().trim();
            
            // show error if staff is empty
            if (staff === '') {
                $('#staff-error').text('Please select Landlady / Landlord').css('color', 'red');
                $('.select2-selection').css('border-color', '#dc3545'); // Apply border color when is-invalid class is added
                $('#staff').addClass('is-invalid');

                checkIfAllFieldsValid();
                return;
            }

            $('#staff-error').empty();
            $('#staff').removeClass('is-invalid');

            // Remove border color when is-invalid class is removed
            $('.select2-selection').css('border-color', '');

            checkIfAllFieldsValid();
        }

        function checkPropertystatus() {
            var property_status = $('#property_status').val().trim();
            
            // show error if property status is empty
            if (property_status === '') {
                $('#property_status-error').text('Please select property status').css('color', 'red');
                $('#property_status').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for property status if needed
            
            $('#property_status-error').empty();
            $('#property_status').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkPropertytype() {
            var property_type_id = $('#property_type_id').val().trim();
            
            // show error if property type is empty
            if (property_type_id === '') {
                $('#property_type_id-error').text('Please select property type').css('color', 'red');
                $('#property_type_id').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for property type if needed
            
            $('#property_type_id-error').empty();
            $('#property_type_id').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkPropertypurok() {
            var property_purok = $('#property_purok').val().trim();
            
            // show error if property purok is empty
            if (property_purok === '') {
                $('#property_purok-error').text('Please input purok').css('color', 'red');
                $('#property_purok').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for property purok if needed
            
            $('#property_purok-error').empty();
            $('#property_purok').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkPropertybarangay() {
            var property_barangay = $('#property_barangay').val().trim();
            
            // show error if property barangay is empty
            if (property_barangay === '') {
                $('#property_barangay-error').text('Please input barangay').css('color', 'red');
                $('#property_barangay').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for property barangay if needed
            
            $('#property_barangay-error').empty();
            $('#property_barangay').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkPropertycity() {
            var property_city = $('#property_city').val().trim();
            
            // show error if property city is empty
            if (property_city === '') {
                $('#property_city-error').text('Please input city').css('color', 'red');
                $('#property_city').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for property city if needed
            
            $('#property_city-error').empty();
            $('#property_city').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkPropertyzipcode() {
            var property_zipcode = $('#property_zipcode').val().trim();
            
            // show error if property zipcode is empty
            if (property_zipcode === '') {
                $('#property_zipcode-error').text('Please input zipcode').css('color', 'red');
                $('#property_zipcode').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for property zipcode if needed
            
            $('#property_zipcode-error').empty();
            $('#property_zipcode').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkPropertyamount() {
            var property_amount = $('#property_amount').val().trim();
            
            // show error if property amount is empty
            if (property_amount === '') {
                $('#property_amount-error').text('Please input property amount').css('color', 'red');
                $('#property_amount').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for property amount if needed
            
            $('#property_amount-error').empty();
            $('#property_amount').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkStatus() {
            var status = $('#status').val().trim();
            
            // show error if status is empty
            if (status === '') {
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

        function checkHaselectricalmeter() {
            var has_electrical_meter = $('input[name="has_electrical_meter"]:checked').val();

            // show error if has_electrical_meter is not selected
            if (!has_electrical_meter) {
                $('#has_electrical_meter-error').text('Please choose electrical meter').css('color', 'red');
                $('#electrical_meter_Yes').addClass('is-invalid');
                $('#electrical_meter_No').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }

            // Perform additional validation for has_electrical_meter if needed

            $('#has_electrical_meter-error').empty();
            $('#electrical_meter_Yes').removeClass('is-invalid');
            $('#electrical_meter_No').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkHaswatermeter() {
            var has_water_meter = $('input[name="has_water_meter"]:checked').val();

            // show error if has_water_meter is not selected
            if (!has_water_meter) {
                $('#has_water_meter-error').text('Please choose water meter').css('color', 'red');
                $('#water_meter_Yes').addClass('is-invalid');
                $('#water_meter_No').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }

            // Perform additional validation for has_water_meter if needed

            $('#has_water_meter-error').empty();
            $('#water_meter_Yes').removeClass('is-invalid');
            $('#water_meter_No').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkHasparkingspace() {
            var has_parking_space = $('input[name="has_parking_space"]:checked').val();

            // show error if has_parking_space is not selected
            if (!has_parking_space) {
                $('#has_parking_space-error').text('Please choose parking space').css('color', 'red');
                $('#parking_space_Yes').addClass('is-invalid');
                $('#parking_space_No').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }

            // Perform additional validation for has_parking_space if needed

            $('#has_parking_space-error').empty();
            $('#parking_space_Yes').removeClass('is-invalid');
            $('#parking_space_No').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkHasconectivity() {
            var has_conectivity = $('input[name="has_conectivity"]:checked').val();

            // show error if has_conectivity is not selected
            if (!has_conectivity) {
                $('#has_conectivity-error').text('Please choose parking space').css('color', 'red');
                $('#conectivity_Yes').addClass('is-invalid');
                $('#conectivity_No').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }

            // Perform additional validation for has_conectivity if needed

            $('#has_conectivity-error').empty();
            $('#conectivity_Yes').removeClass('is-invalid');
            $('#conectivity_No').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }
    });
</script>
<?php include ('../includes/bottom.php'); ?>