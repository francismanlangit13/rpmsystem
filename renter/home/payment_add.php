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
        <h1 class="mt-4">Add Payment</h1>
        <ol class="breadcrumb mb-4 mt-3">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="./payment" class="text-decoration-none">Payment</a></li>
            <li class="breadcrumb-item">Add Payment</li>
        </ol>
        <form id="myForm" action="payment_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Payment form
                                <div class="float-end">
                                    <button type="submit" class="btn btn-primary" id="submit-btn" onclick="return validateForm()"><i class="fas fa-plus"></i> Add</button>
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 mb-3" id="Container">
                                    <?php
                                        $stmt = "SELECT * FROM `utility_type` WHERE `utility_type_status` != 'Archive'";
                                        $stmt_run = mysqli_query($con,$stmt);
                                    ?>
                                    <label for="utility_type_id" class="required">Bill Type</label>
                                    <select class="form-control" id="utility_type_id" name="utility_type_id" required>
                                        <option value="">Select Bill Type</option>
                                        <?php
                                            // use a while loop to fetch data
                                            while ($utility_type = mysqli_fetch_array($stmt_run,MYSQLI_ASSOC)):;
                                        ?>
                                            <option value="<?= $utility_type["utility_type_id"]; ?>"><?= $utility_type["utility_type_name"]; ?></option>
                                        <?php
                                            endwhile; // While loop must be terminated
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-3 mb-3" id="Container">
                                    <?php
                                        $stmt = "SELECT * FROM `payment_type` WHERE payment_type_id != '1' AND `payment_type_status` != 'Archive'";
                                        $stmt_run = mysqli_query($con,$stmt);
                                    ?>
                                    <label for="payment_type_id" class="required">Payment Type</label>
                                    <select class="form-control" id="payment_type_id" name="payment_type_id" required>
                                        <option value="">Select Payment Type</option>
                                        <?php
                                            // use a while loop to fetch data
                                            while ($payment_type = mysqli_fetch_array($stmt_run,MYSQLI_ASSOC)):;
                                        ?>
                                            <option value="<?= $payment_type["payment_type_id"]; ?>"><?= $payment_type["payment_type_name"]; ?></option>
                                        <?php
                                            endwhile; // While loop must be terminated
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-3 mb-3" id="Container1">
                                    <label for="payment_reference" class="required">Reference #</label>
                                    <input type="text" class="form-control" placeholder="Enter Reference #" name="payment_reference" id="payment_reference" required>
                                    <div id="payment_reference-error"></div>
                                </div>

                                <div class="col-md-3 mb-3" id="Container1">
                                    <label for="payment_amount" class="required">Amount</label>
                                    <input type="number" class="form-control" placeholder="Enter Amount" name="payment_amount" id="payment_amount" required>
                                    <div id="payment_amount-error"></div>
                                </div>

                                <div class="col-md-4 mb-3" id="Container">
                                    <label for="image1" class="required">Receipt Attachment</label>
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
                            Are you sure you want to pay?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="add_payment" id="addButton" class="btn btn-success">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>

<script>
    $(document).ready(function(){
        $('#utilities_type_id').change(function(){
            var utilities_type_id = $(this).val();

            // Make an AJAX request to payment_get.php
            $.ajax({
                type: 'POST',
                url: 'payment_get.php',
                data: { utilities_type_id: utilities_type_id },
                success: function(response){
                    // Update the max attribute
                    $('#payment_amount').attr('max', response);
                },
                error: function(){
                    alert('Error fetching amount');
                }
            });
        });
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
<?php include ('../includes/bottom.php'); ?>