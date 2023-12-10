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
        <h1 class="mt-4">Other Bills
            <a href="utilities_add" class="btn btn-success btn-icon-split float-end mt-2"> 
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add Other Bills</span>
            </a>
        </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item">Other Bills</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                DataTable Other Bills
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover text-center" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Full Name</th>
                            <th>Location</th>
                            <th>Phone</th>
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
                            <th>Location</th>
                            <th>Phone</th>
                            <th>Type</th>
                            <th>Bill Amount</th>
                            <th>Date billed</th>
                            <th>Buttons</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                            $query = "SELECT *, DATE_FORMAT(utilities_date, '%M %d, %Y %h:%i %p') as new_utilities_date FROM `utilities`
                                INNER JOIN `user` ON user.user_id = utilities.user_id
                                INNER JOIN utilities_type ON utilities_type.utilities_type_id = utilities.utilities_type_id
                                INNER JOIN property ON property.rented_by = utilities.user_id
                                WHERE `utilities_status` != 'Archive'
                            ";
                            $query_run = mysqli_query($con, $query);
                            if(mysqli_num_rows($query_run) > 0){
                                foreach($query_run as $row){
                        ?>
                        <tr>
                            <td><?= $row['utilities_id']; ?></td>
                            <td><?= $row['fname']; ?> <?= $row['mname']; ?> <?= $row['lname']; ?></td>
                            <td><?= $row['property_location']; ?></td>
                            <td><?= $row['phone']; ?></td>
                            <td><?= $row['utilities_type_name']; ?></td>
                            <td><?= $row['utilities_amount']; ?></td>
                            <td><?= $row['new_utilities_date']; ?></td>
                            <td>
                                <div class="d-flex">
                                    <div class="col-md-4 mb-1" style="margin-right: 0.2rem">
                                        <a href="utilities_view?id=<?=$row['utilities_id']?>" class="btn btn-dark btn-icon-split" title="View"> 
                                            <span class="icon text-white-50"><i class="fas fa-eye"></i></span>
                                        </a>
                                    </div>
                                    <div class="col-md-4 mb-1" style="margin-right: 0.05rem">
                                        <a href="utilities_edit?id=<?=$row['utilities_id']?>" class="btn btn-success btn-icon-split" title="Edit"> 
                                            <span class="icon text-white-50"><i class="fas fa-edit"></i></span>
                                            <span class="text"></span>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" data-toggle="modal" value="<?=$row['utilities_id']; ?>" data-target="#Modal_delete_utilities" onclick="deleteModal(this)" class="btn btn-danger btn-icon-split" title="Delete">
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
<!-- Modal Utilities Delete -->
<div class="modal fade" id="Modal_delete_utilities" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <form action="utilities_code.php" method="POST">
            <input type="hidden" id="delete_id" name="utilities_id">
            <button type="submit" name="delete_utilities" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- JavaScript for delete utilities -->
<script>
    function deleteModal(button) {
        var id = button.value;
        document.getElementById("delete_id").value = id;
    }
</script>
<?php include ('../includes/bottom.php'); ?>