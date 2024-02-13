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
        <h1 class="mt-4">View Payment</h1>
        <ol class="breadcrumb mb-4 mt-3">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="./payment" class="text-decoration-none">Payment</a></li>
            <li class="breadcrumb-item">View Payment</li>
        </ol>
        <?php
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT *, DATE_FORMAT(payment_date, '%M %d, %Y %h:%i %p') as new_payment_date, CONCAT(`fname`, ' ', `mname`, ' ', `lname`, ' ', `suffix`) AS `renter_fullname`, payment.updated_by AS new_updated_by, payment.last_update_date AS new_last_update_date FROM `payment`
                    INNER JOIN `user` ON user.user_id = payment.user_id
                    INNER JOIN payment_type ON payment.payment_type_id = payment_type.payment_type_id
                    INNER JOIN utility ON utility.utility_id = payment.utility_id
                    INNER JOIN `utility_type` ON utility_type.utility_type_id = payment.utility_type_id
                    WHERE user.user_id = '$userID' AND `payment_id` = '$id' AND `payment`.`status` != 'Archive'
                ";
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
                            $balance = $row['utility_amount'] * 0.05 * $monthDiff;
                        } elseif ($paymentStatus === 'Paid') {
                            $balance = $row['utility_amount'] * 0.05 * $monthDiff;
                            // $balance = $row['payment_amount'];
                        } else {
                            // Handle other payment statuses if needed
                            $balance = "0";
                        }
        ?>
        <form action="payment_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Payment form</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="renter"><b>Renter</b></label>
                                    <input type="text" class="form-control-plaintext" id="renter" value="<?= $row['renter_fullname']; ?>" disabled>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="phone"><b>Phone</b></label>
                                    <input type="text" class="form-control-plaintext" id="phone" value="<?= $row['phone']; ?>" disabled>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="utilities_type"><b>Bills Type</b></label>
                                    <input type="text" class="form-control-plaintext" id="utilities_type" value="<?= $row['utility_type_name']; ?>" disabled>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="payment_type"><b>Payment Type</b></label>
                                    <input type="text" class="form-control-plaintext" id="payment_type" value="<?= $row['payment_type_name']; ?>" disabled>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="expected_amount"><b>Expected Amount</b></label>
                                    <input type="text" class="form-control-plaintext" id="expected_amount" value="<?= $row['utility_amount']; ?>" disabled>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="penalty_amount"><b>Penalty Amount 5%</b></label>
                                    <input type="text" class="form-control-plaintext" id="penalty_amount" value="<?= $balance ?>" disabled>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="penalty_amount"><b>No. of months unpaid</b></label>
                                    <input type="text" class="form-control-plaintext" id="penalty_amount" value="<?= $monthDiff ?> months" disabled>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="payment_amount"><b>Paid Amount</b></label>
                                    <input type="number" class="form-control-plaintext" id="payment_amount" value="<?= $row['payment_amount']; ?>" disabled>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="payment_remaining"><b>Remaining Balance</b></label>
                                    <input type="number" class="form-control-plaintext" id="payment_remaining" value="<?= $row['payment_remaining']; ?>" disabled>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="payment_date"><b>Payment Date</b></label>
                                    <input type="text" class="form-control-plaintext" id="payment_date" value="<?= $row['new_payment_date']; ?>" disabled>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="payment_status"><b>Payment Status</b></label>
                                    <input type="text" class="form-control-plaintext" id="payment_status" value="<?= $row['payment_status']; ?>" disabled>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <?php
                                        $id_user = $row['new_updated_by'];
                                        $mysql_run = mysqli_query($con, "SELECT CONCAT(`fname`, ' ', `mname`, ' ', `lname`) AS person FROM `user` WHERE `user_id` = '$id_user'");
                                        $newrow = $mysql_run->fetch_assoc();
                                    ?>
                                    <label for="payment_status"><b>Transact by</b></label>
                                    <input type="text" class="form-control-plaintext" id="payment_status" value="<?= $newrow['person']; ?>" disabled>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="remarks"><b>Remarks</b></label>
                                    <input type="text" class="form-control-plaintext" id="remarks" value="<?= $row['remarks']; ?>" disabled>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="payment_comment"><b>Reason for Reject</b></label>
                                    <input type="text" class="form-control-plaintext" id="payment_comment" value="<?= $row['payment_comment']; ?>" disabled>
                                </div>

                                <div class="col-md-4 mt-3 text-center">
                                    <h6>Receipt Attachment</h6> 
                                    <a href="
                                        <?php
                                            if(!empty($row['payment_attachment'])){ 
                                                echo base_url . 'assets/files/attachment/' . $row['payment_attachment'];
                                            } else { echo base_url . 'assets/files/system/no-image.png'; }
                                        ?>" class="glightbox d-block" data-gallery="QRCode">
                                        <img class="zoom img-fluid img-bordered-sm" id="frame1"
                                        src="
                                            <?php
                                                if(!empty($row['payment_attachment'])) {
                                                    echo base_url . 'assets/files/attachment/' . $row['payment_attachment'];
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
        </form>
        <?php } } else{ ?>
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
<?php include ('../includes/bottom.php'); ?>