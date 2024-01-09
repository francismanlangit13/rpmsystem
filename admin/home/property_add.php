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
        <h1 class="mt-4">Add Property</h1>
        <ol class="breadcrumb mb-4 mt-3">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="./property" class="text-decoration-none">Property</a></li>
            <li class="breadcrumb-item">Add Property</li>
        </ol>
        <form id="myForm" action="property_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Property form
                                <div class="float-end btn-disabled">
                                    <button type="submit" class="btn btn-primary" id="submit-btn" onclick="return validateForm()"><i class="fas fa-plus"></i> Add</button>
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="property_unit_code" class="required">Property Unit Code</label>
                                    <input type="text" class="form-control" placeholder="Enter Property Unit Code" name="property_unit_code" id="property_unit_code" required>
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
                                            while($clientrow = $client_result->fetch_assoc()) {
                                        ?>
                                        <option value="<?=$clientrow['user_id'];?>"><?=$clientrow['fullname'];?></option>
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
                                        <label for="property_status">Property Status</label>
                                        <select class="form-control" name="property_status" id="property_status" required>
                                            <option value="" selected>Select Status</option>
                                            <option value="Rented">Rented</option>
                                            <option value="Available">Available</option>
                                            <option value="Renovating">Renovating</option>
                                            <option value="Reserve">Reserve</option>
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
                                        ?>
                                            <option value="<?= $property_type["property_type_id"]; ?>"><?= $property_type["property_type_name"]; ?></option>
                                        <?php
                                            endwhile; // While loop must be terminated
                                        ?>
                                    </select>
                                    <div id="property_type_id-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="property_location" class="required">Property Location</label>
                                    <input type="text" class="form-control" placeholder="Enter Property Location" name="property_location" id="property_location" required>
                                    <div id="property_location-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="property_amount" class="required">Unit Cost</label>
                                    <input type="number" class="form-control" placeholder="Enter Unit Cost" name="property_amount" id="property_amount" required>
                                    <div id="property_amount-error"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Add -->
            <div class="modal fade" id="Modal_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Save changes</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to add?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="add_property" id="addButton" class="btn btn-success">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>

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
            $('#Modal_add').modal('show');
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
        var debouncedCheckPropertylocation = _.debounce(checkPropertylocation, 500);
        var debouncedCheckPropertyamount = _.debounce(checkPropertyamount, 500);

        // attach event listeners for each input field
        $('#property_unit_code').on('input', debouncedCheckPropertyunitcode);
        $('#staff').on('change', debouncedCheckStaff);
        $('#property_status').on('input', debouncedCheckPropertystatus);
        $('#property_type_id').on('input', debouncedCheckPropertytype);
        $('#property_location').on('input', debouncedCheckPropertylocation);
        $('#property_amount').on('input', debouncedCheckPropertyamount);

        $('#property_unit_code').on('blur', debouncedCheckPropertyunitcode);
        $('#staff').on('blur', debouncedCheckStaff);
        $('#property_status').on('blur', debouncedCheckPropertystatus);
        $('#property_type_id').on('blur', debouncedCheckPropertytype);
        $('#property_location').on('blur', debouncedCheckPropertylocation);
        $('#property_amount').on('blur', debouncedCheckPropertyamount);

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
                 $('#property_location-error').is(':empty') &&
                 $('#property_amount-error').is(':empty') ) {
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

        function checkPropertylocation() {
            var property_location = $('#property_location').val().trim();
            
            // show error if property location is empty
            if (property_location === '') {
                $('#property_location-error').text('Please input property location').css('color', 'red');
                $('#property_location').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for property location if needed
            
            $('#property_location-error').empty();
            $('#property_location').removeClass('is-invalid');
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
    });
</script>
<?php include ('../includes/bottom.php'); ?>