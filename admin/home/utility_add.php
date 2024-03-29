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
        <h1 class="mt-4">Add Manage Bills</h1>
        <ol class="breadcrumb mb-4 mt-3">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="./utility" class="text-decoration-none">Manage Bills</a></li>
            <li class="breadcrumb-item">Add Manage Bills</li>
        </ol>
        <form id="myForm" action="utility_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Manage Bills form
                                <div class="float-end btn-disabled">
                                    <button type="submit" class="btn btn-primary" id="submit-btn" onclick="return validateForm()"><i class="fas fa-plus"></i> Add</button>
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Select2 Example -->
                                <div class="col-md-4 mb-3">
                                    <?php
                                        $renter = "SELECT *, CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS fullname FROM `user` WHERE `type` = 'Renter' AND  `is_rented` = '1' AND status = 'Active'";
                                        $renter_result = $con->query($renter);
                                    ?>
                                    <label for="renter" class="required">Rentee</label>
                                    <select class="form-control select2" id="renter" name="renter" style="width: 100%;" required>
                                        <option value="">Select Rentee</option>
                                        <?php 
                                            if ($renter_result->num_rows > 0) {
                                            while($renterrow = $renter_result->fetch_assoc()) {
                                        ?>
                                        <option value="<?=$renterrow['user_id'];?>"><?=$renterrow['fullname'];?></option>
                                        <?php } } ?>
                                    </select>
                                    <div id="renter-error"></div>
                                </div>
                                <!-- Initialize Select2 -->
                                <script>
                                    $(document).ready(function () {
                                        // Initialize Select2 Elements
                                        $('.select2').select2();
                                    });
                                </script>

                                <div class="col-md-4 mb-3">
                                    <?php
                                        $stmt = "SELECT * FROM `utility_type` WHERE `utility_type_status` != 'Inactive'";
                                        $stmt_run = mysqli_query($con,$stmt);
                                    ?>
                                    <label for="utility_type_id" class="required">Bills Type</label>
                                    <select class="form-control" id="utility_type_id" name="utility_type_id" required>
                                        <option value="">Select Bills Type</option>
                                        <?php
                                            // use a while loop to fetch data
                                            while ($utility_type = mysqli_fetch_array($stmt_run,MYSQLI_ASSOC)):;
                                        ?>
                                            <option value="<?= $utility_type["utility_type_id"]; ?>"><?= $utility_type["utility_type_name"]; ?></option>
                                        <?php
                                            endwhile; // While loop must be terminated
                                        ?>
                                    </select>
                                    <div id="utility_type_id-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="utility_amount" class="required">Bill Amount</label>
                                    <input type="number" class="form-control" placeholder="Enter Bill Amount" name="utility_amount" id="utility_amount" required>
                                    <div id="utility_amount-error"></div>
                                </div>

                                <div class="col-md-4 mb-3" id="Container">
                                    <label for="image1" class="required">Bill Attachment</label>
                                    <input type="file" name="image1" class="form-control btn btn-secondary" style="padding-bottom:2.2rem;" id="image1" accept=".jpg, .jpeg, .png" onchange="previewImage('frame1', 'image1')" required>
                                    <div id="image1-error"></div>
                                </div>

                                <div class="col-md-8" id="Container1"></div>

                                <div class="col-md-4 text-center" id="Container2">
                                    <h6>JPG or PNG no larger than 5 MB</h6> 
                                    <a href="<?php echo base_url . 'assets/files/system/no-image.png'; ?>" class="glightbox d-block" data-gallery="Attachment">
                                        <img class="zoom img-fluid img-bordered-sm" id="frame1" src="<?php echo base_url . 'assets/files/system/no-image.png'; ?>" alt="image" style="height: 180px; max-width: 240px; object-fit: cover;">
                                    </a>
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
                            <button type="submit" name="add_utility" id="addButton" class="btn btn-success">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>

