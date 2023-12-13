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
        <h1 class="mt-4">View Property</h1>
        <ol class="breadcrumb mb-4 mt-3">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="./property" class="text-decoration-none">Property</a></li>
            <li class="breadcrumb-item">View Property</li>
        </ol>
        <?php
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT *, CONCAT(`fname`, ' ', `mname`, ' ', `lname`, ' ', `suffix`) AS `staff_fullname` FROM `property` INNER JOIN `user` ON `user`.`user_id` = `property`.`user_id` INNER JOIN `property_type` ON property.property_type_id = property_type.property_type_id WHERE `property_id` = '$id' AND `property_status` != 'Archive'";
                $sql_run = mysqli_query($con, $sql);

                if(mysqli_num_rows($sql_run) > 0) {
                    foreach($sql_run as $row){
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Property form</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="property_unit_code" class="required">Unit Code</label>
                                <input type="text" class="form-control" id="property_unit_code" value="<?=$row['property_unit_code']?>" disabled>
                                <div id="property_unit_code-error"></div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <?php
                                    $staff_id = $row['user_id'];
                                    $staff = "SELECT *, CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS `staff_fullname` FROM `user` WHERE `user_id` = '$staff_id'";
                                    $staff_result = $con->query($staff);
                                    $staff_data = $staff_result->fetch_assoc();
                                ?>
                                <label for="staff_fullname" class="required">Landlady / Landlord</label>
                                <input type="text" class="form-control" id="staff_fullname" value="<?=$staff_data['staff_fullname']?>" disabled>
                                <div id="staff_fullname-error"></div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <?php
                                    $client_id = $row['rented_by'];
                                    $client = "SELECT *, CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS `renter_fullname` FROM `user` WHERE `user_id` = '$client_id'";
                                    $client_result = $con->query($client);
                                    $client_data = $client_result->fetch_assoc();
                                ?>
                                <label for="renter_fullname" class="required">Rented By</label>
                                <input type="text" class="form-control" id="renter_fullname" value="<?=$client_data['renter_fullname']?>" disabled>
                                <div id="renter_fullname-error"></div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="property_type" class="required">Property Type</label>
                                <input type="text" class="form-control" id="property_type" value="<?=$row['property_type_name']?>" disabled>
                                <div id="property_type-error"></div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="property_location" class="required">Barangay</label>
                                <input type="text" class="form-control" id="property_location" value="<?=$row['property_location']?>" disabled>
                                <div id="property_location-error"></div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="property_amount" class="required">Property Amount</label>
                                <input type="text" class="form-control" id="property_amount" value="₱<?=$row['property_amount']?>" disabled>
                                <div id="property_amount-error"></div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="property_status" class="required">Property Status</label>
                                <input type="text" class="form-control" id="property_status" value="<?=$row['property_status']?>" disabled>
                                <div id="property_status-error"></div>
                            </div>

                            <div class="col-md-3 mb-3 <?php if($row['property_status'] != 'Rented'){ echo "d-none";} ?>">
                                <label for="date_rented" class="required">Date Rented</label>
                                <input type="date" class="form-control" id="date_rented" value="<?=$row['date_rented'];?>" disabled>
                            </div>

                            <div class="col-md-3 mb-3 <?php if($row['property_status'] != 'Rented'){ echo "d-none";} ?>">
                                <label for="property_cash_advance" class="required">Advance Payment</label>
                                <input type="text" class="form-control" id="property_cash_advance" value="<?=$row['property_cash_advance'];?>" disabled>
                            </div>

                            <div class="col-md-3 mb-3 <?php if($row['property_status'] != 'Rented'){ echo "d-none";} ?>">
                                <label for="property_cash_deposit" class="required">Cash Deposit</label>
                                <input type="text" class="form-control" id="property_cash_deposit" value="<?=$row['property_cash_deposit'];?>" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } } else{ ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Property form</h4>
                        </div>
                        <div class="card-body">
                            <h4>No records found.</h4>
                        </div>
                    </div>
                </div>
            </div>
        <?php } } ?>
    </div>
</main>
<?php include ('../includes/bottom.php'); ?>