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
        <h1 class="mt-4">View Manage Bills</h1>
        <ol class="breadcrumb mb-4 mt-3">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="./utility" class="text-decoration-none">Manage Bills</a></li>
            <li class="breadcrumb-item">View Manage Bills</li>
        </ol>
        <?php
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT *, DATE_FORMAT(utility_date, '%M %d, %Y %h:%i %p') as new_utility_date, CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS rent_fullname FROM `utility`
                    INNER JOIN utility_type ON utility_type.utility_type_id = utility.utility_type_id
                    INNER JOIN user ON user.user_id = utility.user_id
                    WHERE `utility_id` = '$id' AND `utility_status` != 'Archive'
                ";
                $sql_run = mysqli_query($con, $sql);

                if(mysqli_num_rows($sql_run) > 0) {
                    foreach($sql_run as $row){
        ?>
        <form action="utility_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Manage Bills form</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="renter"><b>Rentee</b></label>
                                    <input type="text" class="form-control-plaintext" id="renter" value="<?= $row['rent_fullname']; ?>" disabled>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="phone"><b>Phone</b></label>
                                    <input type="text" class="form-control-plaintext" id="phone" value="<?= $row['phone']; ?>" disabled>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="email"><b>Email</b></label>
                                    <input type="text" class="form-control-plaintext" id="email" value="<?= $row['email']; ?>" disabled>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="property_location"><b>Address</b></label>
                                    <textarea class="form-control-plaintext" id="property_location" disabled><?= $row['address']; ?></textarea>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="bill_type"><b>Bill Type</b></label>
                                    <input type="text" class="form-control-plaintext" id="bill_type" value="<?= $row['utility_type_name']; ?>" disabled>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="utility_amount"><b>Bill Amount</b></label>
                                    <input type="text" class="form-control-plaintext" id="utility_amount" value="<?= $row['utility_amount']; ?>" disabled>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="utility_date"><b>Bill Date</b></label>
                                    <input type="text" class="form-control-plaintext" id="utility_date" value="<?= $row['new_utility_date']; ?>" disabled>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="utility_status"><b>Status</b></label>
                                    <input type="text" class="form-control-plaintext" id="utility_status" value="<?= $row['status']; ?>" disabled>
                                </div>

                                <div class="col-md-4 mt-3 text-center <?php if ($row['utility_type_id'] != '1'){ } else { echo"d-none"; }?>" id="Container2">
                                    <h6>Bills Attachment</h6> 
                                    <a href="
                                        <?php
                                            if(!empty($row['utility_attachment'])){ 
                                                echo base_url . 'assets/files/bills/' . $row['utility_attachment'];
                                            } else { echo base_url . 'assets/files/system/no-image.png'; }
                                        ?>" class="glightbox d-block" data-gallery="QRCode">
                                        <img class="zoom img-fluid img-bordered-sm" id="frame1"
                                        src="
                                            <?php
                                                if(!empty($row['utility_attachment'])) {
                                                    echo base_url . 'assets/files/bills/' . $row['utility_attachment'];
                                                } else { echo base_url . 'assets/files/system/no-image.png'; } 
                                            ?>
                                        " alt="image" style="height: 180px; max-width: 240px; object-fit: cover;">
                                    </a>
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
                            <h4>Manage Bills info</h4>
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