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
                                    <input type="hidden" id="renter" name="renter" value="<?=$user_id?>">
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3" id="Container">
                                    <?php
                                        $stmt = "SELECT * FROM `utilities_type` WHERE `utilities_type_status` != 'Archive'";
                                        $stmt_run = mysqli_query($con,$stmt);
                                    ?>
                                    <label for="utilities_type_id" class="required">Bill Type</label>
                                    <select class="form-control" id="utilities_type_id" name="utilities_type_id" required>
                                        <option value="">Select Bill Type</option>
                                        <?php
                                            // use a while loop to fetch data
                                            while ($utilities_type = mysqli_fetch_array($stmt_run,MYSQLI_ASSOC)):;
                                        ?>
                                            <option value="<?= $utilities_type["utilities_type_id"]; ?>"><?= $utilities_type["utilities_type_name"]; ?></option>
                                        <?php
                                            endwhile; // While loop must be terminated
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3" id="Container">
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

                                <div class="col-md-4 mb-3" id="Container1">
                                    <label for="payment_reference" class="required">Reference #</label>
                                    <input type="text" class="form-control" placeholder="Enter Reference #" name="payment_reference" id="payment_reference" required>
                                    <div id="payment_reference-error"></div>
                                </div>

                                <div class="col-md-4 mb-3" id="Container1">
                                    <label for="payment_amount" class="required">Amount</label>
                                    <input type="number" class="form-control" placeholder="Enter Amount" name="payment_amount" id="payment_amount" required>
                                    <div id="payment_amount-error"></div>
                                </div>
                            </div>
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
<?php include ('../includes/bottom.php'); ?>