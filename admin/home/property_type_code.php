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

    // Add property type
    if(isset($_POST["add_property_type"])){
        $property_type_name = $_POST['property_type_name'];
        $status = 'Active';

        $query = "INSERT INTO `property_type`(`property_type_name`, `property_type_status`) VALUES ('$property_type_name','$status')";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Property Type added successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/property_type");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Property Type was not added";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/property_type");
            exit(0);
        }
    }

    // Edit property type
    if(isset($_POST["edit_property_type"])){
        $property_type_id = $_POST["property_type_id"];
        $property_type_name = $_POST['property_type_name'];
        $status = $_POST['status'];

        $query = "UPDATE `property_type` SET `property_type_name`='$property_type_name', `property_type_status`='$status' WHERE `property_type_id`='$property_type_id'";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Property Type updated successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/property_type");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Property Type was not update";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/property_type");
            exit(0);
        }
    }

    //Delete property type
    if(isset($_POST['delete_property_type'])){
        $property_type_id= $_POST['property_type_id'];
        $query = "UPDATE `property_type` SET `property_type_status` = 'Archive' WHERE property_type_id = $property_type_id ";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Property Type deleted successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/property_type");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Property Type was not delete";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/property_type");
            exit(0);
        } 
    }
?>