<?php
    if (!defined('DB_SERVER')){
        include ('../includes/authentication.php');
        // DB connection parameters
        $host = DB_SERVER;
        $user = DB_USERNAME;
        $password = DB_PASSWORD;
        $db = DB_NAME;
        $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
        $user_date = date;
        $curr_user_id = $_SESSION['auth_user']['user_id'];
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
        $password = $_POST['password'];
        $type = 'Renter';
        $address = $_POST['address'];
        $civil_status = $_POST['civil_status'];
        $birthday = $_POST['birthday'];
        $occupation = $_POST['occupation'];
        $company = $_POST['company'];
        $property = $_POST['property'];
        $startrent = $_POST['startrent'];
        $endrent = $_POST['endrent'];
        $cash_advance = $_POST['cash_advance'];
        $cash_deposit = $_POST['cash_deposit'];
        $is_rented = '1';
        $status = 'Active';
        
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
                        $uploadDir = '../../assets/files/attachment/';
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
                        header("Location: " . base_url . "staff/home/user");
                        exit(0);
                    }
                } else {
                    $_SESSION['status'] = "File error";
                    $_SESSION['status_code'] = "error";
                    header("Location: " . base_url . "staff/home/user");
                    exit(0);
                }
            } else {
                $_SESSION['status'] = "Invalid file type";
                $_SESSION['status_code'] = "error";
                header("Location: " . base_url . "staff/home/user");
                exit(0);
            }
        }

        $query = "INSERT INTO `user`(`fname`, `mname`, `lname`, `suffix`, `gender`, `address`, `civil_status`, `birthday`, `occupation`, `company`, `valid_id`, `email`, `phone`, `password`, `is_rented`, `property_rented_id`, `startrent`, `endrent`, `cash_advance`, `cash_deposit`, `status`, `type`) VALUES ('$fname','$mname','$lname','$suffix','$gender','$address','$civil_status','$birthday','$occupation','$company','$fileName','$email','$phone','$password','$is_rented','$property','$startrent','$endrent','$cash_advance','$cash_deposit','$status','$type')";
        $query_run = mysqli_query($con, $query);

        // Get the latest inserted ID
        $user_id = mysqli_insert_id($con);

        if($query_run){
            $stmt_logs = mysqli_query($con, "INSERT INTO `activity_log` (`user_id`, `log_message`, `type`, `log_date`) VALUES ('$curr_user_id','Edit user ID $user_id.','Accounts','$user_date')");
            // Get the last inserted user_id
            $lastUserId = $con->insert_id;
            $query_property = "UPDATE `property` SET rentee_id = '$lastUserId', `property_status` = 'Rented' WHERE `property_id` = '$property'";
            $query_property_run = mysqli_query($con, $query_property);

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
            curl_setopt($ch, CURLOPT_URL, 'https://api.semaphore.co/api/v4/messages');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($ch);
            curl_close($ch);
            echo $output;

            $_SESSION['status'] = "User added successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "staff/home/user");
            exit(0);
        }
        else{
            $_SESSION['status'] = "User was not added";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "staff/home/user");
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
        $civil_status = $_POST['civil_status'];
        $birthday = $_POST['birthday'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $type = 'Renter';
        $status = $_POST['status'];
        $address = $_POST['address'];
        $occupation = $_POST['occupation'];
        $company = $_POST['company'];
        $property = $_POST['property'];
        $old_property = $_POST['old_property'];
        $startrent = $_POST['startrent'];
        $endrent = $_POST['endrent'];
        $cash_advance = $_POST['cash_advance'];
        $cash_deposit = $_POST['cash_deposit'];
        if ($status == 'Inactive'){
            $is_rented = '0';
        } else {
            $is_rented = '1';
        }

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
                        $uploadDir = '../../assets/files/attachment/';
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
                            $query = "UPDATE `user` SET `valid_id`='$fileName' WHERE `user_id` = '$user_id'";
                            $query_run = mysqli_query($con, $query);
                        }
                    } else {
                        $_SESSION['status'] = "File is too large, must be 5MB or below";
                        $_SESSION['status_code'] = "warning";
                        header("Location: " . base_url . "staff/home/user");
                        exit(0);
                    }
                } else {
                    $_SESSION['status'] = "File error";
                    $_SESSION['status_code'] = "error";
                    header("Location: " . base_url . "staff/home/user");
                    exit(0);
                }
            } else {
                $_SESSION['status'] = "Invalid file type";
                $_SESSION['status_code'] = "error";
                header("Location: " . base_url . "staff/home/user");
                exit(0);
            }
        }

        $query = "UPDATE `user` SET `fname`='$fname',`mname`='$mname',`lname`='$lname',`suffix`='$suffix',`gender`='$gender',`address`='$address',`civil_status`='$civil_status',`birthday`='$birthday',`occupation`='$occupation',`company`='$company',`email`='$email',`phone`='$phone',`is_rented`='$is_rented',`property_rented_id`='$property',`startrent`='$startrent',`endrent`='$endrent',`cash_advance`='$cash_advance',`cash_deposit`='$cash_deposit',`status`='$status',`type`='$type' WHERE `user_id`='$user_id'";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $stmt_logs = mysqli_query($con, "INSERT INTO `activity_log` (`user_id`, `log_message`, `type`, `log_date`) VALUES ('$curr_user_id','Edit user ID $user_id.','Accounts','$user_date')");
            if($status == 'Inactive'){
                $query_property = "UPDATE `property` SET rentee_id = '0', property_status = 'Available' WHERE property_id = '$property'";
                $query_property_run = mysqli_query($con, $query_property);
            } else {
                $query_property = "UPDATE `property` SET rentee_id = '$user_id', property_status = 'Rented' WHERE property_id = '$property'";
                $query_property_run = mysqli_query($con, $query_property);
            }
            if($property == $old_property){
                // dead code.
            } else {
                $query_property_update = "UPDATE `property` SET property_status = 'Available' WHERE property_id = '$old_property'";
                $query_property_update_run = mysqli_query($con, $query_property_update);
            }
            $_SESSION['status'] = "User updated successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "staff/home/user");
            exit(0);
        }
        else{
            $_SESSION['status'] = "User was not update";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "staff/home/user");
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
            header("Location: " . base_url . "staff/home/user");
            exit(0);
        }
        else{
            $_SESSION['status'] = "User was not delete";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "staff/home/user");
            exit(0);
        } 
    }
?>