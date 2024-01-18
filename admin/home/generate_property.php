<?php
    include ('../includes/header.php');
    $barangay = isset($_POST['Barangay']) ? $_POST['Barangay'] : '';
    $property_type_id = isset($_POST['property_type_id']) ? $_POST['property_type_id'] : '';
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
        <h1 class="mt-4 noprint">Generate Property</h1>
        <ol class="breadcrumb mb-4 mt-3 noprint">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item">Generate Property</li>
        </ol>
        <form action="generate_property.php" method="post" autocomplete="off" enctype="multipart/form-data">
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
                                <?php
                                    $stmt = "SELECT * FROM `property_type` WHERE `property_type_status` != 'Inactive'";
                                    $stmt_run = mysqli_query($con,$stmt);
                                ?>
                                <label for="property_type_id">Property Type</label>
                                <select class="form-control" id="property_type_id" name="property_type_id">
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
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="Barangay">Location</label>
                                <select class="form-control" id="Barangay" name="Barangay">
                                    <option value="">Select Location</option>
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
                    <col width="20%">
                    <col width="8%">
                    <col width="8%">
                    <col width="10%">
                    <col width="10%">
                    <col width="8%">
                    <col width="15%">
                    <col width="15%">
                    <col width="10%">
                </colgroup> -->
                <thead>
                    <tr class="bg-secondary text-light">
                        <th>No.</th>
                        <th>Property Unit Code</th>
                        <th>Address</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Landlady / Landlord</th>
                        <th>Rentee</th>
                        <th>Property Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $qry = $con->query("SELECT *, CONCAT(`fname`, ' ', `mname`, ' ', `lname`, ' ', `suffix`) AS `staff_fullname`, CONCAT('Purok ', `property_purok`, ', ', `property_barangay`, ', ', `property_city`, ' ', `property_zipcode`) AS `full_address`
                        FROM `property`
                        INNER JOIN `user` ON `user`.`user_id` = `property`.`user_id`
                        INNER JOIN `property_type` ON `property`.`property_type_id` = `property_type`.`property_type_id`
                        WHERE 1 " . 
                        ($barangay != '' ? "AND `property_barangay` LIKE '%{$barangay}%' " : "") . 
                        ($property_type_id != '' ? "AND `property`.`property_type_id` = '{$property_type_id}' " : ""));
                        while($row = $qry->fetch_assoc()):
                            $rentee_id = $row['rentee_id'];
                            $stmt = $con->query("SELECT CONCAT(`fname`, ' ', `mname`, ' ', `lname`, ' ', `suffix`) AS `rentee_fullname` FROM `user` LEFT JOIN `property` ON `property`.`rentee_id` = `user`.`user_id` WHERE `rentee_id` = '$rentee_id'");
                            $row1 = $stmt->fetch_assoc();
                    ?>
                        <tr>
                            <td class="text-center"><?= $row['property_id'] ?></td>
                            <td class="text-center"><?= $row['property_unit_code'] ?></td>
                            <td class=""><?= $row['full_address'] ?></td>
                            <td class=""><p class="m-0"><?= $row['property_type_name'] ?></p></td>
                            <td class=""><p class="m-0">₱<?= $row['property_amount']; ?></p></td>
                            <td class=""><p class="m-0"><?= $row['staff_fullname']; ?></p></td>
                            <td class=""><p class="m-0"><?= $row1['rentee_fullname']; ?></p></td>
                            <td class=""><p class="m-0"><?= $row['property_status'] ?></p></td>
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