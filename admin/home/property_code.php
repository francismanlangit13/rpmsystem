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
        $staff = $_POST['staff'];
        $renter = $_POST['renter'];
        $property_type_id = $_POST['property_type_id'];
        $property_location = $_POST['property_location'];
        $property_amount = $_POST['property_amount'];
        $property_status = $_POST['property_status'];
        $date_rented = $_POST['date_rented'];
        $property_cash_advance = $_POST['property_cash_advance'];
        $property_cash_deposit = $_POST['property_cash_deposit'];
        
        if($property_status == 'Rented'){
            $stmt_run = mysqli_query($con,"UPDATE user SET `is_rented` = '1' WHERE user_id = '$renter'");
        }

        $query = "INSERT INTO `property` (`user_id`, `rented_by`, `property_unit_code`, `property_location`, `property_type_id`, `property_amount`, `date_rented`, `property_cash_advance`, `property_cash_deposit`, `property_status`) VALUES ('$staff','$renter','$property_unit_code','$property_location','$property_type_id','$property_amount','$date_rented','$property_cash_advance','$property_cash_deposit','$property_status')";
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
        $staff = $_POST['staff'];
        $renter = $_POST['renter'];
        $property_type_id = $_POST['property_type_id'];
        $property_location = $_POST['property_location'];
        $property_amount = $_POST['property_amount'];
        $property_status = $_POST['property_status'];
        $date_rented = $_POST['date_rented'];
        $property_cash_advance = $_POST['property_cash_advance'];
        $property_cash_deposit = $_POST['property_cash_deposit'];

        if($property_status == 'Rented'){
            $stmt_run = mysqli_query($con,"UPDATE user SET `is_rented` = '1' WHERE user_id = '$renter'");
        } else {
            $stmt_run = mysqli_query($con,"UPDATE user SET `is_rented` = '0' WHERE user_id = '$renter'");
        }

        $query = "UPDATE `property` SET `user_id`='$staff',`rented_by`='$renter',`property_unit_code`='$property_unit_code',`property_location`='$property_location',`property_type_id`='$property_type_id',`property_amount`='$property_amount',`date_rented`='$date_rented',`property_cash_advance`='$property_cash_advance',`property_cash_deposit`='$property_cash_deposit',`property_status`='$property_status' WHERE `property_id`='$id'";
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

        $query = "
            UPDATE `property` AS p
            JOIN `user` AS u ON p.rented_by = u.user_id
            SET p.`property_status` = 'Archive', u.`is_rented` = '0'
            WHERE p.`property_id` = $property_id;
        ";
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