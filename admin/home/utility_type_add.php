<?php include ('../includes/header.php'); ?>
<style type="text/css">
    #datatablesSimple th:nth-child(7) {
        width: 15% !important;
    }
</style>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Add Utility Type</h1>
        <ol class="breadcrumb mb-4 mt-3">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="./utility_type" class="text-decoration-none">Utility Type</a></li>
            <li class="breadcrumb-item">Add Utility Type</li>
        </ol>
        <form id="myForm" action="utility_type_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Utility Type form
                                <div class="float-end btn-disabled">
                                    <button type="submit" class="btn btn-primary" id="submit-btn" onclick="return validateForm()"><i class="fas fa-plus"></i> Add</button>
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="utility_type_name" class="required">Utility Type</label>
                                    <input type="text" class="form-control" placeholder="Enter Utility Type" name="utility_type_name" id="utility_type_name" required>
                                    <div id="utility_type_name-error"></div>
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
                            <button type="submit" name="add_utility_type" id="addButton" class="btn btn-success">Yes</button>
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
        var debouncedcheckUtilitytype = _.debounce(checkUtilitytype, 500);

        // attach event listeners for each input field
        $('#utility_type_name').on('input', debouncedcheckUtilitytype);

        $('#utility_type_name').on('blur', debouncedcheckUtilitytype);

        function checkIfAllFieldsValid() {
            // check if all input fields are valid and enable submit button if so
            if ( $('#utility_type_name-error').is(':empty') ) {
                $('#submit-btn').prop('disabled', false);
            } else {
                $('#submit-btn').prop('disabled', true);
            }
        }

        function checkUtilitytype() {
            var utility_type_name = $('#utility_type_name').val().trim();
            
            // show error if utility type is empty
            if (utility_type_name === '') {
                $('#utility_type_name-error').text('Please input property type').css('color', 'red');
                $('#utility_type_name').addClass('is-invalid');
                checkIfAllFieldsValid();
                return;
            }
            
            // Perform additional validation for utility type if needed
            
            $('#utility_type_name-error').empty();
            $('#utility_type_name').removeClass('is-invalid');
            checkIfAllFieldsValid();
        }
    });
</script>
<?php include ('../includes/bottom.php'); ?>