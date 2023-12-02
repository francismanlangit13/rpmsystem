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

    // Add utilities
    if(isset($_POST["add_utilities"])){
        $renter = $_POST['renter'];
        $utilities_type_id = $_POST['utilities_type_id'];
        $utilities_amount = $_POST['utilities_amount'];
        $utilities_date = date;
        $utilities_status = 'Active';

        $query = "INSERT INTO `utilities`(`user_id`, `utilities_type_id`, `utilities_amount`, `utilities_date`, `utilities_status`) VALUES ('$renter','$utilities_type_id','$utilities_amount','$utilities_date','$utilities_status')";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Utilities added successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/utilities");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Utilities was not added";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/utilities");
            exit(0);
        }
    }

    // Edit utilities
    if(isset($_POST["edit_utilities"])){
        $utilities_id = $_POST['utilities_id'];
        $renter = $_POST['renter'];
        $utilities_type_id = $_POST['utilities_type_id'];
        $utilities_amount = $_POST['utilities_amount'];

        $query = "UPDATE `utilities` SET `user_id`='$renter', `utilities_type_id`='$utilities_type_id', `utilities_amount`='$utilities_amount' WHERE `utilities_id` = '$utilities_id'";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Utilities updated successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/utilities");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Utilities was not update";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/utilities");
            exit(0);
        }
    }

    //Delete utilities
    if(isset($_POST['delete_utilities'])){
        $utilities_id= $_POST['utilities_id'];
        $query = "UPDATE `utilities` SET `utilities_status` = 'Archive' WHERE utilities_id = $utilities_id ";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Utilities deleted successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/utilities");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Utilities was not delete";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/utilities");
            exit(0);
        } 
    }
?>