<!-- Script for Bills Type if Rent hidden forms -->
<script>
    document.getElementById('utility_type_id').addEventListener('change', function () {
        var Container = document.getElementById('Container');
        var Container1 = document.getElementById('Container1');
        var Container2 = document.getElementById('Container2');
        var image1 = document.getElementById('image1');

        if (this.value === '1') {
            Container.classList.add('d-none');
            Container1.classList.add('d-none');
            Container2.classList.add('d-none');
            image1.required = false;
            image1.disabled = true;
        } else {
            Container.classList.remove('d-none');
            Container1.classList.remove('d-none');
            Container2.classList.remove('d-none');
            image1.required = true;
            image1.disabled = false;
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
        var debouncedCheckRenter = _.debounce(checkRenter, 500);
        var debouncedCheckUtilitytype = _.debounce(checkUtilitytype, 500);
        var debouncedCheckUtilityamount = _.debounce(checkUtilityamount, 500);

        // attach event listeners for each input field
        $('#renter').on('change', debouncedCheckRenter);
        $('#utility_type_id').on('input', debouncedCheckUtilitytype);
        $('#utility_amount').on('input', debouncedCheckUtilityamount);

        $('#renter').on('blur', debouncedCheckRenter);
        $('#utility_type_id').on('blur', debouncedCheckUtilitytype);
        $('#utility_amount').on('blur', debouncedCheckUtilityamount);

        // Initialize Select2 Elements
        $('.select2').select2();

        // handle Select2 change event for renter
        $('#renter').on('change', function () {
            debouncedCheckRenter();
        });

        // handle Select2 opening and closing events for renter
        $('#renter').on('select2:open', function (event) {
            // Set a flag to track if the dropdown was opened
            $(this).data('dropdownOpened', true);
        }).on('select2:close', function (event) {
            // Check if the dropdown was opened and no option was selected
            if ($(this).data('dropdownOpened') && $(this).val() === '') {
                $('#renter-error').text('Please select rentee').css('color', 'red');
                $('.select2-selection').css('border-color', '#dc3545');
                $('#renter').addClass('is-invalid');
                checkIfAllFieldsValid();
            }
            // Reset the flag
            $(this).data('dropdownOpened', false);
        });

        function checkIfAllFieldsValid() {
            // check if all input fields are valid and enable submit button if so
            if ( $('#renter-error').is(':empty') &&
                 $('#utility_type_id-error').is(':empty') &&
                 $('#utility_amount-error').is(':empty') ) {
                $('#submit-btn').prop('disabled', false);
            } else {
                $('#submit-btn').prop('disabled', true);
            }
        }

        function checkRenter() {
            var renter = $('#renter').val().trim();
            
            // show error if renter is empty
            if (renter === '') {
                $('#renter-error').text('Please select rentee').css('color', 'red');
                $('.select2-selection').css('border-color', '#dc3545'); // Apply border color when is-invalid class is added
                $('#renter').addClass('is-invalid');

                checkIfAllFieldsValid();
                return;
            }

            $('#renter-error').empty();
            $('#renter').removeClass('is-invalid');

            // Remove border color when is-invalid class is removed
            $('.select2-selection').css('border-color', '');

            checkIfAllFieldsValid();
        }

        function checkUtilitytype() {
            var utility_type_id = $('#utility_type_id').val().trim();
            
            // show error if utility type is empty
            if (utility_type_id === '') {
                $('#utility_type_id-error').text('Please select bill type').css('color', 'red');
                $('#utility_type_id').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for utility type if needed
            
            $('#utility_type_id-error').empty();
            $('#utility_type_id').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkUtilityamount() {
            var utility_amount = $('#utility_amount').val().trim();
            
            // show error if utility amount is empty
            if (utility_amount === '') {
                $('#utility_amount-error').text('Please input bill amount').css('color', 'red');
                $('#utility_amount').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for utility amount if needed
            
            $('#utility_amount-error').empty();
            $('#utility_amount').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }
    });
</script>
<?php include ('../includes/bottom.php'); ?>