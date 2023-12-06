<?php
    include('db_conn.php');

    if(isset($_POST['btn_login'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $login_query = "SELECT * FROM user WHERE `email` = '$email' AND password = '$password' AND `status` = 'Active' LIMIT 1";
        $login_query_run = mysqli_query($con, $login_query);

        if(mysqli_num_rows($login_query_run) > 0){
            foreach($login_query_run as $data){
                $user_id = $data['user_id'];
                $full_name = $data['fname'].' '.$data['lname'];
                $role_as = $data['type'];
                $user_email = $data['email'];
            }

            $_SESSION['auth'] = true;
            $_SESSION['auth_role'] = "$role_as";
            $_SESSION['auth_user'] = [
                'user_id' =>$user_id,
                'user_name' =>$full_name,
                'user_email' =>$user_email,
            ];

            if( $_SESSION['auth_role'] == 'Admin'){
                header("Location: " . base_url . "admin");
                exit(0);
            }
            elseif( $_SESSION['auth_role'] == 'Staff'){
                header("Location: " . base_url . "staff");
                exit(0);
            }
            elseif( $_SESSION['auth_role'] == 'Renter'){
                header("Location: " . base_url . "renter");
                exit(0);
            }
        }
        else {
            $_SESSION['status'] = "Invalid Email or Password";
            $_SESSION['status_code'] = "warning";
            header("Location: " . base_url . "login");
            exit(0);
        }
    }
    else {
        $_SESSION['status'] = "You are not allowed to access this site";
        $_SESSION['status_code'] = "error";
        header("Location: " . base_url . "login");
        
        exit(0);
    }

?>