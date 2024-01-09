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

    // Add utility
    if(isset($_POST["add_utility"])){
        $renter = $_POST['renter'];
        $utility_type_id = $_POST['utility_type_id'];
        $utility_amount = $_POST['utility_amount'];
        $utility_date = date;
        $utility_status = 'Active';
        $thismonth = date('Y-m');

        $check_billing_sql = "SELECT * FROM `utility` WHERE user_id = '$renter' AND `utility_type_id` = '$utility_type_id' AND DATE_FORMAT(`utility_date`, '%Y-%m') = '$thismonth' AND `utility_status` != 'Archive'";
        $check_billing_sql_run = mysqli_query($con, $check_billing_sql);

        if (mysqli_num_rows($check_billing_sql_run) > 0) {
            $_SESSION['status'] = "The selected user has already added bill this month.";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/utility");
            exit(0);
        } else {

            // SQL for getting the database
            $sql_query = $con->query("SELECT * FROM utility_type WHERE utility_type_id = '$utility_type_id'");
            $utility_type_result = $sql_query->fetch_assoc();

            $stmt_query = $con->query("SELECT * FROM user WHERE user_id = '$renter'");
            $user = $stmt_query->fetch_assoc();

            $fullname = $user['fname'] .' '. $user['mname'] .' '. $user['lname'] .' '. $user['suffix'];
            $utility_type_name = $utility_type_result['utility_type_name'];
            $email = $user['email'];
            $phone = $user['phone'];


            $query = "INSERT INTO `utility`(`user_id`, `utility_type_id`, `utility_amount`, `utility_date`, `utility_status`) VALUES ('$renter','$utility_type_id','$utility_amount','$utility_date','$utility_status')";
            $query_run = mysqli_query($con, $query);

            if($query_run){
                // PHP Compose Mail
                $name = 'Rental Properties Management System';
                // $subject = htmlentities(date('F Y').' Billing Notice - ' . $name);
                // $message = nl2br("Dear $fullname \r\n \r\n This month $utility_type_ name bill is due. Please make a payment of &#8369;$utility_amount online or in cash. Thank you.");
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
                Dear $fullname\r\nThis month $utility_type_name bill is due. Please make a payment of ₱$utility_amount online or in cash.
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
                header("Location: " . base_url . "admin/home/utility");
                exit(0);
            }
            else{
                $_SESSION['status'] = "Other Bills was not added";
                $_SESSION['status_code'] = "error";
                header("Location: " . base_url . "admin/home/utility");
                exit(0);
            }
        }
    }

    // Edit utility
    if(isset($_POST["edit_utility"])){
        $utility_id = $_POST['utilities_id'];
        $renter = $_POST['renter'];
        $utility_type_id = $_POST['utility_type_id'];
        $utility_amount = $_POST['utility_amount'];

        $query = "UPDATE `utility` SET `user_id`='$renter', `utility_type_id`='$utility_type_id', `utility_amount`='$utility_amount' WHERE `utility_id` = '$utility_id'";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Other Bills updated successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/utility");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Other Bills was not update";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/utility");
            exit(0);
        }
    }

    //Delete utility
    if(isset($_POST['delete_utility'])){
        $utility_id= $_POST['utility_id'];
        $query = "UPDATE `utility` SET `utility_status` = 'Archive' WHERE utility_id = $utility_id ";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Other Bills deleted successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/utility");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Other Bills was not delete";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/utility");
            exit(0);
        } 
    }
?>