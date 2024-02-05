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
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $suffix = $_POST['suffix'];
        $gender = $_POST['gender'];
        $civil_status = $_POST['civil_status'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

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
            $customFileName = 'user_' . date('Ymd_His'); // replace with your desired file name
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
                        $uploadDir = '../../assets/files/user/';
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
                            $query = "UPDATE `user` SET `profile`='$fileName' WHERE `user_id` = '$user_id'";
                            $query_run = mysqli_query($con, $query);
                            if ($query_run) {
                                $_SESSION['status'] = "Account updated successfully";
                                $_SESSION['status_code'] = "success";
                                header("Location: " . base_url . "admin/home/myaccount");
                                exit(0);
                            } else {
                                $_SESSION['status'] = "Account was not updated";
                                $_SESSION['status_code'] = "error";
                                header("Location: " . base_url . "admin/home/myaccount");
                                exit(0);
                            }
                        }
                    } else {
                        $_SESSION['status'] = "File is too large, must be 5MB or below";
                        $_SESSION['status_code'] = "warning";
                        header("Location: " . base_url . "admin/home/myaccount");
                        exit(0);
                    }
                } else {
                    $_SESSION['status'] = "File error";
                    $_SESSION['status_code'] = "error";
                    header("Location: " . base_url . "admin/home/myaccount");
                    exit(0);
                }
            } else {
                $_SESSION['status'] = "Invalid file type";
                $_SESSION['status_code'] = "error";
                header("Location: " . base_url . "admin/home/myaccount");
                exit(0);
            }
        }

        $query = "UPDATE `user` SET `fname`='$fname', `mname`='$mname', `lname`='$lname', `suffix`= '$suffix', `gender`='$gender', `civil_status`='$civil_status', `email`='$email', `phone`='$phone' WHERE `user_id`='$user_id'";
        $query_run = mysqli_query($con, $query);
        if ($query_run) {
            $_SESSION['status'] = "Account updated successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/myaccount");
            exit(0);
        } else {
            $_SESSION['status'] = "Account was not updated";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/myaccount");
            exit(0);
        }
    }

    // -------------------------------- Change Password -------------------------------- //
    if (isset($_POST["btn_change_password"])) {
        $currentPassword = $_POST['currentPassword'];
        $password = $_POST['confirmPassword'];

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
                    header("Location: " . base_url . "admin/home/myaccount");
                    exit(0);
                } else {
                    $_SESSION['status'] = "Password was not updated";
                    $_SESSION['status_code'] = "error";
                    header("Location: " . base_url . "admin/home/myaccount");
                    exit(0);
                }
            } else{
                $_SESSION['status'] = "Incorrect current password";
                $_SESSION['status_code'] = "warning";
                header("Location: " . base_url . "admin/home/myaccount");
                exit(0);
            }
        }
    }
?>