<?php
    include ('../includes/header.php');
    $from = isset($_POST['from']) ? $_POST['from'] : date("Y-m-d",strtotime(date("Y-m-d"))); 
    $to = isset($_POST['to']) ? $_POST['to'] : date("Y-m-d",strtotime(date("Y-m-d"))); 
    function duration($dur = 0){
        if($dur == 0){
            return "00:00";
        }
        $hours = floor($dur / (60 * 60));
        $min = floor($dur / (60)) - ($hours*60);
        $dur = sprintf("%'.02d",$hours).":".sprintf("%'.02d",$min);
        return $dur;
    }
?>
<head>
    <!-- Select2 CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <style type="text/css">
        #datatablesSimple th:nth-child(7) {
            width: 15% !important;
        }
        @media print{
            body{
                margin-top: -30px;
            }
            .bg-success-print {
                background-color: #28a745 !important; /* Green color for success */
                color: #fff !important; /* White text for better visibility on dark background */
            }
            .noprint{
                display: none;
            }
            .print-adjust {
                margin-top:-50px;
            }
            .print-table-adjust{
                zoom: 50%;
            }
            .noprint-scroll{
            overflow-x: unset !important;
            }
            @page {
                size: auto;
                margin: 0mm;
            }
        }
        #sys_logo{
            object-fit:cover;
            object-position:center center;
            width: 6.5em;
            height: 6.5em;
        }
    </style>
</head>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Generate Payments</h1>
        <ol class="breadcrumb mb-4 mt-3">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item">Generate Payments</li>
        </ol>
        <form action="generate_payments.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Generate form
                                <div class="float-end">
                                    <button type="submit" name="submit-btn" class="btn btn-sm btn-primary"><i class="fas fa-filter"></i> Filter</button>
                                    <button class="btn btn-sm btn-flat btn-secondary" type="button" onclick="window.print()" <?php if(isset($_POST['submit-btn'])) { } else { echo "disabled";} ?>><i class="fa fa-print"></i> Print</button>
							        <button class="btn btn-sm btn-flat btn-success" type="button" id="export-btn-csv" <?php if(isset($_POST['submit-btn'])) { } else { echo "disabled";} ?>><i class="fas fa-file-csv"></i> CSV</button>
                                </div>
                            </h4>
                        </div>
                        <div class="card-body row">
                            <!-- Select2 Example -->
                            <div class="col-md-3 mb-3">
                                <?php
                                    $staff = "SELECT user_id, CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS fullname FROM `user` WHERE `type` = 'Renter' AND `status` != 'Archive'";
                                    $staff_result = $con->query($staff);
                                ?>
                                <label for="renter" class="required">Rented By</label>
                                <select class="form-control select3" id="renter" name="renter" style="width: 100%;">
                                    <option value="">Select Rented By</option>
                                    <?php 
                                        if ($staff_result->num_rows > 0) {
                                        while($staffrow = $staff_result->fetch_assoc()) {
                                    ?>
                                    <option value="<?=$staffrow['user_id'];?>"><?=$staffrow['fullname'];?></option>
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
                                <?php
                                    $stmt = "SELECT * FROM `utilities_type` WHERE `utilities_type_status` != 'Archive'";
                                    $stmt_run = mysqli_query($con,$stmt);
                                ?>
                                <label for="payment_type" class="required">Payment Type</label>
                                <select class="form-control" id="payment_type" name="payment_type">
                                    <option value="">Select Payment Type</option>
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
                            <div class="form-group col-md-3">
                                <label for="from" class="control-label">Date From</label>
                                <input type="date" name="from" id="from" value="<?= $from ?>" class="form-control form-control-sm rounded-0">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="to" class="control-label">Date To</label>
                                <input type="date" name="to" id="to" value="<?= $to ?>" class="form-control form-control-sm rounded-0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(isset($_POST['submit-btn'])) { ?>
            <h3 class="text-center mt-5">Rental Properties Management System</h3>
            <table class="table text-center table-hover table-striped mt-1">
                <colgroup>
                    <col width="5%">
                    <col width="20%">
                    <col width="8%">
                    <col width="8%">
                    <col width="10%">
                    <col width="8%">
                    <col width="15%">
                    <col width="15%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr class="bg-success text-light">
                        <th>No.</th>
                        <th>Renter</th>
                        <th>Date Payment</th>
                        <th>Payment Type</th>
                        <th>Bill Type</th>
                        <th>Amount</th>
                        <th>Payment Remaining</th>
                        <th>Payment Reference No.</th>
                        <th>Payment Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $renter = $_POST['renter'];
                        $type = $_POST['payment_type'];
                        $qry = $con->query("SELECT *,
                        DATE_FORMAT(payment_date, '%m-%d-%Y') as new_payment_date
                        FROM payment 
                        INNER JOIN `user` ON user.user_id = payment.user_id
                        INNER JOIN `utilities_type` ON utilities_type.utilities_type_id = payment.utilities_type_id
                        INNER JOIN `payment_type` ON payment_type.payment_type_id = payment.payment_type_id
                        WHERE DATE(payment_date) BETWEEN '{$from}' AND '{$to}' 
                        ORDER BY UNIX_TIMESTAMP(payment_date) ASC;");
                        while($row = $qry->fetch_assoc()):
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $row['payment_id'] ?></td>
                            <td class=""><p class="m-0"><?php echo $row['fname'] ?> <?php echo $row['mname'] ?> <?php echo $row['lname'] ?> <?php echo $row['suffix'] ?></p></td>
                            <td class=""><?php echo $row['new_payment_date'] ?></td>
                            <td class=""><p class="m-0"><?php echo $row['payment_type_name'] ?></p></td>
                            <td class=""><p class="m-0"><?php echo $row['utilities_type_name'] ?></p></td>
                            <td class=""><p class="m-0"><?php echo $row['payment_amount'] ?></p></td>
                            <td class=""><p class="m-0"><?php echo $row['payment_remaining'] ?></p></td>
                            <td class=""><p class="m-0"><?php echo $row['payment_reference'] ?></p></td>
                            <td class=""><p class="m-0"><?php echo $row['payment_status'] ?></p></td>
                        </tr>
                    <?php endwhile; ?>
                    <?php if($qry->num_rows <= 0): ?>
                        <tr>
                            <th class="py-1 text-center" colspan="15">No Data.</th>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <?php } ?>
        </form>
    </div>
</main>
<script>
    document.getElementById('property_status').addEventListener('change', function () {
        var dateContainer = document.getElementById('dateContainer');
        var propertyDate = document.getElementById('property_date');

        if (this.value === 'Rented') {
            dateContainer.classList.remove('d-none');
            propertyDate.required = true;
        } else {
            dateContainer.classList.add('d-none');
            propertyDate.required = false;
        }
    });
</script>
<?php include ('../includes/bottom.php'); ?>