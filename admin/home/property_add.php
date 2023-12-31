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
        <h1 class="mt-4">Add Property</h1>
        <ol class="breadcrumb mb-4 mt-3">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="./property" class="text-decoration-none">Property</a></li>
            <li class="breadcrumb-item">Add Property</li>
        </ol>
        <form action="property_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Property form
                                <div class="float-end">
                                    <button type="submit" name="add_property" class="btn btn-primary"><i class="fas fa-plus"></i> Add</button>
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="property_unit_code" class="required">Property Unit Code</label>
                                    <input type="text" class="form-control" placeholder="Enter Property Unit Code" name="property_unit_code" id="property_unit_code" required>
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
                                            while($clientrow = $client_result->fetch_assoc()) {
                                        ?>
                                        <option value="<?=$clientrow['user_id'];?>"><?=$clientrow['fullname'];?></option>
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
                                            <option value="" selected>Select Status</option>
                                            <option value="Rented">Rented</option>
                                            <option value="Available">Available</option>
                                            <option value="Renovating">Renovating</option>
                                            <option value="Reserve">Reserve</option>
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
                                        ?>
                                            <option value="<?= $property_type["property_type_id"]; ?>"><?= $property_type["property_type_name"]; ?></option>
                                        <?php
                                            endwhile; // While loop must be terminated
                                        ?>
                                    </select>
                                    <div id="property_type_id-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="property_location" class="required">Property Location</label>
                                    <input type="text" class="form-control" placeholder="Enter Property Location" name="property_location" id="property_location" required>
                                    <div id="property_location-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="property_amount" class="required">Unit Cost</label>
                                    <input type="number" class="form-control" placeholder="Enter Unit Cost" name="property_amount" id="property_amount" required>
                                    <div id="property_amount-error"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
<?php include ('../includes/bottom.php'); ?>