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
                $sql = "SELECT * FROM `payment` INNER JOIN `user` ON user.user_id = payment.user_id INNER JOIN property ON payment.user_id = property.rented_by WHERE `payment_status` != 'Archive'";
                $sql_run = mysqli_query($con, $sql);

                if(mysqli_num_rows($sql_run) > 0) {
                    foreach($sql_run as $row){
        ?>
        <form action="payment_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Payment form
                                <div class="float-end">
                                    <button type="submit" name="edit_payment" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                                    <input type="hidden" name="payment_id" value="<?=$row['payment_id']?>">
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Select2 Example -->
                                <div class="col-md-4 mb-3">
                                    <?php
                                        $client = "SELECT user_id, CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS fullname FROM `user` WHERE `type` = 'Renter'";
                                        $client_result = $con->query($client);
                                    ?>
                                    <label for="renter" class="required">Renter</label>
                                    <select class="form-control select3" id="renter" name="renter" style="width: 100%;" required>
                                        <option value="">Select Renter</option>
                                        <?php 
                                        if ($client_result->num_rows > 0) {
                                            while ($clientrow = $client_result->fetch_assoc()) {
                                                $selected = ($clientrow['user_id'] == $row['rented_by']) ? 'selected' : '';
                                        ?>
                                        <option value="<?=$clientrow['user_id'];?>" <?=$selected;?>><?=$clientrow['fullname'];?></option>
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

                                <div class="col-md-3 mb-3">
                                    <label for="payment_amount" class="required">Amount</label>
                                    <input type="number" class="form-control" placeholder="Enter Property Cost" name="payment_amount" id="payment_amount" value="<?= $row['payment_amount']; ?>" required>
                                    <div id="payment_amount-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="payment_status" class="required">Payment Status</label>
                                        <select class="form-control" name="payment_status" id="payment_status" required>
                                            <option value="">Select Payment Status</option>
                                            <option value="Partial" <?= isset($row['payment_status']) && $row['payment_status'] == 'Partial' ? 'selected' : '' ?>>Partial</option>
                                            <option value="Full" <?= isset($row['payment_status']) && $row['payment_status'] == 'Full' ? 'selected' : '' ?>>Full</option>
                                        </select>
                                        <div id="payment_status-error"></div>
                                    </div>
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