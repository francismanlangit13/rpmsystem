<?php include ('../includes/header.php'); ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-12 col-md-6">
                <div style="text-align: center;">
                    <img class="img-responsive" src="<?php echo base_url ?>assets/files/system/system_logo.jpg" alt="System Logo" width="20%" height="20%">
                </div>
            </div>
        </div>
        <!-- <div class="row">
            <?php
                $total_query = $con->query("SELECT (SELECT COUNT(*) FROM `property`) as total_property, SUM(CASE WHEN type = 'Admin' THEN 1 ELSE 0 END) as total_admin, SUM(CASE WHEN type = 'Staff' THEN 1 ELSE 0 END) as total_staff, SUM(CASE WHEN type = 'Renter' THEN 1 ELSE 0 END) as total_renter FROM user");
                $total_count = $total_query->fetch_assoc();
            ?>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Total Admin<span class="float-end"><?php echo $total_count['total_admin']; ?></span></div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link text-decoration-none" href="user">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Total Staff <span class="float-end"><?php echo $total_count['total_staff']; ?></span></div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link text-decoration-none" href="user">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Total Renters <span class="float-end"><?php echo $total_count['total_renter']; ?></span></div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link text-decoration-none" href="renter">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Total Property <span class="float-end"><?php echo $total_count['total_property']; ?></span></div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link text-decoration-none" href="property">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-pie me-1"></i>
                        Overall (Annual)
                    </div>
                    <div class="chart-pie mb-4"><canvas id="myPieChart" width="100%" height="20"></canvas></div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Gross Income (Monthly)
                    </div>
                    <div class="card-body"><canvas id="gross_expected" width="100%" height="40"></canvas></div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Payment Recieved (Monthly)
                    </div>
                    <div class="card-body"><canvas id="payment_recieved" width="100%" height="40"></canvas></div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Arrears (Monthly)
                    </div>
                    <div class="card-body"><canvas id="payment_arrears" width="100%" height="40"></canvas></div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include ('../includes/bottom.php'); ?>
<script src="<?php echo base_url ?>assets/demo/chart-bar-demo.js"></script>
<script src="<?php echo base_url ?>assets/demo/chart-pie-demo.js"></script>

<!-- Gross Income SQL and script -->
<?php
    $jan_sql_gross = "SELECT SUM(property_amount) AS total_amount FROM `property`";
    $total_amoun_gross = mysqli_fetch_assoc(mysqli_query($con, $jan_sql_gross))['total_amount'] ?? 0;
?>

<script>
    // Bar Chart Example
    var ctx = document.getElementById("gross_expected");
    var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            datasets: [{
                label: "Revenue",
                backgroundColor: "rgba(2,117,216,1)",
                borderColor: "rgba(2,117,216,1)",
                data: [<?=$total_amoun_gross?>, <?=$total_amoun_gross?>, <?=$total_amoun_gross?>, <?=$total_amoun_gross?>, <?=$total_amoun_gross?>, <?=$total_amoun_gross?>, <?=$total_amoun_gross?>, <?=$total_amoun_gross?>, <?=$total_amoun_gross?>, <?=$total_amoun_gross?>, <?=$total_amoun_gross?>, <?=$total_amoun_gross?>],
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    time: {
                        unit: 'month'
                    },
                    gridLines: {
                        display: true
                    },
                    ticks: {
                        maxTicksLimit: 12
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        //max: 15000,
                        maxTicksLimit: 10
                    },
                    gridLines: {
                        display: true
                    }
                }],
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        var label = data.datasets[tooltipItem.datasetIndex].label || '';

                        if (label) {
                            label += ': ₱' + tooltipItem.yLabel.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                        }

                        return label;
                    }
                }
            },
            legend: {
                display: false
            }
        }
    });
</script>

