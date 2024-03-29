<?php include ('../includes/header.php'); ?>
<style type="text/css">
    #datatablesSimple th:nth-child(7) {
        width: 15% !important;
    }
    .search {
        width: 100%;
        position: relative;
        display: flex;
        justify-content: center;
    }

    .searchTerm {
        width: 30%;
        border: 3px solid #00B4CC;
        border-right: none;
        padding: 15.5px;
        height: 36px;
        border-radius: 5px 0 0 5px;
        outline: none;
        color: #9DBFAF;
    }

    .searchTerm:focus{
        color: #00B4CC;
    }

    .searchButton {
        width: 40px;
        height: 36px;
        border: 1px solid #00B4CC;
        background: #00B4CC;
        text-align: center;
        color: #fff;
        border-radius: 0 5px 5px 0;
        cursor: pointer;
        font-size: 20px;
    }
    .table th, .table td {
        white-space: nowrap;
    }
</style>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Property
            <a href="property_add" class="btn btn-success btn-icon-split float-end mt-2"> 
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add Property</span>
            </a>
        </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item">Property</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                DataTable Property
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover text-center" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Property Unit Code</th>
                            <th>Address</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Landlady / Landlord</th>
                            <th>Property Status</th>
                            <th>Status</th>
                            <th>Buttons</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Property Name</th>
                            <th>Address</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Landlady / Landlord</th>
                            <th>Property Status</th>
                            <th>Status</th>
                            <th>Buttons</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                            $query = "SELECT *, CONCAT(`fname`, ' ', `mname`, ' ', `lname`, ' ', `suffix`) AS `staff_fullname`, CONCAT('Purok ', `property_purok`, ', ', `property_barangay`, ', ', `property_city`, ' ', `property_zipcode`) AS `full_address` FROM `property` INNER JOIN `user` ON `user`.`user_id` = `property`.`user_id` INNER JOIN `property_type` ON property.property_type_id = property_type.property_type_id WHERE `property_status` != 'Archive'";
                            $query_run = mysqli_query($con, $query);
                            if(mysqli_num_rows($query_run) > 0){
                                foreach($query_run as $row){
                        ?>
                        <tr>
                            <td><?= $row['property_id']; ?></td>
                            <td><?= $row['property_unit_code']; ?></td>
                            <td><?= $row['full_address']; ?></td>
                            <td><?= $row['property_type_name']; ?></td>
                            <td>₱<?= $row['property_amount']; ?></td>
                            <td><?= $row['staff_fullname']; ?></td>
                            <td><?= $row['property_status']; ?></td>
                            <td><?= $row['p_status']; ?></td>
                            <td>
                                <div class="d-flex">
                                    <div class="col-md-6 mb-1" style="margin-right: 0.2rem">
                                        <a href="property_view?id=<?=$row['property_id']?>" class="btn btn-dark btn-icon-split" title="View"> 
                                            <span class="icon text-white-50"><i class="fas fa-eye"></i></span>
                                        </a>
                                    </div>
                                    <div class="col-md-6 mb-1" style="margin-right: 0.05rem">
                                        <a href="property_edit?id=<?=$row['property_id']?>" class="btn btn-success btn-icon-split" title="Edit"> 
                                            <span class="icon text-white-50"><i class="fas fa-edit"></i></span>
                                            <span class="text"></span>
                                        </a>
                                    </div>
                                    <div class="col-md-4 d-none">
                                        <button type="button" data-toggle="modal" value="<?=$row['property_id']; ?>" data-target="#Modal_delete_property" onclick="deleteModal(this)" class="btn btn-danger btn-icon-split" title="Delete">
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
<!-- Modal Location Delete -->
<div class="modal fade" id="Modal_delete_property" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Property</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete property ID number <label id="property_id"></label>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <form action="property_code.php" method="POST">
            <input type="hidden" id="delete_id" name="property_id">
            <button type="submit" name="delete_property" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- JavaScript for delete property -->
<script>
    function deleteModal(button) {
        var id = button.value;
        document.getElementById("delete_id").value = id;
        document.getElementById("property_id").innerHTML = id;
    }
</script>
<?php include ('../includes/bottom.php'); ?>