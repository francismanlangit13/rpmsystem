<?php include ('../includes/header.php'); ?>
<style type="text/css">
    #datatablesSimple th:nth-child(7) {
        width: 15% !important;
    }
</style>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Add Payment Type</h1>
        <ol class="breadcrumb mb-4 mt-3">
            <li class="breadcrumb-item active"><a href="./home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="./payment_type" class="text-decoration-none">Payment Type</a></li>
            <li class="breadcrumb-item">Add Payment Type</li>
        </ol>
        <form id="myForm" action="payment_type_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Payment Type form
                                <div class="float-end btn-disabled">
                                    <button type="submit" class="btn btn-primary" id="submit-btn" onclick="return validateForm()"><i class="fas fa-plus"></i> Add</button>
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="payment_type_name" class="required">Payment Type</label>
                                    <input type="text" class="form-control" placeholder="Enter Payment Type" name="payment_type_name" id="payment_type_name" required>
                                    <div id="payment_type_name-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="payment_account_number" class="required">Account Number</label>
                                    <input type="text" class="form-control" placeholder="Enter Account Number" name="payment_account_number" id="payment_account_number" required>
                                    <div id="payment_account_number-error"></div>
                                </div>

                                <div class="col-md-4 mb-3" id="Container">
                                    <label for="image1" class="required">QR Code Attachment</label>
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
                            <button type="submit" name="add_payment_type" id="addButton" class="btn btn-success">Yes</button>
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
        var debouncedCheckPaymenttype = _.debounce(checkPaymenttype, 500);
        var debouncedCheckAccountnumber = _.debounce(checkAccountnumber, 500);

        // attach event listeners for each input field
        $('#payment_type_name').on('input', debouncedCheckPaymenttype);
        $('#payment_account_number').on('input', debouncedCheckAccountnumber);

        $('#payment_type_name').on('blur', debouncedCheckPaymenttype);
        $('#payment_account_number').on('blur', debouncedCheckAccountnumber);

        function checkIfAllFieldsValid() {
            // check if all input fields are valid and enable submit button if so
            if ( $('#payment_type_name-error').is(':empty') && $('#payment_account_number-error').is(':empty') ) {
                $('#submit-btn').prop('disabled', false);
            } else {
                $('#submit-btn').prop('disabled', true);
            }
        }

        function checkPaymenttype() {
            var payment_type_name = $('#payment_type_name').val().trim();
            
            // show error if payment type is empty
            if (payment_type_name === '') {
                $('#payment_type_name-error').text('Please input payment type').css('color', 'red');
                $('#payment_type_name').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for payment type if needed
            
            $('#payment_type_name-error').empty();
            $('#payment_type_name').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkAccountnumber() {
            var payment_account_number = $('#payment_account_number').val().trim();
            
            // show error if account number is empty
            if (payment_account_number === '') {
                $('#payment_account_number-error').text('Please input account number').css('color', 'red');
                $('#payment_account_number').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for account number if needed
            
            $('#payment_account_number-error').empty();
            $('#payment_account_number').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }
    });
</script>
<?php include ('../includes/bottom.php'); ?>