<!-- Payment Receive SQL and script -->
<?php
    $jan_sql = "SELECT SUM(payment_amount) AS total_amount_jan FROM `payment` WHERE DATE_FORMAT(payment_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-01-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-01-01'))";
    $jan_total_amount = mysqli_fetch_assoc(mysqli_query($con, $jan_sql))['total_amount_jan'] ?? 0;

    $feb_sql = "SELECT SUM(payment_amount) AS total_amount_feb FROM `payment` WHERE DATE_FORMAT(payment_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-02-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-02-01'))";
    $feb_total_amount = mysqli_fetch_assoc(mysqli_query($con, $feb_sql))['total_amount_feb'] ?? 0;

    $mar_sql = "SELECT SUM(payment_amount) AS total_amount_mar FROM `payment` WHERE DATE_FORMAT(payment_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-03-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-03-01'))";
    $mar_total_amount = mysqli_fetch_assoc(mysqli_query($con, $mar_sql))['total_amount_mar'] ?? 0;

    $apr_sql = "SELECT SUM(payment_amount) AS total_amount_apr FROM `payment` WHERE DATE_FORMAT(payment_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-04-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-04-01'))";
    $apr_total_amount = mysqli_fetch_assoc(mysqli_query($con, $apr_sql))['total_amount_apr'] ?? 0;

    $may_sql = "SELECT SUM(payment_amount) AS total_amount_may FROM `payment` WHERE DATE_FORMAT(payment_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-05-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-05-01'))";
    $may_total_amount = mysqli_fetch_assoc(mysqli_query($con, $may_sql))['total_amount_may'] ?? 0;

    $jun_sql = "SELECT SUM(payment_amount) AS total_amount_jun FROM `payment` WHERE DATE_FORMAT(payment_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-06-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-06-01'))";
    $jun_total_amount = mysqli_fetch_assoc(mysqli_query($con, $jun_sql))['total_amount_jun'] ?? 0;

    $jul_sql = "SELECT SUM(payment_amount) AS total_amount_jul FROM `payment` WHERE DATE_FORMAT(payment_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-07-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-07-01'))";
    $jul_total_amount = mysqli_fetch_assoc(mysqli_query($con, $jul_sql))['total_amount_jul'] ?? 0;

    $aug_sql = "SELECT SUM(payment_amount) AS total_amount_aug FROM `payment` WHERE DATE_FORMAT(payment_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-08-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-08-01'))";
    $aug_total_amount = mysqli_fetch_assoc(mysqli_query($con, $aug_sql))['total_amount_aug'] ?? 0;

    $sep_sql = "SELECT SUM(payment_amount) AS total_amount_sep FROM `payment` WHERE DATE_FORMAT(payment_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-09-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-09-01'))";
    $sep_total_amount = mysqli_fetch_assoc(mysqli_query($con, $sep_sql))['total_amount_sep'] ?? 0;

    $oct_sql = "SELECT SUM(payment_amount) AS total_amount_oct FROM `payment` WHERE DATE_FORMAT(payment_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-10-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-10-01'))";
    $oct_total_amount = mysqli_fetch_assoc(mysqli_query($con, $oct_sql))['total_amount_oct'] ?? 0;

    $nov_sql = "SELECT SUM(payment_amount) AS total_amount_nov FROM `payment` WHERE DATE_FORMAT(payment_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-11-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-11-01'))";
    $nov_total_amount = mysqli_fetch_assoc(mysqli_query($con, $nov_sql))['total_amount_nov'] ?? 0;

    $dec_sql = "SELECT SUM(payment_amount) AS total_amount_dec FROM `payment` WHERE DATE_FORMAT(payment_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-12-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-12-01'))";
    $dec_total_amount = mysqli_fetch_assoc(mysqli_query($con, $dec_sql))['total_amount_dec'] ?? 0;
?>

<script>
    // Bar Chart Example
    var ctx = document.getElementById("payment_recieved");
    var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            datasets: [{
                label: "Revenue",
                backgroundColor: "rgba(2,117,216,1)",
                borderColor: "rgba(2,117,216,1)",
                data: [<?=$jan_total_amount?>, <?=$feb_total_amount?>, <?=$mar_total_amount?>, <?=$apr_total_amount?>, <?=$may_total_amount?>, <?=$jun_total_amount?>, <?=$jul_total_amount?>, <?=$aug_total_amount?>, <?=$sep_total_amount?>, <?=$oct_total_amount?>, <?=$nov_total_amount?>, <?=$dec_total_amount?>],
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    time: {
                        unit: 'month'
                    },
                    gridLines: {
                        display: true
                    },
                    ticks: {
                        maxTicksLimit: 12
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        //max: 15000,
                        maxTicksLimit: 10
                    },
                    gridLines: {
                        display: true
                    }
                }],
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        var label = data.datasets[tooltipItem.datasetIndex].label || '';

                        if (label) {
                            label += ': ₱' + tooltipItem.yLabel.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                        }

                        return label;
                    }
                }
            },
            legend: {
                display: false
            }
        }
    });
