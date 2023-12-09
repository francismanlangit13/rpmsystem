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

    // Add utilities
    if(isset($_POST["add_utilities"])){
        $renter = $_POST['renter'];
        $utilities_type_id = $_POST['utilities_type_id'];
        $utilities_amount = $_POST['utilities_amount'];
        $utilities_date = date;
        $utilities_status = 'Active';
        $thismonth = date('Y-m');

        $check_billing_sql = "SELECT * FROM `utilities` WHERE user_id = '$renter' AND `utilities_type_id` = '$utilities_type_id' AND DATE_FORMAT(`utilities_date`, '%Y-%m') = '$thismonth' AND `utilities_status` != 'Archive'";
        $check_billing_sql_run = mysqli_query($con, $check_billing_sql);

        if (mysqli_num_rows($check_billing_sql_run) > 0) {
            $_SESSION['status'] = "The selected user has already added bill this month.";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/utilities");
            exit(0);
        } else {

            // SQL for getting the database
            $sql_query = $con->query("SELECT * FROM utilities_type WHERE utilities_type_id = '$utilities_type_id'");
            $utilities_type_result = $sql_query->fetch_assoc();

            $stmt_query = $con->query("SELECT * FROM user WHERE user_id = '$renter'");
            $user = $stmt_query->fetch_assoc();

            $fullname = $user['fname'] .' '. $user['mname'] .' '. $user['lname'] .' '. $user['suffix'];
            $utilities_type_name = $utilities_type_result['utilities_type_name'];
            $email = $user['email'];
            $phone = $user['phone'];


            $query = "INSERT INTO `utilities`(`user_id`, `utilities_type_id`, `utilities_amount`, `utilities_date`, `utilities_status`) VALUES ('$renter','$utilities_type_id','$utilities_amount','$utilities_date','$utilities_status')";
            $query_run = mysqli_query($con, $query);

            if($query_run){
                // PHP Compose Mail
                $name = 'Rental Properties Management System';
                // $subject = htmlentities(date('F Y').' Billing Notice - ' . $name);
                // $message = nl2br("Dear $fullname \r\n \r\n This month $utilities_type_name bill is due. Please make a payment of &#8369;$utilities_amount online or in cash. Thank you.");
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
                Dear $fullname\r\nThis month $utilities_type_name bill is due. Please make a payment of ₱$utilities_amount online or in cash.
                Please visit $url to view your bill details or make online payment.\r\nThank you.
                EOD;
                $ch = curl_init();
                $parameters = array(
                'apikey' => smsapikey, // Your API KEY
                'number' => $phone,
                'message' => $string,
                'sendername' => smsapiname
                );
                curl_setopt($ch, CURLOPT_URL, 'https://api.semaphore.co/api/v4/messages');
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $output = curl_exec($ch);
                curl_close($ch);
                echo $output;

                $_SESSION['status'] = "Other Bills added successfully";
                $_SESSION['status_code'] = "success";
                header("Location: " . base_url . "admin/home/utilities");
                exit(0);
            }
            else{
                $_SESSION['status'] = "Other Bills was not added";
                $_SESSION['status_code'] = "error";
                header("Location: " . base_url . "admin/home/utilities");
                exit(0);
            }
        }
    }

    // Edit utilities
    if(isset($_POST["edit_utilities"])){
        $utilities_id = $_POST['utilities_id'];
        $renter = $_POST['renter'];
        $utilities_type_id = $_POST['utilities_type_id'];
        $utilities_amount = $_POST['utilities_amount'];

        $query = "UPDATE `utilities` SET `user_id`='$renter', `utilities_type_id`='$utilities_type_id', `utilities_amount`='$utilities_amount' WHERE `utilities_id` = '$utilities_id'";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Other Bills updated successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/utilities");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Other Bills was not update";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/utilities");
            exit(0);
        }
    }

    //Delete utilities
    if(isset($_POST['delete_utilities'])){
        $utilities_id= $_POST['utilities_id'];
        $query = "UPDATE `utilities` SET `utilities_status` = 'Archive' WHERE utilities_id = $utilities_id ";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Other Bills deleted successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/utilities");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Other Bills was not delete";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/utilities");
            exit(0);
        } 
    }
?>