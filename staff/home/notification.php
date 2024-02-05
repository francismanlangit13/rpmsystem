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
        <h1 class="mt-4">Notification</h1>
        <ol class="breadcrumb mb-4 mt-3">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item">Notification</li>
        </ol>
        <form id="myForm" action="notification_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Notification form
                                <div class="float-end btn-disabled">
                                    <button type="submit" class="btn btn-primary" id="submit-btn" onclick="return validateForm()"><i class="fas fa-paper-plane"></i> Send</button>
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <!-- Select2 Example -->
                            <div class="col-md-5 mb-3">
                                <?php
                                    $staff = "SELECT user_id, CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS fullname FROM `user` WHERE `type` = 'Renter' AND `status` != 'Inactive'";
                                    $staff_result = $con->query($staff);
                                ?>
                                <label for="renter" class="required">Rented By</label>
                                <select class="form-control select3" id="renter" name="renter" style="width: 100%;" required>
                                    <option value="">Select Rented By</option>
                                    <option value=" ">None</option>
                                    <?php 
                                        if ($staff_result->num_rows > 0) {
                                        while($staffrow = $staff_result->fetch_assoc()) {
                                    ?>
                                    <option value="<?=$staffrow['user_id'];?>"><?=$staffrow['fullname'];?></option>
                                    <?php } } ?>
                                </select>
                                <div id="renter-error"></div>
                            </div>
                            <!-- Initialize Select2 -->
                            <script>
                                $(document).ready(function () {
                                    // Initialize Select2 Elements
                                    $('.select3').select2();
                                });
                            </script>

                            <div class="col-md-12 mb-3">
                                <label for="body" class="required">Body</label>
                                <textarea type="text" class="form-control" placeholder="Enter Body" name="body" id="body" required></textarea>
                                <div id="body-error"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal User Delete -->
            <div class="modal fade" id="Modal_send" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirm send</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want send?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success" name="send_notification" id="sendButton"><i class="fas fa-paper-plane"></i> Send</button>
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
        $(document).on('click', '#sendButton', function() {
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
            $('#Modal_send').modal('show');
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
        var debouncedCheckBody = _.debounce(checkBody, 500);

        // attach event listeners for each input field
        $('#renter').on('change', debouncedCheckRenter);
        $('#body').on('input', debouncedCheckBody);

        $('#renter').on('blur', debouncedCheckRenter);
        $('#body').on('blur', debouncedCheckBody);

        function checkIfAllFieldsValid() {
            // check if all input fields are valid and enable submit button if so
            if ( $('#renter-error').is(':empty') && $('#body-error').is(':empty') ) {
                $('#submit-btn').prop('disabled', false);
            } else {
                $('#submit-btn').prop('disabled', true);
            }
        }

        function checkRenter() {
            var renter = $('#renter').val()
            
            // show error if renter is empty
            if (!renter || renter.trim() === '') {
                $('#renter-error').text('Please select rentee').css('color', 'red');
                $('#renter').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for renter if needed
            
            $('#renter-error').empty();
            $('#renter').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }

        function checkBody() {
            var body = $('#body').val().trim();
            
            // show error if body is empty
            if (body === '') {
                $('#body-error').text('Please input body').css('color', 'red');
                $('#body').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for body if needed
            
            $('#body-error').empty();
            $('#body').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }
    });
</script>
<?php include ('../includes/bottom.php'); ?>