</script>

<!-- Arrears SQL and script -->
<?php
    $jan_sql_arrears = "SELECT SUM(payment_remaining) AS total_amount_jan FROM `payment` WHERE DATE_FORMAT(payment_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-01-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-01-01'))";
    $jan_total_amount_arrears = mysqli_fetch_assoc(mysqli_query($con, $jan_sql_arrears))['total_amount_jan'] ?? 0;

    $feb_sql_arrears = "SELECT SUM(payment_remaining) AS total_amount_feb FROM `payment` WHERE DATE_FORMAT(payment_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-02-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-02-01'))";
    $feb_total_amount_arrears = mysqli_fetch_assoc(mysqli_query($con, $feb_sql_arrears))['total_amount_feb'] ?? 0;

    $mar_sql_arrears = "SELECT SUM(payment_remaining) AS total_amount_mar FROM `payment` WHERE DATE_FORMAT(payment_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-03-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-03-01'))";
    $mar_total_amount_arrears = mysqli_fetch_assoc(mysqli_query($con, $mar_sql_arrears))['total_amount_mar'] ?? 0;

    $apr_sql_arrears = "SELECT SUM(payment_remaining) AS total_amount_apr FROM `payment` WHERE DATE_FORMAT(payment_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-04-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-04-01'))";
    $apr_total_amount_arrears = mysqli_fetch_assoc(mysqli_query($con, $apr_sql_arrears))['total_amount_apr'] ?? 0;

    $may_sql_arrears = "SELECT SUM(payment_remaining) AS total_amount_may FROM `payment` WHERE DATE_FORMAT(payment_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-05-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-05-01'))";
    $may_total_amount_arrears = mysqli_fetch_assoc(mysqli_query($con, $may_sql_arrears))['total_amount_may'] ?? 0;

    $jun_sql_arrears = "SELECT SUM(payment_remaining) AS total_amount_jun FROM `payment` WHERE DATE_FORMAT(payment_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-06-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-06-01'))";
    $jun_total_amount_arrears = mysqli_fetch_assoc(mysqli_query($con, $jun_sql_arrears))['total_amount_jun'] ?? 0;

    $jul_sql_arrears = "SELECT SUM(payment_remaining) AS total_amount_jul FROM `payment` WHERE DATE_FORMAT(payment_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-07-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-07-01'))";
    $jul_total_amount_arrears = mysqli_fetch_assoc(mysqli_query($con, $jul_sql_arrears))['total_amount_jul'] ?? 0;

    $aug_sql_arrears = "SELECT SUM(payment_remaining) AS total_amount_aug FROM `payment` WHERE DATE_FORMAT(payment_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-08-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-08-01'))";
    $aug_total_amount_arrears = mysqli_fetch_assoc(mysqli_query($con, $aug_sql_arrears))['total_amount_aug'] ?? 0;

    $sep_sql_arrears = "SELECT SUM(payment_remaining) AS total_amount_sep FROM `payment` WHERE DATE_FORMAT(payment_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-09-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-09-01'))";
    $sep_total_amount_arrears = mysqli_fetch_assoc(mysqli_query($con, $sep_sql_arrears))['total_amount_sep'] ?? 0;

    $oct_sql_arrears = "SELECT SUM(payment_remaining) AS total_amount_oct FROM `payment` WHERE DATE_FORMAT(payment_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-10-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-10-01'))";
    $oct_total_amount_arrears = mysqli_fetch_assoc(mysqli_query($con, $oct_sql_arrears))['total_amount_oct'] ?? 0;

    $nov_sql_arrears = "SELECT SUM(payment_remaining) AS total_amount_nov FROM `payment` WHERE DATE_FORMAT(payment_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-11-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-11-01'))";
    $nov_total_amount_arrears = mysqli_fetch_assoc(mysqli_query($con, $nov_sql_arrears))['total_amount_nov'] ?? 0;

    $dec_sql_arrears = "SELECT SUM(payment_remaining) AS total_amount_dec FROM `payment` WHERE DATE_FORMAT(payment_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-12-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-12-01'))";
    $dec_total_amount_arrears = mysqli_fetch_assoc(mysqli_query($con, $dec_sql_arrears))['total_amount_dec'] ?? 0;
