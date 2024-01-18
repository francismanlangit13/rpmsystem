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
                            <div class="col-md-3 mb-3">
                                <label for="property_unit_code"><b>Property Unit Code</b></label>
                                <input type="text" class="form-control-plaintext" id="property_unit_code" value="<?=$row['property_unit_code']?>" disabled>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="property_permit"><b>Building Permit No.</b></label>
                                <input type="text" class="form-control-plaintext" id="property_permit" value="<?=$row['property_permit']?>" disabled>
                            </div>

                            <div class="col-md-3 mb-3">
                                <?php
                                    $staff_id = $row['user_id'];
                                    $staff = "SELECT *, CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS `staff_fullname` FROM `user` WHERE `user_id` = '$staff_id'";
                                    $staff_result = $con->query($staff);
                                    $staff_data = $staff_result->fetch_assoc();
                                ?>
                                <label for="staff_fullname"><b>Landlady / Landlord</b></label>
                                <input type="text" class="form-control-plaintext" id="staff_fullname" value="<?=$staff_data['staff_fullname']?>" disabled>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="property_type"><b>Property Type</b></label>
                                <input type="text" class="form-control-plaintext" id="property_type" value="<?=$row['property_type_name']?>" disabled>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="property_status"><b>Property Status</b></label>
                                <input type="text" class="form-control-plaintext" id="property_status" value="<?=$row['property_status']?>" disabled>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="property_purok"><b>Purok</b></label>
                                <input type="text" class="form-control-plaintext" name="property_purok" id="property_purok" value="<?=$row['property_purok']?>" disabled>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="property_barangay"><b>Barangay</b></label>
                                <input type="text" class="form-control-plaintext" name="property_barangay" id="property_barangay" value="<?=$row['property_barangay']?>" disabled>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="property_city"><b>City</b></label>
                                <input type="text" class="form-control-plaintext" name="property_city" id="property_city" value="<?=$row['property_city']?>" disabled>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="property_zipcode"><b>Zipcode</b></label>
                                <input type="text" class="form-control-plaintext" name="property_zipcode" id="property_zipcode" value="<?=$row['property_zipcode']?>" disabled>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="property_amount"><b>Unit Cost</b></label>
                                <input type="text" class="form-control-plaintext" id="property_amount" value="₱<?=$row['property_amount']?>" disabled>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="has_electrical_meter"><b>Does the unit have its own electrical meter?</b></label>
                                <input type="text" class="form-control-plaintext" id="has_electrical_meter" value="<?=$row['has_electrical_meter']?>" disabled>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="has_water_meter"><b>Does the unit have its own water meter?</b></label>
                                <input type="text" class="form-control-plaintext" id="has_water_meter" value="<?=$row['has_water_meter']?>" disabled>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="has_parking_space"><b>Does the unit have a parking space?</b></label>
                                <input type="text" class="form-control-plaintext" id="has_parking_space" value="<?=$row['has_parking_space']?>" disabled>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="has_conectivity"><b>Does the unit have a conectivity?</b></label>
                                <input type="text" class="form-control-plaintext" id="has_conectivity" value="<?=$row['has_conectivity']?>" disabled>
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