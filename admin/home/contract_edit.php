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
        <h1 class="mt-4">Edit Contract</h1>
        <ol class="breadcrumb mb-4 mt-3">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="./contract" class="text-decoration-none">Contracts</a></li>
            <li class="breadcrumb-item">Edit Contract</li>
        </ol>
        <?php
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT *, CONCAT(`fname`, ' ', `mname`, ' ', `lname`, ' ', `suffix`) AS `fullname`, contract.phone AS contract_phone FROM `contract` INNER JOIN `user` ON `user`.`user_id` = `contract`.`user_id` WHERE `contract_id` = '$id' AND `contract_status` != 'Archive'";
                $sql_run = mysqli_query($con, $sql);

                if(mysqli_num_rows($sql_run) > 0) {
                    foreach($sql_run as $row){
        ?>
        <form action="contract_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Contract form
                                <div class="float-end">
                                    <button type="submit" name="edit_contract" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                                    <input type="hidden" name="contract_id" value="<?= $row['contract_id'] ?>">
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="edit_barangay" class="required">Barangay</label>
                                        <select class="form-control" name="edit_barangay" id="edit_barangay" required>
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
                                        <div id="edit_barangay-error"></div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="edit_property_unit_code" class="required">Property Unit Code</label>
                                    <input type="text" class="form-control" placeholder="Enter Property Unit Code" name="edit_property_unit_code" id="edit_property_unit_code" value="<?= $row['property_unit_code']; ?>" required>
                                    <div id="edit_property_unit_code-error"></div>
                                </div>

                                <!-- Select2 Example -->
                                <div class="col-md-4 mb-3">
                                    <?php
                                        $staff = "SELECT user_id, CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS fullname FROM `user` WHERE `type` = 'Renter'";
                                        $staff_result = $con->query($staff);
                                    ?>
                                    <label for="edit_renter" class="required">Lesse holder Name</label>
                                    <select class="form-control select3" id="edit_renter" name="edit_renter" style="width: 100%;" required>
                                        <option value="">Select Lesse holder</option>
                                        <?php 
                                        if ($staff_result->num_rows > 0) {
                                            while ($staffrow = $staff_result->fetch_assoc()) {
                                                $selected = ($staffrow['user_id'] == $row['user_id']) ? 'selected' : '';
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

                                <div class="col-md-6 mb-3">
                                    <label for="edit_occupants1" class="required">Occupant's Name 1</label>
                                    <input type="text" class="form-control" placeholder="Enter Occupant's Name 1" name="edit_occupants1" id="edit_occupants1" value="<?= $row['occupant1']; ?>">
                                    <div id="edit_occupants1-error"></div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="edit_occupants2" class="required">Occupant's Name 2</label>
                                    <input type="text" class="form-control" placeholder="Enter Occupant's Name 2" name="edit_occupants2" id="edit_occupants2" value="<?= $row['occupant2']; ?>">
                                    <div id="edit_occupants2-error"></div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="edit_occupants3" class="required">Occupant's Name 3</label>
                                    <input type="text" class="form-control" placeholder="Enter Occupant's Name 3" name="edit_occupants3" id="edit_occupants3" value="<?= $row['occupant3']; ?>">
                                    <div id="edit_occupants3-error"></div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="edit_occupants4" class="required">Occupant's Name 4</label>
                                    <input type="text" class="form-control" placeholder="Enter Occupant's Name 4" name="edit_occupants4" id="edit_occupants4" value="<?= $row['occupant4']; ?>">
                                    <div id="edit_occupants4-error"></div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="edit_permanent_address" class="required">Permanent Address</label>
                                    <input type="text" class="form-control" placeholder="Enter Permanent Address" name="edit_permanent_address" id="edit_permanent_address" value="<?= $row['permanent_address']; ?>" required>
                                    <div id="edit_permanent_address-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="edit_phone" class="required">Mobile Number</label>
                                    <input type="text" class="form-control" placeholder="Enter Mobile Number" name="edit_phone" id="edit_phone" value="<?= $row['contract_phone']; ?>" required>
                                    <div id="edit_phone-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="edit_contract_start" class="required">Lessee Start Date</label>
                                    <input type="date" class="form-control" placeholder="Enter Permanent Address" name="edit_contract_start" id="edit_contract_start" value="<?= $row['contract_start']; ?>" required>
                                    <div id="edit_contract_start-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="edit_contract_end" class="required">Lessee End Date</label>
                                    <input type="date" class="form-control" placeholder="Enter Permanent Address" name="edit_contract_end" id="edit_contract_end" value="<?= $row['contract_end']; ?>" required>
                                    <div id="edit_contract_end-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="edit_monthly_rent" class="required">Monthly Rent</label>
                                    <input type="text" class="form-control" placeholder="Enter Monthly Rent" name="edit_monthly_rent" id="edit_monthly_rent" value="<?= $row['monthly_rent']; ?>" required>
                                    <div id="edit_monthly_rent-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="edit_contract_status" class="required">Contract Status</label>
                                        <select class="form-control" name="edit_contract_status" id="edit_contract_status" required>
                                            <option value="">Select Contract Status</option>
                                            <option value="Active" <?= isset($row['contract_status']) && $row['contract_status'] == 'Active' ? 'selected' : '' ?>>Active</option>
                                            <option value="Inactive" <?= isset($row['contract_status']) && $row['contract_status'] == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                                        </select>
                                        <div id="edit_contract_status-error"></div>
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
                            <h4>Contract form</h4>
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