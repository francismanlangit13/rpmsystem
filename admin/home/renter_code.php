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
    if(isset($_POST["add_renter"])){
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $pass = $_POST['password'];
        //$new_password = substr(md5(microtime()),rand(0,26),9);
        $password = md5($pass);
        $status = 'Active';
        $type = 'Renter';

        $query = "INSERT INTO `user`(`fname`, `mname`, `lname`, `gender`, `email`, `phone`, `password`, `status`, `type`) VALUES ('$fname','$mname','$lname','$gender','$email','$phone','$password','$status','$type')";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Renter added successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/renter");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Renter was not added";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/renter");
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