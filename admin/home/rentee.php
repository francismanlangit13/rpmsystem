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
        <h1 class="mt-4">Rentee</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item">Rentee</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                DataTable Rentee
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover text-center" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Rentee Name</th>
                            <th>Property Unit Code</th>
                            <th>Location</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Balance</th>
                            <th>Cash Advance Balance</th>
                            <th>Cash Deposit Balance</th>
                            <th>Landlady / Landlord</th>
                            <th>Property Status</th>
                            <!-- <th>Buttons</th> -->
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Rentee Name</th>
                            <th>Property Name</th>
                            <th>Location</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Balance</th>
                            <th>Cash Advance Balance</th>
                            <th>Cash Deposit Balance</th>
                            <th>Landlady / Landlord</th>
                            <th>Property Status</th>
                            <!-- <th>Buttons</th> -->
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                            $query = "SELECT *, CONCAT (`property`.`user_id`) AS staff_user_id, CONCAT(`fname`, ' ', `mname`, ' ', `lname`, ' ', `suffix`) AS `rentee_fullname`, user.user_id AS rentee_id, CONCAT('Purok ', `property_purok`, ', ', `property_barangay`, ', ', `property_city`, ', ', `property_zipcode`) AS `property_location` FROM `user` INNER JOIN `property` ON `user`.`property_rented_id` = `property`.`property_id` INNER JOIN `property_type` ON property.property_type_id = property_type.property_type_id WHERE `is_rented` = '1' AND `status` != 'Inactive'";
                            $query_run = mysqli_query($con, $query);
                            if(mysqli_num_rows($query_run) > 0){
                                foreach($query_run as $row){
                                    $staff_id = $row['staff_user_id'];
                                    $stmt = $con->query("SELECT CONCAT(`fname`, ' ', `mname`, ' ', `lname`, ' ', `suffix`) AS `staff_fullname` FROM `user` WHERE `user_id` = '$staff_id'");
                                    $new_row = $stmt->fetch_assoc();
                        ?>
                        <tr>
                            <td><?= $row['rentee_id']; ?></td>
                            <td><a href="rentee_history?id=<?=$row['rentee_id']?>"><?= $row['rentee_fullname']; ?></a></td>
                            <td><?= $row['property_unit_code']; ?></td>
                            <td><?= $row['property_location']; ?></td>
                            <td><?= $row['property_type_name']; ?></td>
                            <td>₱<?= $row['property_amount']; ?></td>
                            <td>₱<?= $row['balance']; ?></td>
                            <td>₱<?= $row['cash_advance']; ?></td>
                            <td>₱<?= $row['cash_deposit']; ?></td>
                            <td><?= $new_row['staff_fullname']; ?></td>
                            <td><?= $row['property_status']; ?></td>
                            <!-- <td>
                                <div class="d-flex">
                                    <div class="col-md-12 mb-1" style="margin-right: 0.2rem">
                                        <a href="rentee_history?id=<?=$row['rentee_id']?>" class="btn btn-dark btn-icon-split" title="View History"> 
                                            <span class="icon text-white-50"><i class="fas fa-eye"></i></span>
                                        </a>
                                    </div>
                                    <div class="col-md-6 mb-1 d-none" style="margin-right: 0.05rem">
                                        <a href="rentee_history?id=<?=$row['property_id']?>" class="btn btn-success btn-icon-split" title="Edit"> 
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
                            </td> -->
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