?>

<script>
    // Bar Chart Example
    var ctx = document.getElementById("payment_arrears");
    var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            datasets: [{
                label: "Unpaid",
                backgroundColor: "rgba(2,117,216,1)",
                borderColor: "rgba(2,117,216,1)",
                data: [<?=$jan_total_amount_arrears?>, <?=$feb_total_amount_arrears?>, <?=$mar_total_amount_arrears?>, <?=$apr_total_amount_arrears?>, <?=$may_total_amount_arrears?>, <?=$jun_total_amount_arrears?>, <?=$jul_total_amount_arrears?>, <?=$aug_total_amount_arrears?>, <?=$sep_total_amount_arrears?>, <?=$oct_total_amount_arrears?>, <?=$nov_total_amount_arrears?>, <?=$dec_total_amount_arrears?>],
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    time: {
                        unit: 'month'
                    },
                    gridLines: {
                        display: true
                    },
                    ticks: {
                        maxTicksLimit: 12
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        //max: 15000,
                        maxTicksLimit: 10
                    },
                    gridLines: {
                        display: true
                    }
                }],
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        var label = data.datasets[tooltipItem.datasetIndex].label || '';

                        if (label) {
                            label += ': ₱' + tooltipItem.yLabel.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                        }

                        return label;
                    }
                }
            },
            legend: {
                display: false
            }
        }
    });
</script>

<!-- Overall Pie Chart SQL and script -->
<?php
    $total_sql_payment_received = "SELECT SUM(payment_amount) AS total_amount FROM `payment` WHERE `utilities_type_id` = '1' AND DATE_FORMAT(payment_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-01-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-12-01')) AND `status` != 'Archive'";
    $total_sql_payment_received_results = mysqli_fetch_assoc(mysqli_query($con, $total_sql_payment_received))['total_amount'] ?? 0;

    $total_sql_arrears = "SELECT SUM(payment_remaining) AS total_amount FROM `payment` WHERE `utilities_type_id` = '1' AND DATE_FORMAT(payment_date, '%Y-%m-%d') BETWEEN CONCAT(YEAR(CURDATE()), '-01-01') AND LAST_DAY(CONCAT(YEAR(CURDATE()), '-12-01')) AND `status` != 'Archive'";
    $total_sql_arrears_results = mysqli_fetch_assoc(mysqli_query($con, $total_sql_arrears))['total_amount'] ?? 0;

    if ($total_sql_payment_received_results == '0.00') {
        $new_total_sql_payment_received_results = '1';
    } else {
        $new_total_sql_payment_received_results = $total_sql_payment_received_results;
    }
    if ($total_sql_arrears_results == '0.00') {
        $new_total_sql_arrears_results = '1';
    } else {
        $new_total_sql_arrears_results = $total_sql_arrears_results;
    }

    // Calculate percentages
    $payment_receive_percentage = ($new_total_sql_payment_received_results / $new_total_sql_arrears_results) * 100;
    $arrears_percentage = ($new_total_sql_arrears_results / $new_total_sql_payment_received_results) * 100;
?>

<script>
    // Pie Chart Example
    var ctx = document.getElementById("myPieChart");
    var dataValues = [<?=$payment_receive_percentage?>, <?=$arrears_percentage?>]; // Set the values to add up to 100
    var total = dataValues.reduce(function (previousValue, currentValue) {
        return previousValue + currentValue;
    });
    
    var percentages = dataValues.map(function (value) {
        return parseFloat((value / total * 100).toFixed(2));
    });

    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ["Solid Circle"],
            datasets: [{
                data: dataValues,
                backgroundColor: ['#007bff', '#ffffff'], // Use colors for each portion of the pie
            }],
        },
        options: {
            legend: {
                display: false
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var currentValue = dataset.data[tooltipItem.index];
                        var percentage = parseFloat((currentValue / total * 100).toFixed(2));
                        return percentage + '%';
                    }
                }
            },
            title: {
                display: true,
                text: percentages[0] + '%', // Display the calculated total percentage for the first value
                position: 'top', // Center the title at the top of the pie chart
                y: 0.5, // Adjust the y property to center the title
                fontSize: 25 // Adjust the font size as needed
            }
        }
    });
</script>