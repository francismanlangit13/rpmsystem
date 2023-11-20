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

    // Add renter account
    if(isset($_POST["add_properties"])){
        $add_staff = $_POST['add_staff'];
        $add_renter = $_POST['add_renter'];
        $property_name = $_POST['property_name'];
        $property_location = $_POST['property_location'];
        $property_cost = $_POST['property_cost'];
        $property_status = $_POST['property_status'];

        $query = "INSERT INTO `property` (`user_id`, `rented_by`, `property_name`, `location_id`, `property_cost`, `property_status`) VALUES ('$add_staff','$add_renter','$property_name','$property_location','$property_cost','$property_status')";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Properties added successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/properties");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Properties was not added";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/properties");
            exit(0);
        }
    }

    // Edit renter account
    if(isset($_POST["edit_renter"])){
        $user_id = $_POST["user_id"];
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $status = $_POST['status'];

        $query = "UPDATE `user` SET `fname`='$fname',`mname`='$mname',`lname`='$lname',`gender`='$gender',`email`='$email',`phone`='$phone',`status`='$status' WHERE `user_id`='$user_id'";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Renter updated successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/renter");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Renter was not update";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/renter");
            exit(0);
        }
    }

    //Delete renter
    if(isset($_POST['delete_renter'])){
        $user_id= $_POST['user_id'];
        $query = "UPDATE `user` SET `status` = 'Archive' WHERE user_id = $user_id ";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Renter deleted successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/renter");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Renter was not delete";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/renter");
            exit(0);
        } 
    }
?>