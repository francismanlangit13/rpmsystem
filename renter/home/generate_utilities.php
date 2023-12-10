<?php
    include ('../includes/header.php');
    $from = isset($_POST['from']) ? $_POST['from'] : date("Y-m-d",strtotime(date("Y-m-d"))); 
    $to = isset($_POST['to']) ? $_POST['to'] : date("Y-m-d",strtotime(date("Y-m-d"))); 
    function duration($dur = 0){
        if($dur == 0){
            return "00:00";
        }
        $hours = floor($dur / (60 * 60));
        $min = floor($dur / (60)) - ($hours*60);
        $dur = sprintf("%'.02d",$hours).":".sprintf("%'.02d",$min);
        return $dur;
    }
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
        <h1 class="mt-4 noprint">Generate Utilities</h1>
        <ol class="breadcrumb mb-4 mt-3 noprint">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item">Generate Utilities</li>
        </ol>
        <form action="generate_utilities.php" method="post" autocomplete="off" enctype="multipart/form-data">
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
                            <div class="col-md-4 mb-3">
                                <?php
                                    $stmt = "SELECT * FROM `utilities_type` WHERE `utilities_type_id` != '1' AND `utilities_type_status` != 'Archive'";
                                    $stmt_run = mysqli_query($con,$stmt);
                                ?>
                                <label for="utilities_type" class="required">Utilities Type</label>
                                <select class="form-control" id="utilities_type" name="utilities_type">
                                    <option value="">Select Utilities Type</option>
                                    <?php
                                        // use a while loop to fetch data
                                        while ($utilities_type = mysqli_fetch_array($stmt_run,MYSQLI_ASSOC)):;
                                    ?>
                                        <option value="<?= $utilities_type["utilities_type_id"]; ?>"><?= $utilities_type["utilities_type_name"]; ?></option>
                                    <?php
                                        endwhile; // While loop must be terminated
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="from" class="control-label">Date From</label>
                                <input type="date" name="from" id="from" value="<?= $from ?>" class="form-control form-control-sm rounded-0">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="to" class="control-label">Date To</label>
                                <input type="date" name="to" id="to" value="<?= $to ?>" class="form-control form-control-sm rounded-0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(isset($_POST['submit-btn'])) { ?>
            <h3 class="text-center mt-5">Rental Properties Management System</h3>
            <table class="table text-center table-hover table-striped mt-1 print-table-adjust">
                <colgroup>
                    <col width="5%">
                    <col width="30%">
                    <col width="30%">
                    <col width="15%">
                    <col width="20%">
                </colgroup>
                <thead>
                    <tr class="bg-secondary text-light">
                        <th>No.</th>
                        <th>Renter</th>
                        <th>Utilities Type</th>
                        <th>Amount</th>
                        <th>Date added Utilities</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $renter = $user_id;
                        $type = isset($_POST['utilities_type']) ? $_POST['utilities_type'] : '';
                        
                        $qry = $con->query("SELECT *,
                            DATE_FORMAT(utilities_date, '%m-%d-%Y') as new_utilities_date
                            FROM utilities 
                            INNER JOIN `user` ON user.user_id = utilities.user_id
                            INNER JOIN `utilities_type` ON utilities_type.utilities_type_id = utilities.utilities_type_id
                            WHERE DATE(utilities_date) BETWEEN '{$from}' AND '{$to}' " . 
                            ($renter != '' ? "AND user.user_id = '{$renter}' " : "") . 
                            ($type != '' ? "AND utilities.utilities_type_id = '{$type}' " : "") . "
                            ORDER BY UNIX_TIMESTAMP(utilities_date) ASC
                        ");                        
                        while($row = $qry->fetch_assoc()):
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $row['utilities_id'] ?></td>
                            <td class=""><p class="m-0"><?php echo $row['fname'] ?> <?php echo $row['mname'] ?> <?php echo $row['lname'] ?> <?php echo $row['suffix'] ?></p></td>
                            <td class=""><p class="m-0"><?php echo $row['utilities_type_name'] ?></p></td>
                            <td class=""><p class="m-0"><?php echo $row['utilities_amount'] ?></p></td>
                            <td class=""><p class="m-0"><?php echo $row['new_utilities_date'] ?></p></td>
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