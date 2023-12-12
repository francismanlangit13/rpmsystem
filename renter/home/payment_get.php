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
    $utilities_type_id = $_POST['utilities_type_id'];

    if ($utilities_type_id == '1') {

        // Fetch the property_amount from the database based on property
        $stmt = $con->prepare("SELECT property_amount FROM property WHERE rented_by = ?");
        $stmt->bind_param("i",$user_id);
        $stmt->execute();
        $stmt->bind_result($property_amount);

        if ($stmt->fetch()) {
            echo $property_amount;
        } else {
            echo "Error fetching property_amount";
        }

        $stmt->close();
        $con->close();
    } else {
        $utilities_type_id = $_POST['utilities_type_id'];
        $thismonth = date('Y-m');
        $utilities_status = "Archive";

        // Fetch the utilities_amount from the database based on utilities
        $stmt = $con->prepare("SELECT utilities_amount FROM utilities WHERE user_id = ? AND utilities_type_id = ? AND DATE_FORMAT(`utilities_date`, '%Y-%m') = ? AND utilities_status != ?");
        $stmt->bind_param("iiis", $user_id, $utilities_type_id, $thismonth, $utilities_status);
        $stmt->execute();
        $stmt->bind_result($utilities_amount);

        if ($stmt->fetch()) {
            echo $utilities_amount;
        } else {
            echo "Error fetching utilities_amount";
        }

        $stmt->close();
        $con->close();
    }
?>