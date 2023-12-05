<?php include ('../includes/header.php'); ?>
<style type="text/css">
    #datatablesSimple th:nth-child(7) {
        width: 15% !important;
    }
</style>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Contracts
            <a href="contract_add" class="btn btn-success btn-icon-split float-end mt-2"> 
                <span class="icon text-white-50">
                    <i class="fas fa-user"></i>
                </span>
                <span class="text">Add Contract</span>
            </a>
        </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item">Contracts</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                DataTable Contracts
            </div>
            <div class="card-body">
                <table class="text-center" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Full Name</th>
                            <th>Location</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Buttons</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Full Name</th>
                            <th>Location</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Buttons</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                            $query = "SELECT *, contract.phone AS contract_phone FROM `contract` INNER JOIN `user` ON user.user_id = contract.user_id WHERE `contract_status` != 'Archive'";
                            $query_run = mysqli_query($con, $query);
                            if(mysqli_num_rows($query_run) > 0){
                                foreach($query_run as $row){
                        ?>
                        <tr>
                            <td><?= $row['contract_id']; ?></td>
                            <td><?= $row['fname']; ?> <?= $row['mname']; ?> <?= $row['lname']; ?></td>
                            <td><?= $row['property_location']; ?></td>
                            <td><?= $row['email']; ?></td>
                            <td><?= $row['contract_phone']; ?></td>
                            <td><?= $row['contract_status']; ?></td>
                            <td>
                                <div class="row d-inline-flex justify-content-center col-lg-4 col-xl-12">
                                    <div class="col-md-4 mb-1">
                                        <a href="contract_view?id=<?=$row['contract_id']?>" class="btn btn-info btn-icon-split" title="View"> 
                                            <span class="icon text-white-50"><i class="fas fa-eye"></i></span>
                                            <span class="text ml-2 mr-2"></span>
                                        </a>
                                    </div>
                                    <div class="col-md-4 mb-1">
                                        <a href="contract_edit?id=<?=$row['contract_id']?>" class="btn btn-success btn-icon-split" title="Edit"> 
                                            <span class="icon text-white-50"><i class="fas fa-edit"></i></span>
                                            <span class="text"></span>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" data-toggle="modal" value="<?=$row['contract_id']; ?>" data-target="#Modal_delete_contract" onclick="deleteModal(this)" class="btn btn-danger btn-icon-split" title="Delete">
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
<!-- Modal Contract Delete -->
<div class="modal fade" id="Modal_delete_contract" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Contract</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <form action="contract_code.php" method="POST">
            <input type="hidden" id="delete_id" name="contract_id">
            <button type="submit" name="delete_contract" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- JavaScript for delete contract -->
<script>
    function deleteModal(button) {
        var id = button.value;
        document.getElementById("delete_id").value = id;
    }
</script>
<?php include ('../includes/bottom.php'); ?>