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
        <h1 class="mt-4">Payment Type
            <a href="payment_type_add" class="btn btn-success btn-icon-split float-end mt-2"> 
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add Payment Type</span>
            </a>
        </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="./home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item">Payment Type</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                DataTable Payment Type
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover text-center" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Payment Type</th>
                            <th>Status</th>
                            <th>Buttons</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Payment Type</th>
                            <th>Status</th>
                            <th>Buttons</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                            $i = 0;
                            $query = "SELECT * FROM `payment_type` WHERE `payment_type_status` != 'Archive' AND `payment_type_id` != '1'";
                            $query_run = mysqli_query($con, $query);
                            if(mysqli_num_rows($query_run) > 0){
                                foreach($query_run as $row){
                                    $i++
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $row['payment_type_name']; ?></td>
                            <td><?= $row['payment_type_status']; ?></td>
                            <td>
                                <div class="d-flex">
                                    <div class="col-md-12 mb-1" style="margin-right: 0.2rem">
                                        <a href="payment_type_edit?id=<?=$row['payment_type_id']?>" class="btn btn-success btn-icon-split" title="Edit"> 
                                            <span class="icon text-white-50"><i class="fas fa-edit"></i></span>
                                            <span class="text"></span>
                                        </a>
                                    </div>
                                    <div class="col-md-6 d-none" style="margin-right: 0.05rem">
                                        <button type="button" data-toggle="modal" value="<?=$row['payment_type_id']; ?>" data-target="#Modal_delete_payment_type" onclick="deleteModal(this)" class="btn btn-danger btn-icon-split" title="Delete">
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
<!-- Modal payment_type Delete -->
<div class="modal fade" id="Modal_delete_payment_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Payment Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <form action="payment_type_code.php" method="POST">
            <input type="hidden" id="delete_id" name="payment_type_id">
            <button type="submit" name="delete_payment_type" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- JavaScript for delete payment_type -->
<script>
    function deleteModal(button) {
        var id = button.value;
        document.getElementById("delete_id").value = id;
    }
</script>
<?php include ('../includes/bottom.php'); ?>