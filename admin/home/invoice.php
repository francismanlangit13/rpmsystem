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
    }
</style>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 noprint">Notification</h1>
        <ol class="breadcrumb mb-4 mt-3 noprint">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item">Notification</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="container">
                        <?php if(isset($_POST['rentee_id'])){ ?>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="text-center">
                                        <div style="text-align: center;">
                                            <img class="img-responsive" src="<?php echo base_url ?>assets/files/system/system_logo.jpg" alt="System Logo" width="20%" height="20%">
                                        </div>
                                        <h2>Breakdown Invoice of Month of <?php echo date('F Y'); ?></h2>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6 col-lg-6 pull-left">
                                            <div class="panel panel-default height">
                                                <div class="panel-heading">Billing Details</div>
                                                <div class="panel-body">
                                                    <strong>Rentee:</strong><br>
                                                    <strong>Phone:</strong><br>
                                                    <strong>Address:</strong><br>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-6 col-lg-6">
                                            <div class="panel panel-default height">
                                                <div class="panel-heading">Property Information</div>
                                                <div class="panel-body">
                                                    <strong>Unit Code:</strong> Visa<br>
                                                    <strong>Property Permit:</strong> ***** 332<br>
                                                    <strong>Property Location:</strong> 09/2020<br>
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
                                                    <tbody>
                                                        <tr>
                                                            <td>Rent</td>
                                                            <td class="emptyrow"></td>
                                                            <td class="emptyrow"></td>
                                                            <td class="text-right">₱5000.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Water</td>
                                                            <td class="emptyrow"></td>
                                                            <td class="emptyrow"></td>
                                                            <td class="text-right">₱51.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Electicity</td>
                                                            <td class="emptyrow"></td>
                                                            <td class="emptyrow"></td>
                                                            <td class="text-right">₱328.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="highrow"></td>
                                                            <td class="highrow"></td>
                                                            <td class="highrow text-right"><strong>Total</strong></td>
                                                            <td class="highrow text-right">₱5,379.00</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } else { } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include ('../includes/bottom.php'); ?>