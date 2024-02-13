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
    if(isset($_POST["add_property"])){
        $property_unit_code = $_POST['property_unit_code'];
        $property_permit = $_POST['property_permit'];
        $staff = $_POST['staff'];
        $property_type_id = $_POST['property_type_id'];
        $property_purok = $_POST['property_purok'];
        $property_barangay = $_POST['property_barangay'];
        $property_city = $_POST['property_city'];
        $property_zipcode = $_POST['property_zipcode'];
        $property_amount = $_POST['property_amount'];
        $has_electrical_meter = $_POST['has_electrical_meter'];
        $has_water_meter = $_POST['has_water_meter'];
        $has_parking_space = $_POST['has_parking_space'];
        $has_conectivity = $_POST['has_conectivity'];
        $property_status = $_POST['property_status'];

        $query = "INSERT INTO `property` (`user_id`, `property_unit_code`, `property_permit`, `property_purok`, `property_barangay`, `property_city`, `property_zipcode`, `property_type_id`, `has_electrical_meter`, `has_water_meter`, `has_parking_space`, `has_conectivity`, `property_amount`, `property_status`) VALUES ('$staff','$property_unit_code','$property_permit','$property_purok','$property_barangay','$property_city','$property_zipcode','$property_type_id','$has_electrical_meter','$has_water_meter','$has_parking_space','$has_conectivity','$property_amount','$property_status')";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Property added successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/property");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Property was not added";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/property");
            exit(0);
        }
    }

    // Edit property
    if(isset($_POST["edit_property"])){
        $id = $_POST["id"];
        $property_unit_code = $_POST['property_unit_code'];
        $property_permit = $_POST['property_permit'];
        $staff = $_POST['staff'];
        $property_type_id = $_POST['property_type_id'];
        $property_purok = $_POST['property_purok'];
        $property_barangay = $_POST['property_barangay'];
        $property_city = $_POST['property_city'];
        $property_zipcode = $_POST['property_zipcode'];
        $property_amount = $_POST['property_amount'];
        $has_electrical_meter = $_POST['has_electrical_meter'];
        $has_water_meter = $_POST['has_water_meter'];
        $has_parking_space = $_POST['has_parking_space'];
        $has_conectivity = $_POST['has_conectivity'];
        $property_status = $_POST['property_status'];
        $status = $_POST['status'];

        $query = "UPDATE `property` SET `user_id`='$staff',`property_unit_code`='$property_unit_code',`property_permit`='$property_permit',`property_purok`='$property_purok',`property_barangay`='$property_barangay',`property_city`='$property_city',`property_zipcode`='$property_zipcode',`property_type_id`='$property_type_id',`has_electrical_meter`='$has_electrical_meter',`has_water_meter`='$has_water_meter',`has_parking_space`='$has_parking_space',`has_conectivity`='$has_conectivity',`property_amount`='$property_amount',`property_status`='$property_status',`p_status`='$status' WHERE `property_id`='$id'";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Property updated successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/property");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Property was not update";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/property");
            exit(0);
        }
    }

    //Delete property
    if(isset($_POST['delete_property'])){
        $property_id = $_POST['property_id'];
        $query = "UPDATE `property` SET `property_status` = 'Archive' WHERE `property_id` = '$property_id'";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Property deleted successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/property");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Property was not delete";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/property");
            exit(0);
        } 
    }
?>