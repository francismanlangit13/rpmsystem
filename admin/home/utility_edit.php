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
        <h1 class="mt-4">Edit Manage Bills</h1>
        <ol class="breadcrumb mb-4 mt-3">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="./utility" class="text-decoration-none">Manage Bills</a></li>
            <li class="breadcrumb-item">Edit Manage Bills</li>
        </ol>
        <?php
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM `utility` WHERE `utility_id` = '$id' AND `utility_status` != 'Archive'";
                $sql_run = mysqli_query($con, $sql);

                if(mysqli_num_rows($sql_run) > 0) {
                    foreach($sql_run as $row){
        ?>
        <form id="myForm" action="utility_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Manage Bills form
                                <div class="float-end btn-disabled">
                                    <button type="submit" class="btn btn-primary" id="submit-btn" onclick="return validateForm()"><i class="fas fa-save"></i> Save</button>
                                    <input type="hidden" name="utility_id" value="<?=$row['utility_id']?>">
                                    <input type="hidden" name="oldfileimage" value="<?=$row['utility_attachment']?>" />
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Select2 Example -->
                                <div class="col-md-3 mb-3">
                                    <?php
                                        $renter = "SELECT *, CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS fullname FROM `user` WHERE `type` = 'Renter' AND `is_rented` = '1' AND `status` = 'Active'";
                                        $renter_result = $con->query($renter);
                                    ?>
                                    <label for="renter" class="required">Rentee</label>
                                    <select class="form-control select2" id="renter" name="renter" style="width: 100%;" required>
                                        <option value="">Select Rentee</option>
                                        <?php 
                                            if ($renter_result->num_rows > 0) {
                                            while($renterrow = $renter_result->fetch_assoc()) {
                                                $selected = ($renterrow['user_id'] == $row['user_id']) ? 'selected' : '';
                                        ?>
                                        <option value="<?=$renterrow['user_id'];?>" <?=$selected;?>><?=$renterrow['fullname'];?></option>
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

                                <div class="col-md-3 mb-3">
                                    <?php
                                        $stmt = "SELECT * FROM `utility_type` WHERE utility_type_status != 'Inactive'";
                                        $stmt_run = mysqli_query($con,$stmt);
                                    ?>
                                    <label for="utility_type_id" class="required">Bills Type</label>
                                    <select class="form-control" id="utility_type_id" name="utility_type_id" required>
                                        <option value="">Select Bills Type</option>
                                        <?php
                                            // use a while loop to fetch data
                                            while ($utility_type = mysqli_fetch_array($stmt_run,MYSQLI_ASSOC)):;
                                            $selected = ($utility_type['utility_type_id'] == $row['utility_type_id']) ? 'selected' : '';
                                        ?>
                                            <option value="<?= $utility_type["utility_type_id"]; ?>" <?=$selected;?>><?= $utility_type["utility_type_name"]; ?></option>
                                        <?php
                                            endwhile; // While loop must be terminated
                                        ?>
                                    </select>
                                    <div id="utility_type_id-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="utility_amount" class="required">Bill Amount</label>
                                    <input type="text" class="form-control" placeholder="Enter Utility Amount" name="utility_amount" id="utility_amount" value="<?= $row['utility_amount']; ?>" required>
                                    <div id="utility_amount-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="utility_status" class="required">Status</label>
                                        <select class="form-control" name="utility_status" id="utility_status" required>
                                            <option value="" selected>Select Status</option>
                                            <option value="Active" <?= isset($row['utility_status']) && $row['utility_status'] == 'Active' ? 'selected' : '' ?>>Active</option>
                                            <option value="Inactive" <?= isset($row['utility_status']) && $row['utility_status'] == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                                        </select>
                                        <div id="utility_status-error"></div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3 <?php if ($row['utility_type_id'] != '1'){ } else { echo"d-none"; }?>" id="Container">
                                    <label for="image1" class="required">Bill Attachment</label>
                                    <input type="file" name="image1" class="form-control btn btn-secondary" style="padding-bottom:2.2rem;" id="image1" accept=".jpg, .jpeg, .png" onchange="previewImage('frame1', 'image1')">
                                    <div id="image1-error"></div>
                                </div>

                                <div class="col-md-8 <?php if ($row['utility_type_id'] != '1'){ } else { echo"d-none"; }?>" id="Container1"></div>

                                <div class="col-md-4 text-center <?php if ($row['utility_type_id'] != '1'){ } else { echo"d-none"; }?>" id="Container2">
                                    <h6>JPG or PNG no larger than 5 MB</h6> 
                                    <a href="
                                        <?php
                                            if(!empty($row['utility_attachment'])){ 
                                                echo base_url . 'assets/files/bills/' . $row['utility_attachment'];
                                            } else { echo base_url . 'assets/files/system/no-image.png'; }
                                        ?>" class="glightbox d-block" data-gallery="QRCode">
                                        <img class="zoom img-fluid img-bordered-sm" id="frame1"
                                        src="
                                            <?php
                                                if(!empty($row['utility_attachment'])) {
                                                    echo base_url . 'assets/files/bills/' . $row['utility_attachment'];
                                                } else { echo base_url . 'assets/files/system/no-image.png'; } 
                                            ?>
                                        " alt="image" style="height: 180px; max-width: 240px; object-fit: cover;">
                                    </a>
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
                            <button type="submit" name="edit_utility" id="editButton" class="btn btn-success">Save</button>
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
                            <h4>Manage Bills info</h4>
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
            image1.disabled = true;
        } else {
            Container.classList.remove('d-none');
            Container1.classList.remove('d-none');
            Container2.classList.remove('d-none');
            image1.disabled = false;
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
        var debouncedCheckRenter = _.debounce(checkRenter, 500);
        var debouncedCheckUtilitytype = _.debounce(checkUtilitytype, 500);
        var debouncedCheckUtilityamount = _.debounce(checkUtilityamount, 500);
        var debouncedCheckUtilitystatus = _.debounce(checkUtilitystatus, 500);

        // attach event listeners for each input field
        $('#renter').on('change', debouncedCheckRenter);
        $('#utility_type_id').on('input', debouncedCheckUtilitytype);
        $('#utility_amount').on('input', debouncedCheckUtilityamount);
        $('#utility_status').on('input', debouncedCheckUtilitystatus);


        $('#renter').on('blur', debouncedCheckRenter);
        $('#utility_type_id').on('blur', debouncedCheckUtilitytype);
        $('#utility_amount').on('blur', debouncedCheckUtilityamount);
        $('#utility_status').on('blur', debouncedCheckUtilitystatus);

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
                 $('#utility_amount-error').is(':empty') &&
                 $('#utility_status-error').is(':empty') ) {
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
                $('#utility_type_id-error').text('Please select bills type').css('color', 'red');
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

        function checkUtilitystatus() {
            var utility_status = $('#utility_status').val().trim();
            
            // show error if utility amount is empty
            if (utility_status === '') {
                $('#utility_status-error').text('Please select status').css('color', 'red');
                $('#utility_status').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for utility amount if needed
            
            $('#utility_status-error').empty();
            $('#utility_status').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }
    });
</script>
<?php include ('../includes/bottom.php'); ?>