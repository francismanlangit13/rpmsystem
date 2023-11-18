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

    // Add location
    if(isset($_POST["add_location"])){
        $location_name = $_POST['location_name'];

        $query = "INSERT INTO `location`(`location_name`) VALUES ('$location_name')";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Location added successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/location");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Location was not added";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/location");
            exit(0);
        }
    }

    // Edit location
    if(isset($_POST["edit_location"])){
        $location_id = $_POST["location_id"];
        $location_name = $_POST['location_name'];

        $query = "UPDATE `location` SET `location_name`='$location_name' WHERE `location_id`='$location_id'";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Location updated successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/location");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Location was not update";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/location");
            exit(0);
        }
    }

    //Delete location
    if(isset($_POST['delete_location'])){
        $location_id= $_POST['location_id'];
        $query = "DELETE FROM `location` WHERE location_id = $location_id ";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Location deleted successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/location");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Location was not delete";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/location");
            exit(0);
        } 
    }
?>