<?php
    include ('../includes/header.php');
    $renter = isset($_POST['renter']) ? $_POST['renter'] : '';
    $type = isset($_POST['payment_type']) ? $_POST['payment_type'] : '';
    $startmonth = isset($_POST['startmonth']) ? $_POST['startmonth'] : date("Y-m");
    $endmonth = isset($_POST['endmonth']) ? $_POST['endmonth'] : date("Y-m");
    $firstDayOfMonth = date("Y-m-01", strtotime($startmonth));
    $lastDayOfMonth = date("Y-m-t", strtotime($endmonth));
?>
<head>
    <!-- Select2 CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <style type="text/css">
        #datatablesSimple th:nth-child(7) {
            width: 15% !important;
        }
        @media print{
            body{
                margin-top: -70px;
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
        }
        #sys_logo{
            object-fit:cover;
            object-position:center center;
            width: 6.5em;
            height: 6.5em;
        }
    </style>
</head>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 noprint">Generate Arrears</h1>
        <ol class="breadcrumb mb-4 mt-3 noprint">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item">Generate Arrears</li>
        </ol>
        <form action="generate_arrears.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row noprint">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Generate form
                                <div class="float-end">
                                    <button type="submit" name="submit-btn" class="btn btn-sm btn-primary"><i class="fas fa-filter"></i> Filter</button>
                                    <button class="btn btn-sm btn-flat btn-secondary" type="button" onclick="window.print()" <?php if(isset($_POST['submit-btn'])) { } else { echo "disabled";} ?>><i class="fa fa-print"></i> Print</button>
							        <!-- <button class="btn btn-sm btn-flat btn-success" type="button" id="export-btn-csv" <?php if(isset($_POST['submit-btn'])) { } else { echo "disabled";} ?>><i class="fas fa-file-csv"></i> CSV</button> -->
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
                                    <option value="">All Rentee</option>
                                    <?php 
                                        if ($staff_result->num_rows > 0) {
                                        while($staffrow = $staff_result->fetch_assoc()) {
                                        $selected = ($staffrow['user_id'] == $renter) ? 'selected' : '';
                                    ?>
                                    <option value="<?=$staffrow['user_id'];?>" <?=$selected;?>><?=$staffrow['fullname'];?></option>
                                    <?php } } ?>
                                </select>
                                <div id="renter-error"></div>
                            </div>
                            <!-- Initialize Select2 -->
                            <script>
                                $(document).ready(function () {
                                    // Initialize Select2 Elements
                                    $('.select3').select2();
                                });
                            </script>
                            <div class="form-group col-md-3">
                                <label for="startmonth" class="control-label">Date From</label>
                                <input type="month" name="startmonth" id="startmonth" value="<?= $startmonth ?>" class="form-control form-control-sm rounded-0">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="endmonth" class="control-label">Date To</label>
                                <input type="month" name="endmonth" id="endmonth" value="<?= $endmonth ?>" class="form-control form-control-sm rounded-0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(isset($_POST['submit-btn'])) { ?>
            <h3 class="text-center mt-5">Rental Properties Management System</h3>
            <table class="table text-center table-hover table-striped mt-1 print-table-adjust">
                <!-- <colgroup>
                    <col width="5%">
                    <col width="30%">
                    <col width="30%">
                    <col width="15%">
                    <col width="20%">
                </colgroup> -->
                <thead>
                    <tr class="bg-secondary text-light">
                        <th>No.</th>
                        <th>Renter</th>
                        <th>Date Payment</th>
                        <th>Payment Type</th>
                        <th>Bill Type</th>
                        <th>Arrears Remaining</th>
                        <th>Action By</th>
                        <th>Date of Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $qry = $con->query("SELECT *,
                            DATE_FORMAT(payment_date, '%m-%d-%Y') as new_payment_date
                            FROM payment 
                            INNER JOIN `user` ON user.user_id = payment.user_id
                            INNER JOIN `utility_type` ON utility_type.utility_type_id = payment.utility_type_id
                            INNER JOIN `payment_type` ON payment_type.payment_type_id = payment.payment_type_id
                            WHERE `payment_status` = 'Partial' AND DATE(payment_date) BETWEEN '{$firstDayOfMonth}' AND '{$lastDayOfMonth}' " . 
                            ($renter != '' ? "AND user.user_id = '{$renter}' " : "") . 
                            ($type != '' ? "AND payment.utility_type_id = '{$type}' " : "") . "
                            ORDER BY UNIX_TIMESTAMP(payment_date) ASC
                        ");                        
                        while($row = $qry->fetch_assoc()):
                            $staff = $row['updated_by'];
                            $stmt = $con->query("SELECT CONCAT(`fname`, ' ', `mname`, ' ', `lname`, ' ', `suffix`) AS `staff_fullname`, DATE_FORMAT(last_update_date, '%m-%d-%Y %h:%i:%s %p') as new_last_update_date FROM `user` LEFT JOIN `payment` ON `payment`.`updated_by` = `user`.`user_id` WHERE `updated_by` = '$staff'");
                            $row1 = $stmt->fetch_assoc()
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $row['payment_id'] ?></td>
                            <td class=""><p class="m-0"><?php echo $row['fname'] ?> <?php echo $row['mname'] ?> <?php echo $row['lname'] ?> <?php echo $row['suffix'] ?></p></td>
                            <td class=""><?php echo $row['new_payment_date'] ?></td>
                            <td class=""><p class="m-0"><?php echo $row['payment_type_name'] ?></p></td>
                            <td class=""><p class="m-0"><?php echo $row['utility_type_name'] ?></p></td>
                            <td class=""><p class="m-0"><?php echo $row['payment_remaining'] ?></p></td>
                            <td class=""><p class="m-0"><?php echo $row1['staff_fullname'] ?></p></td>
                            <td class=""><p class="m-0"><?php echo $row1['new_last_update_date'] ?></p></td>
                        </tr>
                    <?php endwhile; ?>
                    <?php if($qry->num_rows <= 0): ?>
                        <tr>
                            <th class="py-1 text-center" colspan="15">No Data.</th>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
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