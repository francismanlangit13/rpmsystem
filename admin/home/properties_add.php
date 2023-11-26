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
            <li class="breadcrumb-item active"><a href="./renter" class="text-decoration-none">Properties</a></li>
            <li class="breadcrumb-item">Add Property</li>
        </ol>
        <form action="properties_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Property form
                                <div class="float-end">
                                    <button type="submit" name="add_properties" class="btn btn-primary"><i class="fas fa-plus"></i> Add</button>
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="add_property_unit_code" class="required">Property Unit Code</label>
                                    <input type="text" class="form-control" placeholder="Enter Property Unit Code" name="add_property_unit_code" id="add_property_unit_code" required>
                                    <div id="add_property_unit_code-error"></div>
                                </div>
                                <!-- Select2 Example -->
                                <div class="col-md-4 mb-3">
                                    <?php
                                        $client = "SELECT user_id, CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS fullname FROM `user` WHERE `type` = 'Staff'";
                                        $client_result = $con->query($client);
                                    ?>
                                    <label for="add_staff" class="required">Landlady / Landlord</label>
                                    <select class="form-control select2" id="add_staff" name="add_staff" style="width: 100%;" required>
                                        <option value="">Select Landlady / Landlord</option>
                                        <?php 
                                            if ($client_result->num_rows > 0) {
                                            while($clientrow = $client_result->fetch_assoc()) {
                                        ?>
                                        <option value="<?=$clientrow['user_id'];?>"><?=$clientrow['fullname'];?></option>
                                        <?php } } ?>
                                    </select>
                                    <div id="add_staff-error"></div>
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
                                    <label for="add_renter" class="required">Rented By</label>
                                    <select class="form-control select3" id="add_renter" name="add_renter" style="width: 100%;" required>
                                        <option value="">Select Rented By</option>
                                        <option value=" ">None</option>
                                        <?php 
                                            if ($staff_result->num_rows > 0) {
                                            while($staffrow = $staff_result->fetch_assoc()) {
                                        ?>
                                        <option value="<?=$staffrow['user_id'];?>"><?=$staffrow['fullname'];?></option>
                                        <?php } } ?>
                                    </select>
                                    <div id="add_renter-error"></div>
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
                                        <label for="property_type" class="required">Property Type</label>
                                        <select class="form-control" name="property_type" id="property_type" required>
                                            <option value="" selected disabled>Select Property Type</option>
                                            <option value="Apartment">Apartment</option>
                                            <option value="Boarding House">Boarding House</option>
                                            <option value="Residential Space">Residential Space</option>
                                        </select>
                                        <div id="property_type-error"></div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="address" class="required">Barangay</label>
                                        <select class="form-control" name="barangay" id="barangay" required>
                                            <option value="" selected disabled>Select Barangay</option>
                                            <option value="Adorable">Adorable</option>    
                                            <option value="Butuay">Butuay</option> 
                                            <option value="Carmen">Carmen</option> 
                                            <option value="Corrales">Corrales</option> 
                                            <option value="Dicoloc">Dicoloc</option> 
                                            <option value="Gata">Gata</option> 
                                            <option value="Guintomoyan">Guintomoyan</option> 
                                            <option value="Malibacsan">Malibacsan</option> 
                                            <option value="Macabayao">Macabayao</option> 
                                            <option value="Matugas Alto">Matugas Alto</option> 
                                            <option value="Matugas Bajo">Matugas Bajo</option> 
                                            <option value="Mialem">Mialem</option> 
                                            <option value="Naga">Naga</option> 
                                            <option value="Palilan">Palilan</option> 
                                            <option value="Nacional">Nacional</option> 
                                            <option value="Rizal">Rizal</option>
                                            <option value="San Isidro">San Isidro</option> 
                                            <option value="Santa Cruz">Santa Cruz</option>
                                            <option value="Sibaroc">Sibaroc</option>
                                            <option value="Sinara Alto">Sinara Alto</option>
                                            <option value="Sinara Bajo">Sinara Bajo</option>
                                            <option value="Seti">Seti</option>
                                            <option value="Tabo-o">Tabo-o</option>
                                            <option value="Taraka">Taraka</option>
                                        </select>
                                        <div id="barangay-error"></div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="property_cost" class="required">Property Cost</label>
                                    <input type="text" class="form-control" placeholder="Enter Property Cost" name="property_cost" id="property_cost" required>
                                    <div id="property_cost-error"></div>
                                </div>
    
                                <!-- <div class="col-md-4 mb-3">
                                    <label for="property_date" class="required">Date Rented</label>
                                    <input type="date" class="form-control" placeholder="Enter Email" name="property_date" id="property_date" required>
                                    <div id="property_date-error"></div>
                                </div> -->

                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="property_status">Property Status</label>
                                        <select class="form-control" name="property_status" required>
                                            <option value="" selected disabled>Select Status</option>
                                            <option value="Rented">Rented</option>
                                            <option value="Available">Available</option>
                                            <option value="Renovating">Renovating</option>
                                        </select>
                                        <div id="property_status-error"></div>
                                    </div>
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