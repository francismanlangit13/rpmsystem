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
        <h1 class="mt-4">View Contract</h1>
        <ol class="breadcrumb mb-4 mt-3">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="./contract" class="text-decoration-none">Contracts</a></li>
            <li class="breadcrumb-item">View Contract</li>
        </ol>
        <?php
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT *, CONCAT(`fname`, ' ', `mname`, ' ', `lname`, ' ', `suffix`) AS `fullname`, contract.phone AS contract_phone FROM `contract` INNER JOIN `user` ON `user`.`user_id` = `contract`.`user_id` WHERE `contract_id` = '$id' AND `contract_status` != 'Archive'";
                $sql_run = mysqli_query($con, $sql);

                if(mysqli_num_rows($sql_run) > 0) {
                    foreach($sql_run as $row){
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Contract form</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="view_barangay">Barangay</label>
                                <input type="text" class="form-control" id="view_barangay" value="<?= $row['property_location']; ?>" disabled>
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="view_property_unit_code">Property Unit Code</label>
                                <input type="text" class="form-control" id="view_property_unit_code" value="<?= $row['property_unit_code']; ?>" disabled>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="view_renter">Lesse holder Name</label>
                                <input type="text" class="form-control" id="view_renter" value="<?= $row['fullname']; ?>" disabled>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="view_occupants1">Occupant's Name 1</label>
                                <input type="text" class="form-control" id="view_occupants1" value="<?= $row['occupant1']; ?>" disabled>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="view_occupants2">Occupant's Name 2</label>
                                <input type="text" class="form-control" id="view_occupants2" value="<?= $row['occupant2']; ?>" disabled>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="view_occupants3">Occupant's Name 3</label>
                                <input type="text" class="form-control" id="view_occupants3" value="<?= $row['occupant3']; ?>" disabled>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="view_occupants4">Occupant's Name 4</label>
                                <input type="text" class="form-control" id="view_occupants4" value="<?= $row['occupant4']; ?>" disabled>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="view_permanent_address">Permanent Address</label>
                                <input type="text" class="form-control" id="view_permanent_address" value="<?= $row['permanent_address']; ?>" disabled>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="view_phone">Mobile Number</label>
                                <input type="text" class="form-control" id="view_phone" value="<?= $row['contract_phone']; ?>" disabled>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="view_contract_start">Lessee Start Date</label>
                                <input type="date" class="form-control" id="view_contract_start" value="<?= $row['contract_start']; ?>" disabled>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="view_contract_end">Lessee End Date</label>
                                <input type="date" class="form-control" id="view_contract_end" value="<?= $row['contract_end']; ?>" disabled>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="view_monthly_rent">Monthly Rent</label>
                                <input type="text" class="form-control" id="view_monthly_rent" value="<?= $row['monthly_rent']; ?>" disabled>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="view_contract_status">Contract Status</label>
                                <input type="text" class="form-control" id="view_contract_status" value="<?= $row['contract_status']; ?>" disabled>
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