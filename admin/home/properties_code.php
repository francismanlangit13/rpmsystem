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

    // Add property
    if(isset($_POST["add_properties"])){
        $add_property_unit_code = $_POST['add_property_unit_code'];
        $add_staff = $_POST['add_staff'];
        $add_renter = $_POST['add_renter'];
        $add_property_type = $_POST['add_property_type'];
        $add_property_location = $_POST['add_property_location'];
        $add_property_cost = $_POST['add_property_cost'];
        $add_property_status = $_POST['add_property_status'];

        $query = "INSERT INTO `property` (`user_id`, `rented_by`, `property_unit_code`, `location_id`, `property_type`, `property_cost`, `property_status`) VALUES ('$add_staff','$add_renter','$add_property_unit_code','$add_property_location','$add_property_type','$add_property_cost','$add_property_status')";
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

    // Edit property
    if(isset($_POST["edit_properties"])){
        $id = $_POST["id"];
        $edit_property_unit_code = $_POST['edit_property_unit_code'];
        $edit_staff = $_POST['edit_staff'];
        $edit_renter = $_POST['edit_renter'];
        $edit_property_type = $_POST['edit_property_type'];
        $edit_property_location = $_POST['edit_property_location'];
        $edit_property_cost = $_POST['edit_property_cost'];
        $edit_property_status = $_POST['edit_property_status'];

        $query = "UPDATE `property` SET `user_id`='$edit_staff',`rented_by`='$edit_renter',`property_unit_code`='$edit_property_unit_code',`property_location`='$edit_property_location',`property_type`='$edit_property_type',`property_cost`='$edit_property_cost',`property_status`='$edit_property_status' WHERE `property_id`='$id'";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Properties updated successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/properties");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Properties was not update";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/properties");
            exit(0);
        }
    }

    //Delete property
    if(isset($_POST['delete_properties'])){
        $property_id= $_POST['property_id'];
        $query = "UPDATE `property` SET `property_status` = 'Archive' WHERE `property_id` = $property_id ";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Properties deleted successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/properties");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Properties was not delete";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/properties");
            exit(0);
        } 
    }
?>