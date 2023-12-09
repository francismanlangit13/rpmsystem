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
        // PHP Mailer
        include ("../../assets/vendor/PHPMailer/PHPMailerAutoload.php");
        include ("../../assets/vendor/PHPMailer/class.phpmailer.php");
        include ("../../assets/vendor/PHPMailer/class.smtp.php");
    }

    // Add user account
    if(isset($_POST["add_user"])){
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $suffix = $_POST['suffix'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $pass = $_POST['password'];
        $type = $_POST['role'];
        $new_password = $pass; //substr(md5(microtime()),rand(0,26),10);
        $password = $new_password;
        $status = 'Active';

        $query = "INSERT INTO `user`(`fname`, `mname`, `lname`, `suffix`, `gender`, `email`, `phone`, `password`, `status`, `type`) VALUES ('$fname','$mname','$lname','$suffix','$gender','$email','$phone','$password','$status','$type')";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $fullname = $fname .' '. $mname .' '. $lname .' '. $suffix;
            // PHP Compose Mail
            $name = 'Rental Properties Management System';
            // $subject = htmlentities('Email and Password Credentials - ' . $name);
            // $message = nl2br("Dear $fullname \r\n \r\n Welcome to ".$name."! \r\n \r\n This is your account information \r\n Email: $email \r\n Password: $new_password \r\n \r\n Please change your password immediately. \r\n \r\n Thanks, \r\n ".$name);
            // //PHP Mailer Gmail
            // $mail = new PHPMailer();
            // $mail->IsSMTP();
            // $mail->SMTPAuth = true;
            // $mail->SMTPSecure = 'TLS/STARTTLS';
            // $mail->Host = 'smtp.gmail.com'; // Enter your host here
            // $mail->Port = '587';
            // $mail->IsHTML();
            // $mail->Username = emailuser; // Enter your email here
            // $mail->Password = emailpass; //Enter your passwrod here
            // $mail->setFrom($email, $name);
            // $mail->addAddress($email);
            // $mail->Subject = $subject;
            // $mail->Body = $message;
            // $mail->send();

            // SMS API (Semaphore Message)
            $url = base_url;
            $string = <<<EOD
            Dear $fullname\nWelcome to $name\r\nThis is your account information \nEmail: $email\nPassword: $new_password\r\nPlease change your password immediately.\r\nThanks,\n$name.
            Please check $url
            EOD;
            $ch = curl_init();
            $parameters = array(
              'apikey' => smsapikey, // Your API KEY
              'number' => $phone,
              'message' => $string,
              'sendername' => smsapiname
            );
            curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($ch);
            curl_close($ch);
            echo $output;

            $_SESSION['status'] = "User added successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/user");
            exit(0);
        }
        else{
            $_SESSION['status'] = "User was not added";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/user");
            exit(0);
        }
    }

    // Edit user account
    if(isset($_POST["edit_user"])){
        $user_id = $_POST["user_id"];
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $suffix = $_POST['suffix'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $type = $_POST['role'];
        $status = $_POST['status'];

        $query = "UPDATE `user` SET `fname`='$fname',`mname`='$mname',`lname`='$lname',`suffix`='$suffix',`gender`='$gender',`email`='$email',`phone`='$phone',`status`='$status',`type`='$type' WHERE `user_id`='$user_id'";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "User updated successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/user");
            exit(0);
        }
        else{
            $_SESSION['status'] = "User was not update";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/user");
            exit(0);
        }
    }

    //Delete user
    if(isset($_POST['delete_user'])){
        $user_id= $_POST['user_id'];
        $query = "UPDATE `user` SET `status` = 'Archive' WHERE user_id = $user_id ";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "User deleted successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/user");
            exit(0);
        }
        else{
            $_SESSION['status'] = "User was not delete";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/user");
            exit(0);
        } 
    }
?>