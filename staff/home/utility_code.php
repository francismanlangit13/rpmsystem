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

        $check_billing_sql = "SELECT * FROM `utility` WHERE user_id = '$renter' AND `utility_type_id` = '$utility_type_id' AND DATE_FORMAT(`utility_date`, '%Y-%m') = '$thismonth' AND `utility_status` != 'Inactive'";
        $check_billing_sql_run = mysqli_query($con, $check_billing_sql);

        $stmt = $con->query("SELECT `balance` FROM `user` WHERE `user_id` = '$renter'");
        $row_result = $stmt->fetch_assoc();

        if (mysqli_num_rows($check_billing_sql_run) > 0) {
            $_SESSION['status'] = "The selected user has already added bill this month.";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "staff/home/utility");
            exit(0);
        } else {

            function compressImage($source, $destination, $quality){
                // Get image info
                $imgInfo = getimagesize($source);
                $mime = $imgInfo['mime'];
                // Create a new image from file
                switch ($mime) {
                    case 'image/jpeg':
                        $image = imagecreatefromjpeg($source);
                        break;
                    case 'image/png':
                        $image = imagecreatefrompng($source);
                        break;
                    case 'image/gif':
                        $image = imagecreatefromgif($source);
                        break;
                    default:
                        $image = imagecreatefromjpeg($source);
                }
                // Check and apply image orientation
                $exif = @exif_read_data($source);
                if ($exif && isset($exif['Orientation'])) {
                    $orientation = $exif['Orientation'];
                    if ($orientation == 3) {
                        $image = imagerotate($image, 180, 0);
                    } elseif ($orientation == 6) {
                        $image = imagerotate($image, -90, 0);
                    } elseif ($orientation == 8) {
                        $image = imagerotate($image, 90, 0);
                    }
                }
                // Save image with compression quality
                imagejpeg($image, $destination, $quality);
                // Return compressed image
                return $destination;
            }
            if (isset($_FILES['image1']) && is_uploaded_file($_FILES['image1']['tmp_name']) && $_FILES['image1']['error'] === UPLOAD_ERR_OK) {
                $fileImage = $_FILES['image1'];
                $customFileName = 'Attachment_' . date('Ymd_His'); // replace with your desired file name
                $ext = pathinfo($fileImage['name'], PATHINFO_EXTENSION); // get the file extension
                $fileName = $customFileName . '.' . $ext; // append the extension to the custom file name
                $fileTmpname = $fileImage['tmp_name'];
                $fileSize = $fileImage['size'];
                $fileError = $fileImage['error'];
                $fileExt = explode('.', $fileName);
                $fileActExt = strtolower(end($fileExt));
                $allowed = array('jpg', 'jpeg', 'png');
                if (in_array($fileActExt, $allowed)) {
                    if ($fileError === 0) {
                        if ($fileSize < 5242880) { // 5MB Limit
                            $uploadDir = '../../assets/files/bills/';
                            $targetFile = $uploadDir . $fileName;
                            if ($fileSize > 1048576) { // more than 1 MB
                                // Compress the uploaded image with a quality of 25
                                $compressedImage = compressImage($fileTmpname, $targetFile, 25);
                            } else {
                                // Compress the uploaded image with a quality of 35
                                $compressedImage = compressImage($fileTmpname, $targetFile, 35);
                            }
                        } else {
                            $_SESSION['status'] = "File is too large, must be 5MB or below";
                            $_SESSION['status_code'] = "warning";
                            header("Location: " . base_url . "staff/home/utility");
                            exit(0);
                        }
                    } else {
                        $_SESSION['status'] = "File error";
                        $_SESSION['status_code'] = "error";
                        header("Location: " . base_url . "staff/home/utility");
                        exit(0);
                    }
                } else {
                    $_SESSION['status'] = "Invalid file type";
                    $_SESSION['status_code'] = "error";
                    header("Location: " . base_url . "staff/home/utility");
                    exit(0);
                }
            }

            // SQL for getting the database
            $sql_query = $con->query("SELECT * FROM utility_type WHERE utility_type_id = '$utility_type_id'");
            $utility_type_result = $sql_query->fetch_assoc();

            $stmt_query = $con->query("SELECT * FROM user WHERE user_id = '$renter'");
            $user = $stmt_query->fetch_assoc();

            $fullname = $user['fname'] .' '. $user['mname'] .' '. $user['lname'] .' '. $user['suffix'];
            $utility_type_name = $utility_type_result['utility_type_name'];
            $email = $user['email'];
            $phone = $user['phone'];

            // Update the balance.
            $new_balance = $row_result['balance'] + $utility_amount;


            $query = "INSERT INTO `utility` (`user_id`, `utility_type_id`, `utility_amount`, `utility_date`, `utility_attachment`, `utility_status`, `updated_by`, `last_update_date`) VALUES ('$renter','$utility_type_id','$utility_amount','$utility_date','$fileName','$utility_status','$user_id','$utility_date')";
            $query_run = mysqli_query($con, $query);

            // Get the latest inserted ID
            $utility_id = mysqli_insert_id($con);

            $run_query = mysqli_query($con, "UPDATE `user` SET `balance` = '$new_balance' WHERE `user_id` = '$renter'");

            if($query_run){
                $stmt_logs = mysqli_query($con, "INSERT INTO `activity_log` (`user_id`, `log_message`, `type`, `log_date`) VALUES ('$user_id','Add bills for $utility_type_name ID $utility_id.','Manage Bills','$utility_date')");
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
                header("Location: " . base_url . "staff/home/utility");
                exit(0);
            } else{
                $_SESSION['status'] = "Other Bills was not added";
                $_SESSION['status_code'] = "error";
                header("Location: " . base_url . "staff/home/utility");
                exit(0);
            }
        }
    }

    // Edit utility
    if(isset($_POST["edit_utility"])){
        $utility_id = $_POST['utility_id'];
        $renter = $_POST['renter'];
        $utility_type_id = $_POST['utility_type_id'];
        $utility_amount = $_POST['utility_amount'];
        $utility_status = $_POST['utility_status'];
        $utility_date = date;

        $get_sql = $con->query("SELECT utility_type_name FROM `utility_type` WHERE utility_type_id = '$utility_type_id'");
        $get_result = $get_sql->fetch_assoc();
        $utility_type_name = $get_result['utility_type_name'];

        function compressImage($source, $destination, $quality){
            // Get image info
            $imgInfo = getimagesize($source);
            $mime = $imgInfo['mime'];
            // Create a new image from file
            switch ($mime) {
                case 'image/jpeg':
                    $image = imagecreatefromjpeg($source);
                    break;
                case 'image/png':
                    $image = imagecreatefrompng($source);
                    break;
                case 'image/gif':
                    $image = imagecreatefromgif($source);
                    break;
                default:
                    $image = imagecreatefromjpeg($source);
            }
            // Check and apply image orientation
            $exif = @exif_read_data($source);
            if ($exif && isset($exif['Orientation'])) {
                $orientation = $exif['Orientation'];
                if ($orientation == 3) {
                    $image = imagerotate($image, 180, 0);
                } elseif ($orientation == 6) {
                    $image = imagerotate($image, -90, 0);
                } elseif ($orientation == 8) {
                    $image = imagerotate($image, 90, 0);
                }
            }
            // Save image with compression quality
            imagejpeg($image, $destination, $quality);
            // Return compressed image
            return $destination;
        }

        if (isset($_FILES['image1']) && is_uploaded_file($_FILES['image1']['tmp_name']) && $_FILES['image1']['error'] === UPLOAD_ERR_OK) {
            $fileImage = $_FILES['image1'];
            $OLDfileImage = $_POST['oldfileimage'];
            $customFileName = 'ID_' . date('Ymd_His'); // replace with your desired file name
            $ext = pathinfo($fileImage['name'], PATHINFO_EXTENSION); // get the file extension
            $fileName = $customFileName . '.' . $ext; // append the extension to the custom file name
            $fileTmpname = $fileImage['tmp_name'];
            $fileSize = $fileImage['size'];
            $fileError = $fileImage['error'];
            $fileExt = explode('.', $fileName);
            $fileActExt = strtolower(end($fileExt));
            $allowed = array('jpg', 'jpeg', 'png');
            if (in_array($fileActExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize < 5242880) { // 5MB Limit
                        $uploadDir = '../../assets/files/bills/';
                        unlink($uploadDir . $OLDfileImage);
                        $targetFile = $uploadDir . $fileName;
                        if ($fileSize > 1048576) { // more than 1 MB
                            // Compress the uploaded image with a quality of 25
                            $compressedImage = compressImage($fileTmpname, $targetFile, 25);
                        } else {
                            // Compress the uploaded image with a quality of 35
                            $compressedImage = compressImage($fileTmpname, $targetFile, 35);
                        }
                        if ($compressedImage) {
                            $query = "UPDATE `utility` SET `utility_attachment`='$fileName' WHERE `utility_id` = '$utility_id'";
                            $query_run = mysqli_query($con, $query);
                        }
                    } else {
                        $_SESSION['status'] = "File is too large, must be 5MB or below";
                        $_SESSION['status_code'] = "warning";
                        header("Location: " . base_url . "staff/home/utility");
                        exit(0);
                    }
                } else {
                    $_SESSION['status'] = "File error";
                    $_SESSION['status_code'] = "error";
                    header("Location: " . base_url . "staff/home/utility");
                    exit(0);
                }
            } else {
                $_SESSION['status'] = "Invalid file type";
                $_SESSION['status_code'] = "error";
                header("Location: " . base_url . "staff/home/utility");
                exit(0);
            }
        }

        $query = "UPDATE `utility` SET `user_id`='$renter', `utility_type_id`='$utility_type_id', `utility_amount`='$utility_amount', `utility_status`='$utility_status', `updated_by`='$user_id', `last_update_date`='$utility_date' WHERE `utility_id` = '$utility_id'";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $stmt_logs = mysqli_query($con, "INSERT INTO `activity_log` (`user_id`, `log_message`, `type`, `log_date`) VALUES ('$user_id','Edit bills for $utility_type_name ID $utility_id.','Manage Bills','$utility_date')");
            $_SESSION['status'] = "Other Bills updated successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "staff/home/utility");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Other Bills was not update";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "staff/home/utility");
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
            header("Location: " . base_url . "staff/home/utility");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Other Bills was not delete";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "staff/home/utility");
            exit(0);
        } 
    }
?>