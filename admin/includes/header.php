<?php include ('authentication.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Meta for website -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Rental Properties Mamangement System with SMS notifications">
        <meta name="author" content="Management System, Rental Properties, SMS, Generate Reports">\
        <!-- Website Title -->
        <title>RPM System | Admin</title>
        <!-- Bootstrap CSS -->
        <link href="<?php echo base_url ?>assets/css/styles.css" rel="stylesheet" />
        <!-- Website Logo -->
        <link rel="icon" type="image/x-icon" href="<?php echo base_url ?>assets/img/favicon.png" />
        <!-- Icons -->
        <script data-search-pseudo-elements defer src="<?php echo base_url ?>assets/vendor/font-awesome/js/all.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url ?>assets/vendor/feather-icons/feather.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="nav-fixed">
        <?php 
            include ('navbar.php'); 
            include ('sidebar.php');
            include ('../../message.php');
        ?>