<?php
    include ('../includes/header.php');
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
        <h1 class="mt-4 noprint">Rentee History
            <div class="float-end">
                <button class="btn btn-sm btn-flat btn-secondary" type="button" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
            </div>
        </h1>
        <ol class="breadcrumb mb-4 mt-3 noprint">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item">Rentee History</li>
        </ol>
        <?php if(isset($_GET['id'])) {
            $renter = isset($_GET['id']) ? $_GET['id'] : '';
            $stmt = $con->query("SELECT * FROM `user` WHERE `user_id` = '$renter'");
            $stmt_result = $stmt->fetch_assoc();
        ?>

            <h3 class="text-center mt-5">Full history rentee (<?= $stmt_result['fname'] .' '. $stmt_result['mname'] .' '. $stmt_result['lname'] .' '. $stmt_result['suffix']?>)</h3>
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
                        <th>Renter</th>
                        <th>Date Payment</th>
                        <th>Payment Type</th>
                        <th>Bill Type</th>
                        <th>Amount</th>
                        <th>Balance</th>
                        <th>Payment Reference No.</th>
                        <th>Payment Status</th>
                        <th>Remarks</th>
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
                            WHERE 1 " . 
                            ($renter != '' ? "AND user.user_id = '{$renter}'" : "") . 
                            " ORDER BY UNIX_TIMESTAMP(payment_date) ASC
                        ");                    
                        while($row = $qry->fetch_assoc()):
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $row['payment_id'] ?></td>
                            <td class=""><p class="m-0"><?php echo $row['fname'] ?> <?php echo $row['mname'] ?> <?php echo $row['lname'] ?> <?php echo $row['suffix'] ?></p></td>
                            <td class=""><?php echo $row['new_payment_date'] ?></td>
                            <td class=""><p class="m-0"><?php echo $row['payment_type_name'] ?></p></td>
                            <td class=""><p class="m-0"><?php echo $row['utility_type_name'] ?></p></td>
                            <td class=""><p class="m-0"><?php echo $row['payment_amount'] ?></p></td>
                            <td class=""><p class="m-0"><?php echo $row['payment_remaining'] ?></p></td>
                            <td class=""><p class="m-0"><?php echo $row['payment_reference'] ?></p></td>
                            <td class=""><p class="m-0"><?php echo $row['payment_status'] ?></p></td>
                            <td class=""><p class="m-0"><?php echo $row['remarks'] ?></p></td>
                        </tr>
                    <?php endwhile; ?>
                    <?php if($qry->num_rows <= 0): ?>
                        <tr>
                            <th class="py-1 text-center" colspan="15">No Data.</th>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php } else { echo "No records found"; } ?>
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