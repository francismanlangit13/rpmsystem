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
        <h1 class="mt-4">Edit Property</h1>
        <ol class="breadcrumb mb-4 mt-3">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="./property" class="text-decoration-none">Property</a></li>
            <li class="breadcrumb-item">Edit Property</li>
        </ol>
        <?php
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT *, CONCAT(`fname`, ' ', `mname`, ' ', `lname`, ' ', `suffix`) AS `staff_fullname` FROM `property` INNER JOIN `user` ON `user`.`user_id` = `property`.`user_id` WHERE `property_id` = '$id' AND `property_status` != 'Archive'";
                $sql_run = mysqli_query($con, $sql);

                if(mysqli_num_rows($sql_run) > 0) {
                    foreach($sql_run as $row){
        ?>
        <form action="property_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Property form
                                <div class="float-end">
                                    <button type="submit" name="edit_property" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                                    <input type="hidden" name="id" value="<?=$row['property_id']?>">
                                    <input type="hidden" name="temp_renter" value="<?=$row['rented_by']?>">
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="property_unit_code" class="required">Property Unit Code</label>
                                    <input type="text" class="form-control" placeholder="Enter Property Unit Code" name="property_unit_code" id="property_unit_code" value="<?=$row['property_unit_code']?>" required>
                                    <div id="property_unit_code-error"></div>
                                </div>
                                <!-- Select2 Example -->
                                <div class="col-md-4 mb-3">
                                    <?php
                                        $client = "SELECT user_id, CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS fullname FROM `user` WHERE `type` = 'Staff'";
                                        $client_result = $con->query($client);
                                    ?>
                                    <label for="staff" class="required">Landlady / Landlord</label>
                                    <select class="form-control select2" id="staff" name="staff" style="width: 100%;" required>
                                        <option value="">Select Landlady / Landlord</option>
                                        <?php 
                                        if ($client_result->num_rows > 0) {
                                            while ($clientrow = $client_result->fetch_assoc()) {
                                                $selected = ($clientrow['user_id'] == $row['user_id']) ? 'selected' : '';
                                        ?>
                                        <option value="<?=$clientrow['user_id'];?>" <?=$selected;?>><?=$clientrow['fullname'];?></option>
                                        <?php } } ?>
                                    </select>
                                    <div id="staff-error"></div>
                                </div>
                                <!-- Initialize Select2 -->
                                <script>
                                    $(document).ready(function () {
                                        // Initialize Select2 Elements
                                        $('.select2').select2();
                                    });
                                </script>

                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="property_status">Property Status</label>
                                        <select class="form-control" name="property_status" id="property_status" required>
                                            <option value="" selected disabled>Select Status</option>
                                            <option value="Rented" <?= isset($row['property_status']) && $row['property_status'] == 'Rented' ? 'selected' : '' ?>>Rented</option>
                                            <option value="Available" <?= isset($row['property_status']) && $row['property_status'] == 'Available' ? 'selected' : '' ?>>Available</option>
                                            <option value="Renovating" <?= isset($row['property_status']) && $row['property_status'] == 'Renovating' ? 'selected' : '' ?>>Renovating</option>
                                            <option value="Reserve" <?= isset($row['property_status']) && $row['property_status'] == 'Reserve' ? 'selected' : '' ?>>Reserve</option>
                                        </select>
                                        <div id="property_status-error"></div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <?php
                                        $stmt = "SELECT * FROM `property_type` WHERE property_type_status != 'Archive'";
                                        $stmt_run = mysqli_query($con,$stmt);
                                    ?>
                                    <label for="property_type_id" class="required">Property Type</label>
                                    <select class="form-control" id="property_type_id" name="property_type_id" required>
                                        <option value="">Select Property Type</option>
                                        <?php
                                            // use a while loop to fetch data
                                            while ($property_type = mysqli_fetch_array($stmt_run,MYSQLI_ASSOC)):;
                                            $selected = ($property_type['property_type_id'] == $row['property_type_id']) ? 'selected' : '';
                                        ?>
                                            <option value="<?= $property_type["property_type_id"]; ?>" <?=$selected;?>><?= $property_type["property_type_name"]; ?></option>
                                        <?php
                                            endwhile; // While loop must be terminated
                                        ?>
                                    </select>
                                    <div id="property_type_id-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="property_location" class="required">Property Location</label>
                                    <input type="text" class="form-control" placeholder="Enter Property Location" name="property_location" id="property_location" value="<?=$row['property_location']?>" required>
                                    <div id="property_location-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="property_amount" class="required">Unit Cost</label>
                                    <input type="text" class="form-control" placeholder="Enter Unit Cost" name="property_amount" id="property_amount" value="<?=$row['property_amount']?>" required>
                                    <div id="property_amount-error"></div>
                                </div>

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
<script>
    document.getElementById('property_status').addEventListener('change', function () {
        var Container = document.getElementById('Container');
        var Container1 = document.getElementById('Container1');
        var Container2 = document.getElementById('Container2');
        var Container3 = document.getElementById('Container3');
        var renter = document.getElementById('renter');
        var date_rented = document.getElementById('date_rented');
        var property_cash_advance = document.getElementById('property_cash_advance');
        var property_cash_deposit = document.getElementById('property_cash_deposit');
        var renter1 = document.getElementById('renter');
        var date_rented1 = document.getElementById('date_rented');
        var property_cash_advance1 = document.getElementById('property_cash_advance');
        var property_cash_deposit1 = document.getElementById('property_cash_deposit');

        if (this.value === 'Rented') {
            Container.classList.remove('d-none');
            Container1.classList.remove('d-none');
            Container2.classList.remove('d-none');
            Container3.classList.remove('d-none');
            renter.required = true;
            date_rented.required = true;
            property_cash_advance.required = true;
            property_cash_deposit.required = true;
            renter1.disabled = false;
            date_rented1.disabled = false;
            property_cash_advance1.disabled = false;
            property_cash_deposit1.disabled = false;
        } else {
            Container.classList.add('d-none');
            Container1.classList.add('d-none');
            Container2.classList.add('d-none');
            Container3.classList.add('d-none');
            renter.required = false;
            date_rented.required = false;
            property_cash_advance.required = false;
            property_cash_deposit.required = false;
            renter1.disabled = true;
            date_rented1.disabled = true;
            property_cash_advance1.disabled = true;
            property_cash_deposit1.disabled = true;
        }
    });
</script>
<?php include ('../includes/bottom.php'); ?>