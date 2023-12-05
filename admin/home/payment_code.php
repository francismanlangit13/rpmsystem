<?php
    if (!defined('DB_SERVER')){
        include ('../includes/authentication.php');
        $user_id = $_SESSION['auth_user']['user_id'];
        // DB connection parameters
        $host = DB_SERVER;
        $user = DB_USERNAME;
        $password = DB_PASSWORD;
        $db = DB_NAME;
        $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
        try{
           $conn = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        } catch (PDOException $e){
           echo $e->getMessage();
        }
    }

    // Add payment
    if(isset($_POST["add_payment"])){
        $add_renter = $_POST['add_renter'];
        $utilities_type_id = $_POST['pay_rent'] . $_POST['utilities_type_id'];
        $payment_amount = $_POST['payment_amount'];
        $utilities_id = $_POST['utilities_id'];
        $payment_type_id = '1';
        $payment_date = date;
        $thismonth = date('Y-m');
        $status = 'Active';
        $check_billing_sql = "SELECT * FROM `payment` WHERE user_id = '$add_renter' AND `utilities_type_id` = '$utilities_type_id' AND DATE_FORMAT(`payment_date`, '%Y-%m') = '$thismonth' AND `status` != 'Archive'";
        $check_billing_sql_run = mysqli_query($con, $check_billing_sql);

        if (mysqli_num_rows($check_billing_sql_run) > 0) {
            $_SESSION['status'] = "The selected user has already paid this month.";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/payment");
            exit(0);
        } else {
            if ($utilities_type_id == '1'){
                $stmt = "SELECT * FROM `property` WHERE rented_by = '$add_renter' AND `property_status` = 'Rented'";
                $stmt_run = mysqli_query($con,$stmt);
                if (mysqli_num_rows($stmt_run) > 0){
                    while ($renter_row = $stmt_run->fetch_assoc()) {
                        $payment_remaining = $renter_row['property_amount'] - $payment_amount;
                        break; // exit the loop after the first iteration
                    }
                } else {
                    $_SESSION['status'] = "The selected user does not have in property rented.";
                    $_SESSION['status_code'] = "error";
                    header("Location: " . base_url . "admin/home/payment");
                    exit(0);
                }
            } else {
                $stmt = "SELECT * FROM `utilities` WHERE user_id = '$add_renter' AND `utilities_type_id` = '$utilities_type_id' AND DATE_FORMAT(`utilities_date`, '%Y-%m') = '$thismonth' AND `utilities_status` != 'Archive'";
                $stmt_run = mysqli_query($con,$stmt);
                if (mysqli_num_rows($stmt_run) > 0){
                    while ($renter_row = $stmt_run->fetch_assoc()) {
                        $payment_remaining = $renter_row['utilities_amount'] - $payment_amount;
                        break; // exit the loop after the first iteration
                    }
                } else {
                    $_SESSION['status'] = "The selected user does not have in utilities payment.";
                    $_SESSION['status_code'] = "error";
                    header("Location: " . base_url . "admin/home/payment");
                    exit(0);
                }
            }
            if($payment_remaining > 0){
                $payment_status = 'Partial';
            } else {
                $payment_status = 'Paid';
            }
        }

        $query = "INSERT INTO `payment`(`user_id`, `utilities_type_id`, `payment_type_id`, `payment_amount`, `payment_remaining`, `payment_date`, `payment_status`, `status`) VALUES ('$add_renter','$utilities_type_id','$payment_type_id','$payment_amount','$payment_remaining','$payment_date','$payment_status','$status')";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Payment added successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/payment");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Payment was not added";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/payment");
            exit(0);
        }
    }

    // Edit payment
    if(isset($_POST["edit_payment"])){
        $payment_id = $_POST["payment_id"];
        $payment_amount = $_POST['payment_amount'];

        $stmt = "SELECT * FROM `payment` WHERE payment_id = '$payment_id'";
        $stmt_run = mysqli_query($con, $stmt);
        $status_row = $stmt_run->fetch_assoc();
        $add_renter = $status_row['user_id'];
        $utilities_type_id = $status_row['utilities_type_id'];

        if ($utilities_type_id == '1') {
            $stmt = "SELECT * FROM `property` WHERE rented_by = '$add_renter' AND `property_status` = 'Rented'";
            $stmt_run = mysqli_query($con,$stmt);
            if ($stmt_run){
                while ($renter_row = $stmt_run->fetch_assoc()) {
                    $payment_remaining = $renter_row['property_amount'] - $payment_amount;
                    break; // exit the loop after the first iteration
                }
            } else {
                $_SESSION['status'] = "The selected user does not have in property rented.";
                $_SESSION['status_code'] = "error";
                header("Location: " . base_url . "admin/home/payment");
                exit(0);
            }
        } else {
            $stmt = "SELECT * FROM `utilites` WHERE user_id = '$add_renter' AND `utilities_type_id` = '$utilities_type_id' AND `utilities_date` = '$thismonth'";
            $stmt_run = mysqli_query($con,$stmt);
            if ($stmt_run){
                while ($renter_row = $stmt_run->fetch_assoc()) {
                    $payment_remaining = $renter_row['utilities_amount'] - $payment_amount;
                    break; // exit the loop after the first iteration
                }
            } else {
                $_SESSION['status'] = "The selected user does not have in utilities payment.";
                $_SESSION['status_code'] = "error";
                header("Location: " . base_url . "admin/home/payment");
                exit(0);
            }
        }
        if($payment_remaining > 0){
            $payment_status = 'Partial';
        } else {
            $payment_status = 'Paid';
        }

        $query = "UPDATE `payment` SET `payment_amount`='$payment_amount',`payment_remaining`='$payment_remaining',`payment_status`='$payment_status' WHERE `payment_id`='$payment_id'";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Payment updated successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/payment");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Payment was not update";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/payment");
            exit(0);
        }
    }

    //Delete payment
    if(isset($_POST['delete_payment'])){
        $payment_id= $_POST['payment_id'];
        $query = "UPDATE `payment` SET `status` = 'Archive' WHERE payment_id = $user_id ";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Payment deleted successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/payment");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Payment was not delete";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/payment");
            exit(0);
        }
    }
?>