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

    // Add utility type
    if(isset($_POST["add_utility_type"])){
        $utility_type_name = $_POST['utility_type_name'];
        $status = 'Active';

        $query = "INSERT INTO `utility_type`(`utility_type_name`, `utility_type_status`) VALUES ('$utility_type_name','$status')";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Utility Type added successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/utility_type");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Utility Type was not added";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/utility_type");
            exit(0);
        }
    }

    // Edit utility type
    if(isset($_POST["edit_utility_type"])){
        $utility_type_id = $_POST["utility_type_id"];
        $utility_type_name = $_POST['utility_type_name'];
        $status = $_POST['status'];

        $query = "UPDATE `utility_type` SET `utility_type_name`='$utility_type_name', `utility_type_status`='$status' WHERE `utility_type_id`='$utility_type_id'";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Utility Type updated successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/utility_type");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Utility Type was not update";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/utility_type");
            exit(0);
        }
    }

    //Delete utility type
    if(isset($_POST['delete_utility_type'])){
        $utility_type_id= $_POST['utility_type_id'];
        $query = "UPDATE `utility_type` SET `utility_type_status` = 'Archive' WHERE utility_type_id = $utility_type_id ";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Utility Type deleted successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/utility_type");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Utility Type was not delete";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/utility_type");
            exit(0);
        } 
    }
?>