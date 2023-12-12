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
        $renter = $_POST['renter'];
        $utilities_type_id = $_POST['utilities_type_id'];
        $payment_type_id = $_POST['payment_type_id'];
        $payment_reference = $_POST['payment_reference'];
        $payment_amount = $_POST['payment_amount'];
        $payment_date = date;
        $thismonth = date('Y-m');
        $status = 'Active';
        $payment_status = 'Pending';

        $check_billing_sql = "SELECT * FROM `payment` WHERE user_id = '$renter' AND `utilities_type_id` = '$utilities_type_id' AND DATE_FORMAT(`payment_date`, '%Y-%m') = '$thismonth' AND `status` != 'Archive'";
        $check_billing_sql_run = mysqli_query($con, $check_billing_sql);

        if (mysqli_num_rows($check_billing_sql_run) > 0) {
            $_SESSION['status'] = "You already paid this month.";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "renter/home/payment");
            exit(0);
        } else {
            if($utilities_type_id == '1'){
                $query_run = mysqli_query($con, "INSERT INTO `payment`(`user_id`, `utilities_type_id`, `payment_type_id`, `payment_amount`, `payment_reference`, `payment_date`, `payment_status`, `status`) VALUES ('$renter','$utilities_type_id','$payment_type_id','$payment_amount','$payment_reference','$payment_date','$payment_status','$status')");

                if($query_run){
                    $_SESSION['status'] = "Payment added successfully";
                    $_SESSION['status_code'] = "success";
                    header("Location: " . base_url . "renter/home/payment");
                    exit(0);
                }
                else{
                    $_SESSION['status'] = "Payment was not added";
                    $_SESSION['status_code'] = "error";
                    header("Location: " . base_url . "renter/home/payment");
                    exit(0);
                }
            } else {
                // Getting the data from utilities_type
                $check_billing_type = mysqli_query($con, "SELECT * FROM `utilities_type` WHERE `utilities_type_id` = '$utilities_type_id'");
                $billing_type = $check_billing_type->fetch_assoc();
                $bill = strtolower($billing_type['utilities_type_name']);

                $stmt_run2 = mysqli_query($con, "SELECT * FROM `utilities` WHERE user_id = '$renter' AND `utilities_type_id` = '$utilities_type_id' AND DATE_FORMAT(`utilities_date`, '%Y-%m') = '$thismonth' AND `utilities_status` != 'Archive'");
                if (mysqli_num_rows($stmt_run2) > 0){
                    $query_run_update = mysqli_query($con, "UPDATE `utilities` SET `is_payment_made` = '1' WHERE `user_id` = '$renter' AND `utilities_type_id` = '$utilities_type_id'");
                    $query_run = mysqli_query($con, "INSERT INTO `payment`(`user_id`, `utilities_type_id`, `payment_type_id`, `payment_amount`, `payment_reference`, `payment_date`, `payment_status`, `status`) VALUES ('$renter','$utilities_type_id','$payment_type_id','$payment_amount','$payment_reference','$payment_date','$payment_status','$status')");

                    if($query_run){
                        $_SESSION['status'] = "Payment added successfully";
                        $_SESSION['status_code'] = "success";
                        header("Location: " . base_url . "renter/home/payment");
                        exit(0);
                    }
                    else{
                        $_SESSION['status'] = "Payment was not added";
                        $_SESSION['status_code'] = "error";
                        header("Location: " . base_url . "renter/home/payment");
                        exit(0);
                    }
                } else {
                    $_SESSION['status'] = "You have not have billing in $bill.";
                    $_SESSION['status_code'] = "error";
                    header("Location: " . base_url . "renter/home/payment");
                    exit(0);
                }
            }
        }
    }

    //Delete payment
    if(isset($_POST['delete_payment'])){
        $payment_id= $_POST['payment_id'];

        // Getting the data from utilities
        $get_bill_type = mysqli_query($con, "SELECT * FROM `payment` INNER JOIN `utilities` ON utilities.user_id = payment.user_id WHERE `payment`.`user_id` = '$user_id'");
        $billing_type = $get_bill_type->fetch_assoc();
        $bill_id = $billing_type['utilities_type_id'];

        $query = "DELETE FROM `payment` WHERE `payment_id` = '$payment_id'";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $update_status = mysqli_query($con, "UPDATE `utilities` SET `is_payment_made` = '0' WHERE `user_id` = '$user_id' AND `utilities_type_id` = '$bill_id'");

            $_SESSION['status'] = "Payment deleted successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "renter/home/payment");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Payment was not delete";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "renter/home/payment");
            exit(0);
        }
    }
?>