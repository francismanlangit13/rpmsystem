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
            <li class="breadcrumb-item active"><a href="./properties" class="text-decoration-none">Properties</a></li>
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
        <form action="properties_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Property form
                                <div class="float-end">
                                    <button type="submit" name="edit_properties" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                                    <input type="hidden" name="id" value="<?=$row['property_id']?>">
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="edit_property_unit_code" class="required">Property Unit Code</label>
                                    <input type="text" class="form-control" placeholder="Enter Property Unit Code" name="edit_property_unit_code" id="edit_property_unit_code" value="<?=$row['property_unit_code']?>" required>
                                    <div id="edit_property_unit_code-error"></div>
                                </div>
                                <!-- Select2 Example -->
                                <div class="col-md-4 mb-3">
                                    <?php
                                        $client = "SELECT user_id, CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS fullname FROM `user` WHERE `type` = 'Staff'";
                                        $client_result = $con->query($client);
                                    ?>
                                    <label for="edit_staff" class="required">Landlady / Landlord</label>
                                    <select class="form-control select2" id="edit_staff" name="edit_staff" style="width: 100%;" required>
                                        <option value="">Select Landlady / Landlord</option>
                                        <?php 
                                        if ($client_result->num_rows > 0) {
                                            while ($clientrow = $client_result->fetch_assoc()) {
                                                $selected = ($clientrow['user_id'] == $row['user_id']) ? 'selected' : '';
                                        ?>
                                        <option value="<?=$clientrow['user_id'];?>" <?=$selected;?>><?=$clientrow['fullname'];?></option>
                                        <?php } } ?>
                                    </select>
                                    <div id="edit_staff-error"></div>
                                </div>
                                <!-- Initialize Select2 -->
                                <script>
                                    $(document).ready(function () {
                                        // Initialize Select2 Elements
                                        $('.select2').select2();
                                    });
                                </script>

                                <!-- Select2 Example -->
                                <div class="col-md-4 mb-3">
                                    <?php
                                        $staff = "SELECT user_id, CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS fullname FROM `user` WHERE `type` = 'Renter'";
                                        $staff_result = $con->query($staff);
                                    ?>
                                    <label for="edit_renter" class="required">Rented By</label>
                                    <select class="form-control select3" id="edit_renter" name="edit_renter" style="width: 100%;" required>
                                        <option value="">Select Rented By</option>
                                        <option value="0" <?= isset($row['rented_by']) && $row['rented_by'] == '0' ? 'selected' : '' ?>>None</option>
                                        <?php 
                                        if ($staff_result->num_rows > 0) {
                                            while ($staffrow = $staff_result->fetch_assoc()) {
                                                $selected = ($staffrow['user_id'] == $row['rented_by']) ? 'selected' : '';
                                        ?>
                                        <option value="<?=$staffrow['user_id'];?>" <?=$selected;?>><?=$staffrow['fullname'];?></option>
                                        <?php } } ?>
                                    </select>
                                    <div id="edit_renter-error"></div>
                                </div>
                                <!-- Initialize Select2 -->
                                <script>
                                    $(document).ready(function () {
                                        // Initialize Select2 Elements
                                        $('.select3').select2();
                                    });
                                </script>

                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="edit_property_type" class="required">Property Type</label>
                                        <select class="form-control" name="edit_property_type" id="edit_property_type" required>
                                            <option value="" selected disabled>Select Property Type</option>
                                            <option value="Apartment" <?= isset($row['property_type']) && $row['property_type'] == 'Apartment' ? 'selected' : '' ?>>Apartment</option>
                                            <option value="Boarding House" <?= isset($row['property_type']) && $row['property_type'] == 'Boarding House' ? 'selected' : '' ?>>Boarding House</option>
                                            <option value="Residential Space" <?= isset($row['property_type']) && $row['property_type'] == 'Residential Space' ? 'selected' : '' ?>>Residential Space</option>
                                        </select>
                                        <div id="edit_property_type-error"></div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="edit_property_location" class="required">Barangay</label>
                                        <select class="form-control" name="edit_property_location" id="edit_property_location" required>
                                            <option value="" selected disabled>Select Barangay</option>
                                            <option value="Adorable" <?= isset($row['property_location']) && $row['property_location'] == 'Adorable' ? 'selected' : '' ?>>Adorable</option>    
                                            <option value="Butuay" <?= isset($row['property_location']) && $row['property_location'] == 'Butuay' ? 'selected' : '' ?>>Butuay</option> 
                                            <option value="Carmen" <?= isset($row['property_location']) && $row['property_location'] == 'Carmen' ? 'selected' : '' ?>>Carmen</option> 
                                            <option value="Corrales" <?= isset($row['property_location']) && $row['property_location'] == 'Corrales' ? 'selected' : '' ?>>Corrales</option> 
                                            <option value="Dicoloc" <?= isset($row['property_location']) && $row['property_location'] == 'Dicoloc' ? 'selected' : '' ?>>Dicoloc</option> 
                                            <option value="Gata" <?= isset($row['property_location']) && $row['property_location'] == 'Gata' ? 'selected' : '' ?>>Gata</option> 
                                            <option value="Guintomoyan" <?= isset($row['property_location']) && $row['property_location'] == 'Guintomoyan' ? 'selected' : '' ?>>Guintomoyan</option> 
                                            <option value="Malibacsan" <?= isset($row['property_location']) && $row['property_location'] == 'Malibacsan' ? 'selected' : '' ?>>Malibacsan</option> 
                                            <option value="Macabayao" <?= isset($row['property_location']) && $row['property_location'] == 'Macabayao' ? 'selected' : '' ?>>Macabayao</option> 
                                            <option value="Matugas Alto" <?= isset($row['property_location']) && $row['property_location'] == 'Matugas Alto' ? 'selected' : '' ?>>Matugas Alto</option> 
                                            <option value="Matugas Bajo" <?= isset($row['property_location']) && $row['property_location'] == 'Matugas Bajo' ? 'selected' : '' ?>>Matugas Bajo</option> 
                                            <option value="Mialem" <?= isset($row['property_location']) && $row['property_location'] == 'Mialem' ? 'selected' : '' ?>>Mialem</option> 
                                            <option value="Naga" <?= isset($row['property_location']) && $row['property_location'] == 'Naga' ? 'selected' : '' ?>>Naga</option> 
                                            <option value="Palilan" <?= isset($row['property_location']) && $row['property_location'] == 'Palilan' ? 'selected' : '' ?>>Palilan</option> 
                                            <option value="Nacional" <?= isset($row['property_location']) && $row['property_location'] == 'Nacional' ? 'selected' : '' ?>>Nacional</option> 
                                            <option value="Rizal" <?= isset($row['property_location']) && $row['property_location'] == 'Rizal' ? 'selected' : '' ?>>Rizal</option>
                                            <option value="San Isidro" <?= isset($row['property_location']) && $row['property_location'] == 'San Isidro' ? 'selected' : '' ?>>San Isidro</option> 
                                            <option value="Santa Cruz" <?= isset($row['property_location']) && $row['property_location'] == 'Santa Cruz' ? 'selected' : '' ?>>Santa Cruz</option>
                                            <option value="Sibaroc" <?= isset($row['property_location']) && $row['property_location'] == 'Sibaroc' ? 'selected' : '' ?>>Sibaroc</option>
                                            <option value="Sinara Alto" <?= isset($row['property_location']) && $row['property_location'] == 'Sinara Alto' ? 'selected' : '' ?>>Sinara Alto</option>
                                            <option value="Sinara Bajo" <?= isset($row['property_location']) && $row['property_location'] == 'Sinara Bajo' ? 'selected' : '' ?>>Sinara Bajo</option>
                                            <option value="Seti" <?= isset($row['property_location']) && $row['property_location'] == 'Seti' ? 'selected' : '' ?>>Seti</option>
                                            <option value="Tabo-o" <?= isset($row['property_location']) && $row['property_location'] == 'Tabo-o' ? 'selected' : '' ?>>Tabo-o</option>
                                            <option value="Taraka" <?= isset($row['property_location']) && $row['property_location'] == 'Taraka' ? 'selected' : '' ?>>Taraka</option>
                                        </select>
                                        <div id="edit_property_location-error"></div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="edit_property_cost" class="required">Property Cost</label>
                                    <input type="text" class="form-control" placeholder="Enter Property Cost" name="edit_property_cost" id="edit_property_cost" value="<?=$row['property_cost']?>" required>
                                    <div id="edit_property_cost-error"></div>
                                </div>
    
                                <!-- <div class="col-md-4 mb-3">
                                    <label for="property_date" class="required">Date Rented</label>
                                    <input type="date" class="form-control" placeholder="Enter Email" name="property_date" id="property_date" required>
                                    <div id="property_date-error"></div>
                                </div> -->

                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="edit_property_status">Property Status</label>
                                        <select class="form-control" name="edit_property_status" id="edit_property_status" required>
                                            <option value="" selected disabled>Select Status</option>
                                            <option value="Rented" <?= isset($row['property_status']) && $row['property_status'] == 'Rented' ? 'selected' : '' ?>>Rented</option>
                                            <option value="Available" <?= isset($row['property_status']) && $row['property_status'] == 'Available' ? 'selected' : '' ?>>Available</option>
                                            <option value="Renovating" <?= isset($row['property_status']) && $row['property_status'] == 'Renovating' ? 'selected' : '' ?>>Renovating</option>
                                        </select>
                                        <div id="edit_property_status-error"></div>
                                    </div>
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
<?php include ('../includes/bottom.php'); ?>