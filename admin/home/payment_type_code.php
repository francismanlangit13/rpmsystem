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
    if(isset($_POST["add_payment_type"])){
        $payment_type_name = $_POST['payment_type_name'];
        $payment_account_number = $_POST['payment_account_number'];
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
                        $uploadDir = '../../assets/files/online_payment/';
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
                        header("Location: " . base_url . "admin/home/payment_type");
                        exit(0);
                    }
                } else {
                    $_SESSION['status'] = "File error";
                    $_SESSION['status_code'] = "error";
                    header("Location: " . base_url . "admin/home/payment_type");
                    exit(0);
                }
            } else {
                $_SESSION['status'] = "Invalid file type";
                $_SESSION['status_code'] = "error";
                header("Location: " . base_url . "admin/home/payment_type");
                exit(0);
            }
        }

        $query = "INSERT INTO `payment_type`(`payment_type_name`, `payment_type_account_number`, `payment_type_attachment`, `payment_type_status`) VALUES ('$payment_type_name','$payment_account_number','$fileName','$status')";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Payment Type added successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/payment_type");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Payment Type was not added";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/payment_type");
            exit(0);
        }
    }

    // Edit payment
    if(isset($_POST["edit_payment_type"])){
        $payment_type_id = $_POST["payment_type_id"];
        $payment_type_name = $_POST['payment_type_name'];
        $payment_account_number = $_POST['payment_account_number'];
        $status = $_POST['status'];

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
                        $uploadDir = '../../assets/files/online_payment/';
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
                            $query = "UPDATE `payment_type` SET `payment_type_attachment`='$fileName' WHERE `payment_type_id` = '$payment_type_id'";
                            $query_run = mysqli_query($con, $query);
                        }
                    } else {
                        $_SESSION['status'] = "File is too large, must be 5MB or below";
                        $_SESSION['status_code'] = "warning";
                        header("Location: " . base_url . "admin/home/payment_type");
                        exit(0);
                    }
                } else {
                    $_SESSION['status'] = "File error";
                    $_SESSION['status_code'] = "error";
                    header("Location: " . base_url . "admin/home/payment_type");
                    exit(0);
                }
            } else {
                $_SESSION['status'] = "Invalid file type";
                $_SESSION['status_code'] = "error";
                header("Location: " . base_url . "admin/home/payment_type");
                exit(0);
            }
        }

        $query = "UPDATE `payment_type` SET `payment_type_name`='$payment_type_name', `payment_type_account_number`='$payment_account_number', `payment_type_status`='$status' WHERE `payment_type_id`='$payment_type_id'";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Payment Type updated successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/payment_type");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Payment Type was not update";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/payment_type");
            exit(0);
        }
    }

    //Delete payment
    if(isset($_POST['delete_payment_type'])){
        $payment_type_id= $_POST['payment_type_id'];
        $query = "UPDATE `payment_type` SET `payment_type_status` = 'Archive' WHERE payment_type_id = $payment_type_id ";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Payment Type deleted successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/payment_type");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Payment Type was not delete";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/payment_type");
            exit(0);
        } 
    }
?>