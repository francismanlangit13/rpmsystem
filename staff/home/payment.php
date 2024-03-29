<?php include ('../includes/header.php');
    $month = isset($_POST['month']) ? $_POST['month'] : date("Y-m");
    $firstDayOfMonth = date("Y-m-01", strtotime($month));
    $lastDayOfMonth = date("Y-m-t", strtotime($month));
?>
<style type="text/css">
    #datatablesSimple th:nth-child(7) {
        width: 15% !important;
    }
    .table th, .table td {
        white-space: nowrap;
    }
    @media print{
        #datatablesSimple th:nth-child(13), #datatablesSimple td:nth-child(13) {
            display: none;
        }

        /* Hide DataTables search, show entries per page, and info */
        #datatablesSimple_length,
        #datatablesSimple_filter,
        #datatablesSimple_info,
        #datatablesSimple_paginate,
        .datatable-dropdown,
        .datatable-search,
        .datatable-bottom {
            display: none;
        }
        .system-header{
            display: block !important;
        }
        .card{
            border:none !important;
        }
        body{
            margin-top: -20px;
        }
        .bg-success-print {
            background-color: #28a745 !important; /* Green color for success */
            color: #fff !important; /* White text for better visibility on dark background */
        }
        .noprint{
            display: none !important;
        }
        .print-adjust {
            margin-top:-5px;
        }
        .print-table-adjust{
            zoom: 45%;
        }
        .noprint-scroll{
        overflow-x: unset !important;
        }
        @page {
            size: auto;
            margin: 1mm;
        }
    }
</style>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 noprint">Payments
            <a href="payment_add" class="btn btn-success btn-icon-split float-end mt-2"> 
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Pay Rental</span>
            </a>
        </h1>
        <ol class="breadcrumb mb-4 noprint">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item">Payments</li>
        </ol>
        <form action="payment.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row noprint">
                <div class="form-group col-md-3">
                    <label for="month" class="control-label">Filter by transations in month</label>
                    <input type="month" name="month" id="month" value="<?= $month ?>" class="form-control form-control-sm rounded-0">
                </div>
                <div class="form-group col-md-2" style="margin-top:30px">
                    <button type="submit" name="submit-btn" class="btn btn-sm btn-primary"><i class="fas fa-filter"></i> Filter</button>
                </div>
            </div>
        </form>
        <div class="card mb-4">
            <div class="card-header noprint">
                <i class="fas fa-table me-1"></i>
                DataTable Payments
                <div class="float-end">
                    <button class="btn btn-sm btn-flat btn-secondary" type="button" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
                </div>
            </div>
            <div class="card-body">
                <div class="system-header d-none">
                    <h4 class="text-center">Rental Properties Management System</h4>
                </div>
                <table class="table table-bordered table-hover text-center print-table-adjust" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Full Name</th>
                            <th>Bills Type</th>
                            <th>Bills Amount</th>
                            <th>No. of months unpaid</th>
                            <th>Penalty 5%</th>
                            <th>Total Paid</th>
                            <th>Balance</th>
                            <th>Payment Type</th>
                            <th>Status</th>
                            <th>Remarks</th>
                            <th>Date payment</th>
                            <th>Buttons</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Full Name</th>
                            <th>Bills Type</th>
                            <th>Bills Amount</th>
                            <th>No. of months unpaid</th>
                            <th>Penalty 5%</th>
                            <th>Total Paid</th>
                            <th>Balance</th>
                            <th>Payment Type</th>
                            <th>Status</th>
                            <th>Remarks</th>
                            <th>Date payment</th>
                            <th class="noprint">Buttons</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                            if(isset($_POST['month']) && !empty($_POST['month'])) {
                                $query = "SELECT *, DATE_FORMAT(payment_date, '%M %d, %Y %h:%i %p') AS new_payment_date, payment.last_update_date AS new_last_update_date FROM `payment` INNER JOIN `user` ON user.user_id = payment.user_id INNER JOIN payment_type ON payment.payment_type_id = payment_type.payment_type_id INNER JOIN `utility_type` ON utility_type.utility_type_id = payment.utility_type_id INNER JOIN utility ON utility.utility_id = payment.utility_id WHERE DATE(payment_date) BETWEEN '{$firstDayOfMonth}' AND '{$lastDayOfMonth}' AND `payment`.`status` != 'Archive' ORDER BY payment_id DESC";
                            } else {
                                $query = "SELECT *, DATE_FORMAT(payment_date, '%M %d, %Y %h:%i %p') AS new_payment_date, payment.last_update_date AS new_last_update_date FROM `payment` INNER JOIN `user` ON user.user_id = payment.user_id INNER JOIN payment_type ON payment.payment_type_id = payment_type.payment_type_id INNER JOIN `utility_type` ON utility_type.utility_type_id = payment.utility_type_id INNER JOIN utility ON utility.utility_id = payment.utility_id WHERE `payment`.`status` != 'Archive' ORDER BY payment_id DESC";
                            }
                            $query_run = mysqli_query($con, $query);
                            if(mysqli_num_rows($query_run) > 0){
                                foreach($query_run as $row){

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
                        ?>
                        <tr>
                            <td><?= $row['payment_id']; ?></td>
                            <td><?= $row['fname']; ?> <?= $row['mname']; ?> <?= $row['lname']; ?></td>
                            <td><?= $row['utility_type_name']; ?></td>
                            <td><?= $row['utility_amount']; ?></td>
                            <td><?php echo "$monthDiff"; ?></td>
                            <td>
                                <?php echo number_format($row['utility_amount'] * 0.05 * $monthDiff, 2); ?>
                            </td>
                            <td><?= $row['payment_amount']; ?></td>
                            <td><?= $row['payment_remaining']; ?></td>
                            <td><?= $row['payment_type_name']; ?></td>
                            <td><?= $row['payment_status']; ?></td>
                            <td><?= $row['remarks']; ?></td>
                            <td><?= $row['new_payment_date']; ?></td>
                            <td class="noprint">
                                <div class="d-flex">
                                    <div class="col-md-6 mb-1" style="margin-right: 0.2rem">
                                        <a href="payment_view?id=<?=$row['payment_id']?>" class="btn btn-dark btn-icon-split" title="View"> 
                                            <span class="icon text-white-50"><i class="fas fa-eye"></i></span>
                                        </a>
                                    </div>
                                    <div class="col-md-6 mb-1  d-none" style="margin-right: 0.05rem">
                                        <a href="payment_edit?id=<?=$row['payment_id']?>" class="btn btn-success btn-icon-split" title="Edit"> 
                                            <span class="icon text-white-50"><i class="fas fa-edit"></i></span>
                                            <span class="text"></span>
                                        </a>
                                    </div>
                                    <div class="col-md-4 d-none">
                                        <button type="button" data-toggle="modal" value="<?=$row['payment_id']; ?>" data-target="#Modal_delete_payment" onclick="deleteModal(this)" class="btn btn-danger btn-icon-split" title="Delete">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text"></span>
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php } } else{ } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<!-- Modal Payment Delete -->
<div class="modal fade" id="Modal_delete_payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <form action="payment_code.php" method="POST">
            <input type="hidden" id="delete_id" name="payment_id">
            <button type="submit" name="delete_payment" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- JavaScript for delete payment -->
<script>
    function deleteModal(button) {
        var id = button.value;
        document.getElementById("delete_id").value = id;
    }
</script>
<?php include ('../includes/bottom.php'); ?>