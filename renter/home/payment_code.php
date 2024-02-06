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

    // Add payment
    if(isset($_POST["add_payment"])){
        $renter = $user_id;
        $utility_type_id = $_POST['utility_type_id'];
        $payment_type_id = $_POST['payment_type_id'];
        $payment_reference = $_POST['payment_reference'];
        $payment_amount = $_POST['payment_amount'];
        $payment_date = date;
        $thismonth = date('Y-m');
        $status = 'Active';
        $payment_status = 'Pending';

        $stmt_query = $con->query("SELECT * FROM user WHERE user_id = '$renter'");
        $user = $stmt_query->fetch_assoc();

        $sql_query = $con->query("SELECT * FROM utility INNER JOIN utility_type ON utility_type.utility_type_id = utility.utility_type_id WHERE utility.utility_type_id = '$utility_type_id' AND DATE_FORMAT(`utility_date`, '%Y-%m') = '$thismonth'");
        $utility_type_result = $sql_query->fetch_assoc();

        $fullname = $user['fname'] .' '. $user['mname'] .' '. $user['lname'] .' '. $user['suffix'];
        $utility_type_name = $utility_type_result['utility_type_name'];
        $email = $user['email'];
        $phone = $user['phone'];
        $utility_id = $utility_type_result['utility_id'];

        $check_billing_sql = "SELECT * FROM `payment` WHERE user_id = '$renter' AND `utility_type_id` = '$utility_type_id' AND DATE_FORMAT(`payment_date`, '%Y-%m') = '$thismonth' AND `status` != 'Archive'";
        $check_billing_sql_run = mysqli_query($con, $check_billing_sql);

        if (mysqli_num_rows($check_billing_sql_run) > 0) {
            $_SESSION['status'] = "You already paid this month.";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "renter/home/payment");
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
                            header("Location: " . base_url . "renter/home/utility");
                            exit(0);
                        }
                    } else {
                        $_SESSION['status'] = "File error";
                        $_SESSION['status_code'] = "error";
                        header("Location: " . base_url . "renter/home/utility");
                        exit(0);
                    }
                } else {
                    $_SESSION['status'] = "Invalid file type";
                    $_SESSION['status_code'] = "error";
                    header("Location: " . base_url . "renter/home/utility");
                    exit(0);
                }
            }

            if($utility_type_id == '1'){ // Rent
                $query_run = mysqli_query($con, "INSERT INTO `payment`(`utility_id`, `user_id`, `utility_type_id`, `payment_type_id`, `payment_amount`, `payment_reference`, `payment_attachment`, `payment_date`, `payment_status`, `status`) VALUES ('$utility_id','$renter','$utility_type_id','$payment_type_id','$payment_amount','$payment_reference','$fileName','$payment_date','$payment_status','$status')");

                if($query_run){

                    $string = <<<EOD
                    Dear $fullname\r\nThanks for paying your $utility_type_name bill. Your payment was processed. Please wait for verification. Thank you.
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

                    $_SESSION['status'] = "Payment added successfully";
                    $_SESSION['status_code'] = "success";
                    header("Location: " . base_url . "renter/home/payment");
                    exit(0);
                }
                else{
                    $_SESSION['status'] = "Payment was not added";
                    $_SESSION['status_code'] = "error";
                    header("Location: " . base_url . "renter/home/payment");
                    exit(0);
                }
            } else { // Other bills
                // Getting the data from utility_type
                $check_billing_type = mysqli_query($con, "SELECT * FROM `utility_type` WHERE `utility_type_id` = '$utility_type_id'");
                $billing_type = $check_billing_type->fetch_assoc();
                $bill = strtolower($billing_type['utility_type_name']);

                $stmt_run2 = mysqli_query($con, "SELECT * FROM `utility` WHERE user_id = '$renter' AND `utility_type_id` = '$utility_type_id' AND DATE_FORMAT(`utility_date`, '%Y-%m') = '$thismonth' AND `utility_status` != 'Archive'");
                if (mysqli_num_rows($stmt_run2) > 0){
                    $query_run_update = mysqli_query($con, "UPDATE `utility` SET `is_payment_made` = '1' WHERE `user_id` = '$renter' AND `utility_type_id` = '$utility_type_id'");
                    $query_run = mysqli_query($con, "INSERT INTO `payment`(`utility_id`, `user_id`, `utility_type_id`, `payment_type_id`, `payment_amount`, `payment_reference`, `payment_attachment`, `payment_date`, `payment_status`, `status`) VALUES ('$utility_id','$renter','$utility_type_id','$payment_type_id','$payment_amount','$payment_reference','$fileName','$payment_date','$payment_status','$status')");

                    if($query_run){

                        $string = <<<EOD
                        Dear $fullname\r\nThanks for paying your $utility_type_name bill. Your payment was processed. Please wait for verification. Thank you.
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

                        $_SESSION['status'] = "Payment added successfully";
                        $_SESSION['status_code'] = "success";
                        header("Location: " . base_url . "renter/home/payment");
                        exit(0);
                    }
                    else{
                        $_SESSION['status'] = "Payment was not added";
                        $_SESSION['status_code'] = "error";
                        header("Location: " . base_url . "renter/home/payment");
                        exit(0);
                    }
                } else {
                    $_SESSION['status'] = "You have not have billing in $bill.";
                    $_SESSION['status_code'] = "error";
                    header("Location: " . base_url . "renter/home/payment");
                    exit(0);
                }
            }
        }
    }

    //Delete payment
    if(isset($_POST['delete_payment'])){
        $payment_id= $_POST['payment_id'];

        // Getting the data from utility
        $get_bill_type = mysqli_query($con, "SELECT * FROM `payment` INNER JOIN `utility` ON utility.user_id = payment.user_id WHERE `payment`.`user_id` = '$user_id'");
        $billing_type = $get_bill_type->fetch_assoc();
        $bill_id = $billing_type['utility_type_id'];

        $query = "DELETE FROM `payment` WHERE `payment_id` = '$payment_id'";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $update_status = mysqli_query($con, "UPDATE `utility` SET `is_payment_made` = '0' WHERE `user_id` = '$user_id' AND `utility_type_id` = '$bill_id'");

            $_SESSION['status'] = "Payment deleted successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "renter/home/payment");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Payment was not delete";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "renter/home/payment");
            exit(0);
        }
    }
?>