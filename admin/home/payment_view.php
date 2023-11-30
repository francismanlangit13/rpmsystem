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
                $sql = "SELECT *, DATE_FORMAT(payment_date, '%M %d, %Y %h:%i %p') as new_payment_date, CONCAT(`fname`, ' ', `mname`, ' ', `lname`, ' ', `suffix`) AS `renter_fullname` FROM `payment` INNER JOIN `user` ON user.user_id = payment.user_id INNER JOIN property ON payment.user_id = property.rented_by WHERE `payment`.`status` != 'Archive'";
                $sql_run = mysqli_query($con, $sql);

                if(mysqli_num_rows($sql_run) > 0) {
                    foreach($sql_run as $row){
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
                                    <label for="renter">Renter</label>
                                    <input type="text" class="form-control" id="renter" value="<?= $row['renter_fullname']; ?>" disabled>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="property_location">Property Location</label>
                                    <input type="text" class="form-control" id="property_location" value="<?= $row['property_location']; ?>" disabled>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" value="<?= $row['phone']; ?>" disabled>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="payment_type">Type</label>
                                    <input type="text" class="form-control" id="payment_type" value="<?= $row['payment_type']; ?>" disabled>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="payment_amount">Amount</label>
                                    <input type="number" class="form-control" id="payment_amount" value="<?= $row['payment_amount']; ?>" disabled>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="payment_remaining">Remaining Balance</label>
                                    <input type="number" class="form-control" id="payment_remaining" value="<?= $row['payment_remaining']; ?>" disabled>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="payment_date">Payment Date</label>
                                    <input type="text" class="form-control" id="payment_date" value="<?= $row['new_payment_date']; ?>" disabled>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="payment_status">Payment Status</label>
                                    <input type="text" class="form-control" id="payment_status" value="<?= $row['payment_status']; ?>" disabled>
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