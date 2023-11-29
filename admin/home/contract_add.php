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
        <h1 class="mt-4">Add Contract</h1>
        <ol class="breadcrumb mb-4 mt-3">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="./contract" class="text-decoration-none">Contracts</a></li>
            <li class="breadcrumb-item">Add Contract</li>
        </ol>
        <form action="contract_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Contract form
                                <div class="float-end">
                                    <button type="submit" name="add_contract" class="btn btn-primary"><i class="fas fa-plus"></i> Add</button>
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
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
                                
                                <div class="col-md-4 mb-3">
                                    <label for="add_property_unit_code" class="required">Property Unit Code</label>
                                    <input type="text" class="form-control" placeholder="Enter Property Unit Code" name="add_property_unit_code" id="add_property_unit_code" required>
                                    <div id="add_property_unit_code-error"></div>
                                </div>

                                <!-- Select2 Example -->
                                <div class="col-md-4 mb-3">
                                    <?php
                                        $staff = "SELECT user_id, CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS fullname FROM `user` WHERE `type` = 'Renter'";
                                        $staff_result = $con->query($staff);
                                    ?>
                                    <label for="add_renter" class="required">Lesse holder Name</label>
                                    <select class="form-control select3" id="add_renter" name="add_renter" style="width: 100%;" required>
                                        <option value="">Select Lesse holder</option>
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

                                <div class="col-md-6 mb-3">
                                    <label for="add_occupants1" class="required">Occupant's Name 1</label>
                                    <input type="text" class="form-control" placeholder="Enter Occupant's Name 1" name="add_occupants1" id="add_occupants1">
                                    <div id="add_occupants1-error"></div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="add_occupants2" class="required">Occupant's Name 2</label>
                                    <input type="text" class="form-control" placeholder="Enter Occupant's Name 2" name="add_occupants2" id="add_occupants2">
                                    <div id="add_occupants2-error"></div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="add_occupants3" class="required">Occupant's Name 3</label>
                                    <input type="text" class="form-control" placeholder="Enter Occupant's Name 3" name="add_occupants3" id="add_occupants3">
                                    <div id="add_occupants3-error"></div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="add_occupants4" class="required">Occupant's Name 4</label>
                                    <input type="text" class="form-control" placeholder="Enter Occupant's Name 4" name="add_occupants4" id="add_occupants4">
                                    <div id="add_occupants4-error"></div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="add_permanent_address" class="required">Permanent Address</label>
                                    <input type="text" class="form-control" placeholder="Enter Permanent Address" name="add_permanent_address" id="add_permanent_address" required>
                                    <div id="add_permanent_address-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="add_phone" class="required">Mobile Number</label>
                                    <input type="text" class="form-control" placeholder="Enter Mobile Number" name="add_phone" id="add_phone" required>
                                    <div id="add_phone-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="add_contract_start" class="required">Lessee Start Date</label>
                                    <input type="date" class="form-control" placeholder="Enter Permanent Address" name="add_contract_start" id="add_contract_start" required>
                                    <div id="add_contract_start-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="add_contract_end" class="required">Lessee End Date</label>
                                    <input type="date" class="form-control" placeholder="Enter Permanent Address" name="add_contract_end" id="add_contract_end" required>
                                    <div id="add_contract_end-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="add_monthly_rent" class="required">Monthly Rent</label>
                                    <input type="text" class="form-control" placeholder="Enter Monthly Rent" name="add_monthly_rent" id="add_monthly_rent" required>
                                    <div id="add_monthly_rent-error"></div>
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