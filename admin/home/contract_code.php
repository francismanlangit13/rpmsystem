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

    // Add contract
    if(isset($_POST["add_contract"])){
        $barangay = $_POST['barangay'];
        $add_property_unit_code = $_POST['add_property_unit_code'];
        $add_renter = $_POST['add_renter'];
        $add_occupants1 = $_POST['add_occupants1'];
        $add_occupants2 = $_POST['add_occupants2'];
        $add_occupants3 = $_POST['add_occupants3'];
        $add_occupants4 = $_POST['add_occupants4'];
        $add_permanent_address = $_POST['add_permanent_address'];
        $add_phone = $_POST['add_phone'];
        $add_contract_start = $_POST['add_contract_start'];
        $add_contract_end = $_POST['add_contract_end'];
        $add_monthly_rent = $_POST['add_monthly_rent'];

        $query = "INSERT INTO `contract`(`user_id`, `property_location`, `property_unit_code`, `occupant1`, `occupant2`, `occupant3`, `occupant4`, `permanent_address`, `phone`, `contract_start`, `contract_end`, `monthly_rent`, `contract_status`) VALUES ('$add_renter','$barangay','$add_property_unit_code','$add_occupants1','$add_occupants2','$add_occupants3','$add_occupants4','$add_permanent_address','$add_phone','$add_contract_start','$add_contract_end','$add_monthly_rent','Active')";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Contract added successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/contract");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Contract was not added";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/contract");
            exit(0);
        }
    }

    // Edit contract
    if(isset($_POST["edit_contract"])){
        $contract_id = $_POST["contract_id"];
        $edit_barangay = $_POST['edit_barangay'];
        $edit_property_unit_code = $_POST['edit_property_unit_code'];
        $edit_renter = $_POST['edit_renter'];
        $edit_occupants1 = $_POST['edit_occupants1'];
        $edit_occupants2 = $_POST['edit_occupants2'];
        $edit_occupants3 = $_POST['edit_occupants3'];
        $edit_occupants4 = $_POST['edit_occupants4'];
        $edit_permanent_address = $_POST['edit_permanent_address'];
        $edit_phone = $_POST['edit_phone'];
        $edit_contract_start = $_POST['edit_contract_start'];
        $edit_contract_end = $_POST['edit_contract_end'];
        $edit_monthly_rent = $_POST['edit_monthly_rent'];
        $edit_contract_status = $_POST['edit_contract_status'];

        $query = "UPDATE `contract` SET`user_id`='$edit_renter',`property_location`='$edit_barangay',`property_unit_code`='$edit_property_unit_code',`occupant1`='$edit_occupants1',`occupant2`='$edit_occupants2',`occupant3`='$edit_occupants3',`occupant4`='$edit_occupants4',`permanent_address`='$edit_permanent_address',`phone`='$edit_phone',`contract_start`='$edit_contract_start',`contract_end`='$edit_contract_end',`monthly_rent`='$edit_monthly_rent',`contract_status`='$edit_contract_status' WHERE `contract_id` = '$contract_id'";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Contract updated successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/contract");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Contract was not update";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/contract");
            exit(0);
        }
    }

    //Delete contract
    if(isset($_POST['delete_contract'])){
        $contract_id = $_POST['contract_id'];
        $query = "UPDATE `contract` SET `contract_status` = 'Archive' WHERE contract_id = $contract_id ";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Contract deleted successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/contract");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Contract was not delete";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/contract");
            exit(0);
        } 
    }
?>