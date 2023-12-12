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

    // Add payment
    if(isset($_POST["add_payment"])){
        $add_renter = $_POST['add_renter'];
        $pay_rent_cash_advance = $_POST['pay_rent_cash_advance'];
        $utilities_type_id = $_POST['pay_rent'] . $_POST['utilities_type_id'] . $_POST['pay_cash_advance'];
        $payment_amount = $_POST['payment_amount'];
        $utilities_id = $_POST['utilities_id'];
        $payment_type_id = '1';
        $payment_date = date;
        $thismonth = date('Y-m');
        $status = 'Active';
        $is_cash_advance = 0;
        $is_too_much_cash = 0;

        $check_billing_sql = "SELECT * FROM `payment` WHERE user_id = '$add_renter' AND `utilities_type_id` = '$utilities_type_id' AND DATE_FORMAT(`payment_date`, '%Y-%m') = '$thismonth' AND `status` != 'Archive'";
        $check_billing_sql_run = mysqli_query($con, $check_billing_sql);

        // SQL for getting the database
        $sql_query = $con->query("SELECT * FROM utilities_type WHERE utilities_type_id = '$utilities_type_id'");
        $utilities_type_result = $sql_query->fetch_assoc();

        $stmt_query = $con->query("SELECT * FROM user WHERE user_id = '$add_renter'");
        $user = $stmt_query->fetch_assoc();

        $fullname = $user['fname'] .' '. $user['mname'] .' '. $user['lname'] .' '. $user['suffix'];
        $utilities_type_name = $utilities_type_result['utilities_type_name'];
        $email = $user['email'];
        $phone = $user['phone'];

        if (mysqli_num_rows($check_billing_sql_run) > 0) {
            $_SESSION['status'] = "The selected user has already paid this month.";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/payment");
            exit(0);
        } else {
            if ($utilities_type_id == '1'){ // if the payment is rent. Else for other bills
                if(!$pay_rent_cash_advance){ // if the payment is not using payment advanced.
                    $stmt_run1 = mysqli_query($con, "SELECT * FROM `property` WHERE rented_by = '$add_renter' AND `property_status` = 'Rented'");
                    if (mysqli_num_rows($stmt_run1) > 0){
                        while ($renter_row = $stmt_run1->fetch_assoc()) {
                            $payment_remaining = $renter_row['property_amount'] - $payment_amount;
                            break; // exit the loop after the first iteration
                        }
                    } else {
                        $_SESSION['status'] = "The selected user does not have in property rented.";
                        $_SESSION['status_code'] = "error";
                        header("Location: " . base_url . "admin/home/payment");
                        exit(0);
                    }
                } else { // the user is using payment advanced.
                    $check_balance_cash_advance = mysqli_query($con,"SELECT * FROM property WHERE rented_by = '$add_renter' AND `property_status` = 'Rented'");
                    if (mysqli_num_rows($check_balance_cash_advance) > 0){
                        $utilities_type_id = '1';
                        while ($results_row = $check_balance_cash_advance->fetch_assoc()) {
                            $payment_amount = $results_row['property_cash_advance'];
                            if($payment_amount <= 0){
                                $_SESSION['status'] = "The selected user does not have balance in cash advance.";
                                $_SESSION['status_code'] = "error";
                                header("Location: " . base_url . "admin/home/payment");
                                exit(0);
                            }
                            // Balance deduction
                            $cash_advanced_balance = $payment_amount - $results_row['property_amount'];
                            $cash_advanced_balance = max(0, $cash_advanced_balance);

                            // Reamining Balance
                            $payment_remaining = $results_row['property_amount'] - $payment_amount;
                            $is_cash_advance++;
                            if($results_row['property_amount'] < $payment_amount){ // Kung ang user is dako ang payment advance compared sa property amount will set the payment amount accordingly sa price sa property.
                                $payment_amount = $results_row['property_amount'];
                            }
                            break; // exit the loop after the first iteration
                        }
                    } else {
                        $_SESSION['status'] = "The selected user does not have in property rented.";
                        $_SESSION['status_code'] = "error";
                        header("Location: " . base_url . "admin/home/payment");
                        exit(0);
                    }
                    $run_query = mysqli_query($con, "UPDATE `property` SET `property_cash_advance` = '$cash_advanced_balance' WHERE `rented_by` = '$add_renter' AND `property_status` = 'Rented'");
                }
            } else { // other bills here...

                // Get the SQL statement from utilities how much their utilites payment
                $stmt_run2 = mysqli_query($con, "SELECT * FROM `utilities` WHERE user_id = '$add_renter' AND `utilities_type_id` = '$utilities_type_id' AND DATE_FORMAT(`utilities_date`, '%Y-%m') = '$thismonth' AND `utilities_status` != 'Archive'");
                if (mysqli_num_rows($stmt_run2) > 0){
                    while ($renter_row = $stmt_run2->fetch_assoc()) {
                        $payment_remaining = $renter_row['utilities_amount'] - $payment_amount;
                        break; // exit the loop after the first iteration
                    }
                } else {
                    $_SESSION['status'] = "The selected user does not have in utilities payment.";
                    $_SESSION['status_code'] = "error";
                    header("Location: " . base_url . "admin/home/payment");
                    exit(0);
                }
            }
            if($payment_remaining > 0){ // check if the payment remaining is 0 or not.
                $payment_status = 'Partial';
            } else {
                if($payment_remaining < '-1'){ // if the payment is sobra...
                    $is_too_much_cash = '1'; // mark the payment as sobra...
                    if(!$pay_rent_cash_advance){ // user use cash advance payment.
                        $run_select_query = mysqli_query($con,"SELECT * FROM property WHERE rented_by = '$add_renter' AND `property_status` = 'Rented'");
                        $check_balance_remaining = $run_select_query->fetch_assoc();
                        $new_payment_remaining = $check_balance_remaining['property_cash_advance'] + abs($payment_remaining);

                        // Run SQL UPDATE the property cash advance query
                        $run_update_query = mysqli_query($con, "UPDATE `property` SET `property_cash_advance` = '$new_payment_remaining' WHERE `rented_by` = '$add_renter' AND `property_status` = 'Rented'");
                    }
                    $payment_remaining = '0.00';
                }
                $payment_status = 'Paid';
            }
        }

        // Run the SQL INSERT statement to insert the new payment.
        $query_run = mysqli_query($con, "INSERT INTO `payment`(`user_id`, `utilities_type_id`, `is_cash_advance`, `is_cash_deposit`, `payment_type_id`, `payment_amount`, `payment_remaining`, `payment_date`, `payment_status`, `status`) VALUES ('$add_renter','$utilities_type_id','$is_cash_advance','$is_too_much_cash','$payment_type_id','$payment_amount','$payment_remaining','$payment_date','$payment_status','$status')");

        // Run the SQL SELECT statement to get the values from the database to apply for the SMS such as payment_amount and payment_status.
        $get_sql = $con->query("SELECT * FROM `payment` WHERE user_id = '$add_renter' AND `utilities_type_id` = '$utilities_type_id' AND DATE_FORMAT(`payment_date`, '%Y-%m') = '$thismonth' AND `status` != 'Archive'");
        $status_paid = $get_sql->fetch_assoc();
        $status_paid_name = strtolower($status_paid['payment_status']);

        if($query_run){
            $YearandMonth = date('F Y');
            // PHP Compose Mail
            $name = 'Rental Properties Management System';
            // $subject = htmlentities(date('F Y').' Payment Notice - ' . $name);
            // $message = nl2br("Dear $fullname \r\n \r\n Thanks for paying your $utilities_type_name bill. The amount you $status_paid_name is &#8369;$payment_amount, for the month of $YearandMonth.");
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
            // if(!$pay_rent_cash_advance){ // chec if the user is not paid in cash advance will go to else if the user is paid via cash advance.
            //     $string = <<<EOD
            //     Dear $fullname\r\nThanks for paying your $utilities_type_name bill. The amount you $status_paid_name is ₱$payment_amount, for the month of $YearandMonth.
            //     EOD;
            // } else {
            //     $string = <<<EOD
            //     Dear $fullname\r\nYou have used your payment advance for paying $utilities_type_name bill. The amount you $status_paid_name is ₱$payment_amount, and your balance for payment advance is ₱$cash_advanced_balance for the month of $YearandMonth.
            //     EOD;
            // }
            $string = <<<EOD
                Dear $fullname\r\nThanks for paying your $utilities_type_name bill. The amount you $status_paid_name is ₱$payment_amount, for the month of $YearandMonth.
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
            header("Location: " . base_url . "admin/home/payment");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Payment was not added";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/payment");
            exit(0);
        }
    }

    // Edit payment
    if(isset($_POST["edit_payment"])){
        $payment_id = $_POST["payment_id"];
        $payment_amount = $_POST['payment_amount'];
        $is_too_much_cash_current = 0;

        // For online payment
        $payment_status = $_POST['payment_status'];
        $payment_comment = $_POST['payment_comment'];
        $YearandMonth = date('F Y');

        $stmt = "SELECT * FROM `payment` WHERE payment_id = '$payment_id'";
        $stmt_run = mysqli_query($con, $stmt);
        $status_row = $stmt_run->fetch_assoc();
        $add_renter = $status_row['user_id'];
        $utilities_type_id = $status_row['utilities_type_id'];
        $payment_type_id = $status_row['payment_type_id'];
        $is_too_much_cash = $status_row['is_cash_deposit'];
        $last_amount = $status_row['payment_amount'];

        // Retrieve the full name of user renter
        // SQL for getting the database
        $sql_query = $con->query("SELECT * FROM utilities_type WHERE utilities_type_id = '$utilities_type_id'");
        $utilities_type_result = $sql_query->fetch_assoc();

        $stmt_query = $con->query("SELECT * FROM user WHERE user_id = '$add_renter'");
        $user = $stmt_query->fetch_assoc();

        $check_balance_cash_advance = mysqli_query($con,"SELECT * FROM `property` WHERE rented_by = '$add_renter' AND `property_status` = 'Rented'");
        while ($results_row = $check_balance_cash_advance->fetch_assoc()) {
            $current_balance_cash_advance = $results_row['property_cash_advance'];
            break; // exit the loop after the first iteration
        }

        $fullname = $user['fname'] .' '. $user['mname'] .' '. $user['lname'] .' '. $user['suffix'];
        $utilities_type_name = $utilities_type_result['utilities_type_name'];
        $email = $user['email'];
        $phone = $user['phone'];

        if($payment_type_id == '1'){ // For Cash payment
            if($is_too_much_cash = '1'){ // If sobra ang g bayad sa pag edit.

                // Calculation for edit payment if the cash is too much.
                $update_cash_advance = $last_amount - $payment_amount;
                $new_payment_remaining = $current_balance_cash_advance - $update_cash_advance;
                $run_update_query_cash_advance = mysqli_query($con,"UPDATE `property` SET `property_cash_advance` = '$new_payment_remaining' WHERE `rented_by` = '$add_renter' AND `property_status` = 'Rented'");

                if ($utilities_type_id == '1') { // If payment was rent
                    // SQL Query
                    $stmt = "SELECT * FROM `property` WHERE rented_by = '$add_renter' AND `property_status` = 'Rented'";
                    $stmt_run = mysqli_query($con,$stmt);
                    if ($stmt_run){
                        while ($renter_row = $stmt_run->fetch_assoc()) {
                            $payment_remaining = $renter_row['property_amount'] - $payment_amount;
                            break; // exit the loop after the first iteration
                        }
                    } else {
                        $_SESSION['status'] = "The selected user does not have in property rented.";
                        $_SESSION['status_code'] = "error";
                        header("Location: " . base_url . "admin/home/payment");
                        exit(0);
                    }
                } else { // Payment for other bills
                    // SQL Query
                    $stmt = "SELECT * FROM `utilities` WHERE user_id = '$add_renter' AND `utilities_type_id` = '$utilities_type_id' AND `utilities_date` = '$thismonth'";
                    $stmt_run = mysqli_query($con,$stmt);
                    if ($stmt_run){
                        while ($renter_row = $stmt_run->fetch_assoc()) {
                            $payment_remaining = $renter_row['utilities_amount'] - $payment_amount;
                            break; // exit the loop after the first iteration
                        }
                    } else {
                        $_SESSION['status'] = "The selected user does not have in utilities payment.";
                        $_SESSION['status_code'] = "error";
                        header("Location: " . base_url . "admin/home/payment");
                        exit(0);
                    }
                }
            } else { // If dili sobra ang g bayad sa pag edit.
                if ($utilities_type_id == '1') {
                    // SQL Query
                    $stmt = "SELECT * FROM `property` WHERE rented_by = '$add_renter' AND `property_status` = 'Rented'";
                    $stmt_run = mysqli_query($con,$stmt);
                    if ($stmt_run){
                        while ($renter_row = $stmt_run->fetch_assoc()) {
                            $payment_remaining = $renter_row['property_amount'] - $payment_amount;
                            break; // exit the loop after the first iteration
                        }
                    } else {
                        $_SESSION['status'] = "The selected user does not have in property rented.";
                        $_SESSION['status_code'] = "error";
                        header("Location: " . base_url . "admin/home/payment");
                        exit(0);
                    }
                } else {
                    // SQL Query
                    $stmt = "SELECT * FROM `utilities` WHERE user_id = '$add_renter' AND `utilities_type_id` = '$utilities_type_id' AND `utilities_date` = '$thismonth'";
                    $stmt_run = mysqli_query($con,$stmt);
                    if ($stmt_run){
                        while ($renter_row = $stmt_run->fetch_assoc()) {
                            $payment_remaining = $renter_row['utilities_amount'] - $payment_amount;
                            break; // exit the loop after the first iteration
                        }
                    } else {
                        $_SESSION['status'] = "The selected user does not have in utilities payment.";
                        $_SESSION['status_code'] = "error";
                        header("Location: " . base_url . "admin/home/payment");
                        exit(0);
                    }
                }
            }
            if($payment_remaining > 0){
                $payment_status = 'Partial';
            } else {
                if($payment_remaining < '-1'){ // if the payment is sobra...
                    $is_too_much_cash_current = '1'; // mark the payment as sobra...
                    $payment_remaining = '0.00';
                }
                $payment_status = 'Paid';
            }

            $query = "UPDATE `payment` SET `is_cash_deposit`='$is_too_much_cash_current',`payment_amount`='$payment_amount',`payment_remaining`='$payment_remaining',`payment_status`='$payment_status' WHERE `payment_id`='$payment_id'";
            $query_run = mysqli_query($con, $query);

        } else { // For online payment
            if($payment_status == 'Reject'){
                $query = "UPDATE `payment` SET `payment_status`='$payment_status', `payment_comment`='$payment_comment' WHERE `payment_id`='$payment_id'";
                $query_run = mysqli_query($con, $query);

                // Getting the data from utilities
                $get_bill_type = mysqli_query($con, "SELECT * FROM `payment` INNER JOIN `utilities` ON utilities.user_id = payment.user_id WHERE `payment`.`user_id` = '$add_renter'");
                $billing_type = $get_bill_type->fetch_assoc();
                $bill_id = $billing_type['utilities_type_id'];
                // SQL Query
                $update_status = mysqli_query($con, "UPDATE `utilities` SET `is_payment_made` = '3' WHERE `user_id` = '$add_renter' AND `utilities_type_id` = '$bill_id'");

                $sms_body = <<<EOD
                Dear $fullname\r\nYour payment on your $utilities_type_name bill was rejected.
                EOD;

                $ch = curl_init();
                $parameters = array(
                'apikey' => smsapikey, // Your API KEY
                'number' => $phone,
                'message' => $sms_body,
                'sendername' => smsapiname
                );
                curl_setopt($ch, CURLOPT_URL, 'https://api.semaphore.co/api/v4/messages');
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $output = curl_exec($ch);
                curl_close($ch);
                echo $output;
            } else {
                $query = "UPDATE `payment` SET `payment_amount`='$payment_amount',`payment_remaining`='$payment_remaining',`payment_status`='$payment_status' WHERE `payment_id`='$payment_id'";
                $query_run = mysqli_query($con, $query);

                // Getting the data from utilities
                $get_bill_type = mysqli_query($con, "SELECT * FROM `payment` INNER JOIN `utilities` ON utilities.user_id = payment.user_id WHERE `payment`.`user_id` = '$add_renter'");
                $billing_type = $get_bill_type->fetch_assoc();
                $bill_id = $billing_type['utilities_type_id'];
                // SQL Query
                $update_status = mysqli_query($con, "UPDATE `utilities` SET `is_payment_made` = '2' WHERE `user_id` = '$add_renter' AND `utilities_type_id` = '$bill_id'");

                $sms_body = <<<EOD
                Dear $fullname\r\nThanks for paying your $utilities_type_name bill was approved. The amount you $payment_status is ₱$payment_amount, for the month of $YearandMonth.
                EOD;

                $ch = curl_init();
                $parameters = array(
                'apikey' => smsapikey, // Your API KEY
                'number' => $phone,
                'message' => $sms_body,
                'sendername' => smsapiname
                );
                curl_setopt($ch, CURLOPT_URL, 'https://api.semaphore.co/api/v4/messages');
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $output = curl_exec($ch);
                curl_close($ch);
                echo $output;
            }
        }

        if($query_run){
            $_SESSION['status'] = "Payment updated successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/payment");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Payment was not update";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/payment");
            exit(0);
        }
    }

    //Delete payment
    if(isset($_POST['delete_payment'])){
        $payment_id= $_POST['payment_id'];
        $query = "UPDATE `payment` SET `status` = 'Archive' WHERE payment_id = $payment_id ";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Payment deleted successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/payment");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Payment was not delete";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/payment");
            exit(0);
        }
    }
?>