<?php include ('../includes/header.php'); ?>
<head>
    <!-- Select2 CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<style type="text/css">
    #datatablesSimple th:nth-child(7) {
        width: 15% !important;
    }
    .height {
        min-height: 200px;
    }

    .icon {
        font-size: 47px;
        color: #5CB85C;
    }

    .iconbig {
        font-size: 77px;
        color: #5CB85C;
    }

    /* .table > tbody > tr > .emptyrow {
        border-top: none;
    } */

    .table > thead > tr > .emptyrow {
        border-bottom: none;
    }

    .table > tbody > tr > .highrow {
        border-top: 3px solid;
    }
    .table tbody tr td.customtd {
        padding-left: 280px;
    }
    @media print{
        body{
            margin-top: -50px;
        }
        .bg-success-print {
            background-color: #28a745 !important; /* Green color for success */
            color: #fff !important; /* White text for better visibility on dark background */
        }
        .noprint{
            display: none;
        }
        .print-adjust {
            margin-top:-5px;
        }
        .print-table-adjust{
            zoom: 65%;
        }
        .noprint-scroll{
        overflow-x: unset !important;
        }
        @page {
            size: auto;
            margin: 1mm;
        }
        .col-md-6,
        .col-lg-6 {
            width: 50%;
        }
        .table tbody tr td.customtd {
        padding-left: 215px;
    }
    }
</style>
</head>
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
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="text-center">
                        <div style="text-align: center;">
                            <img class="img-responsive" src="<?php echo base_url ?>assets/files/system/system_logo.jpg" alt="System Logo" width="20%" height="20%">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-12 col-md-6 col-lg-6 pull-left">
                            <div class="panel panel-default height">
                                <div class="panel-heading">Rentee Information</div>
                                <?php
                                    $new_user_id = $row['rentee_id'];
                                    $stmt0 = mysqli_query($con, "SELECT *, DATE_FORMAT(startrent, '%m-%d-%Y') as newstartrent, DATE_FORMAT(endrent, '%m-%d-%Y') as newendrent, CONCAT(`fname`, ' ', `mname`, ' ', `lname`) AS rentee_fullname FROM user WHERE user_id = '$new_user_id'");
                                    $get_renteename = $stmt0->fetch_assoc();
                                ?>
                                <?php if($row['property_status'] == 'Rented'){ ?>
                                    <div class="panel-body">
                                        <strong>Rentee:</strong> <?=$get_renteename['rentee_fullname']?><br>
                                        <strong>Email:</strong> <?=$get_renteename['email']?><br>
                                        <strong>Phone:</strong> <?=$get_renteename['phone']?><br>
                                        <strong>Address:</strong> <?=$get_renteename['address']?><br>
                                        <strong>Occupation:</strong> <?=$get_renteename['occupation']?><br>
                                        <strong>Start Rent:</strong> <?=$get_renteename['newstartrent']?><br>
                                        <strong>End Rent:</strong> <?=$get_renteename['newendrent']?><br>
                                    </div>
                                <?php } else { ?>
                                    <div class="panel-body">
                                        <strong>Rentee:</strong> N/A<br>
                                        <strong>Email:</strong> N/A<br>
                                        <strong>Phone:</strong> N/A<br>
                                        <strong>Address:</strong> N/A<br>
                                        <strong>Occupation:</strong> N/A<br>
                                        <strong>Start Rent:</strong> N/A<br>
                                        <strong>End Rent:</strong> N/A<br>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <div class="panel panel-default height">
                                <div class="panel-heading">Property Information</div>
                                <div class="panel-body">
                                    <strong>Unit Code:</strong> <?=$row['property_unit_code']?><br>
                                    <strong>Unit Cost:</strong> <?=$row['property_amount']?><br>
                                    <strong>Property Permit:</strong> <?=$row['property_permit']?><br>
                                    <strong>Property Type:</strong> <?=$row['property_type_name']?><br>
                                    <strong>Property Status:</strong> <?=$row['property_status']?><br>
                                    <strong>Property Location:</strong> Purok <?=$row['property_purok']?> <?=$row['property_barangay']?>, <?=$row['property_city']?> <?=$row['property_zipcode']?><br>
                                    <strong>Landlady / Landlord:</strong> <?=$row['staff_fullname']?><br>
                                </div>
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