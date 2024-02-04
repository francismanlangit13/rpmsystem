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
        <h1 class="mt-4">Edit Payment</h1>
        <ol class="breadcrumb mb-4 mt-3">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="./payment" class="text-decoration-none">Payment</a></li>
            <li class="breadcrumb-item">Edit Payment</li>
        </ol>
        <?php
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                // $sql = "SELECT * FROM `payment` INNER JOIN `user` ON user.user_id = payment.user_id WHERE `payment_id` = '$id' AND `payment`.`status` != 'Archive'";
                $sql = "SELECT *, payment.last_update_date AS new_last_update_date FROM `payment` INNER JOIN `user` ON user.user_id = payment.user_id INNER JOIN `utility` ON utility.utility_id = payment.utility_id WHERE `payment_id` = '$id' AND `payment`.`status` != 'Archive'";
                $sql_run = mysqli_query($con, $sql);

                if(mysqli_num_rows($sql_run) > 0) {
                    foreach($sql_run as $row){

                        // Assuming $row['utility_date'] is in the format 'YYYY-MM-DD'
                        $utilityDate = $row['utility_date'];

                        if($row['payment_status'] == 'Paid'){
                            $currentDate = $row['new_last_update_date'];
                        } else {
                            // Get the current date
                            $currentDate = date('Y-m-d');
                        }

                        // Convert the dates to DateTime objects
                        $utilityDateTime = new DateTime($utilityDate);
                        $currentDateTime = new DateTime($currentDate);

                        // Calculate the difference in months
                        $monthDiff = $currentDateTime->diff($utilityDateTime)->format('%m');

                        // Check the payment status
                        $paymentStatus = $row['payment_status'];

                        if ($paymentStatus === 'Partial') {
                            $balance = $row['utility_amount'] + $row['utility_amount'] * 0.05 * $monthDiff;
                            $balance_formatted = number_format($balance, 2);
                        } elseif ($paymentStatus === 'Paid') {
                            $balance = $row['payment_amount'];
                        } else {
                            // Handle other payment statuses if needed
                            $balance = "0";
                        }
        ?>
        <?php if($row['payment_type_id'] != '1'){ ?>
            <form action="payment_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Payment form
                                    <div class="float-end">
                                        <button type="submit" name="edit_payment" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                                        <input type="hidden" name="payment_id" value="<?=$row['payment_id']?>">
                                        <input type="hidden" name="payment_amount" value="<?= $row['payment_amount']; ?>">
                                    </div>
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label for="renter">Renter</label>
                                        <input type="text" class="form-control" id="renter" value="<?= $row['renter_fullname']; ?>" disabled>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="payment_reference">Reference Number</label>
                                        <input type="number" class="form-control" id="payment_reference" value="<?= $row['payment_reference']; ?>" disabled>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="payment_amount">Amount</label>
                                        <input type="number" class="form-control" id="payment_amount" min="0" max="<?=$balance?>" value="<?= $row['payment_amount']; ?>" oninput="updateBalance()" disabled>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="payment_balance">Balance</label>
                                        <input type="number" class="form-control-plaintext" id="payment_balance" value="<?= $balance ?>" disabled>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="payment_status" class="required">Status</label>
                                        <select class="form-control" name="payment_status" id="payment_status" required>
                                            <option value="">Select Payment Status</option>
                                            <option value="Partial" <?= isset($row['payment_status']) && $row['payment_status'] == 'Partial' ? 'selected' : '' ?>>Partial</option>
                                            <option value="Paid" <?= isset($row['payment_status']) && $row['payment_status'] == 'Paid' ? 'selected' : '' ?>>Paid</option>
                                            <option value="Reject" <?= isset($row['payment_status']) && $row['payment_status'] == 'Reject' ? 'selected' : '' ?>>Reject</option>
                                        </select>
                                        <div id="payment_status-error"></div>
                                    </div>

                                    <div class="col-md-12 mb-3 <?php if($row['payment_status'] == 'Reject') { } else { echo"d-none"; }?>" id="Container">
                                        <label for="payment_comment">Note if rejected</label>
                                        <input type="text" class="form-control" id="payment_comment" name="payment_comment" value="<?= $row['payment_comment']; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <?php } else { ?>
            <form action="payment_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Payment form
                                    <div class="float-end">
                                        <button type="submit" name="edit_payment" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                                        <input type="hidden" name="payment_id" value="<?=$row['payment_id']?>">
                                        <input type="hidden" name="payment_status" value="<?=$row['payment_status']?>">
                                    </div>
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label for="payment_amount">Payment Amount</label>
                                        <input type="number" class="form-control" id="payment_amount" name ="payment_amount" min="0" max="<?=$balance?>" value="<?= $row['payment_amount']; ?>" oninput="updateBalance()">
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="payment_balance">Balance</label>
                                        <input type="number" class="form-control-plaintext" id="payment_balance" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <?php } } } else{ ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Payment info</h4>
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

<!-- Script for changing balance based on input payment_amount -->
<script>
    // Fetch initial balance from PHP
    var initialBalance = <?= $balance ?>;

    function updateBalance() {
        // Get the payment amount input value
        var paymentAmount = parseFloat(document.getElementById("payment_amount").value) || 0;

        // Calculate the balance
        var balance = initialBalance - paymentAmount;

        // Set the balance input value
        document.getElementById("payment_balance").value = balance < 0 ? 0 : balance;

        // Update payment_status based on balance
        var paymentStatusInput = document.querySelector('input[name="payment_status"]');
        if (balance === 0) {
            paymentStatusInput.value = 'Paid';
        } else {
            paymentStatusInput.value = 'Partial';
        }
    }

    // Call updateBalance after the page loads
    document.addEventListener("DOMContentLoaded", function() {
        updateBalance();
    });
</script>

<!-- <script>
    document.getElementById('payment_status').addEventListener('change', function () {
        var Container = document.getElementById('Container');
        var payment_comment = document.getElementById('payment_comment');
        var payment_comment1 = document.getElementById('payment_comment');
        if (this.value === 'Reject') {
            Container.classList.remove('d-none');
            payment_comment.required = true;
            payment_comment1.disabled = false;
        } else {
            Container.classList.add('d-none');
            payment_comment.required = false;
            payment_comment1.disabled = true;
        }
    });
</script> -->
<?php include ('../includes/bottom.php'); ?>