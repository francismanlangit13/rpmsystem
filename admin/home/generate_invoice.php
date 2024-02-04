<?php
    include ('../includes/header.php');
    $renter = isset($_POST['renter']) ? $_POST['renter'] : '';
    $invdate = isset($_POST['invdate']) ? $_POST['invdate'] : date("Y-m");
?>
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
        <h1 class="mt-4 noprint">Generate Invoice</h1>
        <ol class="breadcrumb mb-4 mt-3 noprint">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item">Generate Invoice</li>
        </ol>
        <form action="generate_invoice.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row noprint">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Generate form
                                <div class="float-end">
                                    <button type="submit" name="submit-btn" class="btn btn-sm btn-primary"><i class="fas fa-filter"></i> Filter</button>
                                    <button class="btn btn-sm btn-flat btn-secondary" type="button" onclick="window.print()" <?php if(isset($_POST['submit-btn'])) { } else { echo "disabled";} ?>><i class="fa fa-print"></i> Print</button>
                                </div>
                            </h4>
                        </div>
                        <div class="card-body row">
                            <!-- Select2 Example -->
                            <div class="col-md-3 mb-3">
                                <?php
                                    $staff = "SELECT user_id, CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS fullname FROM `user` WHERE `type` = 'Renter' AND `status` != 'Inactive'";
                                    $staff_result = $con->query($staff);
                                ?>
                                <label for="renter">Rentee</label>
                                <select class="form-control select3" id="renter" name="renter" style="width: 100%;">
                                    <option value="">Select Rentee</option>
                                    <?php 
                                        if ($staff_result->num_rows > 0) {
                                        while($staffrow = $staff_result->fetch_assoc()) {
                                        $selected = ($staffrow['user_id'] == $renter) ? 'selected' : '';
                                    ?>
                                    <option value="<?=$staffrow['user_id'];?>" <?=$selected;?>><?=$staffrow['fullname'];?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                            <!-- Initialize Select2 -->
                            <script>
                                $(document).ready(function () {
                                    // Initialize Select2 Elements
                                    $('.select3').select2();
                                });
                            </script>
                            
                            <div class="form-group col-md-3">
                                <label for="invdate" class="control-label">Invoice Date</label>
                                <input type="month" name="invdate" id="invdate" value="<?= $invdate ?>" class="form-control form-control-sm rounded-0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(isset($_POST['submit-btn'])) { ?>
                <?php
                    $stmt = mysqli_query($con, "SELECT *, CONCAT(`fname`, ' ', `mname`, ' ', `lname`) AS fullname, property.user_id AS staff_id FROM user INNER JOIN utility ON user.user_id = utility.user_id INNER JOIN property ON user.property_rented_id = property.property_id WHERE user.user_id = '$renter'");
                    $get_details = $stmt->fetch_assoc();
                ?>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="text-center">
                                <div style="text-align: center;">
                                    <img class="img-responsive" src="<?php echo base_url ?>assets/files/system/system_logo.jpg" alt="System Logo" width="20%" height="20%">
                                </div>
                                <h2>Breakdown Invoice of Month of <?php echo date('F Y', strtotime($invdate)); ?></h2>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-xs-12 col-md-6 col-lg-6 pull-left">
                                    <div class="panel panel-default height">
                                        <div class="panel-heading">Billing Details</div>
                                        <div class="panel-body">
                                            <strong>Rentee:</strong> <?=$get_details['fullname']?><br>
                                            <strong>Email:</strong> <?=$get_details['email']?><br>
                                            <strong>Phone:</strong> <?=$get_details['phone']?><br>
                                            <strong>Address:</strong> <?=$get_details['address']?><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="panel panel-default height">
                                        <div class="panel-heading">Property Information</div>
                                        <div class="panel-body">
                                            <strong>Unit Code:</strong> <?=$get_details['property_unit_code']?><br>
                                            <strong>Property Permit:</strong> <?=$get_details['property_permit']?><br>
                                            <strong>Property Location:</strong> Purok <?=$get_details['property_purok']?> <?=$get_details['property_barangay']?>, <?=$get_details['property_city']?> <?=$get_details['property_zipcode']?><br>
                                            <?php
                                                $staff_id = $get_details['staff_id'];
                                                $stmt0 = mysqli_query($con, "SELECT *, CONCAT(`fname`, ' ', `mname`, ' ', `lname`) AS staff_fullname FROM user WHERE user_id = '$staff_id'");
                                                $get_staffname = $stmt0->fetch_assoc();
                                            ?>
                                            <strong>Landlady / Landlord:</strong> <?=$get_staffname['staff_fullname']?><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="text-center"><strong>Bill summary</strong></h3>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-condensed" style="width:98%">
                                            <thead>
                                                <tr>
                                                    <td><strong>Bill Type</strong></td>
                                                    <td class="emptyrow"></td>
                                                    <td class="emptyrow"></td>
                                                    <td class="text-right"><strong>Total</strong></td>
                                                </tr>
                                            </thead>
                                            <?php
                                                $stmt1 = mysqli_query($con, "SELECT * FROM utility 
                                                    INNER JOIN utility_type ON utility_type.utility_type_id = utility.utility_type_id 
                                                    WHERE user_id = '$renter' 
                                                    AND DATE_FORMAT(utility.utility_date, '%Y-%m') = '$invdate'"
                                                );
                                                if (mysqli_num_rows($stmt1) > 0){
                                                    while ($renter_row = $stmt1->fetch_assoc()) {
                                            ?>
                                            <tbody>
                                                <tr>
                                                    <td><?=$renter_row['utility_type_name']?></td>
                                                    <td class="emptyrow"></td>
                                                    <td class="emptyrow"></td>
                                                    <td class="text-right">₱<?=$renter_row['utility_amount']?></td>
                                                </tr>
                                                <?php } } ?>
                                                <tr>
                                                    <td></td>
                                                    <td class="emptyrow"></td>
                                                    <td class="emptyrow customtd">*** Nothing Follows ***</td>
                                                    <td></td>
                                                </tr>
                                                <?php
                                                    $stmt2 = mysqli_query($con, "SELECT SUM(utility_amount) AS total_amount
                                                    FROM utility
                                                    WHERE user_id = '$renter' AND DATE_FORMAT(utility.utility_date, '%Y-%m') = '$invdate'
                                                    GROUP BY user_id");
                                                    $get_total = $stmt2->fetch_assoc();
                                                ?>
                                                <tr>
                                                    <td class="highrow"></td>
                                                    <td class="highrow"></td>
                                                    <td class="highrow text-right"><strong>Total</strong></td>
                                                    <td class="highrow text-right">₱<?= !empty($get_total['total_amount']) ? $get_total['total_amount'] : '0.00' ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </form>
    </div>
</main>
<script>
    document.getElementById('property_status').addEventListener('change', function () {
        var dateContainer = document.getElementById('dateContainer');
        var propertyDate = document.getElementById('property_date');

        if (this.value === 'Rented') {
            dateContainer.classList.remove('d-none');
            propertyDate.required = true;
        } else {
            dateContainer.classList.add('d-none');
            propertyDate.required = false;
        }
    });
</script>
<?php include ('../includes/bottom.php'); ?>