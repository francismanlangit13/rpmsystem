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
            <li class="breadcrumb-item active"><a href="./properties" class="text-decoration-none">Properties</a></li>
            <li class="breadcrumb-item">View Property</li>
        </ol>
        <?php
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT *, CONCAT(`fname`, ' ', `mname`, ' ', `lname`, ' ', `suffix`) AS `staff_fullname` FROM `property` INNER JOIN `user` ON `user`.`user_id` = `property`.`user_id` WHERE `property_id` = '$id' AND `property_status` != 'Archive'";
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
                                <label for="view_property_unit_code" class="required">Unit Code</label>
                                <input type="text" class="form-control" id="view_property_unit_code" value="<?=$row['property_unit_code']?>" disabled>
                                <div id="view_property_unit_code-error"></div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <?php
                                    $staff_id = $row['user_id'];
                                    $staff = "SELECT *, CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS `staff_fullname` FROM `user` WHERE `user_id` = '$staff_id'";
                                    $staff_result = $con->query($staff);
                                    $staff_data = $staff_result->fetch_assoc();
                                ?>
                                <label for="view_staff" class="required">Landlady / Landlord</label>
                                <input type="text" class="form-control" id="view_staff" value="<?=$staff_data['staff_fullname']?>" disabled>
                                <div id="view_staff-error"></div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <?php
                                    $client_id = $row['rented_by'];
                                    $client = "SELECT *, CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS `renter_fullname` FROM `user` WHERE `user_id` = '$client_id'";
                                    $client_result = $con->query($client);
                                    $client_data = $client_result->fetch_assoc();
                                ?>
                                <label for="view_renter" class="required">Rented By</label>
                                <input type="text" class="form-control" id="view_renter" value="<?=$client_data['renter_fullname']?>" disabled>
                                <div id="view_renter-error"></div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="view_property_type" class="required">Property Type</label>
                                <input type="text" class="form-control" id="view_property_type" value="<?=$row['property_type']?>" disabled>
                                <div id="view_property_type-error"></div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="view_barangay" class="required">Barangay</label>
                                <input type="text" class="form-control" id="view_barangay" value="<?=$row['property_location']?>" disabled>
                                <div id="view_barangay-error"></div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="view_property_cost" class="required">Property Cost</label>
                                <input type="text" class="form-control" id="view_property_cost" value="<?=$row['property_cost']?>" disabled>
                                <div id="view_property_cost-error"></div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="view_property_status" class="required">Property Status</label>
                                <input type="text" class="form-control" id="view_property_status" value="<?=$row['property_status']?>" disabled>
                                <div id="view_property_status-error"></div>
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