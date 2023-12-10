<?php include ('../includes/header.php'); ?>
<style type="text/css">
    #datatablesSimple th:nth-child(7) {
        width: 15% !important;
    }
    .table th, .table td {
        white-space: nowrap;
    }
</style>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Payments
            <a href="payment_add" class="btn btn-success btn-icon-split float-end mt-2"> 
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add Payment</span>
            </a>
        </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item">Payments</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                DataTable Payments
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover text-center" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Bills Type</th>
                            <th>Payment Type</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date payment</th>
                            <th>Buttons</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Bills Type</th>
                            <th>Payment Type</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date payment</th>
                            <th>Buttons</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                            $query = "SELECT *, DATE_FORMAT(payment_date, '%M %d, %Y %h:%i %p') as new_payment_date FROM `payment` INNER JOIN `user` ON user.user_id = payment.user_id INNER JOIN property ON payment.user_id = property.rented_by INNER JOIN payment_type ON payment.payment_type_id = payment_type.payment_type_id INNER JOIN `utilities_type` ON utilities_type.utilities_type_id = payment.utilities_type_id WHERE payment.user_id = '$user_id' AND `payment_status` NOT IN ('Partial','Paid') AND payment.status != 'Archive'";
                            $query_run = mysqli_query($con, $query);
                            if(mysqli_num_rows($query_run) > 0){
                                foreach($query_run as $row){
                        ?>
                        <tr>
                            <td><?= $row['payment_id']; ?></td>
                            <td><?= $row['utilities_type_name']; ?></td>
                            <td><?= $row['payment_type_name']; ?></td>
                            <td><?= $row['payment_amount']; ?></td>
                            <td><?= $row['payment_status']; ?></td>
                            <td><?= $row['new_payment_date']; ?></td>
                            <td>
                                <div class="d-flex">
                                    <?php if($row['payment_status'] != "Reject"){ ?>
                                        <div class="col-md-4 mb-1" style="margin-right: 0.2rem">
                                            <a href="payment_view?id=<?=$row['payment_id']?>" class="btn btn-dark btn-icon-split" title="View"> 
                                                <span class="icon text-white-50"><i class="fas fa-eye"></i></span>
                                            </a>
                                        </div>
                                        <div class="col-md-4 mb-1" style="margin-right: 0.05rem">
                                            <a href="payment_edit?id=<?=$row['payment_id']?>" class="btn btn-success btn-icon-split" title="Edit"> 
                                                <span class="icon text-white-50"><i class="fas fa-edit"></i></span>
                                                <span class="text"></span>
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="button" data-toggle="modal" value="<?=$row['payment_id']; ?>" data-target="#Modal_delete_payment" onclick="deleteModal(this)" class="btn btn-danger btn-icon-split" title="Delete">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                                <span class="text"></span>
                                            </button>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-md-6 mb-1" style="margin-right: 0.2rem">
                                            <a href="payment_view?id=<?=$row['payment_id']?>" class="btn btn-dark btn-icon-split" title="View"> 
                                                <span class="icon text-white-50"><i class="fas fa-eye"></i></span>
                                            </a>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" data-toggle="modal" value="<?=$row['payment_id']; ?>" data-target="#Modal_delete_payment" onclick="deleteModal(this)" class="btn btn-danger btn-icon-split" title="Delete">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                                <span class="text"></span>
                                            </button>
                                        </div>
                                    <?php } ?>
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