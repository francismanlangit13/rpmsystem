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
        #datatablesSimple th:nth-child(6), #datatablesSimple td:nth-child(6) {
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
        <h1 class="mt-4 noprint">Other Bills
            <a href="utility_add" class="btn btn-success btn-icon-split float-end mt-2"> 
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add Other Bills</span>
            </a>
        </h1>
        <ol class="breadcrumb mb-4 noprint">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item">Other Bills</li>
        </ol>
        <form action="utility.php" method="post" autocomplete="off" enctype="multipart/form-data">
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
                DataTable Other Bills
                <div class="float-end">
                    <button class="btn btn-sm btn-flat btn-secondary" type="button" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
                </div>
            </div>
            <div class="card-body">
                <div class="system-header d-none">
                    <h4 class="text-center">Rental Properties Management System</h4>
                </div>
                <table class="table table-bordered table-hover text-center" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Full Name</th>
                            <th>Type</th>
                            <th>Bill Amount</th>
                            <th>Date of billed</th>
                            <th>Buttons</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Full Name</th>
                            <th>Type</th>
                            <th>Bill Amount</th>
                            <th>Date billed</th>
                            <th>Buttons</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                            if(isset($_POST['month']) && !empty($_POST['month'])) {
                                $query = "SELECT *, DATE_FORMAT(utility_date, '%M %d, %Y %h:%i %p') as new_utility_date FROM `utility`
                                    INNER JOIN `user` ON user.user_id = utility.user_id
                                    INNER JOIN utility_type ON utility_type.utility_type_id = utility.utility_type_id
                                    WHERE DATE(utility_date) BETWEEN '{$firstDayOfMonth}' AND '{$lastDayOfMonth}' AND `utility_status` != 'Archive'
                                ";
                            } else{
                                $query = "SELECT *, DATE_FORMAT(utility_date, '%M %d, %Y %h:%i %p') as new_utility_date FROM `utility`
                                    INNER JOIN `user` ON user.user_id = utility.user_id
                                    INNER JOIN utility_type ON utility_type.utility_type_id = utility.utility_type_id
                                    WHERE `utility_status` != 'Archive'
                                ";
                            }
                            $query_run = mysqli_query($con, $query);
                            if(mysqli_num_rows($query_run) > 0){
                                foreach($query_run as $row){
                        ?>
                        <tr>
                            <td><?= $row['utility_id']; ?></td>
                            <td><?= $row['fname']; ?> <?= $row['mname']; ?> <?= $row['lname']; ?></td>
                            <td><?= $row['utility_type_name']; ?></td>
                            <td><?= $row['utility_amount']; ?></td>
                            <td><?= $row['new_utility_date']; ?></td>
                            <td>
                                <div class="d-flex">
                                    <div class="col-md-6 mb-1" style="margin-right: 0.2rem">
                                        <a href="utility_view?id=<?=$row['utility_id']?>" class="btn btn-dark btn-icon-split" title="View"> 
                                            <span class="icon text-white-50"><i class="fas fa-eye"></i></span>
                                        </a>
                                    </div>
                                    <div class="col-md-6 mb-1" style="margin-right: 0.05rem">
                                        <a href="utility_edit?id=<?=$row['utility_id']?>" class="btn btn-success btn-icon-split" title="Edit"> 
                                            <span class="icon text-white-50"><i class="fas fa-edit"></i></span>
                                            <span class="text"></span>
                                        </a>
                                    </div>
                                    <div class="col-md-4 d-none">
                                        <button type="button" data-toggle="modal" value="<?=$row['utility_id']; ?>" data-target="#Modal_delete_utility" onclick="deleteModal(this)" class="btn btn-danger btn-icon-split" title="Delete">
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
<!-- Modal Utility Delete -->
<div class="modal fade" id="Modal_delete_utility" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Other Bills</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <form action="utility_code.php" method="POST">
            <input type="hidden" id="delete_id" name="utility_id">
            <button type="submit" name="delete_utility" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- JavaScript for delete utility -->
<script>
    function deleteModal(button) {
        var id = button.value;
        document.getElementById("delete_id").value = id;
    }
</script>
<?php include ('../includes/bottom.php'); ?>