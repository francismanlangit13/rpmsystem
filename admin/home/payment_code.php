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
        $payment_amount = $_POST['payment_amount'];
        $payment_status = $_POST['payment_status'];
        $payment_type = 'Cash';
        $status = 'Active';

        $query = "INSERT INTO `payment`(`user_id`, `payment_type`, `payment_amount`, `payment_status`, `status`) VALUES ('$add_renter','$payment_type','$payment_amount','$payment_status','$status')";
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
        $user_id = $_POST['user_id'];
        $payment_amount = $_POST['payment_amount'];
        $payment_status = $_POST['payment_status'];

        $query = "UPDATE `payment` SET `payment_amount`='$payment_amount',`payment_status`='$payment_status' WHERE `payment_id`='$payment_id'";
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