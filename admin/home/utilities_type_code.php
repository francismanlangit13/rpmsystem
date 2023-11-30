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

    // Add utilities type
    if(isset($_POST["add_utilities_type"])){
        $utilities_type_name = $_POST['utilities_type_name'];
        $status = 'Active';

        $query = "INSERT INTO `utilities_type`(`utilities_type_name`, `utilities_type_status`) VALUES ('$utilities_type_name','$status')";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Utilities Type added successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/utilities_type");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Utilities Type was not added";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/utilities_type");
            exit(0);
        }
    }

    // Edit utilities type
    if(isset($_POST["edit_utilities_type"])){
        $utilities_type_id = $_POST["utilities_type_id"];
        $utilities_type_name = $_POST['utilities_type_name'];

        $query = "UPDATE `utilities_type` SET `utilities_type_name`='$utilities_type_name' WHERE `utilities_type_id`='$utilities_type_id'";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Utilities Type updated successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/utilities_type");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Utilities Type was not update";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/utilities_type");
            exit(0);
        }
    }

    //Delete utilities type
    if(isset($_POST['delete_utilities_type'])){
        $utilities_type_id= $_POST['utilities_type_id'];
        $query = "UPDATE `utilities_type` SET `utilities_type_status` = 'Archive' WHERE utilities_type_id = $utilities_type_id ";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Utilities Type deleted successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/utilities_type");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Utilities Type was not delete";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/utilities_type");
            exit(0);
        } 
    }
?>