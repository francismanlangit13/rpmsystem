<?php
    include ('../includes/header.php');
    $barangay = isset($_POST['Barangay']) ? $_POST['Barangay'] : '';
    $role = isset($_POST['Role']) ? $_POST['Role'] : '';
    $status = isset($_POST['Status']) ? $_POST['Status'] : '';
?>
<head>
    <!-- Select2 CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
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
        .form-check-label{
            margin-left: 1.2rem;
        }
        .form-check-input {
            margin-left: 0rem !important;
        }
    </style>
</head>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 noprint">Generate Users</h1>
        <ol class="breadcrumb mb-4 mt-3 noprint">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item">Generate Users</li>
        </ol>
        <form action="generate_users.php" method="post" autocomplete="off" enctype="multipart/form-data">
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
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="Role">User Type</label>
                                    <select class="form-control" name="Role" id="Role">
                                        <option value="" selected>Select User Type</option>
                                        <option value="">All User Type</option>
                                        <option value="Admin" <?= isset($role) && $role == 'Admin' ? 'selected' : '' ?>>Admin</option>
                                        <option value="Staff" <?= isset($role) && $role == 'Staff' ? 'selected' : '' ?>>Staff</option>
                                        <option value="Renter" <?= isset($role) && $role == 'Renter' ? 'selected' : '' ?>>Rentee</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="Status">User Status</label>
                                    <select class="form-control" name="Status" id="Status">
                                        <option value="" selected>Select Status</option>
                                        <option value="">All Status</option>
                                        <option value="Active" <?= isset($status) && $status == 'Active' ? 'selected' : '' ?>>Active</option>
                                        <option value="Inactive" <?= isset($status) && $status == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="Barangay">Barangay</label>
                                <input type="text" class="form-control" name="Barangay" id="Barangay" value="<?=$barangay?>">
                            </div>
                            <div class="form-group col-md-3"></div>
                            <div class="row">
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="Gender" id="Gender" name="Gender" <?php if(isset($_POST['Gender'])) { echo "checked"; }?>>
                                    <label class="form-check-label" for="Gender">Gender</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="Birthday" id="Birthday" name="Birthday" <?php if(isset($_POST['Birthday'])) { echo "checked"; }?>>
                                    <label class="form-check-label" for="Birthday">Birthday</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="Civil_Status" id="Civil_Status" name="Civil_Status" <?php if(isset($_POST['Civil_Status'])) { echo "checked"; }?>>
                                    <label class="form-check-label" for="Civil_Status">Civil Status</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="Email" id="Email" name="Email" <?php if(isset($_POST['Email'])) { echo "checked"; }?>>
                                    <label class="form-check-label" for="Email">Email</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="Phone" id="Phone" name="Phone" <?php if(isset($_POST['Phone'])) { echo "checked"; }?>>
                                    <label class="form-check-label" for="Phone">Phone</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="Address" id="Address" name="Address" <?php if(isset($_POST['Address'])) { echo "checked"; }?>>
                                    <label class="form-check-label" for="Address">Address</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="Property" id="Property" name="Property" <?php if(isset($_POST['Property'])) { echo "checked"; }?>>
                                    <label class="form-check-label" for="Property">Property</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="Location" id="Location" name="Location" <?php if(isset($_POST['Location'])) { echo "checked"; }?>>
                                    <label class="form-check-label" for="Location">Property Location</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="Property_amount" id="Property_amount" name="Property_amount" <?php if(isset($_POST['Property_amount'])) { echo "checked"; }?>>
                                    <label class="form-check-label" for="Property_amount">Unit Cost</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="Balance" id="Balance" name="Balance" <?php if(isset($_POST['Balance'])) { echo "checked"; }?>>
                                    <label class="form-check-label" for="Balance">Balance</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="Startrent" id="Startrent" name="Startrent" <?php if(isset($_POST['Startrent'])) { echo "checked"; }?>>
                                    <label class="form-check-label" for="Startrent">Start Rent</label>
                                </div>
                                <div class='col-md-2'>
                                    <input class="form-check-input" type="checkbox" value="Endrent" id="Endrent" name="Endrent" <?php if(isset($_POST['Endrent'])) { echo "checked"; }?>>
                                    <label class="form-check-label" for="Endrent">End Rent</label>
                                </div>
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
                    <col width="25%">
                    <col width="20%">
                    <col width="15%">
                    <col width="15%">
                    <col width="10%">
                    <col width="10%">
                </colgroup> -->
                <thead>
                    <tr class="bg-secondary text-light">
                        <th>No.</th>
                        <th>Full Name</th>
                        <?php if(isset($_POST['Gender'])) { ?>
                            <th>Gender</th>
                        <?php } if(isset($_POST['Civil_Status'])) { ?>
                            <th>Civil Status</th>
                        <?php } if(isset($_POST['Birthday'])) { ?>
                            <th>Birthday</th>
                        <?php } if(isset($_POST['Email'])) { ?>
                            <th>Email</th>
                        <?php } if(isset($_POST['Phone'])) { ?>
                            <th>Phone</th>
                        <?php } if(!empty($_POST['Role'])){ ?>
                            <th>Role</th>
                        <?php } if(!empty($_POST['Status'])) { ?>
                            <th>Status</th>
                        <?php } if(isset($_POST['Address'])) { ?>
                            <th>Address</th>
                        <?php } if(isset($_POST['Property'])) { ?>
                            <th>Property</th>
                        <?php } if(isset($_POST['Location'])) { ?>
                            <th>Property Location</th>
                        <?php } if(isset($_POST['Property_amount'])) { ?>
                            <th>Unit Cost</th>
                        <?php } if(isset($_POST['Balance'])) { ?>
                            <th>Balance</th>
                        <?php } if(isset($_POST['Startrent'])) { ?>
                            <th>Start Rent</th>
                        <?php } if(isset($_POST['Endrent'])) { ?>
                            <th>End Rent</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Build the SQL query
                        $qry = "SELECT *, user.user_id AS new_user_id FROM `user` LEFT JOIN `property` ON property.property_id = user.property_rented_id WHERE user.user_id != '$userID'";
                        $conditions = [];
                        if ($role != '') { $conditions[] = " `type` = '$role'"; }
                        if ($status != '') { $conditions[] = " `status` = '$status'"; }
                        if ($barangay != '') { $conditions[] = " `address` LIKE '%$barangay%'"; }
                        if (!empty($conditions)) { $qry .= " AND" . implode(" AND", $conditions); }

                        // Execute the query
                        $qry = $con->query($qry);

                        while ($row = $qry->fetch_assoc()):
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $row['new_user_id'] ?></td>
                            <td class=""><p class="m-0"><?php echo $row['fname'] ?> <?php echo $row['mname'] ?> <?php echo $row['lname'] ?> <?php echo $row['suffix'] ?></p></td>
                            <?php if(isset($_POST['Gender'])) { ?>
                                <td class=""><p class="m-0"><?php echo $row['gender'] ?></p></td>
                            <?php } if(isset($_POST['Civil_Status'])) { ?>
                            <td class=""><p class="m-0"><?php echo $row['civil_status'] ?></p></td>
                            <?php } if(isset($_POST['Birthday'])) { ?>
                                <td class=""><p class="m-0"><?php echo $row['birthday'] ?></p></td>
                            <?php } if(isset($_POST['Email'])) { ?>
                                <td class=""><p class="m-0"><?php echo $row['email'] ?></p></td>
                            <?php } if(isset($_POST['Phone'])) { ?>
                                <td class=""><p class="m-0"><?php echo $row['phone'] ?></p></td>
                            <?php } if(!empty($_POST['Role'])){ ?>
                                <td class=""><p class="m-0"><?php echo $row['type'] ?></p></td>
                            <?php } if(!empty($_POST['Status'])) { ?>
                                <td class=""><p class="m-0"><?php echo $row['status'] ?></p></td>
                            <?php } if(isset($_POST['Address'])) { ?>
                                <td class=""><p class="m-0"><?php echo $row['address'] ?></p></td>
                            <?php } if(isset($_POST['Property'])) { ?>
                                <td class=""><p class="m-0"><?php echo $row['property_unit_code'] ?></p></td>
                            <?php } if(isset($_POST['Location'])) { ?>
                                <td class=""><p class="m-0"><?php echo $row['property_barangay'] .', '. $row['property_city'] .' '. $row['property_zipcode']?></p></td>
                            <?php } if(isset($_POST['Property_amount'])) { ?>
                                <td class=""><p class="m-0"><?php echo $row['property_amount'] ?></p></td>
                            <?php } if(isset($_POST['Balance'])) { ?>
                                <td class=""><p class="m-0"><?php echo $row['balance'] ?></p></td>
                            <?php } if(isset($_POST['Startrent'])) { ?>
                                <td class=""><p class="m-0"><?php echo $row['startrent'] ?></p></td>
                            <?php } if(isset($_POST['Endrent'])) { ?>
                                <td class=""><p class="m-0"><?php echo $row['endrent'] ?></p></td>
                            <?php } ?>
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