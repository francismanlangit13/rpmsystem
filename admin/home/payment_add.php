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
        <form action="payment_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Payment form
                                <div class="float-end">
                                    <button type="submit" name="add_payment" class="btn btn-primary"><i class="fas fa-plus"></i> Add</button>
                                    <input type="hidden" id="pay_cash_advance" name="pay_cash_advance" value="1" disabled>
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Select2 Example -->
                                <div class="col-md-4 mb-3">
                                    <?php
                                        $client = "SELECT user_id, CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS fullname FROM `user` WHERE `type` = 'Renter' AND `status` != 'Archive'";
                                        $client_result = $con->query($client);
                                    ?>
                                    <label for="add_renter" class="required">Renter</label>
                                    <select class="form-control select2" id="add_renter" name="add_renter" style="width: 100%;" required>
                                        <option value="">Select Renter</option>
                                        <?php 
                                            if ($client_result->num_rows > 0) {
                                            while($clientrow = $client_result->fetch_assoc()) {
                                        ?>
                                        <option value="<?=$clientrow['user_id'];?>"><?=$clientrow['fullname'];?></option>
                                        <?php } } ?>
                                    </select>
                                    <div id="add_renter-error"></div>
                                    <input type="checkbox" id="pay_rent_cash_advance" name="pay_rent_cash_advance" value="1" onclick="toggleSelectPayCashAdvance()">
                                    <label for="pay_rent_cash_advance"> Check this if the payment is Rent via Cash Advance</label><br>
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
                                        $stmt = "SELECT * FROM `utilities_type` WHERE `utilities_type_id` != '1' AND `utilities_type_status` != 'Archive'";
                                        $stmt_run = mysqli_query($con,$stmt);
                                    ?>
                                    <label for="utilities_type_id" class="required">Utilities Type</label>
                                    <select class="form-control" id="utilities_type_id" name="utilities_type_id" required>
                                        <option value="">Select Utilities Type</option>
                                        <?php
                                            // use a while loop to fetch data
                                            while ($utilities_type = mysqli_fetch_array($stmt_run,MYSQLI_ASSOC)):;
                                        ?>
                                            <option value="<?= $utilities_type["utilities_type_id"]; ?>"><?= $utilities_type["utilities_type_name"]; ?></option>
                                        <?php
                                            endwhile; // While loop must be terminated
                                        ?>
                                    </select>
                                    <div id="utilities_type_id-error"></div>
                                    <input type="checkbox" id="pay_rent" name="pay_rent" value="1" onclick="toggleSelect()">
                                    <label for="pay_rent"> Check this if the payment is Rent</label><br>
                                </div>

                                <div class="col-md-4 mb-3" id="Container1">
                                    <label for="payment_amount" class="required">Amount</label>
                                    <input type="number" class="form-control" placeholder="Enter Property Cost" name="payment_amount" id="payment_amount" required>
                                    <div id="payment_amount-error"></div>
                                </div>

                                <!-- <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="payment_status" class="required">Payment Status</label>
                                        <select class="form-control" name="payment_status" id="payment_status" required>
                                            <option value="">Select Payment Status</option>
                                            <option value="Partial">Partial</option>
                                            <option value="Full">Full</option>
                                        </select>
                                        <div id="payment_status-error"></div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
<script>
    function toggleSelectPayCashAdvance() {
        var utilities_type_id = document.getElementById('utilities_type_id');
        var utilities_type_id1 = document.getElementById('utilities_type_id');
        var payment_amount = document.getElementById('payment_amount');
        var payment_amount1 = document.getElementById('payment_amount');
        var checkbox = document.getElementById('pay_rent_cash_advance');
        var uncheckbox = document.getElementById('pay_rent');
        var pay_cash_advance = document.getElementById('pay_cash_advance');

        if (checkbox.checked) {
            Container.classList.add('d-none');
            Container1.classList.add('d-none');

            utilities_type_id.required = false;
            payment_amount.required = false;
            utilities_type_id1.disabled = true;
            payment_amount1.disabled = true;
            uncheckbox.checked = false;
            pay_cash_advance.disabled = false;
        } else {
            Container.classList.remove('d-none');
            Container1.classList.remove('d-none');

            utilities_type_id.required = true;
            payment_amount.required = true;
            utilities_type_id1.disabled = false;
            payment_amount1.disabled = false;
            uncheckbox.checked = false;
            pay_cash_advance.disabled = true;
        }
    }
    function toggleSelect() {
        var select = document.getElementById('utilities_type_id');
        var checkbox = document.getElementById('pay_rent');

        if (checkbox.checked) {
            select.disabled = true;
        } else {
            select.disabled = false;
        }
    }
</script>
<?php include ('../includes/bottom.php'); ?>