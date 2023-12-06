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
        <h1 class="mt-4">View Utilities</h1>
        <ol class="breadcrumb mb-4 mt-3">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="./utilities" class="text-decoration-none">Utilities</a></li>
            <li class="breadcrumb-item">View Utilities</li>
        </ol>
        <?php
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT *, CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS rent_fullname FROM `utilities`
                    INNER JOIN utilities_type ON utilities_type.utilities_type_id = utilities.utilities_type_id
                    INNER JOIN user ON user.user_id = utilities.user_id
                    INNER JOIN property ON property.rented_by = utilities.user_id
                    WHERE `utilities_id` = '$id' AND `utilities_status` != 'Archive'
                ";
                $sql_run = mysqli_query($con, $sql);

                if(mysqli_num_rows($sql_run) > 0) {
                    foreach($sql_run as $row){
        ?>
        <form action="utilities_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Utilities form</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="renter">Rented By</label>
                                    <input type="text" class="form-control" id="renter" value="<?= $row['rent_fullname']; ?>" disabled>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="property_location">Location</label>
                                    <input type="text" class="form-control" id="property_location" value="<?= $row['property_location']; ?>" disabled>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" value="<?= $row['phone']; ?>" disabled>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="bill_type">Bill Type</label>
                                    <input type="text" class="form-control" id="bill_type" value="<?= $row['utilities_type_name']; ?>" disabled>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="utilities_amount">Utilities Amount</label>
                                    <input type="text" class="form-control" id="utilities_amount" value="<?= $row['utilities_amount']; ?>" disabled>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="utilities_date">Utilities Date</label>
                                    <input type="text" class="form-control" id="utilities_date" value="<?= $row['utilities_date']; ?>" disabled>
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
                            <h4>Utilities info</h4>
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