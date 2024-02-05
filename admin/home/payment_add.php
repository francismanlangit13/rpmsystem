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
        <h1 class="mt-4">Pay Rental</h1>
        <ol class="breadcrumb mb-4 mt-3">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="./payment" class="text-decoration-none">Payment</a></li>
            <li class="breadcrumb-item">Pay Rental</li>
        </ol>
        <form id="myForm" action="payment_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Payment form
                                <div class="float-end">
                                    <button type="submit" class="btn btn-primary" id="submit-btn" onclick="return validateForm()"><i class="fas fa-plus"></i> Add</button>
                                    <input type="hidden" id="pay_cash_advance" name="pay_cash_advance" value="1" disabled>
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Select2 Example -->
                                <div class="col-md-4 mb-3">
                                    <?php
                                        $client = "SELECT user_id, CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS fullname FROM `user` WHERE `type` = 'Renter' AND `is_rented` = '1' AND `status` != 'Inactive'";
                                        $client_result = $con->query($client);
                                    ?>
                                    <label for="add_renter" class="required">Rentee</label>
                                    <select class="form-control select2" id="add_renter" name="add_renter" style="width: 100%;" required>
                                        <option value="">Select Rentee</option>
                                        <?php 
                                            if ($client_result->num_rows > 0) {
                                            while($clientrow = $client_result->fetch_assoc()) {
                                        ?>
                                        <option value="<?=$clientrow['user_id'];?>"><?=$clientrow['fullname'];?></option>
                                        <?php } } ?>
                                    </select>
                                    <div id="add_renter-error"></div>
                                    <input type="checkbox" id="pay_rent_cash_advance" name="pay_rent_cash_advance" value="1" onclick="toggleSelectPayCashAdvance()">
                                    <label for="pay_rent_cash_advance"> Check this if the payment is Rent via Payment Advance</label><br>
                                </div>
                                <!-- Initialize Select2 -->
                                <script>
                                    $(document).ready(function () {
                                        // Initialize Select2 Elements
                                        $('.select2').select2();
                                    });
                                </script>

                                <div class="col-md-4 mb-3" id="Container">
                                    <?php
                                        $stmt = "SELECT * FROM `utility_type` WHERE `utility_type_id` != '1' AND `utility_type_status` != 'Inactive'";
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
                                    <input type="checkbox" id="pay_rent" name="pay_rent" value="1" onclick="toggleSelect()">
                                    <label for="pay_rent"> Check this if the payment is Rent</label><br>
                                </div>

                                <div class="col-md-4 mb-3" id="Container1">
                                    <label for="payment_amount" class="required">Amount</label>
                                    <input type="number" class="form-control" placeholder="Enter Property Cost" name="payment_amount" id="payment_amount" required>
                                    <div id="payment_amount-error"></div>
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
                            <button type="submit" name="add_payment" id="addButton" class="btn btn-success">Pay</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
<script>
    function toggleSelectPayCashAdvance() {
        var utility_type_id = document.getElementById('utility_type_id');
        var utility_type_id1 = document.getElementById('utility_type_id');
        var payment_amount = document.getElementById('payment_amount');
        var payment_amount1 = document.getElementById('payment_amount');
        var checkbox = document.getElementById('pay_rent_cash_advance');
        var uncheckbox = document.getElementById('pay_rent');
        var pay_cash_advance = document.getElementById('pay_cash_advance');

        if (checkbox.checked) {
            Container.classList.add('d-none');
            Container1.classList.add('d-none');

            utility_type_id.required = false;
            payment_amount.required = false;
            utility_type_id1.disabled = true;
            payment_amount1.disabled = true;
            uncheckbox.checked = false;
            pay_cash_advance.disabled = false;
        } else {
            Container.classList.remove('d-none');
            Container1.classList.remove('d-none');

            utility_type_id.required = true;
            payment_amount.required = true;
            utility_type_id1.disabled = false;
            payment_amount1.disabled = false;
            uncheckbox.checked = false;
            pay_cash_advance.disabled = true;
        }
    }
    function toggleSelect() {
        var select = document.getElementById('utility_type_id');
        var checkbox = document.getElementById('pay_rent');

        if (checkbox.checked) {
            select.disabled = true;
        } else {
            select.disabled = false;
        }
    }
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