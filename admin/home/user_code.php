<?php
    include('../../db_conn.php');

    // Add user account
    if(isset($_POST["add_user"])){
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $pass = $_POST['password'];
        $type = $_POST['role'];
        //$new_password = substr(md5(microtime()),rand(0,26),9);
        $password = md5($pass);
        $status = 'Active';

        $query = "INSERT INTO `user`(`fname`, `mname`, `lname`, `gender`, `email`, `phone`, `password`, `status`, `type`) VALUES ('$fname','$mname','$lname','$gender','$email','$phone','$password','$status','$type')";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "User added successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/user");
            exit(0);
        }
        else{
            $_SESSION['status'] = "User was not added";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/user");
            exit(0);
        }
    }

    // Edit user account
    if(isset($_POST["edit_user"])){
        $user_id = $_POST["user_id"];
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $type = $_POST['role'];
        $status = $_POST['status'];

        $query = "UPDATE `user` SET `fname`='$fname',`mname`='$mname',`lname`='$lname',`gender`='$gender',`email`='$email',`phone`='$phone',`status`='$status',`type`='$type' WHERE `user_id`='$user_id'";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "User updated successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/user");
            exit(0);
        }
        else{
            $_SESSION['status'] = "User was not update";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/user");
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
            header("Location: " . base_url . "admin/home/user");
            exit(0);
        }
        else{
            $_SESSION['status'] = "User was not delete";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/user");
            exit(0);
        } 
    }
?>