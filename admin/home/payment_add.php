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
                                    <label for="add_renter" class="required">Renter</label>
                                    <select class="form-control select3" id="add_renter" name="add_renter" style="width: 100%;" required>
                                        <option value="">Select Renter</option>
                                        <?php 
                                            if ($client_result->num_rows > 0) {
                                            while($clientrow = $client_result->fetch_assoc()) {
                                        ?>
                                        <option value="<?=$clientrow['user_id'];?>"><?=$clientrow['fullname'];?></option>
                                        <?php } } ?>
                                    </select>
                                    <div id="add_renter-error"></div>
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
                                    <input type="number" class="form-control" placeholder="Enter Property Cost" name="payment_amount" id="payment_amount" required>
                                    <div id="payment_amount-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="payment_status" class="required">Payment Status</label>
                                        <select class="form-control" name="payment_status" id="payment_status" required>
                                            <option value="">Select Payment Status</option>
                                            <option value="Partial">Partial</option>
                                            <option value="Full">Full</option>
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
    </div>
</main>
<?php include ('../includes/bottom.php'); ?>