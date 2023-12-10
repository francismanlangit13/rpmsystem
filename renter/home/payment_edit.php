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
                $sql = "SELECT *, CONCAT(`fname`, ' ', `mname`, ' ', `lname`, ' ', `suffix`) AS `renter_fullname` FROM `payment` INNER JOIN `user` ON user.user_id = payment.user_id INNER JOIN property ON payment.user_id = property.rented_by WHERE `payment_id` = '$id' AND payment.payment_type_id != '1' AND `payment`.`status` != 'Archive'";
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
                                        <input type="hidden" name="payment_amount" value="<?= $row['payment_amount']; ?>">
                                    </div>
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label for="payment_reference">Reference Number</label>
                                        <input type="text" class="form-control" id="payment_reference" name="payment_reference" value="<?= $row['payment_reference']; ?>" required>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="payment_amount">Amount</label>
                                        <input type="text" class="form-control" id="payment_amount" value="<?= $row['payment_amount']; ?>" disabled>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="payment_status">Status</label>
                                        <input type="text" class="form-control" id="payment_status" value="<?= $row['payment_status']; ?>" disabled>
                                    </div>

                                    <div class="col-md-12 mb-3 d-none" id="Container">
                                        <label for="payment_comment">Note if rejected</label>
                                        <input type="text" class="form-control" id="payment_comment" value="<?= $row['payment_comment']; ?>">
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
<script>
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
</script>
<?php include ('../includes/bottom.php'); ?>