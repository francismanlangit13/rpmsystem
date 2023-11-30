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
    if(isset($_POST["add_payment_type"])){
        $payment_type_name = $_POST['payment_type_name'];
        $status = 'Active';

        $query = "INSERT INTO `payment_type`(`payment_type_name`, `payment_type_status`) VALUES ('$payment_type_name','$status')";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Payment Type added successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/payment_type");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Payment Type was not added";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/payment_type");
            exit(0);
        }
    }

    // Edit payment
    if(isset($_POST["edit_payment_type"])){
        $payment_type_id = $_POST["payment_type_id"];
        $payment_type_name = $_POST['payment_type_name'];

        $query = "UPDATE `payment_type` SET `payment_type_name`='$payment_type_name' WHERE `payment_type_id`='$payment_type_id'";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Payment Type updated successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/payment_type");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Payment Type was not update";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/payment_type");
            exit(0);
        }
    }

    //Delete payment
    if(isset($_POST['delete_payment_type'])){
        $payment_type_id= $_POST['payment_type_id'];
        $query = "UPDATE `payment_type` SET `payment_type_status` = 'Archive' WHERE payment_type_id = $payment_type_id ";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Payment Type deleted successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/payment_type");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Payment Type was not delete";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/payment_type");
            exit(0);
        } 
    }
?>