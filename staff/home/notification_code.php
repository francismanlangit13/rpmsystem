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

    // Send notification
    if(isset($_POST["send_notification"])){
        $renter = $_POST['renter'];
        $body = $_POST['body'];
        $user_qry = $con->query("SELECT * FROM user WHERE user_id = $renter ");
        $user = $user_qry->fetch_assoc();
        $email = $user['email'];
        $phone = $user['phone'];

        if($user){
            $fullname = $user['fname'] .' '. $user['mname'] .' '. $user['lname'] .' '. $user['suffix'];
            // PHP Compose Mail
            $name = 'Rental Properties Management System';
            $subject = htmlentities('Important Message - ' . $name);
            $message = $body;
            //PHP Mailer Gmail
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'TLS/STARTTLS';
            $mail->Host = 'smtp.gmail.com'; // Enter your host here
            $mail->Port = '587';
            $mail->IsHTML();
            $mail->Username = emailuser; // Enter your email here
            $mail->Password = emailpass; //Enter your passwrod here
            $mail->setFrom($email, $name);
            $mail->addAddress($email);
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->send();

            // SMS API (Semaphore Message)
            $url = base_url;
            $string = <<<EOD
            $body
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

            $_SESSION['status'] = "Sent successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "staff/home/notification");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Was not sent";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "staff/home/notification");
            exit(0);
        }
    }
?>