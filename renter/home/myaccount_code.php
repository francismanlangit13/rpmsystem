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

    // -------------------------------- Update Account -------------------------------- //
    if (isset($_POST["btn_update_account"])) {
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $query = "UPDATE `user` SET `email`='$email', `phone`='$phone' WHERE `user_id`='$user_id'";
        $query_run = mysqli_query($con, $query);
        if ($query_run) {
            $_SESSION['status'] = "Account updated successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "staff/home/myaccount");
            exit(0);
        } else {
            $_SESSION['status'] = "Account was not updated";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "staff/home/myaccount");
            exit(0);
        }
    }

    // -------------------------------- Change Password -------------------------------- //
    if (isset($_POST["btn_change_password"])) {
        $currentPassword = md5($_POST['currentPassword']);
        $password = md5($_POST['confirmPassword']);

        // Prepare and execute the SQL query
        $stmt = $con->prepare("SELECT * FROM user WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            // Fetch user data from the result
            $row = $result->fetch_assoc();
            
            if($row['password'] == $currentPassword){
                $query = "UPDATE `user` SET `password`='$password' WHERE `user_id`='$user_id'";
                $query_run = mysqli_query($con, $query);
                if ($query_run) {
                    $_SESSION['status'] = "Password updated successfully";
                    $_SESSION['status_code'] = "success";
                    header("Location: " . base_url . "staff/home/myaccount");
                    exit(0);
                } else {
                    $_SESSION['status'] = "Password was not updated";
                    $_SESSION['status_code'] = "error";
                    header("Location: " . base_url . "staff/home/myaccount");
                    exit(0);
                }
            } else{
                $_SESSION['status'] = "Incorrect current password";
                $_SESSION['status_code'] = "warning";
                header("Location: " . base_url . "staff/home/myaccount");
                exit(0);
            }
        }
    }
?>