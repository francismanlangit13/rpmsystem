<?php include ('../includes/header.php'); ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Hi, <?= $renter_fullname = $_SESSION['auth_user']['user_name'];?></h1>
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
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-bell me-1"></i>
                        Message Center
                    </div>
                    <div class="alert alert-info alert-dismissible fade show m-1" role="alert">
                        <strong>Attention! </strong> When making online payments, please ensure only one transaction per bill. Attach your reference number and select your desired type of bills. Thank you for your cooperation.
                    </div>
                    <?php
                        $get_sql = $con->query("SELECT * FROM `user` WHERE user_id = '$userID'");
                        $get_user = $get_sql->fetch_assoc();
                        if($get_user['balance'] <= 0){
                    ?>
                    <div class="alert alert-success alert-dismissible fade show m-1" role="alert">
                        <strong>Attention! </strong> Great! you have no outstanding balance as of <b><?php echo date('F j, Y') ?></b>.
                    </div>
                    <?php } else { ?>
                    <div class="alert alert-danger alert-dismissible fade show m-1" role="alert">
                        <strong>Attention! </strong> Dear user, your outstanding balance is ₱<?=$get_user['balance']?>. Please settle your bills as soon as possible Thank you.
                    </div>
                    <?php }
                        $check_rent_amount = mysqli_query($con, "SELECT * FROM utility WHERE user_id = '$userID' AND `utility_type_id` = '1'");
                        $thismonth = date('Y-m');
                        $check_sql = mysqli_query($con, "SELECT * FROM payment WHERE user_id = '$userID' AND DATE_FORMAT(`payment_date`, '%Y-%m') = '$thismonth' AND `payment_status` NOT IN ('Reject') AND `status` != 'Archive'");
                        $check_status = $check_sql->fetch_assoc();

                        $check_rent_sql = mysqli_query($con, "SELECT * FROM payment WHERE user_id = '$userID' AND `utility_type_id` = '1' AND DATE_FORMAT(`payment_date`, '%Y-%m') = '$thismonth' AND `status` != 'Archive'");
                        $check_rent_status = $check_rent_sql->fetch_assoc();
                        
                        if(!$check_status){
                    ?>
                    
                    <?php while ($results_row = $check_rent_amount->fetch_assoc()) { ?>
                        <div class="alert alert-warning alert-dismissible fade show m-1" role="alert">
                            <strong><?= date('F') .' 01, '. date('Y'); ?></strong> You have bill for <b>rent</b> amount ₱<?= $results_row['utility_amount']; ?> in this month please pay.
                        </div>
                    <?php break; } } ?>
                    <?php
                        $query = "SELECT *, DATE_FORMAT(utility_date, '%M %d, %Y') as new_utility_date
                            FROM `utility`
                            INNER JOIN utility_type ON utility_type.utility_type_id = utility.utility_type_id
                            WHERE utility.user_id = '$userID' AND `utility_status` != 'Archive'
                        ";
                    
                        $query_run = mysqli_query($con, $query);
                        if(mysqli_num_rows($query_run) > 0){
                            foreach($query_run as $row){
                                if($row['is_payment_made'] == '0') {
                    ?>
                    <div class="alert alert-warning alert-dismissible fade show m-1" role="alert">
                        <strong><?= $row['new_utility_date']; ?></strong> You have bill for <b><?= strtolower($row['utility_type_name']); ?></b> amount ₱<?= $row['utility_amount']; ?> in this month please pay.
                    </div>
                    <?php } elseif($row['is_payment_made'] == '1') { ?>
                        <div class="alert alert-success alert-dismissible fade show m-1" role="alert">
                            Thank you for your payment for <b><?= $row['utility_type_name']; ?></b>. It is currently being processed, and you will be notified through SMS once the payment is complete.
                        </div>
                    <?php } elseif($row['is_payment_made'] == '2') { } else { ?>
                        <div class="alert alert-danger alert-dismissible fade show m-1" role="alert">
                            Your payment for <b><?= $row['utility_type_name']; ?></b>. Was rejected please see on the <a href="payment">payments</a>.
                        </div>
                    <?php } } } ?>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fab fa-paypal me-1"></i>
                        Payment Method List
                    </div>
                    <div class="row m-1">
                        <?php
                            $query_run = mysqli_query($con, "SELECT * FROM payment_type WHERE payment_type_id != '1' AND payment_type_status = 'Active'");
                            if(mysqli_num_rows($query_run) > 0){
                                foreach($query_run as $row){
                        ?>
                        <div class="col-md-3">
                            <div class="card h-100 text-center">
                                <img class="img-fluid card-img-top mx-auto" src="<?php echo base_url ?>assets/files/online_payment/<?= $row['payment_type_attachment']; ?>" alt="user-avatar" style="width: 60%; object-fit: cover;">
                                <div class="card-body">
                                    <h3 class="card-title" style="font-size: 22px;"><?= $row['payment_type_name']; ?></h3>
                                    <p class="card-text">Account #: <?= $row['payment_type_account_number']; ?></p>
                                </div>
                            </div>
                        </div>
                        <?php } } else { echo "No Payment Method List"; } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include ('../includes/bottom.php'); ?>